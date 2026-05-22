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
$izinData = [
    ['waktu' => '06/12/2026 07:00', 'user' => 'Prayitno', 'alasan' => 'Perbaikan input Uang yang salah karena terdapat angka ganda pada nominal pemasukan'],
    ['waktu' => '06/12/2026 07:00', 'user' => 'AgusNugroho', 'alasan' => 'Perbaikan input Uang yang salah karena nominal tidak sesuai dengan bukti transfer'],
    ['waktu' => '06/12/2026 07:00', 'user' => 'BudiSantoso', 'alasan' => 'Perbaikan input Uang yang salah karena terdapat selisih pencatatan antara buku kas dan sistem'],
];
@endphp
@section('title', 'Permintaan Izin')
@push('styles')
<style>
body { background-color: #dbe7e4; }
.sidebar { background-color: #0d4f46 !important; }
.content-wrapper { padding: 28px 32px; }
.pz-top-row { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; }
.pz-page-title { font-size: 24px; font-weight: 700; color: #1f5c52; margin: 0; }
.pz-top-right { display: flex; align-items: center; gap: 14px; padding-top: 4px; flex-shrink: 0; }
.pz-btn-refresh { width: 30px; height: 30px; border-radius: 8px; border: 1px solid #d1d5db; background: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; padding: 0; }
.pz-btn-refresh:hover { background: #f3f4f6; }
.pz-btn-refresh .material-symbols-outlined { font-size: 16px; color: #6b7280; }
.pz-btn-refresh.spinning .material-symbols-outlined { animation: pz-spin 0.6s ease-in-out; }
@keyframes pz-spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
.pz-last-update { font-size: 11px; color: #9ca3af; font-weight: 400; white-space: nowrap; }
.pz-card { background: #fff; border-radius: 16px; border: 1px solid #1f5c52; box-shadow: 0 2px 8px rgba(0,0,0,0.04); overflow: hidden; }
.pz-card-header { background: #1f5c52; padding: 14px 22px; }
.pz-card-header h2 { font-size: 15px; font-weight: 600; color: #fff; margin: 0; letter-spacing: 0.3px; }
.pz-card-body { padding: 18px 22px; }
.pz-search-box { display: flex; align-items: center; gap: 8px; border: 1px solid #d1d5db; border-radius: 24px; padding: 8px 16px; background: #fff; max-width: 320px; transition: border-color 0.2s; margin-bottom: 18px; }
.pz-search-box:focus-within { border-color: #1f5c52; }
.pz-search-box .material-symbols-outlined { font-size: 18px; color: #9ca3af; }
.pz-search-box input { border: none; outline: none; font-size: 13px; font-family: 'Poppins', sans-serif; color: #374151; width: 100%; background: transparent; }
.pz-search-box input::placeholder { color: #9ca3af; }
.pz-table-wrap { overflow-x: auto; }
.pz-table { width: 100%; border-collapse: collapse; }
.pz-table thead th { padding: 11px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; border-bottom: 2px solid #e5e7eb; letter-spacing: 0.2px; white-space: nowrap; background: #f9fafb; }
.pz-table tbody td { padding: 12px 16px; font-size: 12px; color: #374151; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
.pz-table tbody tr:last-child td { border-bottom: none; }
.pz-table tbody tr:hover { background: #f9fafb; }
.pz-table tbody tr { transition: background 0.15s; }
.pz-table td:last-child { text-align: center; white-space: nowrap; }
.pz-btn-izinkan { display: inline-flex; align-items: center; gap: 6px; background: #1f5c52; color: #fff; border: none; border-radius: 20px; padding: 6px 16px; font-size: 11px; font-weight: 600; font-family: 'Poppins', sans-serif; cursor: pointer; transition: all 0.2s; }
.pz-btn-izinkan:hover { background: #0d4f46; transform: scale(1.03); }
.pz-btn-izinkan .material-symbols-outlined { font-size: 16px; }
.pz-status-badge { display: inline-flex; align-items: center; gap: 5px; padding: 5px 14px; border-radius: 20px; font-size: 11px; font-weight: 600; white-space: nowrap; }
.pz-status-badge .material-symbols-outlined { font-size: 15px; }
.pz-status-badge.approved { background: #d1fae5; color: #065f46; }
.pz-status-badge.rejected { background: #fee2e2; color: #991b1b; }
.pz-table-empty { text-align: center; padding: 48px 16px; color: #9ca3af; font-size: 13px; display: none; }
.pz-table-empty.show { display: table-row; }
.pz-modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px); z-index: 9999; display: flex; align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: opacity 0.3s ease, visibility 0.3s ease; }
.pz-modal-overlay.active { opacity: 1; visibility: visible; }
.pz-modal { background: #fff; border-radius: 18px; padding: 28px 30px; max-width: 460px; width: 92%; box-shadow: 0 20px 60px rgba(0,0,0,0.18); transform: scale(0.85); transition: transform 0.3s ease; }
.pz-modal-overlay.active .pz-modal { transform: scale(1); }
.pz-modal-title { font-size: 18px; font-weight: 700; color: #1f5c52; margin-bottom: 6px; }
.pz-modal-desc { font-size: 13px; color: #6b7280; line-height: 1.6; margin-bottom: 18px; }
.pz-modal-detail { background: #f9fafb; border-radius: 12px; padding: 16px; margin-bottom: 22px; }
.pz-modal-detail-item { display: flex; gap: 8px; margin-bottom: 8px; font-size: 12px; }
.pz-modal-detail-item:last-child { margin-bottom: 0; }
.pz-modal-detail-label { color: #6b7280; flex-shrink: 0; min-width: 90px; }
.pz-modal-detail-value { color: #374151; font-weight: 500; }
.pz-modal-actions { display: flex; justify-content: flex-end; gap: 12px; }
.pz-btn-terima { background: #fff; border: 1.5px solid #1f5c52; color: #1f5c52; border-radius: 10px; padding: 9px 24px; font-size: 13px; font-weight: 600; font-family: 'Poppins', sans-serif; cursor: pointer; transition: all 0.2s; }
.pz-btn-terima:hover { background: #f0fdf4; }
.pz-btn-tolak { background: #dc2626; border: none; color: #fff; border-radius: 10px; padding: 9px 24px; font-size: 13px; font-weight: 600; font-family: 'Poppins', sans-serif; cursor: pointer; transition: all 0.2s; }
.pz-btn-tolak:hover { background: #b91c1c; }
.pz-toast { position: fixed; top: 24px; right: 24px; z-index: 99999; display: flex; align-items: center; gap: 10px; padding: 14px 20px; border-radius: 12px; font-size: 13px; font-weight: 500; font-family: 'Poppins', sans-serif; box-shadow: 0 8px 24px rgba(0,0,0,0.12); transform: translateX(120%); opacity: 0; transition: all 0.4s ease; }
.pz-toast.show { transform: translateX(0); opacity: 1; }
.pz-toast .material-symbols-outlined { font-size: 20px; }
.pz-toast.success { background: #ecfdf5; color: #065f46; border: 1px solid #6ee7b7; }
.pz-toast.success .material-symbols-outlined { color: #059669; }
.pz-toast.error { background: #fef2f2; color: #991b1b; border: 1px solid #fca5a5; }
.pz-toast.error .material-symbols-outlined { color: #dc2626; }
@media (max-width: 768px) { .pz-top-row { flex-direction: column; gap: 12px; } .pz-search-box { max-width: 100%; } .content-wrapper { padding: 20px 16px; } .pz-modal { padding: 22px 20px; } }
</style>
@endpush
@section('content')
<div class="pz-top-row">
    <h1 class="pz-page-title">Permintaan Izin</h1>
    <div class="pz-top-right">
        <button class="pz-btn-refresh" id="refreshBtn" title="Refresh"><span class="material-symbols-outlined">refresh</span></button>
        <span class="pz-last-update" id="lastUpdate">Terakhir : --:--:--</span>
    </div>
</div>
<div class="pz-card">
    <div class="pz-card-header"><h2>Daftar Log</h2></div>
    <div class="pz-card-body">
        <div class="pz-search-box"><span class="material-symbols-outlined">search</span><input type="text" placeholder="Cari permintaan..." id="searchIzin"></div>
        <div class="pz-table-wrap"><table class="pz-table" id="izinTable"><thead><tr><th>Waktu</th><th>User</th><th>Alasan</th><th>Aksi</th></tr></thead><tbody id="izinTbody">@foreach($izinData as $idx => $d)<tr><td>{{ $d['waktu'] }}</td><td>{{ $d['user'] }}</td><td>{{ $d['alasan'] }}</td><td id="action-{{ $idx }}"><button class="pz-btn-izinkan" onclick="openModal({{ $idx }})"><span class="material-symbols-outlined">visibility</span> Izinkan</button></td></tr>@endforeach<tr class="pz-table-empty" id="izinEmpty"><td colspan="4">Tidak ada permintaan izin yang ditemukan</td></tr></tbody></table></div>
    </div>
</div>
<div class="pz-modal-overlay" id="izinModal">
    <div class="pz-modal">
        <div class="pz-modal-title">Setujui Permintaan Izin</div>
        <div class="pz-modal-desc">Anda akan menyetujui permintaan edit dari Bendahara.</div>
        <div class="pz-modal-detail">
            <div class="pz-modal-detail-item"><span class="pz-modal-detail-label">Tanggal:</span><span class="pz-modal-detail-value">05 Jan 2026</span></div>
            <div class="pz-modal-detail-item"><span class="pz-modal-detail-label">Bendahara:</span><span class="pz-modal-detail-value" id="modalUser">Nurhalimah</span></div>
            <div class="pz-modal-detail-item"><span class="pz-modal-detail-label">ID Transaksi:</span><span class="pz-modal-detail-value">TRX-045</span></div>
            <div class="pz-modal-detail-item"><span class="pz-modal-detail-label">Alasan:</span><span class="pz-modal-detail-value">Akun transaksi terdapat angka yang membayar lebih dari nominal standar.</span></div>
        </div>
        <div class="pz-modal-actions"><button class="pz-btn-terima" onclick="handleApprove()">Terima</button><button class="pz-btn-tolak" onclick="handleReject()">Tolak</button></div>
    </div>
</div>
<div class="pz-toast" id="toast"><span class="material-symbols-outlined">check_circle</span><span id="toastMsg">Permintaan berhasil disetujui</span></div>
@endsection
@push('scripts')
<script>
(function(){var s=document.getElementById('searchIzin'),r=document.querySelectorAll('#izinTbody tr:not(.pz-table-empty)'),e=document.getElementById('izinEmpty'),b=document.getElementById('refreshBtn'),l=document.getElementById('lastUpdate');function f(){var q=s.value.toLowerCase().trim(),v=0;r.forEach(function(x){if(q===''||x.textContent.toLowerCase().indexOf(q)!==-1){x.style.display='';v++}else x.style.display='none'});e.classList.toggle('show',v===0)}function u(){var n=new Date();l.textContent='Terakhir : '+String(n.getHours()).padStart(2,'0')+'.'+String(n.getMinutes()).padStart(2,'0')+'.'+String(n.getSeconds()).padStart(2,'0')}s.addEventListener('input',f);b.addEventListener('click',function(){b.classList.remove('spinning');void b.offsetWidth;b.classList.add('spinning');u();setTimeout(function(){b.classList.remove('spinning')},600)});u()})();
var pendingIdx=-1;
function openModal(idx){pendingIdx=idx;document.getElementById('modalUser').textContent=(['Prayitno','AgusNugroho','BudiSantoso'][idx])||'Nurhalimah';document.getElementById('izinModal').classList.add('active')}
function closeModal(){document.getElementById('izinModal').classList.remove('active');pendingIdx=-1}
function showToast(msg,type){var t=document.getElementById('toast'),i=t.querySelector('.material-symbols-outlined'),x=document.getElementById('toastMsg');t.className='pz-toast';t.classList.add(type);i.textContent=type==='success'?'check_circle':'cancel';x.textContent=msg;t.classList.add('show');setTimeout(function(){t.classList.remove('show')},3000)}
function handleApprove(){if(pendingIdx<0)return;document.getElementById('action-'+pendingIdx).innerHTML='<span class="pz-status-badge approved"><span class="material-symbols-outlined">check_circle</span> Disetujui</span>';closeModal();showToast('Permintaan berhasil disetujui','success')}
function handleReject(){if(pendingIdx<0)return;document.getElementById('action-'+pendingIdx).innerHTML='<span class="pz-status-badge rejected"><span class="material-symbols-outlined">cancel</span> Ditolak</span>';closeModal();showToast('Permintaan berhasil ditolak','error')}
document.getElementById('izinModal').addEventListener('click',function(e){if(e.target===this)closeModal()});
</script>
@endpush
