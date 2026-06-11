<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\CalonAnggota;
use App\Models\Anggota;
use App\Models\IuranTahunan;
use App\Models\Pembayaran;
use App\Models\KategoriPemasukan;
use App\Models\KategoriPengeluaran;
use App\Models\PermintaanIzin;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Writer\XLSX\Writer;

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

    public function catatTransaksi()
    {
        $pemasukan = Pemasukan::with('kategoriPemasukan')->get()->map(fn($p) => [
            'id' => $p->id,
            'tipe' => 'Pemasukan',
            'tanggal' => $p->created_at->format('d/m/Y'),
            'jumlah' => $p->jumlah,
            'kategori' => $p->kategoriPemasukan?->nama ?? '-',
            'keterangan' => $p->keterangan ?? '-',
            'created_at' => $p->created_at,
            'file_url' => $p->getFirstMediaUrl('bukti') ?: null,
        ]);

        $pengeluaran = Pengeluaran::with('kategoriPengeluaran')->get()->map(fn($p) => [
            'id' => $p->id,
            'tipe' => 'Pengeluaran',
            'tanggal' => $p->created_at->format('d/m/Y'),
            'jumlah' => $p->jumlah,
            'kategori' => $p->kategoriPengeluaran?->nama ?? '-',
            'keterangan' => $p->keterangan ?? '-',
            'created_at' => $p->created_at,
            'file_url' => $p->getFirstMediaUrl('bukti') ?: null,
        ]);

        $all = $pemasukan->concat($pengeluaran)->sortByDesc('created_at')->values();

        $page = request()->get('page', 1);
        $perPage = 20;
        $transaksi = new LengthAwarePaginator(
            $all->forPage($page, $perPage),
            $all->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $kategoriPemasukan = KategoriPemasukan::all();
        $kategoriPengeluaran = KategoriPengeluaran::all();

        return view('dashboard.bendahara.catat-transaksi', compact('transaksi', 'kategoriPemasukan', 'kategoriPengeluaran'));
    }

    public function storeTransaksi(Request $request)
    {
        $rules = [
            'tipe' => 'required|in:pemasukan,pengeluaran',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:1000',
            'file_bukti' => 'required|file|max:2048',
        ];

        $rules['kategori_id'] = $request->tipe === 'pemasukan'
            ? 'required|exists:kategori_pemasukan,id'
            : 'required|exists:kategori_pengeluaran,id';

        $validated = $request->validate($rules);

        if ($validated['tipe'] === 'pemasukan') {
            $model = Pemasukan::create([
                'tanggal' => $validated['tanggal'],
                'kategori_pemasukan_id' => $validated['kategori_id'],
                'jumlah' => $validated['jumlah'],
                'keterangan' => $validated['keterangan'],
                'created_by' => auth()->id(),
            ]);
            $kategori = $model->kategoriPemasukan?->nama ?? '-';
        } else {
            $model = Pengeluaran::create([
                'tanggal' => $validated['tanggal'],
                'kategori_pengeluaran_id' => $validated['kategori_id'],
                'jumlah' => $validated['jumlah'],
                'keterangan' => $validated['keterangan'],
                'created_by' => auth()->id(),
            ]);
            $kategori = $model->kategoriPengeluaran?->nama ?? '-';
        }

        $model->addMedia($request->file('file_bukti'))->toMediaCollection('bukti');

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $model->id,
                'tipe' => $validated['tipe'] === 'pemasukan' ? 'Pemasukan' : 'Pengeluaran',
                'tanggal' => $model->created_at->format('d/m/Y'),
                'jumlah' => $model->jumlah,
                'kategori' => $kategori,
                'keterangan' => $model->keterangan ?? '-',
                'file_url' => $model->getFirstMediaUrl('bukti') ?: null,
            ]
        ]);
    }

    public function pemasukan()
    {
        $pemasukan = Pemasukan::with('kategoriPemasukan')->latest()->paginate(20);
        $kategoriList = KategoriPemasukan::all();
        return view('dashboard.bendahara.pemasukan', compact('pemasukan', 'kategoriList'));
    }

    public function pengeluaran()
    {
        $pengeluaran = Pengeluaran::with('kategoriPengeluaran')->latest()->paginate(20);
        $kategoriList = KategoriPengeluaran::all();
        return view('dashboard.bendahara.pengeluaran', compact('pengeluaran', 'kategoriList'));
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
        $calonAnggota = CalonAnggota::where('status', 'menunggu_verifikasi')->latest()->paginate(20);
        return view('dashboard.bendahara.verifikasi', compact('calonAnggota'));
    }

    public function storePemasukan(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'kategori_pemasukan_id' => 'required|exists:kategori_pemasukan,id',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:1000',
            'file_bukti' => 'required|file|max:2048',
        ]);

        $pemasukan = Pemasukan::create([
            'tanggal' => $validated['tanggal'],
            'kategori_pemasukan_id' => $validated['kategori_pemasukan_id'],
            'jumlah' => $validated['jumlah'],
            'keterangan' => $validated['keterangan'],
            'created_by' => auth()->id(),
        ]);

        $pemasukan->addMedia($request->file('file_bukti'))->toMediaCollection('bukti');

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $pemasukan->id,
                'tanggal' => $pemasukan->created_at->format('d/m/Y'),
                'jumlah' => $pemasukan->jumlah,
                'kategori' => $pemasukan->kategoriPemasukan?->nama ?? '-',
                'keterangan' => $pemasukan->keterangan ?? '-',
            ]
        ]);
    }

    public function storePengeluaran(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'kategori_pengeluaran_id' => 'required|exists:kategori_pengeluaran,id',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:1000',
            'file_bukti' => 'required|file|max:2048',
        ]);

        $pengeluaran = Pengeluaran::create([
            'tanggal' => $validated['tanggal'],
            'kategori_pengeluaran_id' => $validated['kategori_pengeluaran_id'],
            'jumlah' => $validated['jumlah'],
            'keterangan' => $validated['keterangan'],
            'created_by' => auth()->id(),
        ]);

        $pengeluaran->addMedia($request->file('file_bukti'))->toMediaCollection('bukti');

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $pengeluaran->id,
                'tanggal' => $pengeluaran->created_at->format('d/m/Y'),
                'jumlah' => $pengeluaran->jumlah,
                'kategori' => $pengeluaran->kategoriPengeluaran?->nama ?? '-',
                'keterangan' => $pengeluaran->keterangan ?? '-',
            ]
        ]);
    }

    public function getIuranData(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
        $memberId = $request->input('member_id');

        $daftarAnggota = Anggota::where('status', 'aktif')
            ->when($memberId, fn($q) => $q->where('id', $memberId))
            ->get();

        $data = $daftarAnggota->map(function ($a) use ($tahun) {
            $iuran = $a->iuranTahunan()->where('tahun', $tahun)->get()->keyBy('bulan');

            $bulan = [];
            for ($b = 1; $b <= 12; $b++) {
                $i = $iuran->get($b);
                $bulan[] = [
                    'bulan' => $b,
                    'status' => $i ? $i->status : 'belum_lunas',
                    'tanggal_bayar' => $i ? ($i->tanggal_bayar ? \Carbon\Carbon::parse($i->tanggal_bayar)->format('d/m/Y') : '') : '',
                ];
            }

            return [
                'id' => $a->id,
                'nomor_anggota' => $a->nomor_anggota,
                'nama' => $a->nama,
                'telepon' => $a->telepon,
                'access_code' => $a->access_code,
                'tahun_mulai' => max(2025, $a->tanggal_aktif_kembali
                    ? (int) $a->tanggal_aktif_kembali->format('Y')
                    : (int) $a->created_at->format('Y')),
                'bulan' => $bulan,
            ];
        });

        return response()->json([
            'tahun' => $tahun,
            'anggota' => $data,
        ]);
    }

    public function generateAccessCode(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
        ]);

        $anggota = Anggota::findOrFail($request->anggota_id);
        $code = strtoupper(substr(md5(uniqid($anggota->id . microtime(), true)), 0, 8));
        $anggota->access_code = $code;
        $anggota->save();

        return response()->json([
            'success' => true,
            'access_code' => $code,
        ]);
    }

    public function storeIuran(Request $request)
    {
        $validated = $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'tahun' => 'required|integer|min:2020|max:2099',
            'bulan_mulai' => 'required|integer|min:1|max:12',
            'jumlah_bulan' => 'required|integer|min:1|max:12',
            'nominal' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string|max:1000',
            'file_bukti' => 'required|file|max:2048',
        ]);

        $anggota = Anggota::findOrFail($validated['anggota_id']);
        $tahunMulai = max(2025, $anggota->tanggal_aktif_kembali
            ? (int) $anggota->tanggal_aktif_kembali->format('Y')
            : (int) $anggota->created_at->format('Y'));

        if ($validated['tahun'] < $tahunMulai) {
            return response()->json([
                'success' => false,
                'message' => "Anggota ini mulai aktif tahun $tahunMulai, tidak bisa membayar iuran tahun sebelumnya."
            ], 422);
        }

        for ($tahun = $tahunMulai; $tahun < $validated['tahun']; $tahun++) {
            $bulanLunas = IuranTahunan::where('anggota_id', $validated['anggota_id'])
                ->where('tahun', $tahun)
                ->where('status', 'lunas')
                ->count();
            if ($bulanLunas < 12) {
                return response()->json([
                    'success' => false,
                    'message' => "Anggota masih memiliki tanggungan iuran tahun $tahun. Selesaikan semua tanggungan tahun sebelumnya terlebih dahulu."
                ], 422);
            }
        }

        $filePath = $request->file('file_bukti')->store('bendahara', 'local');

        $totalNominal = $validated['nominal'] * $validated['jumlah_bulan'];
        $bulanAkhir = min($validated['bulan_mulai'] + $validated['jumlah_bulan'] - 1, 12);

        $pemasukan = Pemasukan::create([
            'tanggal' => now()->toDateString(),
            'kategori_pemasukan_id' => 1,
            'jumlah' => $totalNominal,
            'keterangan' => 'Iuran ' . $validated['jumlah_bulan'] . ' bln - ' . ($validated['keterangan'] ?? ''),
            'created_by' => auth()->id(),
        ]);

        $pemasukan->addMedia($request->file('file_bukti'))->toMediaCollection('bukti');

        for ($b = $validated['bulan_mulai']; $b <= $bulanAkhir; $b++) {
            IuranTahunan::create([
                'tahun' => $validated['tahun'],
                'anggota_id' => $validated['anggota_id'],
                'bulan' => $b,
                'nominal' => $validated['nominal'],
                'status' => 'lunas',
                'tanggal_bayar' => now()->toDateString(),
                'file_bukti' => $filePath,
                'verified_by' => auth()->id(),
                'pemasukan_id' => $pemasukan->id,
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'pemasukan_id' => $pemasukan->id,
                'anggota_nama' => $anggota?->nama ?? '',
                'bulan_mulai' => $validated['bulan_mulai'],
                'bulan_akhir' => $bulanAkhir,
                'jumlah_bulan' => $validated['jumlah_bulan'],
            ]
        ]);
    }

    public function getLaporanData(Request $request)
    {
        $search = $request->input('search', '');
        $period = $request->input('period', 'semua');

        $pemasukanQuery = Pemasukan::with('kategoriPemasukan');
        $pengeluaranQuery = Pengeluaran::with('kategoriPengeluaran');

        if ($period === 'hari') {
            $pemasukanQuery->whereDate('created_at', today());
            $pengeluaranQuery->whereDate('created_at', today());
        } elseif ($period === 'minggu') {
            $pemasukanQuery->whereDate('created_at', '>=', today()->subDays(7));
            $pengeluaranQuery->whereDate('created_at', '>=', today()->subDays(7));
        } elseif ($period === 'bulan') {
            $pemasukanQuery->whereRaw("strftime('%m', created_at) = ?", [today()->format('m')])
                ->whereRaw("strftime('%Y', created_at) = ?", [today()->format('Y')]);
            $pengeluaranQuery->whereRaw("strftime('%m', created_at) = ?", [today()->format('m')])
                ->whereRaw("strftime('%Y', created_at) = ?", [today()->format('Y')]);
        }

        $pemasukan = $pemasukanQuery->get();
        $pengeluaran = $pengeluaranQuery->get();

        $transaksi = collect()
            ->merge($pemasukan->map(fn($p) => [
                'tanggal' => $p->created_at->format('d-m-Y'),
                'kategori' => $p->kategoriPemasukan?->nama ?? 'Pemasukan',
                'nominal' => $p->jumlah,
                'type' => 'masuk',
            ]))
            ->merge($pengeluaran->map(fn($p) => [
                'tanggal' => $p->created_at->format('d-m-Y'),
                'kategori' => $p->kategoriPengeluaran?->nama ?? 'Pengeluaran',
                'nominal' => $p->jumlah,
                'type' => 'keluar',
            ]))
            ->sortByDesc('tanggal')
            ->values();

        if ($search) {
            $transaksi = $transaksi->filter(fn($t) =>
                str_contains(strtolower($t['tanggal']), strtolower($search)) ||
                str_contains(strtolower($t['kategori']), strtolower($search))
            )->values();
        }

        $totalPemasukan = $transaksi->where('type', 'masuk')->sum('nominal');
        $totalPengeluaran = $transaksi->where('type', 'keluar')->sum('nominal');

        return response()->json([
            'totalPemasukan' => $totalPemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'saldo' => $totalPemasukan - $totalPengeluaran,
            'transaksi' => $transaksi->map(fn($t) => [
                'tanggal' => $t['tanggal'],
                'kategori' => $t['kategori'],
                'nominal' => ($t['type'] === 'masuk' ? '+ ' : '- ') . number_format($t['nominal'], 0, ',', '.'),
                'type' => $t['type'],
            ]),
            'totalData' => $transaksi->where('type', 'keluar')->count(),
        ]);
    }

    public function getVerifikasiData()
    {
        $calon = CalonAnggota::where('status', 'menunggu_verifikasi')
            ->latest()
            ->get();

        return response()->json([
            'data' => $calon->map(fn($c, $i) => [
                'no' => $i + 1,
                'id' => $c->id,
                'tanggal' => $c->created_at->format('d/m/Y'),
                'nama' => $c->nama,
                'telepon' => $c->telepon,
                'status' => 'Belum Dibayar',
                'is_lunas' => false,
            ]),
        ]);
    }

    public function verifikasiPembayaran($id)
    {
        $calon = CalonAnggota::findOrFail($id);

        if ($calon->status !== 'menunggu_verifikasi') {
            return response()->json(['success' => false, 'message' => 'Status calon anggota tidak valid.'], 400);
        }

        $nominal = 30000;

        $pemasukan = Pemasukan::create([
            'tanggal' => now()->toDateString(),
            'kategori_pemasukan_id' => 3,
            'jumlah' => $nominal,
            'keterangan' => 'Pembayaran pendaftaran - ' . $calon->nama,
            'created_by' => auth()->id(),
        ]);

        Pembayaran::create([
            'tanggal_daftar' => now()->toDateString(),
            'calon_anggota_id' => $calon->id,
            'nominal_pembayaran' => $nominal,
            'status' => 'sudah_dibayar',
            'verified_by' => auth()->id(),
            'pemasukan_id' => $pemasukan->id,
        ]);

        $calon->update(['status' => 'sudah_membayar']);

        return response()->json(['success' => true]);
    }

    public function storePermintaanIzin(Request $request)
    {
        $validated = $request->validate([
            'target_table' => 'required|string',
            'target_id' => 'required|integer',
            'field_name' => 'required|string',
            'old_value' => 'nullable|string',
            'new_value' => 'nullable|string',
            'alasan' => 'required|string|max:2000',
        ]);

        $permintaan = PermintaanIzin::create([
            'user_id' => auth()->id(),
            'target_table' => $validated['target_table'],
            'target_id' => $validated['target_id'],
            'field_name' => $validated['field_name'],
            'old_value' => $validated['old_value'],
            'new_value' => $validated['new_value'],
            'alasan' => $validated['alasan'],
            'status' => 'menunggu',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permintaan akses edit berhasil dikirim ke ketua.',
            'data' => $permintaan,
        ]);
    }

    public function exportLaporan()
    {
        $pemasukan = Pemasukan::with('kategoriPemasukan')->get();
        $pengeluaran = Pengeluaran::with('kategoriPengeluaran')->get();

        $transaksi = collect()
            ->merge($pemasukan->map(fn($p) => [
                'tanggal' => $p->created_at->format('d-m-Y'),
                'kategori' => $p->kategoriPemasukan?->nama ?? 'Pemasukan',
                'nominal' => $p->jumlah,
                'type' => 'masuk',
            ]))
            ->merge($pengeluaran->map(fn($p) => [
                'tanggal' => $p->created_at->format('d-m-Y'),
                'kategori' => $p->kategoriPengeluaran?->nama ?? 'Pengeluaran',
                'nominal' => $p->jumlah,
                'type' => 'keluar',
            ]))
            ->sortByDesc('tanggal')
            ->values();

        $totalPemasukan = $transaksi->where('type', 'masuk')->sum('nominal');
        $totalPengeluaran = $transaksi->where('type', 'keluar')->sum('nominal');

        $writer = new Writer();
        $writer->openToBrowser('Laporan-Keuangan.xlsx');

        $writer->addRow(Row::fromValues(['Tanggal', 'Kategori', 'Nominal', 'Status']));

        foreach ($transaksi as $t) {
            $nominal = $t['type'] === 'masuk'
                ? '+ ' . number_format($t['nominal'], 0, ',', '.')
                : '- ' . number_format($t['nominal'], 0, ',', '.');
            $status = $t['type'] === 'masuk' ? 'Pemasukan' : 'Pengeluaran';
            $writer->addRow(Row::fromValues([$t['tanggal'], $t['kategori'], $nominal, $status]));
        }

        $writer->addRow(Row::fromValues(['', '', '', '']));
        $writer->addRow(Row::fromValues(['Total Pemasukan', '', 'Rp ' . number_format($totalPemasukan, 0, ',', '.'), '']));
        $writer->addRow(Row::fromValues(['Total Pengeluaran', '', 'Rp ' . number_format($totalPengeluaran, 0, ',', '.'), '']));
        $writer->addRow(Row::fromValues(['Saldo Akhir', '', 'Rp ' . number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.'), '']));

        $writer->close();
        exit;
    }
}
