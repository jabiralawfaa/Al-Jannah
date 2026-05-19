@extends('layouts.dashboard')

@section('title', 'Riwayat')
@section('activeMenu', 'riwayat')

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
            'label' => 'Barang Keluar',
            'url' => route('logistik.barang-keluar'),
            'active' => 'logistik/barang-keluar*'
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
<div style="background-color: #d8e4e1; min-height: 100vh; margin: -30px; padding: 30px; font-family: 'Segoe UI', 'Poppins', sans-serif;">
    <h1 style="color: #14524b; font-weight: bold; font-size: 24px; margin-bottom: 24px;">Riwayat</h1>

    <div style="background-color: #f5f5f5; border: 1px solid #c8d6d3; border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.08); overflow: hidden;">
        <div style="padding: 14px 20px; background-color: white; border-bottom: 1px solid #c8d6d3;">
            <h2 style="font-size: 14px; font-weight: bold; color: #1a1a1a; margin: 0;">Riwayat Peminjaman dan Penggunaan Barang/Aset/kendaraan</h2>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #c8d6d3;">
                        <th style="padding: 10px 16px; text-align: left; font-weight: 700; font-size: 12px; color: black; background-color: white;">Waktu</th>
                        <th style="padding: 10px 16px; text-align: left; font-weight: 700; font-size: 12px; color: black; background-color: white;">Tipe</th>
                        <th style="padding: 10px 16px; text-align: left; font-weight: 700; font-size: 12px; color: black; background-color: white;">Barang/Aset</th>
                        <th style="padding: 10px 16px; text-align: left; font-weight: 700; font-size: 12px; color: black; background-color: white;">Jumlah</th>
                        <th style="padding: 10px 16px; text-align: left; font-weight: 700; font-size: 12px; color: black; background-color: white;">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #c8d6d3;">
                        <td style="padding: 10px 16px; font-size: 12px; color: black; background-color: #ecf4f1;">4/16/2026</td>
                        <td style="padding: 10px 16px; background-color: #ecf4f1;">
                            <span style="background-color: #2563eb; color: white; padding: 2px 12px; border-radius: 999px; font-size: 10px; font-weight: 700; display: inline-block;">Dipinjam</span>
                        </td>
                        <td style="padding: 10px 16px; font-size: 12px; color: black; background-color: #ecf4f1;">Toyota Hiace</td>
                        <td style="padding: 10px 16px; font-size: 12px; color: black; background-color: #ecf4f1;">1</td>
                        <td style="padding: 10px 16px; font-size: 12px; color: black; background-color: #ecf4f1;">Pengantaran Jenazah</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #c8d6d3;">
                        <td style="padding: 10px 16px; font-size: 12px; color: black; background-color: #f3f8f6;">4/12/2026</td>
                        <td style="padding: 10px 16px; background-color: #f3f8f6;">
                            <span style="background-color: #166534; color: white; padding: 2px 12px; border-radius: 999px; font-size: 10px; font-weight: 700; display: inline-block;">Masuk</span>
                        </td>
                        <td style="padding: 10px 16px; font-size: 12px; color: black; background-color: #f3f8f6;">Tinta Kuning</td>
                        <td style="padding: 10px 16px; font-size: 12px; color: black; background-color: #f3f8f6;">10</td>
                        <td style="padding: 10px 16px; font-size: 12px; color: black; background-color: #f3f8f6;">Isi Stok</td>
                    </tr>
                    <tr style="border-bottom: 1px solid #c8d6d3;">
                        <td style="padding: 10px 16px; font-size: 12px; color: black; background-color: #ecf4f1;">4/12/2026</td>
                        <td style="padding: 10px 16px; background-color: #ecf4f1;">
                            <span style="background-color: #8b0000; color: white; padding: 2px 12px; border-radius: 999px; font-size: 10px; font-weight: 700; display: inline-block;">Keluar</span>
                        </td>
                        <td style="padding: 10px 16px; font-size: 12px; color: black; background-color: #ecf4f1;">Tinta Hitam</td>
                        <td style="padding: 10px 16px; font-size: 12px; color: black; background-color: #ecf4f1;">2</td>
                        <td style="padding: 10px 16px; font-size: 12px; color: black; background-color: #ecf4f1;">Isi Ulang Tinta Printer</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="background-color: white; height: 300px;"></div>
    </div>
</div>
@endsection
