<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\CalonAnggota;
use App\Models\LogSuperadmin;
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
        $nomorAnggota = 'AJ-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);

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

        LogSuperadmin::create([
            'user_id' => Auth::id(),
            'aksi' => 'verifikasi',
            'deskripsi' => "Verifikasi calon anggota {$calon->nama} - {$nomorAnggota}",
            'modul' => 'Sekretaris',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return back()->with('success', "Calon anggota {$calon->nama} berhasil diverifikasi.");
    }
}
