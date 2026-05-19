@extends('layouts.dashboard')

@section('title', 'Dashboard Logistik')

@php
    $menuItems = [
        [
            'label' => 'Beranda',
            'url' => route('logistik.dashboard'),
            'active' => 'logistik'
        ],
        [
            'label' => 'Stok Barang',
            'url' => route('logistik.stok'),
            'active' => 'logistik/stok*'
        ],
        [
            'label' => 'Barang Masuk',
            'url' => route('logistik.barang-masuk'),
            'active' => 'logistik/barang-masuk*'
        ],
        [
            'label' => 'Aset & Kendaraan',
            'url' => route('logistik.aset'),
            'active' => 'logistik/aset*'
        ],
        [
            'label' => 'Riwayat',
            'url' => route('logistik.riwayat'),
            'active' => 'logistik/riwayat*'
        ],
    ];
@endphp

@section('content')
<div style="background-color: #d8e4e1; min-height: 100vh; margin: -30px; padding: 30px; font-family: 'Inter', 'Poppins', sans-serif;">
    <h1 style="color: #14524b; font-weight: bold; margin-bottom: 24px; font-size: 24px;">Dashboard</h1>

    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; margin-bottom: 24px;">
        <div style="background-color: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #c8d6d3; padding: 20px;">
            <div style="display: flex; align-items: center; gap: 16px;">
                <span class="material-icons" style="font-size: 40px; color: #14524b;">inventory_2</span>
                <div>
                    <div style="font-size: 28px; font-weight: 700; color: #1a1a1a;">{{ $totalBarang }}</div>
                    <div style="font-size: 13px; color: #6b7280; margin-top: 2px;">Jenis Barang</div>
                </div>
            </div>
        </div>
        <div style="background-color: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #c8d6d3; padding: 20px;">
            <div style="display: flex; align-items: center; gap: 16px;">
                <span class="material-icons" style="font-size: 40px; color: #14524b;">south_west</span>
                <div>
                    <div style="font-size: 28px; font-weight: 700; color: #1a1a1a;">{{ $barangMasukHariIni }}</div>
                    <div style="font-size: 13px; color: #6b7280; margin-top: 2px;">Barang Masuk Hari ini</div>
                </div>
            </div>
        </div>
        <div style="background-color: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #c8d6d3; padding: 20px;">
            <div style="display: flex; align-items: center; gap: 16px;">
                <span class="material-icons" style="font-size: 40px; color: #b91c1c;">north_east</span>
                <div>
                    <div style="font-size: 28px; font-weight: 700; color: #1a1a1a;">{{ $barangKeluarHariIni }}</div>
                    <div style="font-size: 13px; color: #6b7280; margin-top: 2px;">Barang Keluar Hari ini</div>
                </div>
            </div>
        </div>
        <div style="background-color: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #c8d6d3; padding: 20px;">
            <div style="display: flex; align-items: center; gap: 16px;">
                <span class="material-icons" style="font-size: 40px; color: #eab308;">error_outline</span>
                <div>
                    <div style="font-size: 28px; font-weight: 700; color: #1a1a1a;">{{ $totalStokMenipis }}</div>
                    <div style="font-size: 13px; color: #6b7280; margin-top: 2px;">Stok Menipis (&lt;10)</div>
                </div>
            </div>
        </div>
    </div>

    <div style="background-color: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #c8d6d3; overflow: hidden;">
        <div style="background-color: #f0b400; padding: 12px 24px;">
            <h2 style="color: black; font-size: 16px; font-weight: bold; margin: 0;">PERINGATAN STOK MENIPIS</h2>
        </div>
        <div style="padding: 0; background-color: #d8e4e1;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; background-color: transparent;">
                    <thead>
                        <tr style="border-bottom: 2px solid #14524b;">
                            <th style="background-color: transparent; color: black; font-weight: 700; font-size: 13px; padding: 12px 20px; border: 1px solid #94a3b8;">Kode Barang</th>
                            <th style="background-color: transparent; color: black; font-weight: 700; font-size: 13px; padding: 12px 20px; border: 1px solid #94a3b8;">Nama Barang</th>
                            <th style="background-color: transparent; color: black; font-weight: 700; font-size: 13px; padding: 12px 20px; border: 1px solid #94a3b8;">Kategori</th>
                            <th style="background-color: transparent; color: black; font-weight: 700; font-size: 13px; padding: 12px 20px; border: 1px solid #94a3b8;">Sisa Stok</th>
                            <th style="background-color: transparent; color: black; font-weight: 700; font-size: 13px; padding: 12px 20px; border: 1px solid #94a3b8;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stokMenipis as $barang)
                        <tr style="border-bottom: 1px solid #94a3b8;">
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #94a3b8;">{{ $barang->kode_barang }}</td>
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #94a3b8;">{{ $barang->nama_barang }}</td>
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #94a3b8;">{{ $barang->kategori }}</td>
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #94a3b8;">{{ $barang->stok }} {{ $barang->satuan }}</td>
                            <td style="padding: 12px 20px; border: 1px solid #94a3b8;">
                                <span style="background-color: #f0b400; color: black; padding: 4px 16px; border-radius: 999px; font-size: 11px; font-weight: 700; display: inline-block;">Segera Restock</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="background-color: white; height: 250px;"></div>
        </div>
    </div>
</div>
@endsection
