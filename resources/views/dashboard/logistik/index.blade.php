@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Beranda', 'url' => '/logistik', 'active' => 'logistik'],
        ['label' => 'Stok Barang', 'url' => '/logistik/stok', 'active' => 'logistik/stok*'],
        ['label' => 'Aset & Kendaraan', 'url' => '/logistik/aset', 'active' => 'logistik/aset*'],
        ['label' => 'Riwayat', 'url' => '/logistik/riwayat', 'active' => 'logistik/riwayat*'],
    ]
])

@section('title', 'Dashboard Logistik')

@section('activeMenu', 'beranda')

@section('content')
    <h1 style="color: var(--primary-900); font-weight: bold; margin-bottom: 30px; text-transform: lowercase;">dashboard</h1>

    @if(session('success'))
        <div style="background-color: #d8efdd; border: 1px solid #35ab50; border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; font-family: 'Segoe UI', sans-serif; font-size: 0.95rem; color: #154420;">
            <span class="material-icons" style="color: #35ab50; font-size: 20px;">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background-color: #fde8e8; border: 1px solid #e53e3e; border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; font-family: 'Segoe UI', sans-serif; font-size: 0.95rem; color: #742a2a;">
            <span class="material-icons" style="color: #e53e3e; font-size: 20px;">error</span>
            {{ session('error') }}
        </div>
    @endif

    <div class="stats-grid">
        <div class="stat-card">
            <div style="display: flex; align-items: center; gap: 16px;">
                <span class="material-icons" style="font-size: 48px; color: var(--primary-900);">inventory_2</span>
                <div>
                    <div class="stat-label">Jenis Barang</div>
                    <div class="stat-value">{{ $totalBarang }}</div>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div style="display: flex; align-items: center; gap: 16px;">
                <span class="material-icons" style="font-size: 48px; color: var(--primary-900);">south_west</span>
                <div>
                    <div class="stat-label">Barang masuk hari ini</div>
                    <div class="stat-value">{{ $barangMasukHariIni }}</div>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div style="display: flex; align-items: center; gap: 16px;">
                <span class="material-icons" style="font-size: 48px; color: var(--danger-500);">north_east</span>
                <div>
                    <div class="stat-label">Barang keluar hari ini</div>
                    <div class="stat-value">{{ $barangKeluarHariIni }}</div>
                </div>
            </div>
        </div>
        <div class="stat-card">
            <div style="display: flex; align-items: center; gap: 16px;">
                <span class="material-icons" style="font-size: 48px; color: var(--warning-500);">error_outline</span>
                <div>
                    <div class="stat-label">Stok menipis (&lt;10)</div>
                    <div class="stat-value">{{ $totalStokMenipis }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 0; overflow: hidden;">
        <div style="background-color: #f0b400; padding: 12px 24px;">
            <h2 style="color: var(--black); font-size: 18px; font-weight: bold; margin: 0;">PERINGATAN STOK MENIPIS</h2>
        </div>
        <div style="padding: 24px;">
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Sisa Stok</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stokMenipis as $barang)
                        <tr>
                            <td style="font-weight: 600;">{{ $barang->kode_barang }}</td>
                            <td>{{ $barang->nama_barang }}</td>
                            <td>{{ $barang->kategoriBarang->nama ?? '-' }}</td>
                            <td>{{ $barang->stok }} {{ $barang->satuan }}</td>
                            <td>
                                <span style="background-color: #f0b400; color: var(--black); padding: 4px 20px; border-radius: 20px; font-size: 11px; font-weight: 700; display: inline-block; min-width: 80px; text-align: center;">Segera Restock</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
