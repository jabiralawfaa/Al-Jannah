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

$anggotaData = [
    ['no' => 1, 'nama' => 'Siti Nurhaliza', 'jabatan' => 'Ketua', 'divisi' => 'Pimpinan', 'bergabung' => '1 Maret 2026', 'status' => 'Aktif'],
    ['no' => 2, 'nama' => 'Siti Nurhaliza', 'jabatan' => 'Bendahara', 'divisi' => 'Keuangan', 'bergabung' => '1 Maret 2026', 'status' => 'Aktif'],
    ['no' => 3, 'nama' => 'Siti Nurhaliza', 'jabatan' => 'Sekretaris', 'divisi' => 'Administrasi', 'bergabung' => '1 Maret 2026', 'status' => 'Aktif'],
    ['no' => 4, 'nama' => 'Siti Nurhaliza', 'jabatan' => 'Anggota', 'divisi' => 'Logistik', 'bergabung' => '1 Maret 2026', 'status' => 'Aktif'],
    ['no' => 5, 'nama' => 'Siti Nurhaliza', 'jabatan' => 'Anggota', 'divisi' => 'Keuangan', 'bergabung' => '1 Maret 2026', 'status' => 'Aktif'],
    ['no' => 6, 'nama' => 'Siti Nurhaliza', 'jabatan' => 'Anggota', 'divisi' => 'Keuangan', 'bergabung' => '1 Maret 2026', 'status' => 'Aktif'],
];
@endphp

@section('title', 'Data Anggota')

@push('styles')
<style>
body { background-color: #eef6f2; }
.sidebar { background-color: #0d4f46 !important; }
.content-wrapper { padding: 28px 32px; }
.ketua-page-title { font-size: 24px; font-weight: 700; color: #0d4f46; margin-bottom: 2px; }
.ketua-page-subtitle { font-size: 13px; color: #6b7280; font-weight: 400; margin: 0; }
.ketua-anggota-top { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 22px; }
.ketua-top-filters { display: flex; align-items: center; gap: 10px; padding-top: 6px; flex-shrink: 0; }
.ketua-top-filters select { border: 1px solid #d1d5db; border-radius: 8px; padding: 5px 10px; font-size: 12px; font-family: 'Poppins', sans-serif; color: #374151; background: #fff; cursor: pointer; outline: none; appearance: auto; }
.ketua-btn-refresh { width: 30px; height: 30px; border-radius: 8px; border: 1px solid #d1d5db; background: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; padding: 0; }
.ketua-btn-refresh:hover { background: #f3f4f6; }
.ketua-btn-refresh .material-symbols-outlined { font-size: 16px; color: #6b7280; }
.ketua-btn-refresh.spinning .material-symbols-outlined { animation: spin 0.6s ease-in-out; }
@keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
.ketua-last-update { font-size: 11px; color: #9ca3af; font-weight: 400; white-space: nowrap; }
.ketua-anggota-card { background: #fff; border-radius: 14px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.04); overflow: hidden; }
.ketua-anggota-card-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 22px; border-bottom: 1px solid #f3f4f6; flex-wrap: wrap; gap: 12px; }
.ketua-card-header-left { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }
.ketua-card-header-left h2 { font-size: 15px; font-weight: 600; color: #111827; margin: 0; }
.ketua-badge-count { background: #e8f0fe; color: #0d4f46; font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; line-height: 1.4; }
.ketua-card-header-right { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
.ketua-search-box { display: flex; align-items: center; gap: 6px; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px; background: #fff; }
.ketua-search-box .material-symbols-outlined { font-size: 16px; color: #9ca3af; }
.ketua-search-box input { border: none; outline: none; font-size: 12px; font-family: 'Poppins', sans-serif; color: #374151; width: 140px; background: transparent; }
.ketua-search-box input::placeholder { color: #9ca3af; }
.ketua-filter-select { border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 10px; font-size: 12px; font-family: 'Poppins', sans-serif; color: #374151; background: #fff; cursor: pointer; outline: none; appearance: auto; }
.ketua-table-wrap { overflow-x: auto; }
.ketua-table { width: 100%; border-collapse: collapse; min-height: 200px; }
.ketua-table thead { background: #f9fafb; }
.ketua-table thead th { padding: 10px 18px; text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; border-bottom: 1px solid #e5e7eb; letter-spacing: 0.2px; white-space: nowrap; }
.ketua-table tbody td { padding: 11px 18px; font-size: 12px; color: #374151; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
.ketua-table tbody tr:last-child td { border-bottom: none; }
.ketua-table tbody tr:hover { background: #f9fafb; }
.ketua-table tbody tr { transition: background 0.15s; }
.ketua-status-aktif { display: inline-block; background: #d1fae5; color: #0d4f46; font-size: 11px; font-weight: 600; padding: 3px 14px; border-radius: 20px; line-height: 1.4; text-align: center; }
.ketua-table-empty { text-align: center; padding: 48px 18px; color: #9ca3af; font-size: 13px; display: none; }
.ketua-table-empty.show { display: table-row; }
.ketua-table td:last-child, .ketua-table th:last-child { text-align: center; }
@media (max-width: 1200px) { .ketua-card-header-right { margin-top: 4px; } }
@media (max-width: 768px) { .ketua-anggota-top { flex-direction: column; gap: 12px; } .ketua-search-box input { width: 100px; } .content-wrapper { padding: 20px 16px; } .ketua-anggota-card-header { flex-direction: column; align-items: stretch; } .ketua-card-header-right { justify-content: flex-end; } }
</style>
@endpush

@section('content')
<div class="ketua-anggota-top">
    <div>
        <h1 class="ketua-page-title">Data Anggota</h1>
        <p class="ketua-page-subtitle">Kelola informasi anggota organisasi</p>
    </div>
    <div class="ketua-top-filters">
        <button class="ketua-btn-refresh" id="refreshBtn" title="Refresh">
            <span class="material-symbols-outlined">refresh</span>
        </button>
        <span class="ketua-last-update" id="lastUpdate">Terakhir : --:--:--</span>
    </div>
</div>

<div class="ketua-anggota-card">
    <div class="ketua-anggota-card-header">
        <div class="ketua-card-header-left">
            <h2>Data Anggota</h2>
            <span class="ketua-badge-count">5 Anggota</span>
        </div>
        <div class="ketua-card-header-right">
            <div class="ketua-search-box">
                <span class="material-symbols-outlined">search</span>
                <input type="text" placeholder="Cari Anggota..." id="searchAnggota">
            </div>
            <select class="ketua-filter-select" id="filterStatus">
                <option value="">Semua Status</option>
                <option value="Aktif">Aktif</option>
                <option value="Nonaktif">Nonaktif</option>
            </select>
            <select class="ketua-filter-select" id="filterDivisi">
                <option value="">Semua Divisi</option>
                <option value="Pimpinan">Pimpinan</option>
                <option value="Keuangan">Keuangan</option>
                <option value="Administrasi">Administrasi</option>
                <option value="Logistik">Logistik</option>
            </select>
        </div>
    </div>

    <div class="ketua-table-wrap">
        <table class="ketua-table" id="anggotaTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Jabatan</th>
                    <th>Divisi</th>
                    <th>Bergabung</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody id="anggotaTbody">
                @foreach($anggotaData as $a)
                <tr data-status="{{ $a['status'] }}" data-divisi="{{ $a['divisi'] }}">
                    <td>{{ $a['no'] }}</td>
                    <td>{{ $a['nama'] }}</td>
                    <td>{{ $a['jabatan'] }}</td>
                    <td>{{ $a['divisi'] }}</td>
                    <td>{{ $a['bergabung'] }}</td>
                    <td><span class="ketua-status-aktif">{{ $a['status'] }}</span></td>
                </tr>
                @endforeach
                <tr class="ketua-table-empty" id="emptyRow">
                    <td colspan="6">Tidak ada anggota yang ditemukan</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function() {
    var searchInput = document.getElementById('searchAnggota');
    var filterStatus = document.getElementById('filterStatus');
    var filterDivisi = document.getElementById('filterDivisi');
    var table = document.getElementById('anggotaTable');
    var rows = table.querySelectorAll('tbody tr[data-status]');
    var emptyRow = document.getElementById('emptyRow');
    var refreshBtn = document.getElementById('refreshBtn');
    var lastUpdate = document.getElementById('lastUpdate');

    function filterTable() {
        var search = searchInput.value.toLowerCase().trim();
        var status = filterStatus.value;
        var divisi = filterDivisi.value;
        var visibleCount = 0;

        rows.forEach(function(row) {
            var rowStatus = row.getAttribute('data-status');
            var rowDivisi = row.getAttribute('data-divisi');
            var rowText = row.textContent.toLowerCase();

            var matchSearch = search === '' || rowText.indexOf(search) !== -1;
            var matchStatus = status === '' || rowStatus === status;
            var matchDivisi = divisi === '' || rowDivisi === divisi;

            if (matchSearch && matchStatus && matchDivisi) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        if (visibleCount === 0) {
            emptyRow.classList.add('show');
        } else {
            emptyRow.classList.remove('show');
        }
    }

    function updateTimestamp() {
        var now = new Date();
        var h = String(now.getHours()).padStart(2, '0');
        var m = String(now.getMinutes()).padStart(2, '0');
        var s = String(now.getSeconds()).padStart(2, '0');
        lastUpdate.textContent = 'Terakhir : ' + h + '.' + m + '.' + s;
    }

    searchInput.addEventListener('input', filterTable);
    filterStatus.addEventListener('change', filterTable);
    filterDivisi.addEventListener('change', filterTable);

    refreshBtn.addEventListener('click', function() {
        this.classList.remove('spinning');
        void this.offsetWidth;
        this.classList.add('spinning');
        updateTimestamp();
        filterTable();
        setTimeout(function() {
            refreshBtn.classList.remove('spinning');
        }, 600);
    });

    updateTimestamp();
})();
</script>
@endpush
