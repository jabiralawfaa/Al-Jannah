<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SekretarisController;
use App\Http\Controllers\AdminWebController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\LogistikController;
use App\Http\Controllers\BendaharaController;

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

    Route::get('/sekretaris/anggota', [SekretarisController::class, 'anggota'])->name('sekretaris.anggota');

    Route::get('/sekretaris/log', [SekretarisController::class, 'log'])->name('sekretaris.log');

    Route::get('/sekretaris/anggota/{id}/edit', [SekretarisController::class, 'editAnggota'])->name('sekretaris.anggota.edit');

    Route::get('/sekretaris/anggota/{id}/nonaktif', [SekretarisController::class, 'nonaktifAnggota'])->name('sekretaris.anggota.nonaktif');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth', 'role:logistik,superadmin'])->group(function () {
    Route::get('/logistik', [LogistikController::class, 'index'])->name('logistik.dashboard');

    Route::get('/logistik/stok', [LogistikController::class, 'stok'])->name('logistik.stok');

    Route::get('/logistik/aset', [LogistikController::class, 'aset'])->name('logistik.aset');

    Route::get('/logistik/riwayat', [LogistikController::class, 'riwayat'])->name('logistik.riwayat');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
    Route::get('/superadmin/log', [SuperAdminController::class, 'logIndex'])->name('superadmin.log');
    Route::get('/superadmin/file', [SuperAdminController::class, 'fileIndex'])->name('superadmin.file');
    Route::post('/superadmin/file/upload', [SuperAdminController::class, 'uploadFile'])->name('superadmin.file.upload');
    Route::get('/superadmin/file/{id}/download', [SuperAdminController::class, 'downloadFile'])->name('superadmin.file.download');
    Route::put('/superadmin/user/{id}', [SuperAdminController::class, 'updateUser'])->name('superadmin.user.update');
    Route::post('/superadmin/user', [SuperAdminController::class, 'storeUser'])->name('superadmin.user.store');
});

Route::middleware(['auth', 'role:bendahara,superadmin'])->group(function () {
    Route::get('/bendahara', [BendaharaController::class, 'index'])->name('bendahara.dashboard');

    Route::get('/bendahara/pemasukan', [BendaharaController::class, 'pemasukan'])->name('bendahara.pemasukan');

    Route::get('/bendahara/pengeluaran', [BendaharaController::class, 'pengeluaran'])->name('bendahara.pengeluaran');

    Route::get('/bendahara/iuran', [BendaharaController::class, 'iuran'])->name('bendahara.iuran');

    Route::get('/bendahara/laporan', [BendaharaController::class, 'laporan'])->name('bendahara.laporan');

    Route::get('/bendahara/verifikasi', [BendaharaController::class, 'verifikasi'])->name('bendahara.verifikasi');
});

Route::middleware(['auth', 'role:ketua'])->group(function () {
    Route::get('/ketua', function () {
        return view('dashboard.ketua.index');
    })->name('ketua.dashboard');

    Route::get('/ketua/anggota', function () {
        return view('dashboard.ketua.anggota');
    })->name('ketua.anggota');

    Route::get('/ketua/keuangan', function () {
        return view('dashboard.ketua.keuangan');
    })->name('ketua.keuangan');

    Route::get('/ketua/aset', function () {
        return view('dashboard.ketua.aset');
    })->name('ketua.aset');

    Route::get('/ketua/log', function () {
        return view('dashboard.ketua.log');
    })->name('ketua.log');

    Route::get('/ketua/izin', function () {
        return view('dashboard.ketua.izin');
    })->name('ketua.izin');
});

Route::middleware(['auth', 'role:adminweb'])->group(function () {
    Route::get('/adminweb', [AdminWebController::class, 'index'])->name('adminweb.dashboard');
    Route::get('/adminweb/posts', [AdminWebController::class, 'posts'])->name('adminweb.posts');
    Route::get('/adminweb/posts/buat', [AdminWebController::class, 'createPost'])->name('adminweb.posts.create');
    Route::get('/adminweb/posts/{id}/edit', [AdminWebController::class, 'editPost'])->name('adminweb.posts.edit');

    Route::post('/adminweb/kategori', [AdminWebController::class, 'storeCategory'])->name('adminweb.kategori.store');
});
