<?php

namespace Database\Seeders;

use App\Models\CalonAnggota;
use App\Models\KeluargaAnggota;
use Illuminate\Database\Seeder;

class KeluargaAnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $keluarga = [
            [
                'calon' => CalonAnggota::where('email', 'ahmad.fauzi@email.com')->first(),
                'anggota_keluarga' => [
                    ['nama' => 'Rina Fauzi', 'jenis_kelamin' => 'perempuan', 'tanggal_lahir' => '2010-03-15'],
                    ['nama' => 'Budi Fauzi', 'jenis_kelamin' => 'laki-laki', 'tanggal_lahir' => '2015-07-22'],
                ],
            ],
            [
                'calon' => CalonAnggota::where('email', 'siti.nurhaliza@email.com')->first(),
                'anggota_keluarga' => [
                    ['nama' => 'Ahmad Nurhadi', 'jenis_kelamin' => 'laki-laki', 'tanggal_lahir' => '2008-11-10'],
                ],
            ],
            [
                'calon' => CalonAnggota::where('email', 'rizky.pratama@email.com')->first(),
                'anggota_keluarga' => [
                    ['nama' => 'Dewi Pratama', 'jenis_kelamin' => 'perempuan', 'tanggal_lahir' => '2012-05-20'],
                    ['nama' => 'Rizky Pratama Jr.', 'jenis_kelamin' => 'laki-laki', 'tanggal_lahir' => '2018-09-14'],
                    ['nama' => 'Sari Pratama', 'jenis_kelamin' => 'perempuan', 'tanggal_lahir' => '2020-01-30'],
                ],
            ],
            [
                'calon' => CalonAnggota::where('email', 'dewi.lestari@email.com')->first(),
                'anggota_keluarga' => [
                    ['nama' => 'Hendra Lestari', 'jenis_kelamin' => 'laki-laki', 'tanggal_lahir' => '2005-12-01'],
                ],
            ],
            [
                'calon' => CalonAnggota::where('email', 'fajar.kurniawan@email.com')->first(),
                'anggota_keluarga' => [
                    ['nama' => 'Maya Kurniawan', 'jenis_kelamin' => 'perempuan', 'tanggal_lahir' => '2016-04-18'],
                    ['nama' => 'Indra Kurniawan', 'jenis_kelamin' => 'laki-laki', 'tanggal_lahir' => '2019-08-25'],
                ],
            ],
            [
                'calon' => CalonAnggota::where('email', 'budi.santoso@email.com')->first(),
                'anggota_keluarga' => [
                    ['nama' => 'Ani Santoso', 'jenis_kelamin' => 'perempuan', 'tanggal_lahir' => '2011-06-05'],
                ],
            ],
        ];

        foreach ($keluarga as $item) {
            if (!$item['calon']) continue;

            foreach ($item['anggota_keluarga'] as $anggota) {
                KeluargaAnggota::create([
                    'calon_anggota_id' => $item['calon']->id,
                    'nama' => $anggota['nama'],
                    'jenis_kelamin' => $anggota['jenis_kelamin'],
                    'tanggal_lahir' => $anggota['tanggal_lahir'],
                ]);
            }
        }
    }
}
