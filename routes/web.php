<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/berita/{slug}', function ($slug = 'kegiatan-rutin-rkm-al-jannah-bulan-ini') {
    return view('post-detail');
})->name('post.show');
