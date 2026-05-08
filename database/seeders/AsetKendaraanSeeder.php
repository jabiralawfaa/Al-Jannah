<?php

namespace Database\Seeders;

use App\Models\AsetKendaraan;
use App\Models\KategoriAset;
use Illuminate\Database\Seeder;

class AsetKendaraanSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriKendaraan = KategoriAset::where('nama', 'Kendaraan')->first();
        $kategoriElektronik = KategoriAset::where('nama', 'Elektronik')->first();

        $aset = [
            [
                'kode_aset' => 'KDR-001',
                'nama_aset' => 'Mobil Avanza',
                'nomor_plat_seri' => 'B 1234 XY',
                'kategori_aset_id' => $kategoriKendaraan->id,
                'status' => 'tersedia',
            ],
            [
                'kode_aset' => 'KDR-002',
                'nama_aset' => 'Motor Supra',
                'nomor_plat_seri' => 'B 5678 ZA',
                'kategori_aset_id' => $kategoriKendaraan->id,
                'status' => 'dipinjam',
            ],
            [
                'kode_aset' => 'ELT-001',
                'nama_aset' => 'Proyektor Epson',
                'nomor_plat_seri' => 'SN-PROJ-001',
                'kategori_aset_id' => $kategoriElektronik->id,
                'status' => 'tersedia',
            ],
            [
                'kode_aset' => 'ELT-002',
                'nama_aset' => 'Laptop Lenovo',
                'nomor_plat_seri' => 'SN-LPT-002',
                'kategori_aset_id' => $kategoriElektronik->id,
                'status' => 'rusak',
            ],
            [
                'kode_aset' => 'ELT-003',
                'nama_aset' => 'Speaker Bluetooth',
                'nomor_plat_seri' => 'SN-SPK-003',
                'kategori_aset_id' => $kategoriElektronik->id,
                'status' => 'tersedia',
            ],
        ];

        foreach ($aset as $a) {
            AsetKendaraan::create($a);
        }
    }
}
