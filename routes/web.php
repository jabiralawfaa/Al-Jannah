<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;

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

Route::get('/sekretaris', function () {
    return view('dashboard.sekretaris.index');
})->name('sekretaris.dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/superadmin/file', [SuperAdminController::class, 'fileIndex'])->name('superadmin.file');
    Route::post('/superadmin/file/upload', [SuperAdminController::class, 'uploadFile'])->name('superadmin.file.upload');
    Route::get('/superadmin/file/{id}/download', [SuperAdminController::class, 'downloadFile'])->name('superadmin.file.download');
    Route::put('/superadmin/user/{id}', [SuperAdminController::class, 'updateUser'])->name('superadmin.user.update');
    Route::post('/superadmin/user', [SuperAdminController::class, 'storeUser'])->name('superadmin.user.store');
});
