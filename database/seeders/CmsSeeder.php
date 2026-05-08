<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Media;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CmsSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::create([
            'name' => 'Berita Umum',
            'slug' => 'berita-umum',
        ]);

        $media = Media::create([
            'file_name' => 'placeholder.jpg',
            'file_path' => 'images/placeholder.jpg',
            'mime_type' => 'image/jpeg',
            'file_size' => 102400,
            'dimensions' => '1920x1080',
            'alt_text' => 'Gambar placeholder',
        ]);

        $posts = [
            [
                'title' => 'Kegiatan Rutin Bulanan Al-Jannah',
                'slug' => 'kegiatan-rutin-bulanan-al-jannah',
                'content' => '<p>Alhamdulillah, kegiatan rutin bulanan Al-Jannah berlangsung dengan lancar. Kegiatan ini dihadiri oleh seluruh anggota dan pengurus.</p>',
                'media_id' => $media->id,
                'status' => 'published',
                'published_at' => now(),
                'category_id' => $category->id,
            ],
            [
                'title' => 'Program Sosial untuk Masyarakat',
                'slug' => 'program-sosial-untuk-masyarakat',
                'content' => '<p>Program sosial Al-Jannah telah disalurkan ke beberapa keluarga yang membutuhkan di sekitar wilayah Banyuwangi.</p>',
                'media_id' => $media->id,
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'category_id' => $category->id,
            ],
            [
                'title' => 'Rapat Pengurus Tahunan',
                'slug' => 'rapat-pengurus-tahunan',
                'content' => '<p>Rapat pengurus tahunan telah dilaksanakan untuk membahas rencana kegiatan tahun depan.</p>',
                'media_id' => $media->id,
                'status' => 'published',
                'published_at' => now()->subDays(7),
                'category_id' => $category->id,
            ],
            [
                'title' => 'Peningkatan Kapasitas Anggota',
                'slug' => 'peningkatan-kapasitas-anggota',
                'content' => '<p>Pelatihan peningkatan kapasitas anggota diadakan untuk meningkatkan kemampuan anggota dalam berkontribusi.</p>',
                'media_id' => $media->id,
                'status' => 'published',
                'published_at' => now()->subDays(10),
                'category_id' => $category->id,
            ],
            [
                'title' => 'Selamat Hari Raya Idul Fitri',
                'slug' => 'selamat-hari-raya-idul-fitri',
                'content' => '<p>Mohon maaf lahir dan batin dari seluruh keluarga besar RKM Al-Jannah.</p>',
                'media_id' => $media->id,
                'status' => 'published',
                'published_at' => now()->subDays(30),
                'category_id' => $category->id,
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }

        $page = Page::create([
            'title' => 'Tentang Kami',
            'slug' => 'tentang-kami',
            'content' => '<p>RKM Al-Jannah adalah sebuah organisasi sosial yang bergerak di bidang kemanusiaan dan keagamaan di Banyuwangi.</p>',
            'media_id' => $media->id,
            'status' => 'published',
            'published_at' => now(),
        ]);

        $menus = [
            [
                'label' => 'Beranda',
                'sort_order' => 1,
                'is_active' => true,
                'custom_url' => '/',
            ],
            [
                'label' => 'Tentang Kami',
                'sort_order' => 2,
                'is_active' => true,
                'page_id' => $page->id,
            ],
            [
                'label' => 'Berita',
                'sort_order' => 3,
                'is_active' => true,
                'custom_url' => '#berita',
            ],
            [
                'label' => 'Daftar',
                'sort_order' => 4,
                'is_active' => true,
                'custom_url' => '/daftar',
            ],
            [
                'label' => 'Login',
                'sort_order' => 5,
                'is_active' => true,
                'custom_url' => '/login',
            ],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
