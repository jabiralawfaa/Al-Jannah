<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\CalonAnggota;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnggotaSeeder extends Seeder
{
    public function run(): void
    {
        $calonAnggota = CalonAnggota::where('status', 'disetujui')->get();
        $user = User::first();

        $anggotas = [];
        foreach ($calonAnggota as $index => $ca) {
            $anggotas[] = [
                'nomor_anggota' => 'AJ-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'calon_anggota_id' => $ca->id,
                'nama' => $ca->nama,
                'email' => $ca->email,
                'telepon' => $ca->telepon,
                'alamat' => $ca->alamat,
                'status' => 'aktif',
                'created_by' => $user->id,
            ];
        }

        foreach ($anggotas as $anggota) {
            Anggota::create($anggota);
        }
    }
}
