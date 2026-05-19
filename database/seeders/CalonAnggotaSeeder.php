<?php

namespace Database\Seeders;

use App\Models\CalonAnggota;
use Illuminate\Database\Seeder;

class CalonAnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $calonAnggota = [
            [
                'nama' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@email.com',
                'telepon' => '081234567890',
                'alamat' => 'Jl. Raya Banyuwangi No. 123',
                'status' => 'disetujui',
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@email.com',
                'telepon' => '081234567891',
                'alamat' => 'Jl. Veteran No. 45',
                'status' => 'menunggu_verifikasi',
            ],
            [
                'nama' => 'Rizky Pratama',
                'email' => 'rizky.pratama@email.com',
                'telepon' => '081234567892',
                'alamat' => 'Jl. Diponegoro No. 78',
                'status' => 'disetujui',
            ],
            [
                'nama' => 'Dewi Lestari',
                'email' => 'dewi.lestari@email.com',
                'telepon' => '081234567893',
                'alamat' => 'Jl. Sudirman No. 90',
                'status' => 'ditolak',
            ],
            [
                'nama' => 'Fajar Kurniawan',
                'email' => 'fajar.kurniawan@email.com',
                'telepon' => '081234567894',
                'alamat' => 'Jl. Gajah Mada No. 15',
                'status' => 'disetujui',
            ],
            [
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@email.com',
                'telepon' => '081234567895',
                'alamat' => 'Jl. Merdeka No. 7',
                'status' => 'sudah_membayar',
            ],
        ];

        foreach ($calonAnggota as $ca) {
            CalonAnggota::create($ca);
        }
    }
}
