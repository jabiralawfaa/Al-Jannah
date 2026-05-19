@extends('layouts.dashboard')

@section('title', 'Stok Barang')
@section('activeMenu', 'stok')

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
<div style="background-color: #d8e4e1; min-height: 100vh; margin: -30px; padding: 30px; font-family: 'Inter', 'Poppins', sans-serif;">
    <h1 style="color: #14524b; font-weight: bold; margin-bottom: 24px; font-size: 24px;">Stok Barang</h1>

    <div style="background-color: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #c8d6d3; padding: 24px; margin-bottom: 24px;">
        <h2 style="color: #1a1a1a; font-size: 18px; font-weight: bold; margin: 0 0 20px 0;">Tambah Barang baru</h2>

        <form>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                <div>
                    <div style="margin-bottom: 12px;">
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 4px;">Kode Barang</label>
                        <input type="text" placeholder="Contoh : K-A4" style="width: 100%; padding: 8px 10px; border: 1px solid #c8d6d3; border-radius: 4px; font-size: 13px; outline: none; color: #1a1a1a; background-color: white;">
                    </div>
                    <div style="margin-bottom: 12px;">
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 4px;">Nama Barang</label>
                        <input type="text" placeholder="Contoh : Kertas A3" style="width: 100%; padding: 8px 10px; border: 1px solid #c8d6d3; border-radius: 4px; font-size: 13px; outline: none; color: #1a1a1a; background-color: white;">
                    </div>
                    <div style="margin-bottom: 0;">
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 4px;">Stok Awal</label>
                        <input type="text" placeholder="0" style="width: 100%; padding: 8px 10px; border: 1px solid #c8d6d3; border-radius: 4px; font-size: 13px; outline: none; color: #1a1a1a; background-color: white;">
                    </div>
                </div>
                <div>
                    <div style="margin-bottom: 12px;">
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 4px;">Kategori</label>
                        <select style="width: 100%; padding: 8px 10px; border: 1px solid #c8d6d3; border-radius: 4px; font-size: 13px; outline: none; color: #1a1a1a; background-color: white;">
                            <option>ATK</option>
                            <option>Bahan</option>
                            <option>Alat Kebersihan</option>
                        </select>
                    </div>
                    <div style="margin-bottom: 0;">
                        <label style="display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 4px;">Satuan</label>
                        <input type="text" placeholder="Pcs, Box, Unit" style="width: 100%; padding: 8px 10px; border: 1px solid #c8d6d3; border-radius: 4px; font-size: 13px; outline: none; color: #1a1a1a; background-color: white;">
                    </div>
                </div>
            </div>
            <div style="margin-top: 20px;">
                <button type="submit" style="background-color: #14524b; color: white; border: none; padding: 10px 28px; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                    <span class="material-icons" style="font-size: 18px;">add</span>
                    Tambah Barang
                </button>
            </div>
        </form>
    </div>

    <div style="background-color: white; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #14524b; overflow: hidden;">
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #d1d5db;">
                        <th style="padding: 12px 20px; text-align: left; font-weight: 700; font-size: 13px; color: black; background-color: white;">Kode Barang</th>
                        <th style="padding: 12px 20px; text-align: left; font-weight: 700; font-size: 13px; color: black; background-color: white;">Nama Barang</th>
                        <th style="padding: 12px 20px; text-align: left; font-weight: 700; font-size: 13px; color: black; background-color: white;">Kategori</th>
                        <th style="padding: 12px 20px; text-align: left; font-weight: 700; font-size: 13px; color: black; background-color: white;">Stok</th>
                        <th style="padding: 12px 20px; text-align: left; font-weight: 700; font-size: 13px; color: black; background-color: white;">Satuan</th>
                        <th style="padding: 12px 20px; text-align: center; font-weight: 700; font-size: 13px; color: black; background-color: white;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">TP-H</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">Tinta Printer Hitam</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">ATK</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">5</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">Botol</td>
                        <td style="padding: 12px 20px; text-align: center; background-color: #ecf4f1;">
                            <button onclick="openModal()" style="background-color: #dc2626; border: none; width: 28px; height: 28px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer;">
                                <span class="material-icons" style="font-size: 16px; color: white;">delete</span>
                            </button>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #f3f8f6;">TP-K</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #f3f8f6;">Tinta Printer Kuning</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #f3f8f6;">ATK</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #f3f8f6;">12</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #f3f8f6;">Botol</td>
                        <td style="padding: 12px 20px; text-align: center; background-color: #f3f8f6;">
                            <button onclick="openModal()" style="background-color: #dc2626; border: none; width: 28px; height: 28px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer;">
                                <span class="material-icons" style="font-size: 16px; color: white;">delete</span>
                            </button>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">PACK-W</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">Paket Jenazah (Wanita Dewasa)</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">Bahan</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">11</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">Pcs</td>
                        <td style="padding: 12px 20px; text-align: center; background-color: #ecf4f1;">
                            <button onclick="openModal()" style="background-color: #dc2626; border: none; width: 28px; height: 28px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer;">
                                <span class="material-icons" style="font-size: 16px; color: white;">delete</span>
                            </button>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #f3f8f6;">PACK-P</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #f3f8f6;">Paket Jenazah (Pria Dewasa)</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #f3f8f6;">Bahan</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #f3f8f6;">2</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #f3f8f6;">Pcs</td>
                        <td style="padding: 12px 20px; text-align: center; background-color: #f3f8f6;">
                            <button onclick="openModal()" style="background-color: #dc2626; border: none; width: 28px; height: 28px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer;">
                                <span class="material-icons" style="font-size: 16px; color: white;">delete</span>
                            </button>
                        </td>
                    </tr>
                    <tr style="border-bottom: 1px solid #e5e7eb;">
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">PACK-B</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">Paket Jenazah (Bayi)</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">Bahan</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">3</td>
                        <td style="padding: 12px 20px; font-size: 13px; color: black; background-color: #ecf4f1;">Pcs</td>
                        <td style="padding: 12px 20px; text-align: center; background-color: #ecf4f1;">
                            <button onclick="openModal()" style="background-color: #dc2626; border: none; width: 28px; height: 28px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer;">
                                <span class="material-icons" style="font-size: 16px; color: white;">delete</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="background-color: white; height: 200px;"></div>
    </div>
</div>

<div id="deleteModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); z-index: 9999; display: none; align-items: center; justify-content: center;">
    <div style="background-color: white; border-radius: 8px; border: 2px solid #f0e000; box-shadow: 0 4px 20px rgba(0,0,0,0.15); width: 360px; padding: 30px 28px;">
        <h3 style="text-align: center; font-weight: bold; color: black; font-size: 18px; margin: 0 0 10px 0;">Peringatan!</h3>
        <p style="text-align: center; color: black; font-size: 15px; margin: 0 0 24px 0;">Yakin Ingin Menghapus barang?</p>
        <div style="display: flex; gap: 12px; justify-content: center;">
            <button onclick="closeModal()" style="background-color: white; border: 1px solid #d1d5db; color: black; padding: 8px 32px; border-radius: 999px; font-size: 14px; font-weight: 500; cursor: pointer; font-family: 'Inter', 'Poppins', sans-serif;">Batal</button>
            <button onclick="closeModal()" style="background-color: #dc2626; color: white; border: none; padding: 8px 32px; border-radius: 999px; font-size: 14px; font-weight: 500; cursor: pointer; box-shadow: 0 2px 6px rgba(220,38,38,0.3); font-family: 'Inter', 'Poppins', sans-serif;">Hapus</button>
        </div>
        <p style="text-align: center; font-size: 11px; color: #6b7280; margin: 16px 0 0 0;">Penghapusan membutuhkan konfirmasi</p>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('deleteModal').style.display = 'flex';
}
function closeModal() {
    document.getElementById('deleteModal').style.display = 'none';
}
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
});
</script>
@endsection
