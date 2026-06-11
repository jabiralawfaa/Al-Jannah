<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\IuranTahunan;
use App\Models\Pemasukan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoIuranSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user) return;

        $nominal = 10000;
        $tahunMulai = 2025;
        $totalBulan = 21;

        $namaAnggota = [
            ['nama' => 'Ahmad Fauzi', 'email' => 'ahmad.fauzi@example.com', 'telepon' => '081234567890', 'alamat' => 'Blok A-15'],
            ['nama' => 'Budi Santoso', 'email' => 'budi.santoso@example.com', 'telepon' => '081234567891', 'alamat' => 'Blok B-07'],
            ['nama' => 'Chaerul Anwar', 'email' => 'chaerul.anwar@example.com', 'telepon' => '081234567892', 'alamat' => 'Blok C-22'],
        ];

        foreach ($namaAnggota as $index => $data) {
            $lastId = Anggota::max('id') ?? 0;

            $anggota = new Anggota();
            $anggota->nomor_anggota = 'RKM-' . str_pad($lastId + 1 + $index, 5, '0', STR_PAD_LEFT);
            $anggota->nama = $data['nama'];
            $anggota->email = $data['email'];
            $anggota->telepon = $data['telepon'];
            $anggota->alamat = $data['alamat'];
            $anggota->status = 'aktif';
            $anggota->tanggal_aktif_kembali = '2025-01-01';
            $anggota->created_by = $user->id;
            $anggota->created_at = '2025-01-01 00:00:00';
            $anggota->updated_at = '2025-01-01 00:00:00';
            $anggota->save();

            $bulanDibayar = 0;
            for ($tahun = $tahunMulai; $bulanDibayar < $totalBulan; $tahun++) {
                $sisa = $totalBulan - $bulanDibayar;
                $maxBulan = min($sisa, 12);
                $batchNominal = $nominal * $maxBulan;

                $pemasukan = new Pemasukan();
                $pemasukan->tanggal = $tahun . '-01-15';
                $pemasukan->kategori_pemasukan_id = 1;
                $pemasukan->jumlah = $batchNominal;
                $pemasukan->keterangan = "Iuran {$maxBulan} bln - {$data['nama']} (demo)";
                $pemasukan->created_by = $user->id;
                $pemasukan->created_at = $tahun . '-01-15 00:00:00';
                $pemasukan->updated_at = $tahun . '-01-15 00:00:00';
                $pemasukan->save();

                for ($b = 1; $b <= $maxBulan; $b++) {
                    $iuran = new IuranTahunan();
                    $iuran->tahun = $tahun;
                    $iuran->anggota_id = $anggota->id;
                    $iuran->bulan = $b;
                    $iuran->nominal = $nominal;
                    $iuran->status = 'lunas';
                    $iuran->tanggal_bayar = $tahun . '-01-15';
                    $iuran->verified_by = $user->id;
                    $iuran->pemasukan_id = $pemasukan->id;
                    $iuran->created_at = $tahun . '-01-15 00:00:00';
                    $iuran->updated_at = $tahun . '-01-15 00:00:00';
                    $iuran->save();
                    $bulanDibayar++;
                }
            }
        }

        $this->command->info('Demo iuran data created: ' . count($namaAnggota) . ' members from Jan 2025 with 21 months paid.');
    }
}
