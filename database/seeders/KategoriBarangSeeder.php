<?php

namespace Database\Seeders;

use App\Models\KategoriBarang;
use Illuminate\Database\Seeder;

class KategoriBarangSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['nama' => 'ATK', 'deskripsi' => 'Alat Tulis Kantor'],
            ['nama' => 'Elektronik', 'deskripsi' => 'Peralatan elektronik'],
            ['nama' => 'Kebersihan', 'deskripsi' => 'Alat kebersihan'],
            ['nama' => 'Dokumentasi', 'deskripsi' => 'Kertas, map, dan alat dokumentasi'],
            ['nama' => 'Lainnya', 'deskripsi' => 'Barang lainnya'],
        ];

        foreach ($kategori as $kat) {
            KategoriBarang::create($kat);
        }
    }
}
