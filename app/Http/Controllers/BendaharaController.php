<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\CalonAnggota;
use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    public function index()
    {
        $totalPemasukan = Pemasukan::sum('jumlah');
        $totalPengeluaran = Pengeluaran::sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        $pemasukan = Pemasukan::with('kategoriPemasukan')->latest()->take(5)->get();
        $pengeluaran = Pengeluaran::with('kategoriPengeluaran')->latest()->take(5)->get();

        $transaksi = collect()
            ->merge($pemasukan->map(fn($p) => (object)[
                'created_at' => $p->created_at,
                'nama'       => $p->kategoriPemasukan?->nama ?? 'Pemasukan',
                'jenis'      => 'pemasukan',
                'nominal'    => $p->jumlah,
                'keterangan' => $p->keterangan,
            ]))
            ->merge($pengeluaran->map(fn($p) => (object)[
                'created_at' => $p->created_at,
                'nama'       => $p->kategoriPengeluaran?->nama ?? 'Pengeluaran',
                'jenis'      => 'pengeluaran',
                'nominal'    => $p->jumlah,
                'keterangan' => $p->keterangan,
            ]))
            ->sortByDesc('created_at')
            ->take(5);

        return view('dashboard.bendahara.index', compact('totalPemasukan', 'totalPengeluaran', 'saldo', 'transaksi'));
    }

    public function pemasukan()
    {
        $pemasukan = Pemasukan::with('kategoriPemasukan')->latest()->paginate(20);
        return view('dashboard.bendahara.pemasukan', compact('pemasukan'));
    }

    public function pengeluaran()
    {
        $pengeluaran = Pengeluaran::with('kategoriPengeluaran')->latest()->paginate(20);
        return view('dashboard.bendahara.pengeluaran', compact('pengeluaran'));
    }

    public function iuran()
    {
        return view('dashboard.bendahara.iuran');
    }

    public function laporan()
    {
        return view('dashboard.bendahara.laporan');
    }

    public function verifikasi()
    {
        $calonAnggota = CalonAnggota::where('status', 'pending')->latest()->paginate(20);
        return view('dashboard.bendahara.verifikasi', compact('calonAnggota'));
    }
}
