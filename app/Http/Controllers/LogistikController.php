<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogistikController extends Controller
{
    public function index()
    {
        $totalBarang = 5;
        $barangMasukHariIni = 50;
        $barangKeluarHariIni = 0;
        $totalStokMenipis = 3;

        $stokMenipis = collect([
            (object)[
                'kode_barang' => 'TPH-1',
                'nama_barang' => 'Tinta Printer Hitam',
                'kategori' => 'ATK',
                'stok' => 5,
                'satuan' => 'Botol'
            ],
            (object)[
                'kode_barang' => 'PACK-P',
                'nama_barang' => 'Paket Jenazah (Pria Dewasa)',
                'kategori' => 'Bahan',
                'stok' => 2,
                'satuan' => 'Pcs'
            ],
            (object)[
                'kode_barang' => 'PACK-B',
                'nama_barang' => 'Paket Jenazah (Bayi)',
                'kategori' => 'Bahan',
                'stok' => 3,
                'satuan' => 'Pcs'
            ],
        ]);

        return view('dashboard.logistik.index', compact(
            'totalBarang',
            'barangMasukHariIni',
            'barangKeluarHariIni',
            'totalStokMenipis',
            'stokMenipis'
        ));
    }

    public function stok()
    {
        return view('dashboard.logistik.stok');
    }

    public function aset()
    {
        return view('dashboard.logistik.aset');
    }

    public function barangMasuk()
    {
        return view('dashboard.logistik.barang-masuk');
    }

    public function barangKeluar()
    {
        return view('dashboard.logistik.barang-keluar');
    }

    public function riwayat()
    {
        return view('dashboard.logistik.riwayat');
    }
}
