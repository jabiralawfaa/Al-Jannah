<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\CalonAnggota;
use App\Models\KeluargaAnggota;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SekretarisController extends Controller
{
    public function index()
    {
        $calonAnggota = CalonAnggota::whereIn('status', ['menunggu_verifikasi', 'sudah_membayar'])
            ->latest()
            ->get();

        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'aktif')->count();
        $anggotaNonAktif = Anggota::where('status', 'non_aktif')->count();
        $menungguVerifikasi = CalonAnggota::whereIn('status', ['menunggu_verifikasi', 'sudah_membayar'])->count();

        return view('dashboard.sekretaris.index', compact(
            'calonAnggota',
            'totalAnggota',
            'anggotaAktif',
            'anggotaNonAktif',
            'menungguVerifikasi'
        ));
    }

    public function verifikasi($id)
    {
        $calon = CalonAnggota::findOrFail($id);

        if ($calon->status !== 'sudah_membayar') {
            return back()->with('error', 'Calon anggota belum melakukan pembayaran.');
        }

        $calon->update(['status' => 'disetujui']);

        $lastId = Anggota::max('id') ?? 0;
        $nomorAnggota = 'RKM-' . str_pad($lastId + 1, 5, '0', STR_PAD_LEFT);

        Anggota::create([
            'nomor_anggota' => $nomorAnggota,
            'calon_anggota_id' => $calon->id,
            'nama' => $calon->nama,
            'email' => $calon->email,
            'telepon' => $calon->telepon,
            'alamat' => $calon->alamat,
            'status' => 'aktif',
            'created_by' => Auth::id(),
        ]);

        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aksi' => 'verifikasi',
            'deskripsi' => "Verifikasi calon atas nama {$calon->nama} - {$nomorAnggota}",
            'modul' => 'Sekretaris',
            'referensi_id' => $calon->id,
        ]);

        return back()->with('success', "Calon anggota {$calon->nama} berhasil diverifikasi.");
    }

    public function log()
    {
        $activities = LogAktivitas::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('dashboard.sekretaris.log', compact('activities'));
    }

    public function anggota()
    {
        $anggota = Anggota::with('calonAnggota.keluargaAnggota')
            ->latest()
            ->paginate(20);

        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'aktif')->count();
        $anggotaNonAktif = Anggota::where('status', 'non_aktif')->count();

        return view('dashboard.sekretaris.anggota', compact(
            'anggota',
            'totalAnggota',
            'anggotaAktif',
            'anggotaNonAktif'
        ));
    }

    public function editAnggota($id)
    {
        $anggota = Anggota::with('calonAnggota')->find($id);

        if (!$anggota) {
            $anggota = (object) [
                'id' => $id,
                'nomor_anggota' => 'RKM-' . str_pad($id, 5, '0', STR_PAD_LEFT),
                'nama' => 'Anggota',
                'telepon' => '-',
            ];
        }

        return view('dashboard.sekretaris.anggota-edit', compact('anggota'));
    }

    public function nonaktifAnggota($id)
    {
        $anggota = Anggota::with('calonAnggota')->find($id);

        if (!$anggota) {
            $anggota = (object) [
                'id' => $id,
                'nomor_anggota' => 'RKM-' . str_pad($id, 5, '0', STR_PAD_LEFT),
                'nama' => 'Anggota',
            ];
        }

        return view('dashboard.sekretaris.anggota-nonaktif', compact('anggota'));
    }
}
