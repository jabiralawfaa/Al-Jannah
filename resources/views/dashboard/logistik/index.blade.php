@extends('layouts.dashboard')

@section('title', 'Dashboard Logistik')

@php
    $menuItems = [
        ['label' => 'Beranda', 'url' => route('logistik.dashboard'), 'active' => 'logistik'],
        ['label' => 'Stok Barang', 'url' => route('logistik.stok'), 'active' => 'logistik/stok*'],
        ['label' => 'Aset & Kendaraan', 'url' => route('logistik.aset'), 'active' => 'logistik/aset*'],
        ['label' => 'Riwayat', 'url' => route('logistik.riwayat'), 'active' => 'logistik/riwayat*'],
    ];

    use Illuminate\Support\Facades\DB;
    $totalStok = DB::table('stok_barang')->sum('stok');

    $stokTerbanyak = DB::table('stok_barang')
        ->leftJoin('kategori_barang', 'stok_barang.kategori_barang_id', '=', 'kategori_barang.id')
        ->select('stok_barang.kode_barang', 'stok_barang.nama_barang', 'kategori_barang.nama as kategori', 'stok_barang.stok', 'stok_barang.satuan')
        ->orderBy('stok_barang.stok', 'desc')
        ->limit(5)
        ->get();
    $maxStok = $stokTerbanyak->max('stok') ?: 100;

    $stokMenipisStatik = collect([
        (object) ['nama_barang' => 'Tinta Printer Hitam', 'stok' => 5],
        (object) ['nama_barang' => 'Paket Jenazah Pria', 'stok' => 2],
        (object) ['nama_barang' => 'Paket Jenazah Bayi', 'stok' => 3],
    ]);
@endphp

@push('styles')
<style>
    main.main-content > div.content-wrapper { background: #d8e4e1; }
    .page-logistik .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin-bottom: 24px; }
    .page-logistik .stat-card { padding: 18px 22px; display: flex; align-items: center; gap: 16px; }
    .page-logistik .stat-card .stat-icon { width: 48px; height: 48px; border-radius: 14px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    .page-logistik .stat-card .stat-icon .material-icons { font-size: 24px; }
    .page-logistik .stat-card .stat-value { font-size: 26px; font-weight: 800; color: #1f2937; line-height: 1.1; }
    .page-logistik .stat-card .stat-unit { font-size: 12px; color: #6b7280; font-weight: 500; margin-top: 2px; }
    .page-logistik .row-2col { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
    .page-logistik .card { border: 1.5px solid #c9d8d4; border-radius: 14px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); }
    .page-logistik .card-header-custom { padding: 14px 22px; border-bottom: 1px solid #e5e7eb; }
    .page-logistik .card-header-custom h2 { font-size: 13px; font-weight: 700; color: #16423c; margin: 0; text-transform: uppercase; letter-spacing: 0.3px; }
    .page-logistik .card-body-custom { padding: 18px 22px; }
    .bar-label { font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px; display: flex; justify-content: space-between; }
    .bar-track { height: 10px; background: #e5e7eb; border-radius: 10px; overflow: hidden; }
    .bar-fill { height: 100%; border-radius: 10px; transition: width 0.6s ease; }
    .legend-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; flex-shrink: 0; }
    .progress-track { height: 8px; background: #e5e7eb; border-radius: 8px; overflow: hidden; min-width: 100px; }
    .progress-fill { height: 100%; border-radius: 8px; background: linear-gradient(90deg, #22c55e, #16a34a); }
    .badge-restock { background: #f0b400; color: #000; padding: 2px 14px; border-radius: 20px; font-size: 10px; font-weight: 700; display: inline-block; white-space: nowrap; }
    @media (max-width: 1024px) {
        .page-logistik .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .page-logistik .row-2col { grid-template-columns: 1fr; }
    }
    @media (max-width: 640px) {
        .page-logistik .stats-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="page-logistik">
    <h1 style="color: #16423c; font-weight: bold; margin-bottom: 24px; text-transform: lowercase; font-size: 22px;">dashboard</h1>

    @if(session('success'))
        <div style="background-color: #d8efdd; border: 1px solid #35ab50; border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; font-size: 0.95rem; color: #154420;">
            <span class="material-icons" style="color: #35ab50; font-size: 20px;">check_circle</span>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background-color: #fde8e8; border: 1px solid #e53e3e; border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; font-size: 0.95rem; color: #742a2a;">
            <span class="material-icons" style="color: #e53e3e; font-size: 20px;">error</span>
            {{ session('error') }}
        </div>
    @endif

    <div class="stats-grid">
        <div class="stat-card card">
            <div class="stat-icon" style="background: #e8f5e9;">
                <span class="material-icons" style="color: #2e7d32;">inventory</span>
            </div>
            <div>
                <div class="stat-value">{{ $totalBarang }}</div>
                <div class="stat-unit">Jenis Barang</div>
            </div>
        </div>
        <div class="stat-card card">
            <div class="stat-icon" style="background: #e3f2fd;">
                <span class="material-icons" style="color: #1565c0;">login</span>
            </div>
            <div>
                <div class="stat-value">{{ $barangMasukHariIni }}</div>
                <div class="stat-unit">Barang Masuk Hari Ini</div>
            </div>
        </div>
        <div class="stat-card card">
            <div class="stat-icon" style="background: #fce4ec;">
                <span class="material-icons" style="color: #c62828;">logout</span>
            </div>
            <div>
                <div class="stat-value">{{ $barangKeluarHariIni }}</div>
                <div class="stat-unit">Barang Keluar Hari Ini</div>
            </div>
        </div>
        <div class="stat-card card">
            <div class="stat-icon" style="background: #fff8e1;">
                <span class="material-icons" style="color: #f57f17;">inventory_2</span>
            </div>
            <div>
                <div class="stat-value">{{ $totalStok }}</div>
                <div class="stat-unit">Total Stok</div>
            </div>
        </div>
    </div>

    <div class="row-2col">
        <div class="card" style="padding: 0; overflow: hidden;">
            <div class="card-header-custom">
                <h2>Stok per Kategori</h2>
            </div>
            <div class="card-body-custom">
                @php $kategoriData = [['label' => 'ATK', 'value' => 180, 'color' => '#3b82f6'], ['label' => 'Bahan', 'value' => 60, 'color' => '#22c55e'], ['label' => 'Peralatan', 'value' => 25, 'color' => '#f59e0b'], ['label' => 'Lainnya', 'value' => 10, 'color' => '#8b5cf6']]; $maxKat = 180; @endphp
                <div style="display: flex; flex-direction: column; gap: 16px;">
                    @foreach($kategoriData as $k)
                    <div>
                        <div class="bar-label"><span>{{ $k['label'] }}</span><span>{{ $k['value'] }}</span></div>
                        <div class="bar-track"><div class="bar-fill" style="width: {{ $k['value'] / $maxKat * 100 }}%; background: {{ $k['color'] }};"></div></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card" style="padding: 0; overflow: hidden;">
            <div class="card-header-custom">
                <h2>Status Aset &amp; Kendaraan</h2>
            </div>
            <div class="card-body-custom" style="display: flex; flex-direction: column; align-items: center; gap: 16px; padding: 24px 22px;">
                <svg width="130" height="130" viewBox="0 0 130 130">
                    <circle cx="65" cy="65" r="48" fill="none" stroke="#e5e7eb" stroke-width="20"/>
                    <circle cx="65" cy="65" r="48" fill="none" stroke="#22c55e" stroke-width="20"
                            stroke-dasharray="241.3 301.6" stroke-dashoffset="0"
                            transform="rotate(-90 65 65)"/>
                    <circle cx="65" cy="65" r="48" fill="none" stroke="#3b82f6" stroke-width="20"
                            stroke-dasharray="60.3 301.6" stroke-dashoffset="-241.3"
                            transform="rotate(-90 65 65)"/>
                </svg>
                <div style="display: flex; gap: 24px; flex-wrap: wrap; justify-content: center;">
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <span class="legend-dot" style="background: #22c55e;"></span>
                        <span style="font-size: 12px; color: #374151;">Tersedia <strong>4</strong></span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <span class="legend-dot" style="background: #3b82f6;"></span>
                        <span style="font-size: 12px; color: #374151;">Dipakai <strong>1</strong></span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <span class="legend-dot" style="background: #f97316;"></span>
                        <span style="font-size: 12px; color: #374151;">Maintenance <strong>0</strong></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row-2col">
        <div class="card" style="padding: 0; overflow: hidden;">
            <div class="card-header-custom">
                <h2>Aktivitas Barang 2026</h2>
            </div>
            <div class="card-body-custom" style="padding: 16px 22px 20px;">
                @php
                    $bulan = ['Jan','Feb','Mar','Apr','Mei','Jun'];
                    $masuk = [5,8,4,10,6,7];
                    $keluar = [2,3,1,4,2,3];
                    $maxVal = 10;
                    $chartW = 440; $chartH = 180; $padL = 35; $padB = 30; $padT = 15; $padR = 15;
                    $drawW = $chartW - $padL - $padR;
                    $drawH = $chartH - $padT - $padB;
                    $stepX = $drawW / (count($bulan) - 1);
                    $scaleY = $drawH / $maxVal;
                    function pt($i, $v, $padL, $padT, $stepX, $scaleY, $drawH) {
                        $x = $padL + $i * $stepX;
                        $y = $padT + $drawH - $v * $scaleY;
                        return "$x,$y";
                    }
                    $ptsMasuk = ''; $ptsKeluar = '';
                    foreach ($masuk as $i => $v) {
                        $ptsMasuk .= ($i > 0 ? ' ' : '') . pt($i, $v, $padL, $padT, $stepX, $scaleY, $drawH);
                    }
                    foreach ($keluar as $i => $v) {
                        $ptsKeluar .= ($i > 0 ? ' ' : '') . pt($i, $v, $padL, $padT, $stepX, $scaleY, $drawH);
                    }
                @endphp
                <svg width="100%" height="200" viewBox="0 0 {{ $chartW }} {{ $chartH }}" style="display: block;">
                    @for ($i = 0; $i <= 10; $i+=2)
                    <line x1="{{ $padL }}" y1="{{ $padT + $drawH - $i * $scaleY }}" x2="{{ $chartW - $padR }}" y2="{{ $padT + $drawH - $i * $scaleY }}" stroke="#e5e7eb" stroke-width="1" stroke-dasharray="3 3"/>
                    <text x="{{ $padL - 6 }}" y="{{ $padT + $drawH - $i * $scaleY + 4 }}" text-anchor="end" font-size="9" fill="#9ca3af">{{ $i }}</text>
                    @endfor
                    @foreach ($bulan as $i => $b)
                    <text x="{{ $padL + $i * $stepX }}" y="{{ $chartH - 4 }}" text-anchor="middle" font-size="10" fill="#6b7280">{{ $b }}</text>
                    @endforeach
                    <polyline points="{{ $ptsMasuk }}" fill="none" stroke="#3b82f6" stroke-width="2.5" stroke-linejoin="round" stroke-linecap="round"/>
                    <polyline points="{{ $ptsKeluar }}" fill="none" stroke="#f59e0b" stroke-width="2.5" stroke-linejoin="round" stroke-linecap="round"/>
                    @foreach ($masuk as $i => $v)
                    <circle cx="{{ $padL + $i * $stepX }}" cy="{{ $padT + $drawH - $v * $scaleY }}" r="3.5" fill="#3b82f6" stroke="#fff" stroke-width="1.5"/>
                    @endforeach
                    @foreach ($keluar as $i => $v)
                    <circle cx="{{ $padL + $i * $stepX }}" cy="{{ $padT + $drawH - $v * $scaleY }}" r="3.5" fill="#f59e0b" stroke="#fff" stroke-width="1.5"/>
                    @endforeach
                </svg>
                <div style="display: flex; gap: 20px; justify-content: center; margin-top: 8px;">
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <span style="width: 14px; height: 3px; border-radius: 2px; background: #3b82f6; display: inline-block;"></span>
                        <span style="font-size: 11px; color: #6b7280;">Barang Masuk</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <span style="width: 14px; height: 3px; border-radius: 2px; background: #f59e0b; display: inline-block;"></span>
                        <span style="font-size: 11px; color: #6b7280;">Barang Keluar</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card" style="padding: 0; overflow: hidden;">
            <div class="card-header-custom">
                <h2>Barang Masuk / Keluar Hari Ini</h2>
            </div>
            <div class="card-body-custom" style="display: flex; flex-direction: column; gap: 28px; padding: 36px 22px;">
                <div style="display: flex; align-items: center; gap: 18px;">
                    <div style="width: 52px; height: 52px; border-radius: 14px; background: #e8f5e9; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <span class="material-icons" style="font-size: 26px; color: #2e7d32;">south</span>
                    </div>
                    <div>
                        <div style="font-size: 32px; font-weight: 800; color: #1f2937; line-height: 1;">{{ $barangMasukHariIni }}</div>
                        <div style="font-size: 12px; color: #6b7280; font-weight: 500; margin-top: 4px;">Barang Masuk</div>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 18px;">
                    <div style="width: 52px; height: 52px; border-radius: 14px; background: #fce4ec; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <span class="material-icons" style="font-size: 26px; color: #c62828;">north</span>
                    </div>
                    <div>
                        <div style="font-size: 32px; font-weight: 800; color: #1f2937; line-height: 1;">{{ $barangKeluarHariIni }}</div>
                        <div style="font-size: 12px; color: #6b7280; font-weight: 500; margin-top: 4px;">Barang Keluar</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 0; overflow: hidden; margin-bottom: 20px;">
        <div style="background: #f0b400; padding: 12px 22px; display: flex; align-items: center; gap: 10px;">
            <span class="material-icons" style="font-size: 18px; color: #000;">warning</span>
            <h2 style="color: #000; font-size: 14px; font-weight: 700; margin: 0; text-transform: uppercase; letter-spacing: 0.3px;">Peringatan Stok Menipis</h2>
        </div>
        <div class="card-body-custom">
            @if($stokMenipis->isNotEmpty() || $stokMenipisStatik->isNotEmpty())
            <div class="table-container">
                <table class="table" style="font-size: 13px;">
                    <thead>
                        <tr>
                            <th style="padding: 10px 16px;">Barang</th>
                            <th style="padding: 10px 16px;">Stok</th>
                            <th style="padding: 10px 16px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stokMenipisStatik as $b)
                        <tr>
                            <td style="padding: 10px 16px; font-weight: 600;">{{ $b->nama_barang }}</td>
                            <td style="padding: 10px 16px;">{{ $b->stok }}</td>
                            <td style="padding: 10px 16px;"><span class="badge-restock">Segera Restock</span></td>
                        </tr>
                        @endforeach
                        @foreach($stokMenipis as $b)
                        <tr>
                            <td style="padding: 10px 16px; font-weight: 600;">{{ $b->nama_barang }}</td>
                            <td style="padding: 10px 16px;">{{ $b->stok }}</td>
                            <td style="padding: 10px 16px;"><span class="badge-restock">Segera Restock</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div style="display: flex; align-items: center; gap: 10px; padding: 8px 0;">
                <span class="material-icons" style="color: #16a34a; font-size: 22px;">check_circle</span>
                <span style="font-size: 14px; color: #374151; font-weight: 500;">Semua stok barang dalam kondisi aman</span>
            </div>
            @endif
        </div>
    </div>

    <div class="card" style="padding: 0; overflow: hidden;">
        <div class="card-header-custom">
            <h2>Barang dengan Stok Terbanyak</h2>
        </div>
        <div class="card-body-custom" style="padding: 0;">
            <div class="table-container">
                <table class="table" style="font-size: 13px;">
                    <thead>
                        <tr>
                            <th style="padding: 12px 22px;">Kode</th>
                            <th style="padding: 12px 22px;">Nama Barang</th>
                            <th style="padding: 12px 22px;">Kategori</th>
                            <th style="padding: 12px 22px;">Stok</th>
                            <th style="padding: 12px 22px;">Indikator</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stokTerbanyak as $b)
                        <tr>
                            <td style="padding: 12px 22px; font-weight: 600; color: #16423c;">{{ $b->kode_barang }}</td>
                            <td style="padding: 12px 22px; font-weight: 500;">{{ $b->nama_barang }}</td>
                            <td style="padding: 12px 22px; color: #6b7280;">{{ $b->kategori ?? '-' }}</td>
                            <td style="padding: 12px 22px; font-weight: 600;">{{ $b->stok }} {{ $b->satuan }}</td>
                            <td style="padding: 12px 22px;">
                                <div class="progress-track">
                                    <div class="progress-fill" style="width: {{ $b->stok / $maxStok * 100 }}%;"></div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 24px; color: #6b7280;">Belum ada data barang.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
