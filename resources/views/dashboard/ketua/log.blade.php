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
@section('title', 'Log Aktivitas')
@push('styles')
<style>
body { background-color: #dbe7e4; }
.sidebar { background-color: #0d4f46 !important; }
.content-wrapper { padding: 28px 32px; }
.kt-top-row { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; }
.kt-page-title { font-size: 24px; font-weight: 700; color: #1f5c52; margin: 0; }
.kt-top-right { display: flex; align-items: center; gap: 14px; padding-top: 4px; flex-shrink: 0; }
.kt-btn-refresh { width: 30px; height: 30px; border-radius: 8px; border: 1px solid #d1d5db; background: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; padding: 0; }
.kt-btn-refresh:hover { background: #f3f4f6; }
.kt-btn-refresh .material-symbols-outlined { font-size: 16px; color: #6b7280; }
.kt-btn-refresh.spinning .material-symbols-outlined { animation: kt-spin 0.6s ease-in-out; }
@keyframes kt-spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
.kt-last-update { font-size: 11px; color: #9ca3af; font-weight: 400; white-space: nowrap; }
.kt-card { background: #fff; border-radius: 16px; border: 1px solid #1f5c52; box-shadow: 0 2px 8px rgba(0,0,0,0.04); overflow: hidden; }
.kt-card-header { background: #1f5c52; padding: 14px 22px; }
.kt-card-header h2 { font-size: 15px; font-weight: 600; color: #fff; margin: 0; letter-spacing: 0.3px; }
.kt-card-body { padding: 18px 22px; }
.kt-search-box { display: flex; align-items: center; gap: 8px; border: 1px solid #d1d5db; border-radius: 24px; padding: 8px 16px; background: #fff; max-width: 320px; transition: border-color 0.2s; margin-bottom: 18px; }
.kt-search-box:focus-within { border-color: #1f5c52; }
.kt-search-box .material-symbols-outlined { font-size: 18px; color: #9ca3af; }
.kt-search-box input { border: none; outline: none; font-size: 13px; font-family: 'Poppins', sans-serif; color: #374151; width: 100%; background: transparent; }
.kt-search-box input::placeholder { color: #9ca3af; }
.kt-table-wrap { overflow-x: auto; }
.kt-table { width: 100%; border-collapse: collapse; }
.kt-table thead th { padding: 11px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; border-bottom: 2px solid #e5e7eb; letter-spacing: 0.2px; white-space: nowrap; background: #f9fafb; }
.kt-table tbody td { padding: 12px 16px; font-size: 12px; color: #374151; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
.kt-table tbody tr:last-child td { border-bottom: none; }
.kt-table tbody tr:hover { background: #f9fafb; }
.kt-table tbody tr { transition: background 0.15s; }
.kt-badge { display: inline-block; padding: 3px 12px; border-radius: 20px; font-size: 11px; font-weight: 600; }
.kt-badge.hijau { background: #d1fae5; color: #065f46; }
.kt-badge.orange { background: #fed7aa; color: #9a3412; }
.kt-badge.hijau-tua { background: #dbeafe; color: #1e40af; }
.kt-table-empty { text-align: center; padding: 48px 16px; color: #9ca3af; font-size: 13px; display: none; }
.kt-table-empty.show { display: table-row; }
@media (max-width: 768px) { .kt-top-row { flex-direction: column; gap: 12px; } .kt-search-box { max-width: 100%; } .content-wrapper { padding: 20px 16px; } }
</style>
@endpush
@section('content')
<div class="kt-top-row">
    <h1 class="kt-page-title">Log Aktivitas</h1>
    <div class="kt-top-right">
        <button class="kt-btn-refresh" id="refreshBtn" title="Refresh"><span class="material-symbols-outlined">refresh</span></button>
        <span class="kt-last-update" id="lastUpdate">Terakhir : --:--:--</span>
    </div>
</div>
<div class="kt-card">
    <div class="kt-card-header"><h2>Daftar Log</h2></div>
    <div class="kt-card-body">
        <div class="kt-search-box"><span class="material-symbols-outlined">search</span><input type="text" placeholder="Cari log..." id="searchLog"></div>
        <div class="kt-table-wrap"><table class="kt-table" id="logTable"><thead><tr><th>Waktu</th><th>User</th><th>Modul</th><th>Aksi</th></tr></thead><tbody id="logTbody">@forelse($logs as $l)<tr><td>{{ $l->created_at->format('d/m/Y H:i') }}</td><td>{{ $l->user?->nama ?? '-' }}</td><td>{{ $l->modul ?? '-' }}</td><td><span class="kt-badge hijau">{{ $l->deskripsi }}</span></td></tr>@empty<tr class="kt-table-empty show" id="logEmpty"><td colspan="4">Tidak ada log yang ditemukan</td></tr>@endforelse</tbody></table></div>
    </div>
</div>
@endsection
@push('scripts')
<script>
(function(){var s=document.getElementById('searchLog'),r=document.querySelectorAll('#logTbody tr:not(.kt-table-empty)'),e=document.getElementById('logEmpty'),b=document.getElementById('refreshBtn'),l=document.getElementById('lastUpdate');function f(){var q=s.value.toLowerCase().trim(),v=0;r.forEach(function(x){var t=x.textContent.toLowerCase();if(q===''||t.indexOf(q)!==-1){x.style.display='';v++}else x.style.display='none'});e.classList.toggle('show',v===0)}function u(){var n=new Date();l.textContent='Terakhir : '+String(n.getHours()).padStart(2,'0')+'.'+String(n.getMinutes()).padStart(2,'0')+'.'+String(n.getSeconds()).padStart(2,'0')}s.addEventListener('input',f);b.addEventListener('click',function(){b.classList.remove('spinning');void b.offsetWidth;b.classList.add('spinning');u();setTimeout(function(){b.classList.remove('spinning')},600)});u()})();
</script>
@endpush
