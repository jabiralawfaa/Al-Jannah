<?php

namespace Database\Seeders;

use App\Models\KategoriPemasukan;
use Illuminate\Database\Seeder;

class KategoriPemasukanSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['nama' => 'Iuran Anggota', 'deskripsi' => 'Pemasukan dari iuran anggota tahunan'],
            ['nama' => 'Donasi', 'deskripsi' => 'Donasi dari masyarakat atau pihak ketiga'],
            ['nama' => 'Pendaftaran Anggota Baru', 'deskripsi' => 'Biaya pendaftaran anggota baru'],
            ['nama' => 'Kegiatan Amal', 'deskripsi' => 'Pemasukan dari kegiatan amal'],
            ['nama' => 'Lainnya', 'deskripsi' => 'Pemasukan lainnya'],
        ];

        foreach ($kategori as $kat) {
            KategoriPemasukan::create($kat);
        }
    }
}
