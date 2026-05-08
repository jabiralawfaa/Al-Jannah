<?php

namespace Database\Seeders;

use App\Models\KategoriPengeluaran;
use Illuminate\Database\Seeder;

class KategoriPengeluaranSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['nama' => 'Kegiatan Organisasi', 'deskripsi' => 'Pengeluaran untuk kegiatan rutin'],
            ['nama' => 'Logistik & ATK', 'deskripsi' => 'Pengeluaran untuk barang logistik dan ATK'],
            ['nama' => 'Sosial & Kemanusiaan', 'deskripsi' => 'Pengeluaran untuk kegiatan sosial'],
            ['nama' => 'Operasional', 'deskripsi' => 'Pengeluaran operasional kantor'],
            ['nama' => 'Lainnya', 'deskripsi' => 'Pengeluaran lainnya'],
        ];

        foreach ($kategori as $kat) {
            KategoriPengeluaran::create($kat);
        }
    }
}
