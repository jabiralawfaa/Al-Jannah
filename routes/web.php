<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SekretarisController;
use App\Http\Controllers\PendaftaranController;

Route::get('/', function () {
    return view('public.index');
})->name('home');

Route::get('/berita/{slug}', function ($slug = 'kegiatan-rutin-rkm-al-jannah-bulan-ini') {
    return view('public.berita-detail');
})->name('post.show');

Route::get('/daftar', [PendaftaranController::class, 'create'])->name('register');
Route::post('/register-member', [PendaftaranController::class, 'store'])->name('register-member.store');

Route::get('/anggota', function () {
    return view('public.anggota');
})->name('anggota');

Route::middleware(['auth', 'role:sekretaris,superadmin'])->group(function () {
    Route::get('/sekretaris', [SekretarisController::class, 'index'])->name('sekretaris.dashboard');
    Route::post('/sekretaris/{id}/verifikasi', [SekretarisController::class, 'verifikasi'])->name('sekretaris.verifikasi');

    Route::get('/sekretaris/anggota', function () {
        return view('dashboard.sekretaris.anggota');
    })->name('sekretaris.anggota');

    Route::get('/sekretaris/log', function () {
        return view('dashboard.sekretaris.log');
    })->name('sekretaris.log');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/superadmin/log', [SuperAdminController::class, 'logIndex'])->name('superadmin.log');
    Route::get('/superadmin/file', [SuperAdminController::class, 'fileIndex'])->name('superadmin.file');
    Route::post('/superadmin/file/upload', [SuperAdminController::class, 'uploadFile'])->name('superadmin.file.upload');
    Route::get('/superadmin/file/{id}/download', [SuperAdminController::class, 'downloadFile'])->name('superadmin.file.download');
    Route::put('/superadmin/user/{id}', [SuperAdminController::class, 'updateUser'])->name('superadmin.user.update');
    Route::post('/superadmin/user', [SuperAdminController::class, 'storeUser'])->name('superadmin.user.store');
});
