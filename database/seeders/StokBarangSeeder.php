<?php

namespace Database\Seeders;

use App\Models\KategoriBarang;
use App\Models\StokBarang;
use Illuminate\Database\Seeder;

class StokBarangSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriATK = KategoriBarang::where('nama', 'ATK')->first();
        $kategoriElektronik = KategoriBarang::where('nama', 'Elektronik')->first();

        $barang = [
            [
                'kode_barang' => 'ATK-001',
                'nama_barang' => 'Kertas A4',
                'stok' => 50,
                'stok_minimum' => 10,
                'satuan' => 'rim',
                'kategori_barang_id' => $kategoriATK->id,
                'status' => 'tersedia',
            ],
            [
                'kode_barang' => 'ATK-002',
                'nama_barang' => 'Pulpen Biru',
                'stok' => 100,
                'stok_minimum' => 20,
                'satuan' => 'pcs',
                'kategori_barang_id' => $kategoriATK->id,
                'status' => 'tersedia',
            ],
            [
                'kode_barang' => 'ATK-003',
                'nama_barang' => 'Stapler',
                'stok' => 10,
                'stok_minimum' => 5,
                'satuan' => 'pcs',
                'kategori_barang_id' => $kategoriATK->id,
                'status' => 'tersedia',
            ],
            [
                'kode_barang' => 'ELK-001',
                'nama_barang' => 'Kabel USB',
                'stok' => 20,
                'stok_minimum' => 5,
                'satuan' => 'pcs',
                'kategori_barang_id' => $kategoriElektronik->id,
                'status' => 'tersedia',
            ],
            [
                'kode_barang' => 'ELK-002',
                'nama_barang' => 'Baterai AA',
                'stok' => 30,
                'stok_minimum' => 10,
                'satuan' => 'pcs',
                'kategori_barang_id' => $kategoriElektronik->id,
                'status' => 'tersedia',
            ],
        ];

        foreach ($barang as $b) {
            StokBarang::create($b);
        }
    }
}
