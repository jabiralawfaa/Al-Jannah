<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function showAccessCode()
    {
        return view('public.anggota');
    }

    public function verifyAccessCode(Request $request)
    {
        $request->validate([
            'access_code' => 'required|string|max:50',
        ]);

        $anggota = Anggota::where('access_code', $request->access_code)
            ->where('status', 'aktif')
            ->first();

        if (!$anggota) {
            return back()->withErrors(['access_code' => 'Kode akses tidak valid.'])->withInput();
        }

        session(['anggota_id' => $anggota->id]);

        return redirect()->route('anggota.dashboard');
    }

    public function dashboard()
    {
        $anggotaId = session('anggota_id');
        if (!$anggotaId) {
            return redirect()->route('anggota');
        }

        $anggota = Anggota::with('iuranTahunan')->findOrFail($anggotaId);
        $tahun = date('Y');
        $nominalPerBulan = 10000;

        $iuranBulanan = [];
        $totalLunas = 0;
        $totalBelum = 0;

        for ($b = 1; $b <= 12; $b++) {
            $iuran = $anggota->iuranTahunan
                ->where('tahun', $tahun)
                ->where('bulan', $b)
                ->first();

            $lunas = $iuran && $iuran->status === 'lunas';
            if ($lunas) $totalLunas++;
            else $totalBelum++;

            $iuranBulanan[] = [
                'bulan' => $b,
                'nama_bulan' => [
                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
                    4 => 'April', 5 => 'Mei', 6 => 'Juni',
                    7 => 'Juli', 8 => 'Agustus', 9 => 'September',
                    10 => 'Oktober', 11 => 'November', 12 => 'Desember',
                ][$b],
                'lunas' => $lunas,
                'nominal' => $nominalPerBulan,
                'tanggal_bayar' => $iuran?->tanggal_bayar,
            ];
        }

        $totalHarusDibayar = $totalBelum * $nominalPerBulan;
        $totalSudahDibayar = $totalLunas * $nominalPerBulan;
        $progressPersen = $totalLunas / 12 * 100;

        return view('anggota.dashboard', compact(
            'anggota', 'tahun', 'iuranBulanan',
            'totalLunas', 'totalBelum',
            'totalHarusDibayar', 'totalSudahDibayar',
            'nominalPerBulan', 'progressPersen'
        ));
    }
}
