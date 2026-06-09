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
@endphp
@section('title', 'Keuangan')
@push('styles')
<style>
body { background-color: #eef6f2; }
.sidebar { background-color: #0d4f46 !important; }
.content-wrapper { padding: 28px 32px; }
.ketua-page-title { font-size: 24px; font-weight: 700; color: #0d4f46; margin-bottom: 22px; }
.ketua-summary-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 24px; }
.ketua-summary-card { background: #fff; border-radius: 14px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.04); padding: 24px 20px; text-align: center; transition: box-shadow 0.25s ease, transform 0.25s ease; cursor: default; }
.ketua-summary-card:hover { box-shadow: 0 4px 16px rgba(13,79,70,0.10); transform: translateY(-1px); }
.ketua-summary-label { font-size: 12px; font-weight: 500; color: #6b7280; margin-bottom: 8px; letter-spacing: 0.2px; }
.ketua-summary-nominal { font-size: 22px; font-weight: 700; color: #111827; margin-bottom: 6px; line-height: 1.2; }
.ketua-summary-nominal.green { color: #0d4f46; }
.ketua-summary-nominal.red { color: #dc2626; }
.ketua-summary-nominal.green-dark { color: #0d4f46; }
.ketua-summary-sub { font-size: 11px; color: #9ca3af; font-weight: 400; }
.ketua-table-container { background: #fff; border-radius: 14px; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0,0,0,0.04); overflow: hidden; }
.ketua-table-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 22px; border-bottom: 1px solid #f3f4f6; flex-wrap: wrap; gap: 12px; }
.ketua-table-header h2 { font-size: 15px; font-weight: 600; color: #111827; margin: 0; }
.ketua-table-actions { display: flex; align-items: center; gap: 10px; }
.ketua-search-box { display: flex; align-items: center; gap: 6px; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 12px; background: #fff; }
.ketua-search-box .material-symbols-outlined { font-size: 16px; color: #9ca3af; }
.ketua-search-box input { border: none; outline: none; font-size: 12px; font-family: 'Poppins', sans-serif; color: #374151; width: 140px; background: transparent; }
.ketua-search-box input::placeholder { color: #9ca3af; }
.ketua-filter-select { border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 10px; font-size: 12px; font-family: 'Poppins', sans-serif; color: #374151; background: #fff; cursor: pointer; outline: none; appearance: auto; }
.ketua-table-wrap { overflow-x: auto; min-height: 280px; }
.ketua-table { width: 100%; border-collapse: collapse; }
.ketua-table thead th { padding: 10px 18px; text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; border-bottom: 1px solid #e5e7eb; letter-spacing: 0.2px; white-space: nowrap; background: #fff; }
.ketua-table tbody td { padding: 11px 18px; font-size: 12px; color: #374151; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
.ketua-table tbody tr:last-child td { border-bottom: none; }
.ketua-table tbody tr:hover { background: #f9fafb; }
.ketua-table tbody tr { transition: background 0.15s; }
.ketua-jumlah-masuk { color: #0d4f46; font-weight: 600; }
.ketua-jumlah-keluar { color: #dc2626; font-weight: 600; }
.ketua-table-empty { text-align: center; padding: 48px 18px; color: #9ca3af; font-size: 13px; display: none; }
.ketua-table-empty.show { display: table-row; }
.ketua-kategori-badge { display: inline-block; padding: 2px 10px; border-radius: 20px; font-size: 10px; font-weight: 600; }
.ketua-kategori-badge.masuk { background: #d1fae5; color: #065f46; }
.ketua-kategori-badge.keluar { background: #fee2e2; color: #991b1b; }
.ketua-btn-export { display: inline-flex; align-items: center; gap: 6px; background: #0d4f46; color: #fff; border: none; border-radius: 8px; padding: 7px 16px; font-size: 12px; font-weight: 600; font-family: 'Poppins', sans-serif; cursor: pointer; transition: all 0.2s; white-space: nowrap; }
.ketua-btn-export:hover { background: #0a3d36; }
.ketua-btn-export .material-symbols-outlined { font-size: 16px; }
.kt-export-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px); z-index: 9999; display: flex; align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: opacity 0.3s ease, visibility 0.3s ease; }
.kt-export-overlay.active { opacity: 1; visibility: visible; }
.kt-export-modal { background: #fff; border-radius: 18px; padding: 28px 30px; max-width: 400px; width: 92%; box-shadow: 0 20px 60px rgba(0,0,0,0.18); transform: scale(0.85); transition: transform 0.3s ease; text-align: center; }
.kt-export-overlay.active .kt-export-modal { transform: scale(1); }
.kt-export-icon { width: 56px; height: 56px; border-radius: 50%; background: #ecfdf5; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; }
.kt-export-icon .material-symbols-outlined { font-size: 28px; color: #0d4f46; }
.kt-export-modal-title { font-size: 18px; font-weight: 700; color: #111827; margin-bottom: 8px; }
.kt-export-modal-desc { font-size: 13px; color: #6b7280; line-height: 1.6; margin-bottom: 8px; }
.kt-export-modal-info { font-size: 12px; color: #9ca3af; margin-bottom: 22px; }
.kt-export-modal-info strong { color: #374151; }
.kt-export-actions { display: flex; justify-content: center; gap: 12px; }
.kt-export-btn-batal { background: #fff; border: 1.5px solid #d1d5db; color: #374151; border-radius: 10px; padding: 9px 28px; font-size: 13px; font-weight: 600; font-family: 'Poppins', sans-serif; cursor: pointer; transition: all 0.2s; }
.kt-export-btn-batal:hover { background: #f3f4f6; }
.kt-export-btn-ya { background: #0d4f46; border: none; color: #fff; border-radius: 10px; padding: 9px 28px; font-size: 13px; font-weight: 600; font-family: 'Poppins', sans-serif; cursor: pointer; transition: all 0.2s; }
.kt-export-btn-ya:hover { background: #0a3d36; }
.kt-toast { position: fixed; top: 24px; right: 24px; z-index: 99999; display: flex; align-items: center; gap: 10px; padding: 14px 20px; border-radius: 12px; font-size: 13px; font-weight: 500; font-family: 'Poppins', sans-serif; box-shadow: 0 8px 24px rgba(0,0,0,0.12); transform: translateX(120%); opacity: 0; transition: all 0.4s ease; }
.kt-toast.show { transform: translateX(0); opacity: 1; }
.kt-toast .material-symbols-outlined { font-size: 20px; }
.kt-toast.success { background: #ecfdf5; color: #065f46; border: 1px solid #6ee7b7; }
.kt-toast.success .material-symbols-outlined { color: #059669; }
@media (max-width: 768px) { .ketua-summary-cards { grid-template-columns: 1fr; } .ketua-table-header { flex-direction: column; align-items: stretch; } .ketua-table-actions { justify-content: flex-end; } .ketua-search-box input { width: 100px; } .content-wrapper { padding: 20px 16px; } .ketua-table-wrap { min-height: 200px; } }
@media (max-width: 1200px) { .ketua-summary-cards { gap: 14px; } }
</style>
@endpush
@section('content')
<h1 class="ketua-page-title">Keuangan</h1>
<div class="ketua-summary-cards">
    <div class="ketua-summary-card"><div class="ketua-summary-label">Total Pemasukan</div><div class="ketua-summary-nominal green">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div><div class="ketua-summary-sub">Seluruh periode</div></div>
    <div class="ketua-summary-card"><div class="ketua-summary-label">Total Pengeluaran</div><div class="ketua-summary-nominal red">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div><div class="ketua-summary-sub">Seluruh periode</div></div>
    <div class="ketua-summary-card"><div class="ketua-summary-label">Saldo Saat Ini</div><div class="ketua-summary-nominal green-dark">Rp {{ number_format($saldo, 0, ',', '.') }}</div><div class="ketua-summary-sub">Per {{ now()->format('d M Y') }}</div></div>
</div>
<div class="ketua-table-container">
    <div class="ketua-table-header">
        <div class="ketua-table-actions">
            <div class="ketua-search-box"><span class="material-symbols-outlined">search</span><input type="text" placeholder="Cari transaksi..." id="searchTransaksi"></div>
            <select class="ketua-filter-select" id="filterKategori"><option value="">Semua</option><option value="Pemasukan">Pemasukan</option><option value="Pengeluaran">Pengeluaran</option></select>
        </div>
        <button class="ketua-btn-export" id="btnExport"><span class="material-symbols-outlined">download</span> Ekspor</button>
    </div>
    <div class="ketua-table-wrap">
        <table class="ketua-table" id="transaksiTable"><thead><tr><th>Tanggal</th><th>Keterangan</th><th>Kategori</th><th>Jumlah</th></tr></thead><tbody id="transaksiTbody">@forelse($transactions as $t)@php $isPemasukan = $t['kategori'] === 'Pemasukan'; @endphp<tr data-kategori="{{ $t['kategori'] }}"><td>{{ $t['tanggal'] }}</td><td>{{ $t['keterangan'] ?: $t['kategori_nama'] }}</td><td><span class="ketua-kategori-badge {{ $isPemasukan ? 'masuk' : 'keluar' }}">{{ $t['kategori'] }}</span></td><td class="{{ $isPemasukan ? 'ketua-jumlah-masuk' : 'ketua-jumlah-keluar' }}">{{ $isPemasukan ? '+' : '-' }} Rp {{ number_format($t['jumlah'], 0, ',', '.') }}</td></tr>@empty<tr class="ketua-table-empty show" id="emptyRow"><td colspan="4">Tidak ada transaksi yang ditemukan</td></tr>@endforelse</tbody></table>
    </div>
</div>
<div class="kt-export-overlay" id="exportModal">
    <div class="kt-export-modal">
        <div class="kt-export-icon"><span class="material-symbols-outlined">download</span></div>
        <div class="kt-export-modal-title">Ekspor Data Transaksi</div>
        <div class="kt-export-modal-desc">Anda akan mengekspor data transaksi keuangan ke file CSV.</div>
        <div class="kt-export-modal-info">Data yang diekspor sesuai filter &amp; pencarian saat ini (<strong id="exportCount">0</strong> transaksi)</div>
        <div class="kt-export-actions"><button class="kt-export-btn-batal" id="exportBatal">Tidak</button><button class="kt-export-btn-ya" id="exportYa">Ya, Ekspor</button></div>
    </div>
</div>
<div class="kt-toast" id="exportToast"><span class="material-symbols-outlined">check_circle</span><span id="toastMsg">Data berhasil diekspor</span></div>
@endsection
@push('scripts')
<script>
(function(){var s=document.getElementById('searchTransaksi'),k=document.getElementById('filterKategori'),r=document.querySelectorAll('#transaksiTable tbody tr[data-kategori]'),e=document.getElementById('emptyRow');function f(){var q=s.value.toLowerCase().trim(),v=k.value,o=0;r.forEach(function(x){var a=x.getAttribute('data-kategori'),t=x.textContent.toLowerCase();if((q===''||t.indexOf(q)!==-1)&&(v===''||a===v)){x.style.display='';o++}else x.style.display='none'});e.classList.toggle('show',o===0)}s.addEventListener('input',f);k.addEventListener('change',f);var m=document.getElementById('exportModal'),b=document.getElementById('btnExport'),y=document.getElementById('exportYa'),t=document.getElementById('exportBatal'),c=document.getElementById('exportCount');function u(){return document.querySelectorAll('#transaksiTable tbody tr[data-kategori]:not([style*="display: none"])').length}function x(){h();o('Data sedang diekspor...')}function o(n){var a=document.getElementById('exportToast'),g=document.getElementById('toastMsg');a.className='kt-toast';a.classList.add('success');g.textContent=n;a.classList.add('show');setTimeout(function(){a.classList.remove('show')},3000)}function h(){m.classList.remove('active')}b.addEventListener('click',function(){if(c)c.textContent=u();m.classList.add('active')});y.addEventListener('click',x);t.addEventListener('click',h);m.addEventListener('click',function(e){if(e.target===this)h()})})();
</script>
@endpush
