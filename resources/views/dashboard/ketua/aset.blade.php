@extends('layouts.dashboard')

@php
$menuItems = [
    ['label' => 'Beranda', 'url' => route('ketua.dashboard'), 'active' => 'ketua'],
    ['label' => 'Data Anggota', 'url' => route('ketua.anggota'), 'active' => 'ketua/anggota*'],
    ['label' => 'Keuangan', 'url' => route('ketua.keuangan'), 'active' => 'ketua/keuangan*'],
    ['label' => 'Aset Organisasi', 'url' => route('ketua.aset'), 'active' => 'ketua/aset*'],
    ['label' => 'Log Aktivitas', 'url' => route('ketua.log'), 'active' => 'ketua/log*'],
    ['label' => 'Permintaan Izin', 'url' => route('ketua.izin'), 'active' => 'ketua/izin*'],
];

$barang = [
    ['kode' => 'TP-H', 'nama' => 'Tinta Printer Hitam', 'kategori' => 'ATK', 'stok' => 5, 'satuan' => 'Botol'],
    ['kode' => 'TP-K', 'nama' => 'Tinta Printer Kuning', 'kategori' => 'ATK', 'stok' => 12, 'satuan' => 'Botol'],
    ['kode' => 'PACK-W', 'nama' => 'Paket Jenazah (Wanita Dewasa)', 'kategori' => 'Bahan', 'stok' => 11, 'satuan' => 'PCS'],
    ['kode' => 'PACK-P', 'nama' => 'Paket Jenazah (Pria Dewasa)', 'kategori' => 'Bahan', 'stok' => 2, 'satuan' => 'PCS'],
    ['kode' => 'PACK-B', 'nama' => 'Paket Jenazah (bayi)', 'kategori' => 'Bahan', 'stok' => 3, 'satuan' => 'PCS'],
];

$inventaris = [
    ['nama' => 'Toyota Hiace', 'plat' => 'BB 123 XYZ', 'tipe' => 'Mobil', 'status' => 'Dipakai', 'kondisi' => 'Mesin Baik, Body Lecet'],
    ['nama' => 'Suzuki Carry', 'plat' => 'BB 123 XYZ', 'tipe' => 'Pickup', 'status' => 'Tersedia', 'kondisi' => 'Mesin Berfungsi'],
];
@endphp

@section('title', 'Aset Organisasi')

@push('styles')
<style>
body { background-color: #dbe7e4; }
.sidebar { background-color: #0d4f46 !important; }
.aset-top-row { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 18px; }
.aset-page-title { font-size: 24px; font-weight: 700; color: #1f5c52; margin: 0; }
.aset-top-right { display: flex; align-items: center; gap: 14px; padding-top: 4px; flex-shrink: 0; }
.aset-btn-refresh { width: 30px; height: 30px; border-radius: 8px; border: 1px solid #d1d5db; background: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; padding: 0; }
.aset-btn-refresh:hover { background: #f3f4f6; }
.aset-btn-refresh .material-symbols-outlined { font-size: 16px; color: #6b7280; }
.aset-btn-refresh.spinning .material-symbols-outlined { animation: aset-spin 0.6s ease-in-out; }
@keyframes aset-spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
.aset-last-update { font-size: 11px; color: #9ca3af; font-weight: 400; white-space: nowrap; }
.aset-search-row { margin-bottom: 20px; }
.aset-search-box { display: flex; align-items: center; gap: 8px; border: 1px solid #d1d5db; border-radius: 24px; padding: 8px 16px; background: #fff; max-width: 320px; transition: border-color 0.2s; }
.aset-search-box:focus-within { border-color: #1f5c52; }
.aset-search-box .material-symbols-outlined { font-size: 18px; color: #9ca3af; }
.aset-search-box input { border: none; outline: none; font-size: 13px; font-family: 'Poppins', sans-serif; color: #374151; width: 100%; background: transparent; }
.aset-search-box input::placeholder { color: #9ca3af; }
.aset-card { background: #fff; border-radius: 16px; border: 1px solid #1f5c52; box-shadow: 0 2px 8px rgba(0,0,0,0.04); overflow: hidden; margin-bottom: 24px; }
.aset-card-header { display: flex; justify-content: space-between; align-items: center; padding: 18px 22px; border-bottom: 1px solid #e5e7eb; flex-wrap: wrap; gap: 12px; }
.aset-card-header h2 { font-size: 16px; font-weight: 600; color: #1f5c52; margin: 0; }
.aset-card-actions { display: flex; align-items: center; gap: 10px; }
.aset-card-search { display: flex; align-items: center; gap: 6px; border: 1px solid #e5e7eb; border-radius: 20px; padding: 6px 14px; background: #fff; transition: border-color 0.2s; }
.aset-card-search:focus-within { border-color: #1f5c52; }
.aset-card-search .material-symbols-outlined { font-size: 16px; color: #9ca3af; }
.aset-card-search input { border: none; outline: none; font-size: 12px; font-family: 'Poppins', sans-serif; color: #374151; width: 150px; background: transparent; }
.aset-card-search input::placeholder { color: #9ca3af; }
.aset-table-wrap { overflow-x: auto; min-height: 200px; }
.aset-table { width: 100%; border-collapse: collapse; }
.aset-table thead th { padding: 11px 18px; text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; border-bottom: 1px solid #e5e7eb; letter-spacing: 0.2px; white-space: nowrap; background: #f9fafb; }
.aset-table tbody td { padding: 12px 18px; font-size: 12px; color: #374151; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
.aset-table tbody tr:last-child td { border-bottom: none; }
.aset-table tbody tr:hover { background: #f9fafb; }
.aset-table tbody tr { transition: background 0.15s; }
.aset-table-empty { text-align: center; padding: 48px 18px; color: #9ca3af; font-size: 13px; display: none; }
.aset-table-empty.show { display: table-row; }
.aset-status-badge { display: inline-flex; align-items: center; gap: 5px; padding: 3px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; }
.aset-status-badge .dot { width: 6px; height: 6px; border-radius: 50%; display: inline-block; }
.aset-status-badge.dipakai { background: #dbeafe; color: #1e40af; }
.aset-status-badge.dipakai .dot { background: #3b82f6; }
.aset-status-badge.tersedia { background: #d1fae5; color: #065f46; }
.aset-status-badge.tersedia .dot { background: #10b981; }
.aset-btn-ubah { border: 1px solid #d1d5db; border-radius: 20px; padding: 5px 14px; font-size: 11px; font-weight: 500; font-family: 'Poppins', sans-serif; color: #374151; background: #fff; cursor: pointer; transition: all 0.2s; white-space: nowrap; }
.aset-btn-ubah:hover { background: #f3f4f6; border-color: #9ca3af; }
.aset-table td:last-child { text-align: center; }
@media (max-width: 768px) { .aset-top-row { flex-direction: column; gap: 12px; } .aset-card-header { flex-direction: column; align-items: stretch; } .aset-card-actions { justify-content: flex-end; } .aset-card-search input { width: 110px; } .aset-search-box { max-width: 100%; } .aset-table-wrap { min-height: 150px; } }
</style>
@endpush

@section('content')
<div class="aset-top-row">
    <h1 class="aset-page-title">Data Aset Organisasi</h1>
    <div class="aset-top-right">
        <button class="aset-btn-refresh" id="refreshBtn" title="Refresh">
            <span class="material-symbols-outlined">refresh</span>
        </button>
        <span class="aset-last-update" id="lastUpdate">Terakhir : --:--:--</span>
    </div>
</div>

<div class="aset-search-row">
    <div class="aset-search-box">
        <span class="material-symbols-outlined">search</span>
        <input type="text" placeholder="Cari data aset..." id="searchGlobal">
    </div>
</div>

<div class="aset-card">
    <div class="aset-card-header">
        <h2>Data Barang</h2>
        <div class="aset-card-actions">
            <div class="aset-card-search">
                <span class="material-symbols-outlined">search</span>
                <input type="text" placeholder="Cari barang..." id="searchBarang">
            </div>
        </div>
    </div>
    <div class="aset-table-wrap">
        <table class="aset-table" id="barangTable">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody id="barangTbody">
                @foreach($barang as $b)
                <tr>
                    <td>{{ $b['kode'] }}</td>
                    <td>{{ $b['nama'] }}</td>
                    <td>{{ $b['kategori'] }}</td>
                    <td>{{ $b['stok'] }}</td>
                    <td>{{ $b['satuan'] }}</td>
                </tr>
                @endforeach
                <tr class="aset-table-empty" id="barangEmpty">
                    <td colspan="5">Tidak ada barang yang ditemukan</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="aset-card">
    <div class="aset-card-header">
        <h2>Data Inventaris Organisasi</h2>
        <div class="aset-card-actions">
            <div class="aset-card-search">
                <span class="material-symbols-outlined">search</span>
                <input type="text" placeholder="Cari inventaris..." id="searchInventaris">
            </div>
        </div>
    </div>
    <div class="aset-table-wrap">
        <table class="aset-table" id="inventarisTable">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Plat/Seri</th>
                    <th>Tipe</th>
                    <th>Status</th>
                    <th>Kondisi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="inventarisTbody">
                @foreach($inventaris as $i)
                <tr data-status="{{ $i['status'] }}">
                    <td>{{ $i['nama'] }}</td>
                    <td>{{ $i['plat'] }}</td>
                    <td>{{ $i['tipe'] }}</td>
                    <td>
                        <span class="aset-status-badge {{ $i['status'] === 'Dipakai' ? 'dipakai' : 'tersedia' }}">
                            <span class="dot"></span>{{ $i['status'] }}
                        </span>
                    </td>
                    <td>{{ $i['kondisi'] }}</td>
                    <td>
                        <button class="aset-btn-ubah" onclick="ubahStatus(this)">Ubah Status</button>
                    </td>
                </tr>
                @endforeach
                <tr class="aset-table-empty" id="inventarisEmpty">
                    <td colspan="6">Tidak ada inventaris yang ditemukan</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function() {
    var searchGlobal = document.getElementById('searchGlobal');
    var searchBarang = document.getElementById('searchBarang');
    var searchInventaris = document.getElementById('searchInventaris');
    var refreshBtn = document.getElementById('refreshBtn');
    var lastUpdate = document.getElementById('lastUpdate');

    function filterTable(input, tableId, emptyId) {
        var search = input.value.toLowerCase().trim();
        var rows = document.querySelectorAll('#' + tableId + ' tbody tr[data-status], #' + tableId + ' tbody tr:not(.aset-table-empty)');
        var emptyRow = document.getElementById(emptyId);
        var visible = 0;

        rows.forEach(function(row) {
            if (row.classList.contains('aset-table-empty')) return;
            var text = row.textContent.toLowerCase();
            if (search === '' || text.indexOf(search) !== -1) {
                row.style.display = ''; visible++;
            } else {
                row.style.display = 'none';
            }
        });
        if (emptyRow) emptyRow.classList.toggle('show', visible === 0);
    }

    searchGlobal.addEventListener('input', function() {
        filterTable(searchGlobal, 'barangTable', 'barangEmpty');
        filterTable(searchGlobal, 'inventarisTable', 'inventarisEmpty');
    });
    searchBarang.addEventListener('input', function() {
        filterTable(searchBarang, 'barangTable', 'barangEmpty');
    });
    searchInventaris.addEventListener('input', function() {
        filterTable(searchInventaris, 'inventarisTable', 'inventarisEmpty');
    });

    function updateTimestamp() {
        var now = new Date();
        var h = String(now.getHours()).padStart(2, '0');
        var m = String(now.getMinutes()).padStart(2, '0');
        var s = String(now.getSeconds()).padStart(2, '0');
        if (lastUpdate) lastUpdate.textContent = 'Terakhir : ' + h + '.' + m + '.' + s;
    }

    if (refreshBtn) refreshBtn.addEventListener('click', function() {
        this.classList.remove('spinning');
        void this.offsetWidth;
        this.classList.add('spinning');
        updateTimestamp();
        setTimeout(function() { if (refreshBtn) refreshBtn.classList.remove('spinning'); }, 600);
    });
    updateTimestamp();
})();

function ubahStatus(btn) {
    var row = btn.closest('tr');
    var badge = row.querySelector('.aset-status-badge');
    var isDipakai = badge.classList.contains('dipakai');

    if (isDipakai) {
        badge.className = 'aset-status-badge tersedia';
        badge.innerHTML = '<span class="dot"></span>Tersedia';
        row.setAttribute('data-status', 'Tersedia');
    } else {
        badge.className = 'aset-status-badge dipakai';
        badge.innerHTML = '<span class="dot"></span>Dipakai';
        row.setAttribute('data-status', 'Dipakai');
    }

    btn.style.transform = 'scale(0.95)';
    setTimeout(function() { btn.style.transform = ''; }, 200);
}
</script>
@endpush
