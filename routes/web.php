<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public.index');
});

Route::get('/berita/{slug}', function ($slug = 'kegiatan-rutin-rkm-al-jannah-bulan-ini') {
    return view('public.berita-detail');
})->name('post.show');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/daftar', function () {
    return view('public.pendaftaran');
})->name('register');
