<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Page;
use App\Models\Category;
use Illuminate\Http\Request;
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
        return view('errors.555');
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
