@extends('layouts.dashboard')

@section('title', 'Barang Keluar')
@section('activeMenu', 'barang-keluar')

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
            'label' => 'Aset & Kendaraan',
            'url' => route('logistik.aset'),
            'active' => 'logistik/aset*'
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
            'label' => 'Riwayat',
            'url' => route('logistik.riwayat'),
            'active' => 'logistik/riwayat*'
        ],
    ];
@endphp

@section('content')
<div style="background-color: #d8e4e1; min-height: 100vh; margin: -30px; padding: 30px; font-family: 'Segoe UI', 'Poppins', sans-serif;">
    <h1 style="color: #14524b; font-weight: bold; font-size: 24px; margin-bottom: 24px;">Barang Keluar</h1>

    <div style="display: flex; justify-content: center;">
    <div style="background-color: #f5f5f5; border: 1px solid #c8d6d3; border-radius: 6px; box-shadow: 0 2px 6px rgba(0,0,0,0.08); width: 330px; padding: 20px;">
        <h2 style="font-size: 15px; font-weight: bold; color: #1a1a1a; margin: 0 0 16px 0;">Input Barang Keluar / Digunakan</h2>

        <form>
            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Pilih Barang</label>
                <select style="width: 100%; height: 32px; border: 1px solid #c8d6d3; border-radius: 4px; padding: 0 10px; font-size: 12px; outline: none; color: #1a1a1a; background: #ffffff; font-family: 'Segoe UI', 'Poppins', sans-serif;">
                    <option>Pilih Barang ....</option>
                    <option>Tinta Printer Hitam</option>
                    <option>Tinta Printer Kuning</option>
                    <option>Kertas A4</option>
                    <option>Paket Jenazah (Pria)</option>
                </select>
            </div>
            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Jumlah Barang Keluar</label>
                <input type="number" value="0" style="width: 100%; height: 32px; border: 1px solid #c8d6d3; border-radius: 4px; padding: 0 10px; font-size: 12px; outline: none; color: #1a1a1a; background: #ffffff; font-family: 'Segoe UI', 'Poppins', sans-serif;">
            </div>
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Keperluan</label>
                <textarea placeholder="Contoh : untuk pengajian acara" style="width: 100%; height: 80px; border: 1px solid #c8d6d3; border-radius: 4px; padding: 8px 10px; font-size: 12px; resize: none; outline: none; color: #1a1a1a; background: #ffffff; font-family: 'Segoe UI', 'Poppins', sans-serif;"></textarea>
            </div>
            <button type="submit" style="background-color: #8b0000; color: white; border: none; border-radius: 6px; height: 34px; padding: 0 20px; font-size: 12px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); font-family: 'Segoe UI', 'Poppins', sans-serif; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#6d0000'" onmouseout="this.style.backgroundColor='#8b0000'">
                <span class="material-icons" style="font-size: 16px;">remove</span>
                Kurangi Stok
            </button>
        </form>
    </div>
    </div>
</div>
@endsection
