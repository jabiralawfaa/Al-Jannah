@extends('layouts.dashboard')

@section('title', 'Aset & Kendaraan')
@section('activeMenu', 'aset')

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
    <h1 style="color: #14524b; font-weight: bold; font-size: 24px; margin-bottom: 24px;">Aset & Kendaraan</h1>

    <div style="background-color: white; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); border: 1px solid #14524b; padding: 24px; margin-bottom: 24px;">
        <h2 style="font-size: 18px; font-weight: bold; color: #1a1a1a; margin: 0 0 20px 0;">Tambah Barang baru</h2>

        <form>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div>
                    <div style="margin-bottom: 14px;">
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 4px;">Nama Aset / kendaraan</label>
                        <input type="text" placeholder="Contoh : Toyota Hiace" style="width: 100%; padding: 8px 10px; border: 1px solid #c8d6d3; border-radius: 4px; font-size: 13px; outline: none; color: #1a1a1a; background-color: white; font-family: 'Segoe UI', 'Poppins', sans-serif;">
                    </div>
                    <div style="margin-bottom: 0;">
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 4px;">Tipe</label>
                        <select style="width: 100%; padding: 8px 10px; border: 1px solid #c8d6d3; border-radius: 4px; font-size: 13px; outline: none; color: #1a1a1a; background-color: white; font-family: 'Segoe UI', 'Poppins', sans-serif;">
                            <option>Mobil</option>
                            <option>Pickup</option>
                            <option>Motor</option>
                            <option>Gedung</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div style="margin-bottom: 14px;">
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 4px;">Nomor Plat/Seri</label>
                        <input type="text" placeholder="Contoh : B 1234 XYZ" style="width: 100%; padding: 8px 10px; border: 1px solid #c8d6d3; border-radius: 4px; font-size: 13px; outline: none; color: #1a1a1a; background-color: white; font-family: 'Segoe UI', 'Poppins', sans-serif;">
                    </div>
                    <div style="margin-bottom: 0;">
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 4px;">Kondisi Awal</label>
                        <select style="width: 100%; padding: 8px 10px; border: 1px solid #c8d6d3; border-radius: 4px; font-size: 13px; outline: none; color: #1a1a1a; background-color: white; font-family: 'Segoe UI', 'Poppins', sans-serif;">
                            <option>Baik</option>
                            <option>Rusak Ringan</option>
                            <option>Rusak Berat</option>
                        </select>
                    </div>
                </div>
            </div>
            <div style="margin-top: 20px;">
                <button type="submit" style="background-color: #0f4b45; color: white; border: none; padding: 10px 24px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); font-family: 'Segoe UI', 'Poppins', sans-serif; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#0d3d38'" onmouseout="this.style.backgroundColor='#0f4b45'">
                    <span class="material-icons" style="font-size: 18px;">add</span>
                    Tambah Aset
                </button>
            </div>
        </form>
    </div>

    <div style="background-color: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); border: 1px solid #14524b; overflow: hidden;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #c8d6d3;">
                        <th style="padding: 12px 20px; text-align: left; font-weight: 700; font-size: 13px; color: black; background-color: white;">Nama Barang</th>
                        <th style="padding: 12px 20px; text-align: left; font-weight: 700; font-size: 13px; color: black; background-color: white;">Plat/Seri</th>
                        <th style="padding: 12px 20px; text-align: left; font-weight: 700; font-size: 13px; color: black; background-color: white;">Tipe</th>
                        <th style="padding: 12px 20px; text-align: left; font-weight: 700; font-size: 13px; color: black; background-color: white;">Status</th>
                        <th style="padding: 12px 20px; text-align: left; font-weight: 700; font-size: 13px; color: black; background-color: white;">Kondisi</th>
                        <th style="padding: 12px 20px; text-align: center; font-weight: 700; font-size: 13px; color: black; background-color: white;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #c8d6d3;">
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">Toyota Hiace</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">BB 123 XYZ</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">Mobil</td>
                        <td style="padding: 12px 20px; background-color: #ecf4f1;">
                            <span style="background-color: #2563eb; color: white; padding: 3px 14px; border-radius: 999px; font-size: 11px; font-weight: 700; display: inline-block;">Dipakai</span>
                        </td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">Mesin Baik, Body Lecet</td>
                        <td style="padding: 12px 20px; text-align: center; background-color: #ecf4f1;">
                            <button onclick="openModal()" style="background-color: #f3f4f6; border: 1px solid #9ca3af; font-size: 12px; padding: 4px 12px; border-radius: 4px; cursor: pointer; font-family: 'Segoe UI', 'Poppins', sans-serif; color: #111; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#e5e7eb'" onmouseout="this.style.backgroundColor='#f3f4f6'">Ubah Status</button>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #c8d6d3;">
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #f3f8f6;">Suzuki Carry</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #f3f8f6;">BB 123 XYZ</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #f3f8f6;">Pickup</td>
                        <td style="padding: 12px 20px; background-color: #f3f8f6;">
                            <span style="background-color: #166534; color: white; padding: 3px 14px; border-radius: 999px; font-size: 11px; font-weight: 700; display: inline-block;">Tersedia</span>
                        </td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #f3f8f6;">Mesin Berfungsi</td>
                        <td style="padding: 12px 20px; text-align: center; background-color: #f3f8f6;">
                            <button onclick="openModal()" style="background-color: #f3f4f6; border: 1px solid #9ca3af; font-size: 12px; padding: 4px 12px; border-radius: 4px; cursor: pointer; font-family: 'Segoe UI', 'Poppins', sans-serif; color: #111; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#e5e7eb'" onmouseout="this.style.backgroundColor='#f3f4f6'">Ubah Status</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="background-color: white; height: 280px;"></div>
    </div>
</div>

<div id="statusModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.45); z-index: 9999; display: none; align-items: center; justify-content: center;">
    <div style="background: #ffffff; width: 400px; border-radius: 8px; padding: 24px; border: 1px solid #2d5a52; box-shadow: 0 6px 18px rgba(0,0,0,0.18);">
        <div style="font-size: 16px; font-weight: 700; color: #111; text-align: center; margin-bottom: 20px;">Pengubahan Status</div>
        <form>
            <label style="font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px; display: block;">Status</label>
            <select style="width: 100%; height: 32px; border: 1px solid #c8d6d3; border-radius: 4px; padding: 0 10px; font-size: 12px; background: #ffffff; margin-bottom: 14px; outline: none; color: #1a1a1a; font-family: 'Segoe UI', 'Poppins', sans-serif;">
                <option>Dipakai</option>
                <option>Tersedia</option>
                <option>Maintenance</option>
            </select>
            <label style="font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px; display: block;">Kondisi</label>
            <textarea placeholder="Tulis kondisi kendaraan disini." style="width: 100%; height: 90px; border: 1px solid #c8d6d3; border-radius: 4px; padding: 10px; font-size: 12px; resize: none; outline: none; margin-bottom: 16px; color: #1a1a1a; font-family: 'Segoe UI', 'Poppins', sans-serif; font-style: italic;"></textarea>
            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal()" style="background: #ffffff; border: 1px solid #9ca3af; border-radius: 999px; height: 28px; padding: 0 22px; font-size: 12px; font-weight: 600; cursor: pointer; color: #111; font-family: 'Segoe UI', 'Poppins', sans-serif; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f3f4f6'" onmouseout="this.style.backgroundColor='#ffffff'">Batal</button>
                <button type="submit" style="background: #ff1d1d; color: white; border: none; border-radius: 999px; height: 28px; padding: 0 22px; font-size: 12px; font-weight: 600; cursor: pointer; font-family: 'Segoe UI', 'Poppins', sans-serif; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#d61010'" onmouseout="this.style.backgroundColor='#ff1d1d'">Hapus</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('statusModal').style.display = 'flex';
}
function closeModal() {
    document.getElementById('statusModal').style.display = 'none';
}
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('statusModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
});
</script>
@endsection
