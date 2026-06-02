@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Beranda', 'url' => '/logistik', 'active' => 'logistik'],
        ['label' => 'Stok Barang', 'url' => '/logistik/stok', 'active' => 'logistik/stok*'],
        ['label' => 'Aset & Kendaraan', 'url' => '/logistik/aset', 'active' => 'logistik/aset*'],
        ['label' => 'Riwayat', 'url' => '/logistik/riwayat', 'active' => 'logistik/riwayat*'],
    ]
])

@section('title', 'Riwayat')

@section('activeMenu', 'riwayat')

@section('content')
<div style="background-color: #d8e4e1; min-height: 100vh; margin: -30px; padding: 30px; font-family: 'Inter', 'Poppins', sans-serif;">
    <h1 style="color: var(--primary-900); font-weight: bold; margin-bottom: 20px; font-size: 24px;">Riwayat</h1>

    <div class="card" style="border: none; box-shadow: 0 2px 6px rgba(0,0,0,0.08); padding: 0; overflow: hidden; border-radius: 10px; background-color: white;">
        <div style="background-color: var(--primary-900); padding: 10px 20px;">
            <h2 style="color: white; font-size: 14px; font-weight: 700; margin: 0;">Riwayat Peminjaman dan Penggunaan Barang/Aset/Kendaraan</h2>
        </div>
        <div style="padding: 0;">
            <div class="table-container">
                <table id="riwayat-table" class="table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="background-color: white; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #b7c8c2;">Waktu</th>
                            <th style="background-color: white; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #b7c8c2;">Tipe</th>
                            <th style="background-color: white; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #b7c8c2;">Barang/Aset</th>
                            <th style="background-color: white; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #b7c8c2;">Jumlah</th>
                            <th style="background-color: white; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #b7c8c2;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $tipeColors = [
                                'masuk' => '#166534',
                                'keluar' => '#8b0000',
                                'dipinjam' => '#2563eb',
                                'dikembalikan' => '#166534',
                            ];
                        @endphp
                        @forelse($riwayat as $item)
                        <tr>
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #b7c8c2;">{{ \Carbon\Carbon::parse($item->waktu)->format('d/m/Y H:i') }}</td>
                            <td style="padding: 12px 20px; border: 1px solid #b7c8c2; text-align: center;">
                                <span style="background-color: {{ $tipeColors[$item->tipe] ?? '#6b7280' }}; color: white; padding: 4px 20px; border-radius: 20px; font-size: 11px; font-weight: 700; display: inline-block; min-width: 80px;">{{ ucfirst($item->tipe) }}</span>
                            </td>
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #b7c8c2;">{{ $item->nama_barang ?? $item->kode_barang ?? '-' }}</td>
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #b7c8c2;">{{ $item->jumlah }}</td>
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #b7c8c2;">{{ $item->keterangan ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="padding: 20px; text-align: center; color: #6b7280; font-size: 13px;">Belum ada riwayat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div style="background-color: white; height: 20px;"></div>
        </div>
    </div>
</div>

<style>
    #riwayat-table tbody tr { background-color: #ffffff; }
    #riwayat-table tbody tr:hover { background-color: #f7fbfa; }
</style>
@endsection
