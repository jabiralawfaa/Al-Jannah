<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\User;
use App\Models\FileOrganisasi;
use App\Models\LogSuperadmin;

Route::get('/', function () {
    return view('public.index');
})->name('home');

Route::get('/berita/{slug}', function ($slug = 'kegiatan-rutin-rkm-al-jannah-bulan-ini') {
    return view('public.berita-detail');
})->name('post.show');

Route::get('/daftar', function () {
    return view('public.pendaftaran');
})->name('register');

Route::get('/anggota', function () {
    return view('public.anggota');
})->name('anggota');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/superadmin', function () {
        $users = User::all();
        $files = FileOrganisasi::all();
        $logs = LogSuperadmin::all();

        return view('dashboard.superadmin.index', compact('users', 'files', 'logs'));
    })->name('superadmin.dashboard');
});
