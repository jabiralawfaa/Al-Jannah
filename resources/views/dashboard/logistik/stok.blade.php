@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Beranda', 'url' => '/logistik', 'active' => 'logistik'],
        ['label' => 'Stok Barang', 'url' => '/logistik/stok', 'active' => 'logistik/stok*'],
        ['label' => 'Aset & Kendaraan', 'url' => '/logistik/aset', 'active' => 'logistik/aset*'],
        ['label' => 'Riwayat', 'url' => '/logistik/riwayat', 'active' => 'logistik/riwayat*'],
    ]
])

@section('title', 'Stok Barang')

@section('activeMenu', 'stok')

@section('content')
<div style="background-color: #d8e4e1; min-height: 100vh; margin: -30px; padding: 30px; font-family: 'Inter', 'Poppins', sans-serif;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1 style="color: var(--primary-900); font-weight: bold; font-size: 24px; margin: 0;">Stok Barang</h1>
        <div style="display: flex; gap: 8px;">
            <button onclick="openModal('tambahBarangModal')" style="background-color: var(--primary-900); color: white; border: none; padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <span class="material-icons" style="font-size: 14px;">add</span>
                Tambah Jenis Barang
            </button>
            <button onclick="openModal('tambahStokModal')" style="background-color: var(--primary-900); color: white; border: none; padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <span class="material-icons" style="font-size: 14px;">input</span>
                Tambah Stok
            </button>
            <button onclick="openModal('kurangiStokModal')" style="background-color: #8b0000; color: white; border: none; padding: 6px 14px; border-radius: 8px; font-size: 12px; font-weight: 700; cursor: pointer; display: inline-flex; align-items: center; gap: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <span class="material-icons" style="font-size: 14px;">remove</span>
                Kurangi Stok
            </button>
        </div>
    </div>

    <div style="margin-bottom: 20px;">
        <div style="position: relative; width: 100%;">
            <span class="material-icons" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #4b5563; font-size: 20px;">search</span>
            <input type="text" placeholder="Cari ...." style="width: 100%; padding: 8px 12px 8px 40px; background-color: white; border: 1px solid #9ca3af; border-radius: 10px; font-size: 13px; outline: none; color: black;">
        </div>
    </div>

    <div class="card" style="border: none; box-shadow: 0 2px 6px rgba(0,0,0,0.08); padding: 0; overflow: hidden; border-radius: 10px; background-color: white;">
        <div style="background-color: var(--primary-900); padding: 10px 20px;">
            <h2 style="color: white; font-size: 14px; font-weight: 700; margin: 0;">Daftar Stok Barang</h2>
        </div>
        <div style="padding: 0;">
            <div class="table-container">
                <table id="stok-table" class="table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="background-color: white; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #b7c8c2;">Kode Barang</th>
                            <th style="background-color: white; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #b7c8c2;">Nama Barang</th>
                            <th style="background-color: white; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #b7c8c2;">Kategori</th>
                            <th style="background-color: white; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #b7c8c2;">Stok</th>
                            <th style="background-color: white; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #b7c8c2;">Satuan</th>
                            <th style="background-color: white; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #b7c8c2;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $barangList = [
                                ['kode' => 'TP-H', 'nama' => 'Tinta Printer Hitam', 'kategori' => 'ATK', 'stok' => 5, 'satuan' => 'Botol'],
                                ['kode' => 'TP-K', 'nama' => 'Tinta Printer Kuning', 'kategori' => 'ATK', 'stok' => 12, 'satuan' => 'Botol'],
                                ['kode' => 'PACK-W', 'nama' => 'Paket Jenazah (Wanita Dewasa)', 'kategori' => 'Bahan', 'stok' => 11, 'satuan' => 'Pcs'],
                                ['kode' => 'PACK-P', 'nama' => 'Paket Jenazah (Pria Dewasa)', 'kategori' => 'Bahan', 'stok' => 2, 'satuan' => 'Pcs'],
                                ['kode' => 'PACK-B', 'nama' => 'Paket Jenazah (Bayi)', 'kategori' => 'Bahan', 'stok' => 3, 'satuan' => 'Pcs'],
                            ];
                        @endphp
                        @foreach($barangList as $item)
                        <tr>
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #b7c8c2; font-weight: 600;">{{ $item['kode'] }}</td>
                            <td style="padding: 12px 20px; font-weight: 500; color: black; font-size: 13px; border: 1px solid #b7c8c2;">{{ $item['nama'] }}</td>
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #b7c8c2;">{{ $item['kategori'] }}</td>
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #b7c8c2;">{{ $item['stok'] }}</td>
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #b7c8c2;">{{ $item['satuan'] }}</td>
                            <td style="padding: 12px 20px; border: 1px solid #b7c8c2;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <button onclick="openModal('editBarangModal')" style="background-color: #fcd34d; border: 1px solid black; width: 28px; height: 28px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer;">
                                        <span class="material-icons" style="font-size: 16px; color: black;">edit</span>
                                    </button>
                                    <button onclick="openModal('hapusBarangModal')" style="background-color: #dc2626; border: none; width: 28px; height: 28px; border-radius: 6px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer;">
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
    #stok-table tbody tr:nth-child(odd) { background-color: #eef5f2; }
    #stok-table tbody tr:nth-child(even) { background-color: #ffffff; }
    #stok-table tbody tr:hover { background-color: #e5efeb; }
</style>

<div id="tambahBarangModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; display: none; align-items: center; justify-content: center;">
    <div style="background: white; width: 520px; max-width: 90%; border-radius: 12px; padding: 28px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); border: 1px solid var(--primary-900);">
        <h3 style="font-size: 16px; font-weight: 700; color: black; margin: 0 0 20px 0;">Tambah Barang Baru</h3>
        <form>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Kode Barang</label>
                    <input type="text" placeholder="Contoh : K-A4" style="width: 100%; padding: 7px 10px; border: 1px solid #c8d6d3; border-radius: 6px; font-size: 12px; outline: none; color: black; background: white;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Nama Barang</label>
                    <input type="text" placeholder="Contoh : Kertas A3" style="width: 100%; padding: 7px 10px; border: 1px solid #c8d6d3; border-radius: 6px; font-size: 12px; outline: none; color: black; background: white;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Kategori</label>
                    <select style="width: 100%; padding: 7px 10px; border: 1px solid #c8d6d3; border-radius: 6px; font-size: 12px; outline: none; color: black; background: white;">
                        <option>ATK</option>
                        <option>Bahan</option>
                        <option>Alat Kebersihan</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Stok Awal</label>
                    <input type="text" placeholder="0" style="width: 100%; padding: 7px 10px; border: 1px solid #c8d6d3; border-radius: 6px; font-size: 12px; outline: none; color: black; background: white;">
                </div>
                <div style="grid-column: span 2;">
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Satuan</label>
                    <input type="text" placeholder="Pcs, Box, Unit" style="width: 100%; padding: 7px 10px; border: 1px solid #c8d6d3; border-radius: 6px; font-size: 12px; outline: none; color: black; background: white;">
                </div>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                <button type="button" onclick="closeModal('tambahBarangModal')" style="background: #374151; color: white; border: none; padding: 8px 24px; border-radius: 8px; font-weight: 700; font-size: 13px; cursor: pointer;">Batal</button>
                <button type="submit" style="background: var(--primary-900); color: white; border: none; padding: 8px 24px; border-radius: 8px; font-weight: 700; font-size: 13px; cursor: pointer;">Tambah Barang</button>
            </div>
        </form>
    </div>
</div>

<div id="tambahStokModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; display: none; align-items: center; justify-content: center;">
    <div style="background: white; width: 440px; max-width: 90%; border-radius: 12px; padding: 28px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); border: 1px solid var(--primary-900);">
        <h3 style="font-size: 16px; font-weight: 700; color: black; margin: 0 0 20px 0;">Input Barang Datang</h3>
        <form>
            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Nama Barang</label>
                <input type="text" placeholder="Nama Barang" style="width: 100%; height: 32px; border: 1px solid #c8d6d3; border-radius: 6px; padding: 0 10px; font-size: 12px; outline: none; color: black; background: white;">
            </div>
            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Jumlah Barang Datang</label>
                <input type="number" value="0" style="width: 100%; height: 32px; border: 1px solid #c8d6d3; border-radius: 6px; padding: 0 10px; font-size: 12px; outline: none; color: black; background: white;">
            </div>
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Keterangan/Supplier</label>
                <textarea placeholder="Contoh : Supplier PT. Sinar Dunia" style="width: 100%; height: 70px; border: 1px solid #c8d6d3; border-radius: 6px; padding: 8px 10px; font-size: 12px; resize: none; outline: none; color: black; background: white; font-family: 'Inter', 'Poppins', sans-serif;"></textarea>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('tambahStokModal')" style="background: #374151; color: white; border: none; padding: 8px 24px; border-radius: 8px; font-weight: 700; font-size: 13px; cursor: pointer;">Batal</button>
                <button type="submit" style="background: var(--primary-900); color: white; border: none; padding: 8px 24px; border-radius: 8px; font-weight: 700; font-size: 13px; cursor: pointer;">Konfirmasi</button>
            </div>
        </form>
    </div>
</div>

<div id="kurangiStokModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; display: none; align-items: center; justify-content: center;">
    <div style="background: white; width: 440px; max-width: 90%; border-radius: 12px; padding: 28px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); border: 1px solid #8b0000;">
        <h3 style="font-size: 16px; font-weight: 700; color: black; margin: 0 0 20px 0;">Input Barang Keluar / Digunakan</h3>
        <form>
            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Pilih Barang</label>
                <select style="width: 100%; height: 32px; border: 1px solid #c8d6d3; border-radius: 6px; padding: 0 10px; font-size: 12px; outline: none; color: black; background: white;">
                    <option>Pilih Barang ....</option>
                    <option>Tinta Printer Hitam</option>
                    <option>Tinta Printer Kuning</option>
                    <option>Kertas A4</option>
                    <option>Paket Jenazah (Pria)</option>
                </select>
            </div>
            <div style="margin-bottom: 14px;">
                <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Jumlah Barang Keluar</label>
                <input type="number" value="0" style="width: 100%; height: 32px; border: 1px solid #c8d6d3; border-radius: 6px; padding: 0 10px; font-size: 12px; outline: none; color: black; background: white;">
            </div>
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Keperluan</label>
                <textarea placeholder="Contoh : Digunakan untuk laporan bulanan" style="width: 100%; height: 70px; border: 1px solid #c8d6d3; border-radius: 6px; padding: 8px 10px; font-size: 12px; resize: none; outline: none; color: black; background: white; font-family: 'Inter', 'Poppins', sans-serif;"></textarea>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="closeModal('kurangiStokModal')" style="background: #374151; color: white; border: none; padding: 8px 24px; border-radius: 8px; font-weight: 700; font-size: 13px; cursor: pointer;">Batal</button>
                <button type="submit" style="background: #8b0000; color: white; border: none; padding: 8px 24px; border-radius: 8px; font-weight: 700; font-size: 13px; cursor: pointer;">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div id="editBarangModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; display: none; align-items: center; justify-content: center;">
    <div style="background: white; width: 520px; max-width: 90%; border-radius: 12px; padding: 28px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); border: 1px solid var(--primary-900);">
        <h3 style="font-size: 16px; font-weight: 700; color: black; margin: 0 0 20px 0;">Ubah Data Barang</h3>
        <form>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Kode Barang</label>
                    <input type="text" value="TP-H" style="width: 100%; padding: 7px 10px; border: 1px solid #c8d6d3; border-radius: 6px; font-size: 12px; outline: none; color: black; background: white;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Nama Barang</label>
                    <input type="text" value="Tinta Printer Hitam" style="width: 100%; padding: 7px 10px; border: 1px solid #c8d6d3; border-radius: 6px; font-size: 12px; outline: none; color: black; background: white;">
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Kategori</label>
                    <select style="width: 100%; padding: 7px 10px; border: 1px solid #c8d6d3; border-radius: 6px; font-size: 12px; outline: none; color: black; background: white;">
                        <option selected>ATK</option>
                        <option>Bahan</option>
                        <option>Alat Kebersihan</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Stok</label>
                    <input type="text" value="5" style="width: 100%; padding: 7px 10px; border: 1px solid #c8d6d3; border-radius: 6px; font-size: 12px; outline: none; color: black; background: white;">
                </div>
                <div style="grid-column: span 2;">
                    <label style="display: block; font-size: 12px; font-weight: 600; color: #374151; margin-bottom: 4px;">Satuan</label>
                    <input type="text" value="Botol" style="width: 100%; padding: 7px 10px; border: 1px solid #c8d6d3; border-radius: 6px; font-size: 12px; outline: none; color: black; background: white;">
                </div>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                <button type="button" onclick="closeModal('editBarangModal')" style="background: #374151; color: white; border: none; padding: 8px 24px; border-radius: 8px; font-weight: 700; font-size: 13px; cursor: pointer;">Batal</button>
                <button type="submit" style="background: var(--primary-900); color: white; border: none; padding: 8px 24px; border-radius: 8px; font-weight: 700; font-size: 13px; cursor: pointer;">Ubah</button>
            </div>
        </form>
    </div>
</div>

<div id="hapusBarangModal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; display: none; align-items: center; justify-content: center;">
    <div style="background: white; width: 400px; max-width: 90%; border-radius: 12px; padding: 30px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); text-align: center;">
        <h3 style="font-size: 18px; font-weight: 800; color: black; margin: 0 0 10px 0;">Hapus Data Barang?</h3>
        <p style="font-size: 14px; color: #6b7280; margin: 0 0 24px 0;">Data yang dihapus tidak dapat dikembalikan.</p>
        <div style="display: flex; gap: 12px; justify-content: center;">
            <button onclick="closeModal('hapusBarangModal')" style="background: #374151; color: white; border: none; padding: 10px 28px; border-radius: 8px; font-weight: 800; font-size: 14px; cursor: pointer;">Batal</button>
            <button onclick="closeModal('hapusBarangModal')" style="background: #dc2626; color: white; border: none; padding: 10px 28px; border-radius: 8px; font-weight: 800; font-size: 14px; cursor: pointer;">Hapus</button>
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
    var modals = ['tambahBarangModal', 'tambahStokModal', 'kurangiStokModal', 'editBarangModal', 'hapusBarangModal'];
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
