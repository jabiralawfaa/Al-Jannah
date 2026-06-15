<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokBarang;
use App\Models\KategoriBarang;
use App\Models\RiwayatBarang;
use App\Models\AsetKendaraan;
use App\Models\KategoriAset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LogistikController extends Controller
{
    public function index()
    {
        $totalBarang = StokBarang::count();

        $barangMasukHariIni = RiwayatBarang::whereDate('waktu', today())
            ->where('tipe', 'masuk')
            ->sum('jumlah');

        $barangKeluarHariIni = RiwayatBarang::whereDate('waktu', today())
            ->where('tipe', 'keluar')
            ->sum('jumlah');

        $totalStokMenipis = StokBarang::where('stok', '<', 10)->count();

        $stokMenipis = StokBarang::with('kategoriBarang')
            ->where('stok', '<', 10)
            ->get();

        return view('dashboard.logistik.index', compact(
            'totalBarang',
            'barangMasukHariIni',
            'barangKeluarHariIni',
            'totalStokMenipis',
            'stokMenipis'
        ));
    }

    public function stok(Request $request)
    {
        $query = StokBarang::with('kategoriBarang');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_barang', 'like', "%{$search}%")
                  ->orWhere('nama_barang', 'like', "%{$search}%")
                  ->orWhere('satuan', 'like', "%{$search}%")
                  ->orWhereHas('kategoriBarang', function ($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        $barang = $query->get();
        $kategoris = KategoriBarang::all();
        return view('dashboard.logistik.stok', compact('barang', 'kategoris'));
    }

    public function storeBarang(Request $request)
    {
        $validated = $request->validate([
            'kode_barang' => 'required|unique:stok_barang,kode_barang',
            'nama_barang' => 'required',
            'kategori_barang_id' => 'required|exists:kategori_barang,id',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required',
        ]);

        $validated['stok_minimum'] = 0;
        $validated['status'] = $validated['stok'] > 0 ? 'tersedia' : 'habis';

        StokBarang::create($validated);

        return redirect()->route('logistik.stok')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function updateBarang(Request $request, $id)
    {
        $barang = StokBarang::findOrFail($id);

        $validated = $request->validate([
            'kode_barang' => 'required|unique:stok_barang,kode_barang,' . $id,
            'nama_barang' => 'required',
            'kategori_barang_id' => 'required|exists:kategori_barang,id',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required',
            'stok_minimum' => 'nullable|integer|min:0',
        ]);

        $validated['status'] = (int) $validated['stok'] > 0 ? 'tersedia' : 'habis';
        $validated['stok_minimum'] = $validated['stok_minimum'] ?? 0;

        $barang->update($validated);

        return redirect()->route('logistik.stok')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroyBarang($id)
    {
        $barang = StokBarang::findOrFail($id);
        $barang->delete();

        return redirect()->route('logistik.stok')->with('success', 'Barang berhasil dihapus.');
    }

    public function storeBarangMasuk(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => 'required|exists:stok_barang,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated) {
            $barang = StokBarang::findOrFail($validated['barang_id']);
            $newStok = $barang->stok + $validated['jumlah'];

            $barang->update([
                'stok' => $newStok,
                'status' => 'tersedia',
            ]);

            RiwayatBarang::create([
                'waktu' => now(),
                'tipe' => 'masuk',
                'tipe_referensi' => 'stok_barang',
                'referensi_id' => $barang->id,
                'jumlah' => $validated['jumlah'],
                'keterangan' => $validated['keterangan'],
                'user_id' => Auth::id(),
            ]);
        });

        return redirect()->route('logistik.stok')->with('success', 'Stok berhasil ditambahkan.');
    }

    public function storeBarangKeluar(Request $request)
    {
        $validated = $request->validate([
            'barang_id' => 'required|exists:stok_barang,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
        ]);

        $barang = StokBarang::findOrFail($validated['barang_id']);

        if ($barang->stok < $validated['jumlah']) {
            return redirect()->back()
                ->with('error', 'Jumlah barang keluar tidak boleh melebihi stok yang tersedia. Stok tersedia: ' . $barang->stok)
                ->withInput();
        }

        DB::transaction(function () use ($validated, $barang) {
            $newStok = $barang->stok - $validated['jumlah'];

            $barang->update([
                'stok' => $newStok,
                'status' => $newStok <= 0 ? 'habis' : 'tersedia',
            ]);

            RiwayatBarang::create([
                'waktu' => now(),
                'tipe' => 'keluar',
                'tipe_referensi' => 'stok_barang',
                'referensi_id' => $barang->id,
                'jumlah' => $validated['jumlah'],
                'keterangan' => $validated['keterangan'],
                'user_id' => Auth::id(),
            ]);
        });

        return redirect()->route('logistik.stok')->with('success', 'Stok berhasil dikurangi.');
    }

    public function aset()
    {
        $aset = AsetKendaraan::with('kategoriAset')->get();
        $kategoris = KategoriAset::all();
        return view('dashboard.logistik.aset', compact('aset', 'kategoris'));
    }

    public function riwayat()
    {
        $riwayat = DB::table('riwayat_barang')
            ->leftJoin('stok_barang', function ($join) {
                $join->on('riwayat_barang.referensi_id', '=', 'stok_barang.id')
                    ->where('riwayat_barang.tipe_referensi', '=', 'stok_barang');
            })
            ->select(
                'riwayat_barang.*',
                'stok_barang.nama_barang',
                'stok_barang.kode_barang'
            )
            ->orderBy('riwayat_barang.waktu', 'desc')
            ->get();

        return view('dashboard.logistik.riwayat', compact('riwayat'));
    }
}
