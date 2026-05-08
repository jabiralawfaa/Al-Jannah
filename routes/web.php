<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\FileOrganisasi;
use App\Models\LogSuperadmin;

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

Route::get('/superadmin', function () {
    $users = User::all();
    $files = FileOrganisasi::all();
    $logs = LogSuperadmin::all();
    
    return view('dashboard.superadmin.index', compact('users', 'files', 'logs'));
})->name('superadmin.dashboard');

Route::post('/logout', function () {
    return redirect('/login');
})->name('logout');
