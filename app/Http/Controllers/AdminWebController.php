<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Post;
use App\Models\Page;
use App\Models\Category;
use App\Services\FileRenamer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminWebController extends Controller
{
    public function index()
    {
        $jumlahPosts = Post::count();
        $jumlahPages = Page::count();
        $jumlahKategori = Category::count();
        $jumlahPengunjung = 0;

        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $pengunjungPerBulan = array_fill(0, 12, 0);

        return view('dashboard.adminweb.index', compact(
            'jumlahPosts',
            'jumlahPages',
            'jumlahKategori',
            'jumlahPengunjung',
            'bulan',
            'pengunjungPerBulan'
        ));
    }

    public function posts(Request $request)
    {
        $search = $request->get('search');

        $posts = Post::with(['category', 'media'])
            ->when($search, function ($query, $search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhereHas('category', function ($cq) use ($search) {
                          $cq->where('name', 'like', "%{$search}%");
                      });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = Category::all();

        return view('dashboard.adminweb.posts', compact('posts', 'categories'));
    }

    public function storeCategory(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        $data['slug'] = Str::slug($data['name']);

        Category::create($data);

        return redirect()->route('adminweb.posts')->with('success', 'Kategori "' . e($data['name']) . '" berhasil ditambahkan.');
    }

    public function createPost()
    {
        return view('dashboard.adminweb.editor');
    }

    public function editPost($id)
    {
        $post = Post::with('category')->findOrFail($id);
        return view('dashboard.adminweb.editor', compact('post'));
    }

    public function publishPost($id)
    {
        $post = Post::findOrFail($id);
        $post->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        return redirect()->route('adminweb.posts')->with('success', 'Postingan "' . e($post->title) . '" berhasil diterbitkan.');
    }

    public function destroyPost($id)
    {
        $post = Post::findOrFail($id);
        $title = $post->title;
        $post->delete();

        return redirect()->route('adminweb.posts')->with('success', 'Postingan "' . e($title) . '" berhasil dihapus.');
    }

    public function editPage($id)
    {
        $page = Page::findOrFail($id);

        if ($page->slug === 'beranda') {
            $data = json_decode($page->content, true) ?? [];
            return view('dashboard.adminweb.page-edit-beranda', compact('page', 'data'));
        }

        return view('dashboard.adminweb.page-edit', compact('page'));
    }

    public function updatePage(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        if ($page->slug === 'beranda') {
            $request->validate([
                'services.items.*.image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
                'member_benefits.items.*.image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            ]);

            $data = $this->sanitizeData($request->except('_token', '_method'));

            if (isset($data['services']['items'])) {
                foreach ($data['services']['items'] as $i => &$svc) {
                    if ($request->hasFile("services.items.{$i}.image_file")) {
                        $svc['image'] = $this->storePageImage($request->file("services.items.{$i}.image_file"));
                    } else {
                        $svc['image'] = $svc['existing_image'] ?? '';
                    }
                    unset($svc['existing_image']);
                }
            }

            if (isset($data['member_benefits']['items'])) {
                foreach ($data['member_benefits']['items'] as $i => &$item) {
                    if ($request->hasFile("member_benefits.items.{$i}.image_file")) {
                        $item['image'] = $this->storePageImage($request->file("member_benefits.items.{$i}.image_file"));
                    } else {
                        $item['image'] = $item['existing_image'] ?? '';
                    }
                    unset($item['existing_image']);
                }
            }

            $page->update([
                'content' => json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT),
            ]);

            return redirect()->route('adminweb.pages.edit', $id)
                ->with('success', 'Halaman Beranda berhasil diperbarui.');
        }

        $page->update($request->only(['title', 'content']));

        return redirect()->route('adminweb.pages.edit', $id)
            ->with('success', 'Halaman "' . e($page->title) . '" berhasil diperbarui.');
    }

    private function storePageImage($file): string
    {
        $storedName = FileRenamer::rename($file->getClientOriginalName());
        $path = $file->storeAs('page-images', $storedName, 'local');
        $fileSize = Storage::disk('local')->size($path);

        $media = Media::create([
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'file_size' => $fileSize,
        ]);

        return (string) $media->id;
    }

    private function sanitizeData(array $data): array
    {
        $sanitizer = new \Symfony\Component\HtmlSanitizer\HtmlSanitizer(
            (new \Symfony\Component\HtmlSanitizer\HtmlSanitizerConfig)
                ->allowSafeElements()
                ->allowRelativeLinks()
                ->allowAttribute('class', allowedElements: '*')
                ->allowAttribute('style', allowedElements: '*')
                ->allowAttribute('href', allowedElements: 'a')
                ->allowAttribute('target', allowedElements: 'a')
                ->withMaxInputLength(500000),
        );

        array_walk_recursive($data, function (&$value) use ($sanitizer) {
            if (is_string($value)) {
                $value = $sanitizer->sanitize($value);
            }
        });

        return $data;
    }

    public function pages(Request $request)
    {
        $search = $request->get('search');

        $pages = Page::with('media')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->when(!$search, function ($query) {
                return $query->orderByRaw("CASE WHEN slug = 'beranda' THEN 0 ELSE 1 END");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.adminweb.pages', compact('pages'));
    }

    public function publishPage($id)
    {
        $page = Page::findOrFail($id);
        $page->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        return redirect()->route('adminweb.pages')->with('success', 'Halaman "' . e($page->title) . '" berhasil diterbitkan.');
    }

    public function destroyPage($id)
    {
        $page = Page::findOrFail($id);
        $title = $page->title;
        $page->delete();

        return redirect()->route('adminweb.pages')->with('success', 'Halaman "' . e($title) . '" berhasil dihapus.');
    }
}
