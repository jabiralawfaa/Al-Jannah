<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Page;
use App\Models\Category;
use App\Models\User;

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
}
