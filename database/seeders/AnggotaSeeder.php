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

        foreach ($calonAnggota as $index => $ca) {
            $anggota = new Anggota();
            $anggota->nomor_anggota = 'RKM-' . str_pad($index + 1, 5, '0', STR_PAD_LEFT);
            $anggota->calon_anggota_id = $ca->id;
            $anggota->nama = $ca->nama;
            $anggota->email = $ca->email;
            $anggota->telepon = $ca->telepon;
            $anggota->alamat = $ca->alamat;
            $anggota->status = 'aktif';
            $anggota->created_by = $user->id;
            $anggota->created_at = '2025-01-01 00:00:00';
            $anggota->updated_at = '2025-01-01 00:00:00';
            $anggota->save();
        }
    }
}
