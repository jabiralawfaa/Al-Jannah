<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Kategori File - Pemilah
    |--------------------------------------------------------------------------
    |
    | Mendefinisikan ekstensi file untuk setiap kategori.
    | Referensi: .Panduan-AI/pemilah-file.md
    |
    */

    'diterima' => [
        // Dokumen & Teks
        'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx',
        'odt', 'ods', 'odp',
        'txt', 'rtf', 'csv',
        // Gambar & Desain
        'jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'tif', 'webp',
        'psd', 'ai', 'indd', 'sketch', 'eps',
        // Audio & Video
        'mp3', 'wav', 'ogg', 'flac', 'aac',
        'mp4', 'avi', 'mov', 'mkv', 'wmv', 'webm', 'flv',
        // Arsip & Kompresi (perlu scan antivirus)
        'zip', 'rar', '7z', 'tar', 'gz',
        // Engineering & 3D
        'dwg', 'dxf', 'stl', 'obj',
    ],

    'mencurigakan' => [
        // Dokumen dengan Makro
        'docm', 'xlsm', 'pptm', 'dotm', 'xltm',
        // Skrip & Kode Pemrograman
        'py', 'java', 'jar', 'c', 'cpp', 'h', 'cs', 'rb', 'go',
        'sh', 'bash', 'ps1',
        // Web & Database
        'sql', 'xml', 'xsd', 'svg', 'htm', 'html',
        // Image Disk & Virtualisasi
        'iso', 'img', 'vhd', 'vhdx',
    ],

    'ditolak' => [
        // Eksekusi Windows
        'exe', 'msi', 'bat', 'cmd', 'com', 'scr', 'pif',
        'vbs', 'vbe', 'wsf', 'wsh', 'cpl', 'dll', 'sys', 'reg', 'inf',
        // Eksekusi macOS
        'dmg', 'app', 'pkg',
        // Eksekusi Linux
        'deb', 'rpm', 'run',
        // Skrip Sisi Server
        'php', 'aspx', 'asp', 'jsp', 'cgi',
        // Lainnya
        'hta', 'lnk', 'url',
    ],

    /*
    |--------------------------------------------------------------------------
    | Izin File per Kategori
    |--------------------------------------------------------------------------
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
