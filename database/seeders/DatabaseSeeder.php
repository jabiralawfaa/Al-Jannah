<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            KategoriPemasukanSeeder::class,
            KategoriPengeluaranSeeder::class,
            CalonAnggotaSeeder::class,
            AnggotaSeeder::class,
            KategoriBarangSeeder::class,
            KategoriAsetSeeder::class,
            StokBarangSeeder::class,
            AsetKendaraanSeeder::class,
            CmsSeeder::class,
        ]);
    }
}
