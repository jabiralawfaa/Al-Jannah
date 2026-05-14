<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Kategori File - Pemilah
    |--------------------------------------------------------------------------
    |
    | Mendefinisikan ekstensi file untuk setiap kategori:
    | - diterima: file aman yang diizinkan
    | - mencurigakan: file berpotensi berbahaya, akses terbatas
    | - ditolak: file berbahaya, akses sangat terbatas
    |
    */

    'diterima' => [
        // Dokumen
        'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx',
        'txt', 'csv', 'rtf', 'odt', 'ods', 'odp', 'md', 'xps',
        // Gambar
        'jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp', 'ico',
    ],

    'mencurigakan' => [
        'exe', 'msi', 'bat', 'cmd', 'vbs', 'ps1', 'psm1',
        'scr', 'jar', 'zip', 'rar', '7z', 'tar', 'gz',
        'lnk', 'wsf',
    ],

    'ditolak' => [
        'php', 'phtml', 'php3', 'php4', 'php5', 'php7', 'php8',
        'html', 'htm', 'xhtml',
        'js', 'jsx', 'mjs',
        'sql',
        'asp', 'aspx',
        'py', 'pyc',
        'pl',
        'cgi',
        'htaccess', 'htpasswd',
        'com', 'sys', 'dll', 'drv', 'cpl',
    ],

    /*
    |--------------------------------------------------------------------------
    | Izin File per Kategori
    |--------------------------------------------------------------------------
    |
    | Mengacu pada panduan di .Panduan-AI/pemilah-file.md
    |
    */
    'permissions' => [
        'diterima' => 0644,
        'mencurigakan' => 0640,
        'ditolak' => 0600,
    ],

    /*
    |--------------------------------------------------------------------------
    | Sub-direktori penyimpanan per kategori
    |--------------------------------------------------------------------------
    |
    */
    'paths' => [
        'diterima' => 'file_organisasi/diterima',
        'mencurigakan' => 'file_organisasi/mencurigakan',
        'ditolak' => 'file_organisasi/ditolak',
    ],

    /*
    |--------------------------------------------------------------------------
    | Label untuk tampilan
    |--------------------------------------------------------------------------
    |
    */
    'labels' => [
        'diterima' => 'Diterima',
        'mencurigakan' => 'Mencurigakan',
        'ditolak' => 'Ditolak',
    ],

    'badge_classes' => [
        'diterima' => 'badge-success',
        'mencurigakan' => 'badge-warning',
        'ditolak' => 'badge-danger',
    ],
];
