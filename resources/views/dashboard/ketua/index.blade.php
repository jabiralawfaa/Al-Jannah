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
$stats = [
    ['icon' => 'groups', 'value' => '198', 'label' => 'Anggota', 'color' => 'green'],
    ['icon' => 'account_balance', 'value' => 'Rp.29.000.000', 'label' => 'Saldo Kas', 'color' => 'green'],
    ['icon' => 'inventory_2', 'value' => '5', 'label' => 'Total Aset', 'color' => 'green'],
    ['icon' => 'edit', 'value' => '3', 'label' => 'Permintaan izin Edit', 'color' => 'orange'],
];
$activities = [
    ['icon' => 'how_to_reg', 'color' => 'green', 'text' => 'Verifikasi Disetujui - Sekretaris', 'time' => '16 Jan 2026 10:30'],
    ['icon' => 'currency_exchange', 'color' => 'blue', 'text' => 'Permintaan Update data Keuangan - Bendahara', 'time' => '16 Jan 2026 09:45'],
    ['icon' => 'assignment', 'color' => 'orange-bg', 'text' => 'Pengubahan status Aset - Logistik', 'time' => '15 Jan 2026 14:20'],
];
$requests = [
    ['title' => 'Pengubahan Dana Pemasukan - Bendahara', 'detail' => 'Tabel : Pemasukan - field : infaq jariyah masjid at-taqwa', 'reason' => 'Dana yang masuk tidak sesuai dengan yang asli, seharusnya 750.000 tetapi tercatat 500.000', 'date' => '16 Jan 2026 09:30'],
    ['title' => 'Perubahan Data Anggota - Sekretaris', 'detail' => 'Tabel : Anggota - field : alamat, no_telepon', 'reason' => 'Data anggota telah diperbarui oleh yang bersangkutan, perlu penyesuaian di sistem', 'date' => '17 Jan 2026 14:15'],
    ['title' => 'Update Stok Barang - Logistik', 'detail' => 'Tabel : Stok Barang - field : jumlah_stok', 'reason' => 'Terdapat barang masuk dan keluar yang belum tercatat, stok perlu disesuaikan', 'date' => '17 Jan 2026 08:45'],
];
$requestData = array_map(function($r) {
    $user = explode(' - ', $r['title'])[1] ?? $r['title'];
    return ['date' => $r['date'], 'user' => $user, 'detail' => $r['detail'], 'reason' => $r['reason']];
}, $requests);
@endphp
@section('title', 'Dashboard Ketua')
@push('styles')
<style>
body { background-color: #eef6f2; }
.sidebar { background-color: #0d4f46 !important; }
.ketua-page-title { font-size: 26px; font-weight: 700; color: #0d4f46; margin-bottom: 24px; }
.ketua-stat-cards { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 24px; }
.ketua-stat-card { background: #fff; border-radius: 14px; padding: 20px 22px; border: 1px solid #e8ecf0; box-shadow: 0 1px 3px rgba(0,0,0,0.04); display: flex; align-items: center; gap: 16px; transition: box-shadow 0.25s ease, transform 0.25s ease; cursor: default; }
.ketua-stat-card:hover { box-shadow: 0 4px 16px rgba(13,79,70,0.10); transform: translateY(-1px); }
.ketua-stat-icon { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
.ketua-stat-icon .material-symbols-outlined { font-size: 26px; color: #fff; }
.ketua-stat-icon.green { background-color: #0d4f46; }
.ketua-stat-icon.orange { background-color: #f59e0b; }
.ketua-stat-info { flex: 1; min-width: 0; }
.ketua-stat-value { font-size: 22px; font-weight: 700; color: #111827; line-height: 1.2; }
.ketua-stat-label { font-size: 12px; font-weight: 500; color: #6b7280; margin-top: 2px; letter-spacing: 0.2px; }
.ketua-two-col { display: grid; grid-template-columns: 1.5fr 1fr; gap: 20px; margin-bottom: 24px; }
.ketua-card { background: #fff; border-radius: 14px; border: 1px solid #e8ecf0; box-shadow: 0 1px 3px rgba(0,0,0,0.04); padding: 22px 24px; }
.ketua-card-title { font-size: 16px; font-weight: 600; color: #111827; margin-bottom: 18px; }
.ketua-chart-container { position: relative; height: 220px; width: 100%; }
.ketua-chart-footer { font-size: 11px; color: #9ca3af; text-align: center; margin-top: 14px; font-weight: 500; }
.ketua-activities-list { display: flex; flex-direction: column; gap: 12px; }
.ketua-activity-item { display: flex; align-items: flex-start; gap: 12px; padding: 12px 14px; background: #f9fafb; border-radius: 10px; transition: background 0.2s; }
.ketua-activity-item:hover { background: #f3f4f6; }
.ketua-activity-icon { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px; }
.ketua-activity-icon .material-symbols-outlined { font-size: 17px; color: #fff; }
.ketua-activity-icon.green { background-color: #0d4f46; }
.ketua-activity-icon.blue { background-color: #0284c7; }
.ketua-activity-icon.orange-bg { background-color: #d97706; }
.ketua-activity-text { flex: 1; min-width: 0; }
.ketua-activity-desc { font-size: 13px; font-weight: 500; color: #1f2937; line-height: 1.4; }
.ketua-activity-time { font-size: 11px; color: #9ca3af; margin-top: 3px; font-weight: 400; }
.br-card-header { background: #1f5c52; padding: 14px 22px; display: flex; justify-content: space-between; align-items: center; border-radius: 14px 14px 0 0; }
.br-card-header h2 { font-size: 15px; font-weight: 600; color: #fff; margin: 0; letter-spacing: 0.3px; }
.br-header-right { display: flex; align-items: center; gap: 14px; flex-shrink: 0; }
.br-btn-refresh { width: 30px; height: 30px; border-radius: 8px; border: 1px solid rgba(255,255,255,0.4); background: rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s; padding: 0; }
.br-btn-refresh:hover { background: rgba(255,255,255,0.3); }
.br-btn-refresh .material-symbols-outlined { font-size: 16px; color: #fff; }
.br-btn-refresh.spinning .material-symbols-outlined { animation: br-spin 0.6s ease-in-out; }
@keyframes br-spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
.br-last-update { font-size: 11px; color: rgba(255,255,255,0.7); font-weight: 400; white-space: nowrap; }
.br-card-body { padding: 18px 22px; }
.br-search-box { display: flex; align-items: center; gap: 8px; border: 1px solid #d1d5db; border-radius: 24px; padding: 8px 16px; background: #fff; max-width: 320px; transition: border-color 0.2s; margin-bottom: 18px; }
.br-search-box:focus-within { border-color: #1f5c52; }
.br-search-box .material-symbols-outlined { font-size: 18px; color: #9ca3af; }
.br-search-box input { border: none; outline: none; font-size: 13px; font-family: 'Poppins', sans-serif; color: #374151; width: 100%; background: transparent; }
.br-search-box input::placeholder { color: #9ca3af; }
.br-table-wrap { overflow-x: auto; }
.br-table { width: 100%; border-collapse: collapse; }
.br-table thead th { padding: 11px 16px; text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; border-bottom: 2px solid #e5e7eb; letter-spacing: 0.2px; white-space: nowrap; background: #f9fafb; }
.br-table tbody td { padding: 12px 16px; font-size: 12px; color: #374151; border-bottom: 1px solid #f3f4f6; vertical-align: middle; }
.br-table tbody tr:last-child td { border-bottom: none; }
.br-table tbody tr:hover { background: #f9fafb; }
.br-table tbody tr { transition: background 0.15s; }
.br-table td:last-child { text-align: center; white-space: nowrap; }
.br-btn-izinkan { display: inline-flex; align-items: center; gap: 6px; background: #1f5c52; color: #fff; border: none; border-radius: 20px; padding: 6px 16px; font-size: 11px; font-weight: 600; font-family: 'Poppins', sans-serif; cursor: pointer; transition: all 0.2s; }
.br-btn-izinkan:hover { background: #0d4f46; transform: scale(1.03); }
.br-btn-izinkan .material-symbols-outlined { font-size: 16px; }
.br-status-badge { display: inline-flex; align-items: center; gap: 5px; padding: 5px 14px; border-radius: 20px; font-size: 11px; font-weight: 600; white-space: nowrap; }
.br-status-badge .material-symbols-outlined { font-size: 15px; }
.br-status-badge.approved { background: #d1fae5; color: #065f46; }
.br-status-badge.rejected { background: #fee2e2; color: #991b1b; }
.br-table-empty { text-align: center; padding: 48px 16px; color: #9ca3af; font-size: 13px; display: none; }
.br-table-empty.show { display: table-row; }
.br-modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px); z-index: 9999; display: flex; align-items: center; justify-content: center; opacity: 0; visibility: hidden; transition: opacity 0.3s ease, visibility 0.3s ease; }
.br-modal-overlay.active { opacity: 1; visibility: visible; }
.br-modal { background: #fff; border-radius: 18px; padding: 28px 30px; max-width: 460px; width: 92%; box-shadow: 0 20px 60px rgba(0,0,0,0.18); transform: scale(0.85); transition: transform 0.3s ease; }
.br-modal-overlay.active .br-modal { transform: scale(1); }
.br-modal-title { font-size: 18px; font-weight: 700; color: #1f5c52; margin-bottom: 6px; }
.br-modal-desc { font-size: 13px; color: #6b7280; line-height: 1.6; margin-bottom: 18px; }
.br-modal-detail-box { background: #f9fafb; border-radius: 12px; padding: 16px; margin-bottom: 22px; }
.br-modal-detail-item { display: flex; gap: 8px; margin-bottom: 8px; font-size: 12px; }
.br-modal-detail-item:last-child { margin-bottom: 0; }
.br-modal-detail-label { color: #6b7280; flex-shrink: 0; min-width: 90px; }
.br-modal-detail-value { color: #374151; font-weight: 500; }
.br-modal-actions { display: flex; justify-content: flex-end; gap: 12px; }
.br-btn-terima { background: #fff; border: 1.5px solid #1f5c52; color: #1f5c52; border-radius: 10px; padding: 9px 24px; font-size: 13px; font-weight: 600; font-family: 'Poppins', sans-serif; cursor: pointer; transition: all 0.2s; }
.br-btn-terima:hover { background: #f0fdf4; }
.br-btn-tolak { background: #dc2626; border: none; color: #fff; border-radius: 10px; padding: 9px 24px; font-size: 13px; font-weight: 600; font-family: 'Poppins', sans-serif; cursor: pointer; transition: all 0.2s; }
.br-btn-tolak:hover { background: #b91c1c; }
.br-toast { position: fixed; top: 24px; right: 24px; z-index: 99999; display: flex; align-items: center; gap: 10px; padding: 14px 20px; border-radius: 12px; font-size: 13px; font-weight: 500; font-family: 'Poppins', sans-serif; box-shadow: 0 8px 24px rgba(0,0,0,0.12); transform: translateX(120%); opacity: 0; transition: all 0.4s ease; }
.br-toast.show { transform: translateX(0); opacity: 1; }
.br-toast .material-symbols-outlined { font-size: 20px; }
.br-toast.success { background: #ecfdf5; color: #065f46; border: 1px solid #6ee7b7; }
.br-toast.success .material-symbols-outlined { color: #059669; }
.br-toast.error { background: #fef2f2; color: #991b1b; border: 1px solid #fca5a5; }
.br-toast.error .material-symbols-outlined { color: #dc2626; }
@media (max-width: 1200px) { .ketua-stat-cards { grid-template-columns: repeat(2, 1fr); } .ketua-two-col { grid-template-columns: 1fr; } }
@media (max-width: 768px) { .ketua-stat-cards { grid-template-columns: 1fr; } .br-card-header { flex-direction: column; gap: 12px; } .br-search-box { max-width: 100%; } }
</style>
@endpush
@section('content')
<h1 class="ketua-page-title">Dashboard</h1>
<div class="ketua-stat-cards">@foreach($stats as $s)
    <div class="ketua-stat-card"><div class="ketua-stat-icon {{ $s['color'] }}"><span class="material-symbols-outlined">{{ $s['icon'] }}</span></div><div class="ketua-stat-info"><div class="ketua-stat-value">{{ $s['value'] }}</div><div class="ketua-stat-label">{{ $s['label'] }}</div></div></div>
@endforeach</div>
<div class="ketua-two-col">
    <div class="ketua-card"><div class="ketua-card-title">Arus Keuangan</div><div class="ketua-chart-container"><canvas id="financeChart"></canvas></div><div class="ketua-chart-footer">Data Keuangan Tahun 2026</div></div>
    <div class="ketua-card"><div class="ketua-card-title">Aktivitas Terbaru</div><div class="ketua-activities-list">@foreach($activities as $a)
        <div class="ketua-activity-item"><div class="ketua-activity-icon {{ $a['color'] }}"><span class="material-symbols-outlined">{{ $a['icon'] }}</span></div><div class="ketua-activity-text"><div class="ketua-activity-desc">{{ $a['text'] }}</div><div class="ketua-activity-time">{{ $a['time'] }}</div></div></div>
    @endforeach</div></div>
</div>
<div class="ketua-card" style="padding:0;">
    <div class="br-card-header"><h2>Permintaan Izin Edit</h2><div class="br-header-right"><button class="br-btn-refresh" id="brRefreshBtn" title="Refresh"><span class="material-symbols-outlined">refresh</span></button><span class="br-last-update" id="brLastUpdate">Terakhir : --:--:--</span></div></div>
    <div class="br-card-body">
        <div class="br-search-box"><span class="material-symbols-outlined">search</span><input type="text" placeholder="Cari permintaan..." id="searchIzin"></div>
        <div class="br-table-wrap"><table class="br-table" id="izinTable"><thead><tr><th>Waktu</th><th>User</th><th>Alasan</th><th>Aksi</th></tr></thead><tbody>@foreach($requests as $idx => $r)@php $user = explode(' - ', $r['title'])[1] ?? $r['title']; @endphp<tr><td>{{ $r['date'] }}</td><td>{{ $user }}</td><td>{{ $r['reason'] }}</td><td id="ba-action-{{ $idx }}"><button class="br-btn-izinkan" onclick="openModal({{ $idx }})"><span class="material-symbols-outlined">visibility</span> Izinkan</button></td></tr>@endforeach<tr class="br-table-empty" id="izinEmpty"><td colspan="4">Tidak ada permintaan izin yang ditemukan</td></tr></tbody></table></div>
    </div>
</div>
<div class="br-modal-overlay" id="izinModal">
    <div class="br-modal">
        <div class="br-modal-title">Setujui Permintaan Izin</div>
        <div class="br-modal-desc">Anda akan menyetujui permintaan edit berikut:</div>
        <div class="br-modal-detail-box">
            <div class="br-modal-detail-item"><span class="br-modal-detail-label">Tanggal:</span><span class="br-modal-detail-value" id="modalDate">-</span></div>
            <div class="br-modal-detail-item"><span class="br-modal-detail-label">User:</span><span class="br-modal-detail-value" id="modalUser">-</span></div>
            <div class="br-modal-detail-item"><span class="br-modal-detail-label">Detail:</span><span class="br-modal-detail-value" id="modalDetail">-</span></div>
            <div class="br-modal-detail-item"><span class="br-modal-detail-label">Alasan:</span><span class="br-modal-detail-value" id="modalReason">-</span></div>
        </div>
        <div class="br-modal-actions"><button class="br-btn-terima" onclick="handleApprove()">Terima</button><button class="br-btn-tolak" onclick="handleReject()">Tolak</button></div>
    </div>
</div>
<div class="br-toast" id="toast"><span class="material-symbols-outlined">check_circle</span><span id="toastMsg">Permintaan berhasil disetujui</span></div>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
var ctx=document.getElementById('financeChart').getContext('2d');
new Chart(ctx,{type:'bar',data:{labels:['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],datasets:[{label:'Pemasukan',data:[4.2,3.8,5.1,4.5,5.8,6.2,5.5,4.9,5.3,6.0,5.7,6.5],backgroundColor:'#8BC4A8',borderRadius:6,borderSkipped:false,barPercentage:0.55,categoryPercentage:0.7},{label:'Pengeluaran',data:[2.8,3.2,3.5,2.9,4.1,3.7,3.3,3.8,3.0,4.2,3.9,4.5],backgroundColor:'#0d4f46',borderRadius:6,borderSkipped:false,barPercentage:0.55,categoryPercentage:0.7}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:true,position:'top',align:'end',labels:{font:{family:'Poppins',size:11,weight:'500'},color:'#6b7280',boxWidth:14,boxHeight:8,padding:14,usePointStyle:true,pointStyle:'circle'}},tooltip:{backgroundColor:'#1f2937',titleFont:{family:'Poppins',size:12},bodyFont:{family:'Poppins',size:11},padding:10,cornerRadius:8,callbacks:{label:function(c){return c.dataset.label+': Rp '+c.raw+' JT'}}}},scales:{x:{grid:{display:false},ticks:{font:{family:'Poppins',size:10},color:'#9ca3af'}},y:{grid:{color:'#f3f4f6',drawBorder:false},ticks:{font:{family:'Poppins',size:10},color:'#9ca3af',padding:8,callback:function(v){return'Rp'+v+'JT'}},beginAtZero:true}}}});
var requestData=@json($requestData),pendingIdx=-1;
function openModal(idx){var d=requestData[idx];if(!d)return;pendingIdx=idx;document.getElementById('modalDate').textContent=d.date;document.getElementById('modalUser').textContent=d.user;document.getElementById('modalDetail').textContent=d.detail;document.getElementById('modalReason').textContent=d.reason;document.getElementById('izinModal').classList.add('active')}
function closeModal(){document.getElementById('izinModal').classList.remove('active');pendingIdx=-1}
function showToast(msg,type){var t=document.getElementById('toast'),icon=t.querySelector('.material-symbols-outlined'),text=document.getElementById('toastMsg');t.className='br-toast';t.classList.add(type);icon.textContent=type==='success'?'check_circle':'cancel';text.textContent=msg;t.classList.add('show');setTimeout(function(){t.classList.remove('show')},3000)}
function handleApprove(){if(pendingIdx<0)return;document.getElementById('ba-action-'+pendingIdx).innerHTML='<span class="br-status-badge approved"><span class="material-symbols-outlined">check_circle</span> Disetujui</span>';closeModal();showToast('Permintaan berhasil disetujui','success')}
function handleReject(){if(pendingIdx<0)return;document.getElementById('ba-action-'+pendingIdx).innerHTML='<span class="br-status-badge rejected"><span class="material-symbols-outlined">cancel</span> Ditolak</span>';closeModal();showToast('Permintaan berhasil ditolak','error')}
document.getElementById('izinModal').addEventListener('click',function(e){if(e.target===this)closeModal()});
(function(){var s=document.getElementById('searchIzin');if(!s)return;var r=document.querySelectorAll('#izinTable tbody tr:not(.br-table-empty)'),e=document.getElementById('izinEmpty'),b=document.getElementById('brRefreshBtn'),l=document.getElementById('brLastUpdate');function f(){var q=s.value.toLowerCase().trim(),v=0;r.forEach(function(x){if(q===''||x.textContent.toLowerCase().indexOf(q)!==-1){x.style.display='';v++}else x.style.display='none'});if(e)e.classList.toggle('show',v===0)}function u(){var n=new Date();if(l)l.textContent='Terakhir : '+String(n.getHours()).padStart(2,'0')+'.'+String(n.getMinutes()).padStart(2,'0')+'.'+String(n.getSeconds()).padStart(2,'0')}if(s)s.addEventListener('input',f);if(b)b.addEventListener('click',function(){b.classList.remove('spinning');void b.offsetWidth;b.classList.add('spinning');u();setTimeout(function(){b.classList.remove('spinning')},600)});u()})();
</script>
@endpush
