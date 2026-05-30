@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Beranda', 'url' => '/logistik', 'active' => 'logistik'],
        ['label' => 'Stok Barang', 'url' => '/logistik/stok', 'active' => 'logistik/stok*'],
        ['label' => 'Aset & Kendaraan', 'url' => '/logistik/aset', 'active' => 'logistik/aset*'],
        ['label' => 'Riwayat', 'url' => '/logistik/riwayat', 'active' => 'logistik/riwayat*'],
    ]
])

@section('title', 'Aset & Kendaraan')

@section('activeMenu', 'aset')

@section('content')
<div style="background-color: #d8e4e1; min-height: 100vh; margin: -30px; padding: 30px; font-family: 'Inter', 'Poppins', sans-serif;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 style="color: var(--primary-900); font-weight: bold; font-size: 24px; margin: 0;">Aset & Kendaraan</h1>
        <button onclick="openModal('tambahAsetModal')" style="background-color: var(--primary-900); color: white; border: none; padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <span class="material-icons" style="font-size: 14px;">add</span>
            Tambah Aset
        </button>
    </div>

    <div style="margin-bottom: 20px;">
        <div style="position: relative; width: 100%;">
            <span class="material-icons" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #5f716d; font-size: 18px;">search</span>
            <input type="text" placeholder="Cari kendaraan/aset..." style="width: 100%; padding: 8px 12px 8px 40px; background-color: white; border: 1px solid #b7c8c2; border-radius: 999px; font-size: 13px; outline: none; color: black; height: 38px;">
        </div>
    </div>

    <div class="card" style="border: none; box-shadow: 0 2px 6px rgba(0,0,0,0.08); padding: 0; overflow: hidden; border-radius: 10px; background-color: white;">
        <div style="background-color: var(--primary-900); padding: 10px 20px;">
            <h2 style="color: white; font-size: 14px; font-weight: 700; margin: 0;">Daftar Aset</h2>
        </div>
        <div style="padding: 0;">
            <div class="table-container">
                <table id="aset-table" class="table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="background-color: white; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #b7c8c2;">Nama Kendaraan</th>
                            <th style="background-color: white; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #b7c8c2;">Plat Nomor</th>
                            <th style="background-color: white; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #b7c8c2;">Tipe</th>
                            <th style="background-color: white; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #b7c8c2;">Status</th>
                            <th style="background-color: white; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #b7c8c2;">Kondisi</th>
                            <th style="background-color: white; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #b7c8c2;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $asetList = [
                                [
                                    'nama' => 'Toyota Hiace',
                                    'plat' => 'W 1234 XYZ',
                                    'tipe' => 'Mobil',
                                    'status' => 'Dipakai',
                                    'statusBg' => '#2563eb',
                                    'kondisi' => 'Baik & Layak Jalan',
                                ],
                                [
                                    'nama' => 'Suzuki Carry',
                                    'plat' => 'W 5678 YZA',
                                    'tipe' => 'Mobil',
                                    'status' => 'Tersedia',
                                    'statusBg' => '#166534',
                                    'kondisi' => 'Baik',
                                ],
                            ];
                        @endphp
                        @foreach($asetList as $item)
                        <tr>
                            <td style="padding: 12px 20px; font-weight: 500; color: black; font-size: 13px; border: 1px solid #b7c8c2;">{{ $item['nama'] }}</td>
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #b7c8c2;">{{ $item['plat'] }}</td>
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #b7c8c2;">{{ $item['tipe'] }}</td>
                            <td style="padding: 12px 20px; border: 1px solid #b7c8c2; text-align: center;">
                                <span style="background-color: {{ $item['statusBg'] }}; color: white; padding: 4px 20px; border-radius: 20px; font-size: 11px; font-weight: 700; display: inline-block; min-width: 80px;">{{ $item['status'] }}</span>
                            </td>
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #b7c8c2;">{{ $item['kondisi'] }}</td>
                            <td style="padding: 12px 20px; border: 1px solid #b7c8c2;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <button onclick="openModal('statusModal')" style="background-color: var(--primary-900); border: none; width: 28px; height: 28px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer;">
                                        <span class="material-icons" style="font-size: 16px; color: white;">edit</span>
                                    </button>
                                    <button onclick="openModal('hapusAsetModal')" style="background-color: #dc2626; border: none; width: 28px; height: 28px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer;">
                                        <span class="material-icons" style="font-size: 16px; color: white;">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="background-color: white; height: 20px;"></div>
        </div>
    </div>
</div>

<style>
    #aset-table tbody tr { background-color: #ffffff; }
    #aset-table tbody tr:hover { background-color: #f7fbfa; }
</style>
</div>

<div id="tambahAsetModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; display: none; align-items: center; justify-content: center;">
    <div style="background: white; width: 520px; max-width: 90%; border-radius: 12px; padding: 28px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); border: 1px solid var(--primary-900);">
        <h3 style="font-size: 16px; font-weight: 700; color: black; margin: 0 0 20px 0;">Tambah Barang baru</h3>
        <form>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                <div>
                    <div style="margin-bottom: 14px;">
                        <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Nama Aset / Kendaraan</label>
                        <input type="text" placeholder="Contoh : Toyota Hiace" style="width: 100%; padding: 7px 10px; border: 1px solid #c8d6d3; border-radius: 6px; font-size: 12px; outline: none; color: black; background: white;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Tipe</label>
                        <select style="width: 100%; padding: 7px 10px; border: 1px solid #c8d6d3; border-radius: 6px; font-size: 12px; outline: none; color: black; background: white;">
                            <option>Mobil</option>
                            <option>Motor</option>
                            <option>Barang</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div style="margin-bottom: 14px;">
                        <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Nomor Plat/Seri</label>
                        <input type="text" placeholder="Contoh : B 1234 XYZ" style="width: 100%; padding: 7px 10px; border: 1px solid #c8d6d3; border-radius: 6px; font-size: 12px; outline: none; color: black; background: white;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Kondisi Awal</label>
                        <select style="width: 100%; padding: 7px 10px; border: 1px solid #c8d6d3; border-radius: 6px; font-size: 12px; outline: none; color: black; background: white;">
                            <option>Baik</option>
                            <option>Rusak Ringan</option>
                            <option>Rusak Berat</option>
                        </select>
                    </div>
                </div>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                <button type="button" onclick="closeModal('tambahAsetModal')" style="background: #374151; color: white; border: none; padding: 8px 24px; border-radius: 8px; font-weight: 700; font-size: 13px; cursor: pointer;">Batal</button>
                <button type="submit" style="background: var(--primary-900); color: white; border: none; padding: 8px 24px; border-radius: 8px; font-weight: 700; font-size: 13px; cursor: pointer;">Tambah</button>
            </div>
        </form>
    </div>
</div>

<div id="statusModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; display: none; align-items: center; justify-content: center;">
    <div style="background: white; width: 440px; max-width: 90%; border-radius: 12px; padding: 28px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); border: 1px solid var(--primary-900);">
        <h3 style="font-size: 16px; font-weight: 700; color: black; margin: 0 0 20px 0;">Pengubahan Status</h3>
        <form>
            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Status</label>
                <select style="width: 100%; height: 32px; border: 1px solid #c8d6d3; border-radius: 6px; padding: 0 10px; font-size: 12px; outline: none; color: black; background: white;">
                    <option>Dipakai</option>
                    <option>Tersedia</option>
                    <option>Maintenance</option>
                </select>
            </div>
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Kondisi</label>
                <textarea placeholder="Tulis kondisi kendaraan disini." style="width: 100%; height: 70px; border: 1px solid #c8d6d3; border-radius: 6px; padding: 8px 10px; font-size: 12px; resize: none; outline: none; color: black; background: white; font-family: 'Inter', 'Poppins', sans-serif;"></textarea>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('statusModal')" style="background: white; color: #374151; border: 1px solid #d1d5db; padding: 8px 24px; border-radius: 8px; font-weight: 700; font-size: 13px; cursor: pointer;">Batal</button>
                <button type="submit" style="background: #dc2626; color: white; border: none; padding: 8px 24px; border-radius: 8px; font-weight: 700; font-size: 13px; cursor: pointer;">Hapus</button>
            </div>
        </form>
    </div>
</div>

<div id="hapusAsetModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; display: none; align-items: center; justify-content: center;">
    <div style="background: white; width: 400px; max-width: 90%; border-radius: 12px; padding: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); text-align: center;">
        <h3 style="font-size: 18px; font-weight: 800; color: black; margin: 0 0 10px 0;">Hapus Data Aset?</h3>
        <p style="font-size: 14px; color: #6b7280; margin: 0 0 24px 0;">Data yang dihapus tidak dapat dikembalikan.</p>
        <div style="display: flex; gap: 12px; justify-content: center;">
            <button onclick="closeModal('hapusAsetModal')" style="background: #374151; color: white; border: none; padding: 10px 28px; border-radius: 8px; font-weight: 800; font-size: 14px; cursor: pointer;">Batal</button>
            <button onclick="closeModal('hapusAsetModal')" style="background: #dc2626; color: white; border: none; padding: 10px 28px; border-radius: 8px; font-weight: 800; font-size: 14px; cursor: pointer;">Hapus</button>
        </div>
    </div>
</div>

<script>
function openModal(id) {
    document.getElementById(id).style.display = 'flex';
}
function closeModal(id) {
    document.getElementById(id).style.display = 'none';
}
document.addEventListener('DOMContentLoaded', function() {
    var modals = ['tambahAsetModal', 'statusModal', 'hapusAsetModal'];
    modals.forEach(function(id) {
        var el = document.getElementById(id);
        if (el) {
            el.addEventListener('click', function(e) {
                if (e.target === this) closeModal(id);
            });
        }
    });
});
</script>
@endsection
