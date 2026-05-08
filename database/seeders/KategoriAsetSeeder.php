<?php

namespace Database\Seeders;

use App\Models\KategoriAset;
use Illuminate\Database\Seeder;

class KategoriAsetSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['nama' => 'Kendaraan', 'deskripsi' => 'Kendaraan organisasi'],
            ['nama' => 'Elektronik', 'deskripsi' => 'Aset elektronik'],
            ['nama' => 'Furnitur', 'deskripsi' => 'Perabotan kantor'],
            ['nama' => 'Alat Kegiatan', 'deskripsi' => 'Alat untuk kegiatan'],
            ['nama' => 'Lainnya', 'deskripsi' => 'Aset lainnya'],
        ];

        foreach ($kategori as $kat) {
            KategoriAset::create($kat);
        }
    }
}
