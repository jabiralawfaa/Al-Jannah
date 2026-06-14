@extends('layouts.dashboard', ['menuItems' => [
  ['label' => 'Dashboard',              'url' => '/bendahara',                    'active' => 'bendahara'],
  ['label' => 'Catat Transaksi',        'url' => '/bendahara/catat-transaksi',    'active' => 'bendahara/catat-transaksi'],
  ['label' => 'Iuran Anggota',          'url' => '/bendahara/iuran',              'active' => 'bendahara/iuran'],
  ['label' => 'Laporan Keuangan',       'url' => '/bendahara/laporan',            'active' => 'bendahara/laporan'],
  ['label' => 'Verifikasi Pendaftaran', 'url' => '/bendahara/verifikasi',         'active' => 'bendahara/verifikasi'],
]])
@section('title', 'Dashboard Bendahara')

@push('styles')
<style>
:root{--p:#16423C;--pl:#1f5c53;--pd:#0d2d29;--bg:#f0f2f5;--b:rgba(0,0,0,.06);--t1:#111827;--t2:#6b7280;--tm:#9ca3af;--s1:0 1px 3px rgba(0,0,0,.04);--s2:0 4px 16px rgba(0,0,0,.06);--s3:0 8px 32px rgba(0,0,0,.08);--r1:8px;--r2:12px;--r3:16px;--cv:cubic-bezier(.4,0,.2,1)}
body{background:var(--bg);background-image:radial-gradient(ellipse at 10% 20%,rgba(22,66,60,.03) 0,transparent 50%),radial-gradient(ellipse at 90% 80%,rgba(22,66,60,.03) 0,transparent 50%)}
.page-title{font-size:1.4rem;font-weight:700;color:var(--pd);margin-bottom:1.5rem;display:flex;align-items:center;gap:.6rem;letter-spacing:-.02em}
.page-title::before{content:'';display:inline-block;width:4px;height:1.4rem;background:linear-gradient(180deg,var(--p),var(--pl));border-radius:2px}
.stat-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.5rem}
.charts-row{display:grid;grid-template-columns:1.4fr 1fr 1fr;gap:1rem;margin-bottom:1.5rem}
.tables-row{display:grid;grid-template-columns:1fr 1fr;gap:1rem;margin-bottom:1.5rem}
.stat-card{background:#fff;border-radius:var(--r3);padding:1.25rem 1.25rem 1.1rem;border:1px solid var(--b);box-shadow:var(--s1);transition:transform .3s var(--cv),box-shadow .3s var(--cv);display:flex;flex-direction:column;position:relative;overflow:hidden}
.stat-card::after{content:'';position:absolute;inset:0;border-radius:inherit;opacity:0;transition:opacity .3s var(--cv);pointer-events:none;background:linear-gradient(135deg,rgba(22,66,60,.02),transparent 60%)}
.stat-card:hover{transform:translateY(-4px);box-shadow:var(--s3);border-color:rgba(22,66,60,.1)}
.stat-card:hover::after{opacity:1}
.stat-icon-wrap{width:42px;height:42px;border-radius:var(--r1);display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-bottom:.8rem;position:relative}
.stat-icon-wrap::before{content:'';position:absolute;inset:0;border-radius:inherit;opacity:.15;background:inherit}
.stat-icon-wrap .material-symbols-outlined{font-size:1.3rem;color:#fff;position:relative;z-index:1}
.stat-card .stat-label{font-size:.7rem;font-weight:600;color:var(--t2);letter-spacing:.4px;text-transform:uppercase;margin-bottom:.2rem}
.stat-card .stat-value{font-size:1.3rem;font-weight:700;color:var(--t1);line-height:1.25;letter-spacing:-.01em}
.stat-card .stat-sub{font-size:.68rem;font-weight:500;margin-top:.4rem;display:flex;align-items:center;gap:.3rem;padding:.15rem .5rem;border-radius:999px;width:fit-content}
.stat-card .stat-sub.up{color:#059669;background:rgba(5,150,105,.08)}
.stat-card .stat-sub.down{color:#dc2626;background:rgba(220,38,38,.08)}
.stat-card .stat-sub.neutral{color:var(--t2);background:rgba(107,114,128,.08)}
.chart-card{background:#fff;border-radius:var(--r3);border:1px solid var(--b);box-shadow:var(--s1);padding:1.25rem;transition:box-shadow .3s var(--cv)}
.chart-card:hover{box-shadow:var(--s2)}
.chart-card .chart-title{font-size:.8rem;font-weight:600;color:var(--t1);margin-bottom:1rem;padding-left:.75rem;border-left:3px solid var(--p)}
.chart-card .chart-container{position:relative;width:100%}
.chart-card .chart-container.bar-chart{height:220px}
.chart-card .chart-container.donut-chart{height:200px}
.table-card{background:#fff;border-radius:var(--r3);border:1px solid var(--b);box-shadow:var(--s1);overflow:hidden;transition:box-shadow .3s var(--cv)}
.table-card:hover{box-shadow:var(--s2)}
.table-card .table-header{padding:.9rem 1.25rem;border-bottom:1px solid #f0f0f0;display:flex;justify-content:space-between;align-items:center}
.table-card .table-header h3{font-size:.8rem;font-weight:600;color:var(--t1);margin:0;padding-left:.7rem;border-left:3px solid var(--p)}
.table-card .table-body{overflow-x:auto}
.table-card table{width:100%;border-collapse:collapse}
.table-card thead th{padding:.6rem 1rem;text-align:left;font-size:.65rem;font-weight:600;color:var(--t2);border-bottom:1px solid #eef0f2;letter-spacing:.4px;text-transform:uppercase;white-space:nowrap;background:#f8f9fb}
.table-card tbody td{padding:.65rem 1rem;font-size:.75rem;color:var(--t1);border-bottom:1px solid #f3f4f6;vertical-align:middle}
.table-card tbody tr:last-child td{border-bottom:none}
.table-card tbody tr:hover{background:#f8faf9}
.table-card tbody tr{transition:background .15s}
.table-card tbody tr:nth-child(even){background:#fafbfc}
.table-card tbody tr:nth-child(even):hover{background:#f3f6f4}
.tab-filter{display:flex;gap:.25rem}
.tab-filter button{padding:.3rem .8rem;font-size:.65rem;font-weight:600;font-family:Poppins,sans-serif;border:1px solid #e0e3e7;border-radius:6px;background:#fff;color:var(--t2);cursor:pointer;transition:all .2s var(--cv)}
.tab-filter button.active{background:var(--p);border-color:var(--p);color:#fff;box-shadow:0 2px 8px rgba(22,66,60,.2)}
.tab-filter button:hover:not(.active){background:#f5f6f8;border-color:#d0d3d8}
.badge-type{display:inline-flex;align-items:center;gap:.3rem;padding:.15rem .6rem;border-radius:999px;font-size:.65rem;font-weight:600}
.badge-type.pemasukan{background:linear-gradient(135deg,#d1fae5,#a7f3d0);color:#065f46}
.badge-type.pengeluaran{background:linear-gradient(135deg,#fee2e2,#fecaca);color:#991b1b}
.ranking-item{display:flex;align-items:center;gap:.75rem;padding:.6rem 1rem;border-bottom:1px solid #f3f4f6;transition:background .15s}
.ranking-item:last-child{border-bottom:none}
.ranking-item:hover{background:#f8faf9}
.ranking-num{width:26px;height:26px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.6rem;font-weight:700;color:#fff;flex-shrink:0}
.ranking-num.gold{background:linear-gradient(135deg,#f59e0b,#d97706);box-shadow:0 2px 6px rgba(245,158,11,.35)}
.ranking-num.silver{background:linear-gradient(135deg,#9ca3af,#6b7280);box-shadow:0 2px 6px rgba(156,163,175,.3)}
.ranking-num.bronze{background:linear-gradient(135deg,#b45309,#92400e);box-shadow:0 2px 6px rgba(180,83,9,.3)}
.ranking-num.normal{background:#e5e7eb;color:var(--t2)}
.ranking-info{flex:1;min-width:0}
.ranking-name{font-size:.75rem;font-weight:600;color:var(--t1)}
.ranking-value{font-size:.75rem;font-weight:700;color:var(--p);white-space:nowrap}
.progress-fill{transition:width .8s cubic-bezier(.4,0,.2,1)}
.insight-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:1rem}
.insight-item{border-radius:var(--r2);padding:1rem;position:relative;overflow:hidden;transition:transform .25s var(--cv),box-shadow .25s var(--cv)}
.insight-item:hover{transform:translateY(-2px);box-shadow:var(--s2)}
.insight-item::before{content:'';position:absolute;top:0;left:0;width:4px;height:100%;border-radius:0 2px 2px 0}
.insight-item.type-pemasukan{background:linear-gradient(135deg,#f0fdf4,#dcfce7)}.insight-item.type-pemasukan::before{background:#059669}
.insight-item.type-pengeluaran{background:linear-gradient(135deg,#fef2f2,#fee2e2)}.insight-item.type-pengeluaran::before{background:#dc2626}
.insight-item.type-anggota{background:linear-gradient(135deg,#eff6ff,#dbeafe)}.insight-item.type-anggota::before{background:#0369a1}
.insight-item.type-rasio{background:linear-gradient(135deg,#fefce8,#fef9c3)}.insight-item.type-rasio::before{background:#d97706}
.insight-item.type-saldo{background:linear-gradient(135deg,#f5f3ff,#ede9fe)}.insight-item.type-saldo::before{background:#7c3aed}
.insight-item .insight-label{font-size:.62rem;font-weight:600;text-transform:uppercase;letter-spacing:.4px;margin-bottom:.3rem}
.insight-item .insight-label.green{color:#059669}.insight-item .insight-label.red{color:#dc2626}
.insight-item .insight-label.blue{color:#0369a1}.insight-item .insight-label.amber{color:#d97706}
.insight-item .insight-label.purple{color:#7c3aed}
.insight-item .insight-value{font-size:.85rem;font-weight:700;color:var(--t1)}
.insight-item .insight-sub{font-size:.65rem;color:var(--t2);margin-top:.1rem}
.anim-fade-up{opacity:0;transform:translateY(16px);animation:fadeUp .5s var(--cv) forwards}@keyframes fadeUp{to{opacity:1;transform:translateY(0)}}
.anim-delay-1{animation-delay:.05s}.anim-delay-2{animation-delay:.1s}
.anim-delay-3{animation-delay:.15s}.anim-delay-4{animation-delay:.2s}
.anim-delay-5{animation-delay:.25s}.anim-delay-6{animation-delay:.3s}
.anim-delay-7{animation-delay:.35s}.anim-delay-8{animation-delay:.4s}
@media(max-width:1200px){.stat-grid{grid-template-columns:repeat(2,1fr)}.charts-row,.tables-row{grid-template-columns:1fr}}
@media(max-width:768px){.stat-grid,.insight-grid{grid-template-columns:1fr}}
</style>
@endpush

@section('content')
<div class="page-title">Dashboard Bendahara</div>

{{-- Ringkasan Keuangan --}}
<div class="stat-grid">
@foreach($statCards as $card)
  <div class="stat-card anim-fade-up anim-delay-{{ $card['delay'] }}">
    <div class="stat-icon-wrap" style="background:linear-gradient(135deg,{{ $card['color'] }});">
      <span class="material-symbols-outlined">{{ $card['icon'] }}</span>
    </div>
    <div class="stat-label">{{ $card['label'] }}</div>
    <div class="stat-value {{ $card['value_class'] ?? '' }}">{{ $card['value'] }}</div>
    @isset($card['sub'])
      @if(($card['sub']['type'] ?? '') === 'progress')
      <div style="margin-top:.5rem;height:6px;background:#e5e7eb;border-radius:99px;overflow:hidden;box-shadow:inset 0 1px 2px rgba(0,0,0,.05)">
        <div class="progress-fill" data-target="{{ $card['sub']['value'] }}%" style="height:100%;width:0%;background:linear-gradient(90deg,#6366f1,#818cf8);border-radius:99px"></div>
      </div>
      @else
      <div class="stat-sub {{ $card['sub']['class'] }}">
        @isset($card['sub']['icon'])
        <span class="material-symbols-outlined" style="font-size:.85rem">{{ $card['sub']['icon'] }}</span>
        @endisset
        {{ $card['sub']['text'] }}
      </div>
      @endif
    @endisset
  </div>
@endforeach
</div>

{{-- Charts --}}
<div class="charts-row">
  <div class="chart-card anim-fade-up anim-delay-1">
    <div class="chart-title">Arus Kas Bulanan</div>
    <div class="chart-container bar-chart"><canvas id="chartArusKas"></canvas></div>
  </div>
  <div class="chart-card anim-fade-up anim-delay-2">
    <div class="chart-title">Pengeluaran per Kategori</div>
    <div class="chart-container donut-chart"><canvas id="chartKategori"></canvas></div>
  </div>
  <div class="chart-card anim-fade-up anim-delay-3">
    <div class="chart-title">Perbandingan Pemasukan &amp; Pengeluaran</div>
    <div class="chart-container donut-chart"><canvas id="chartPerbandingan"></canvas></div>
  </div>
</div>

{{-- Transaksi Terbaru --}}
<div class="tables-row" style="grid-template-columns:1fr">
  <div class="table-card anim-fade-up anim-delay-1">
    <div class="table-header">
      <h3>Transaksi Terbaru</h3>
      <div class="tab-filter" id="tabFilter">
        <button class="active" data-tab="pemasukan">Pemasukan</button>
        <button data-tab="pengeluaran">Pengeluaran</button>
      </div>
    </div>
    <div class="table-body">
      <table>
        <thead><tr><th>Tanggal</th><th>Keterangan</th><th>Jumlah</th></tr></thead>
        <tbody id="transaksiBody">
          @foreach($transaksiMasuk as $t)
          <tr class="transaksi-row" data-jenis="pemasukan">
            <td>{{ $t->tanggal }}</td><td>{{ $t->keterangan }}</td>
            <td><span class="badge-type pemasukan">{{ $t->jumlah_fmt }}</span></td>
          </tr>
          @endforeach
          @foreach($transaksiKeluar as $t)
          <tr class="transaksi-row" data-jenis="pengeluaran" style="display:none">
            <td>{{ $t->tanggal }}</td><td>{{ $t->keterangan }}</td>
            <td><span class="badge-type pengeluaran">{{ $t->jumlah_fmt }}</span></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

{{-- Kategori Progress --}}
<div class="tables-row">
@foreach($kategoriList as $kt)
  <div class="table-card anim-fade-up anim-delay-{{ $loop->index + 1 }}">
    <div class="table-header"><h3>Top Kategori {{ $kt['title'] }}</h3></div>
    <div class="table-body" style="padding:.75rem 1rem">
    @forelse($kt['items'] as $item)
      <div style="margin-bottom:.85rem">
        <div style="display:flex;justify-content:space-between;font-size:.75rem;margin-bottom:.3rem">
          <span style="color:#374151;font-weight:500">{{ $item['nama'] }}</span>
          <span style="color:{{ $kt['color'] }};font-weight:700">{{ $item['total_fmt'] }} ({{ $item['persen'] }}%)</span>
        </div>
        <div style="height:6px;background:#e5e7eb;border-radius:99px;overflow:hidden;box-shadow:inset 0 1px 2px rgba(0,0,0,.04)">
          <div class="progress-fill" data-target="{{ $item['persen'] }}%" style="height:100%;width:0%;background:linear-gradient(90deg,{{ $kt['gradient'] }});border-radius:99px"></div>
        </div>
      </div>
    @empty
      <div style="text-align:center;padding:1.5rem;color:#9ca3af;font-size:.8rem">Belum ada data {{ lcfirst($kt['title']) }}</div>
    @endforelse
    </div>
  </div>
@endforeach
</div>

{{-- Ranking --}}
<div class="tables-row">
@foreach($rankingList as $rk)
  <div class="table-card anim-fade-up anim-delay-{{ $loop->index + 1 }}">
    <div class="table-header"><h3>{{ $rk['title'] }}</h3></div>
    <div class="table-body">
    @forelse($rk['items'] as $item)
      <div class="ranking-item">
        <div class="ranking-num {{ $item['rank_class'] }}">{{ $item['rank'] }}</div>
        <div class="ranking-info">
          <div class="ranking-name">{{ $item['name'] }}</div>
          <div style="font-size:.65rem;color:#6b7280">{{ $item['detail'] }}</div>
        </div>
        <div class="ranking-value">{{ $item['amount'] }}</div>
      </div>
    @empty
      <div style="text-align:center;padding:2rem;color:#9ca3af;font-size:.8rem">{{ $rk['empty'] }}</div>
    @endforelse
    </div>
  </div>
@endforeach
</div>

{{-- Ringkasan Iuran --}}
<div class="stat-grid">
@foreach($iuranCards as $card)
  <div class="stat-card anim-fade-up anim-delay-{{ $card['delay'] }}">
    <div class="stat-icon-wrap" style="background:linear-gradient(135deg,{{ $card['color'] }});">
      <span class="material-symbols-outlined">{{ $card['icon'] }}</span>
    </div>
    <div class="stat-label">{{ $card['label'] }}</div>
    <div class="stat-value">{{ $card['value'] }}</div>
    @isset($card['sub'])
      @if(($card['sub']['type'] ?? '') === 'progress')
      <div style="margin-top:.5rem;height:6px;background:#e5e7eb;border-radius:99px;overflow:hidden;box-shadow:inset 0 1px 2px rgba(0,0,0,.05)">
        <div class="progress-fill" data-target="{{ $card['sub']['value'] }}%" style="height:100%;width:0%;background:linear-gradient(90deg,#6366f1,#818cf8);border-radius:99px"></div>
      </div>
      @endif
    @endisset
  </div>
@endforeach
</div>

{{-- Insight Keuangan --}}
<div class="chart-card anim-fade-up anim-delay-1" style="margin-bottom:1.5rem">
  <div class="chart-title">Insight Keuangan</div>
  <div class="insight-grid">
  @foreach($insightList as $item)
    <div class="insight-item type-{{ $item['type'] }}">
      <div class="insight-label {{ $item['cls'] }}">{{ $item['label'] }}</div>
      <div class="insight-value">{{ $item['value'] }}</div>
      <div class="insight-sub">{{ $item['sub'] }}</div>
    </div>
  @endforeach
  </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/chart.umd.min.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded',function(){
var C={green:'#16423C',greenLight:'#8BC4A8',blue:'#0369a1',purple:'#7c3aed',cyan:'#0891b2',emerald:'#059669',red:'#dc2626',amber:'#d97706',indigo:'#6366f1',orange:'#f59e0b',pink:'#ec4899',teal:'#14b8a6',gray:'#6b7280'},F={family:'Poppins, sans-serif'},A=Object.assign;
function tC(e){return e.label+': Rp '+Number(e.raw).toLocaleString('id-ID')}
function tK(e){var d=kD[e.dataIndex];return e.label+': Rp '+Number(d.nominal).toLocaleString('id-ID')+' ('+d.persen+'%)'}
function mT(c){return{backgroundColor:'#1f2937',titleFont:A({},F,{size:11}),bodyFont:A({},F,{size:10}),padding:10,cornerRadius:8,callbacks:{label:c}}}
function mL(){return{font:A({},F,{size:9}),color:'#6b7280',boxWidth:10,boxHeight:10,padding:8,usePointStyle:true}}
var e1=document.getElementById('chartArusKas');
if(e1) new Chart(e1,{type:'bar',data:{labels:@json($chartLabels),datasets:[{label:'Pemasukan',data:@json($chartPemasukan),backgroundColor:C.greenLight,borderRadius:6,borderSkipped:false,barPercentage:.55,categoryPercentage:.7},{label:'Pengeluaran',data:@json($chartPengeluaran),backgroundColor:C.green,borderRadius:6,borderSkipped:false,barPercentage:.55,categoryPercentage:.7}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:true,position:'top',align:'end',labels:A({},F,{size:10,weight:'500',color:'#6b7280',boxWidth:12,boxHeight:7,padding:12,usePointStyle:true,pointStyle:'circle'})},tooltip:mT(tC)},scales:{x:{grid:{display:false},ticks:A({},F,{size:9,color:'#9ca3af'})},y:{grid:{color:'#f0f2f5',drawBorder:false},ticks:A({},F,{size:9,color:'#9ca3af',padding:6,callback:function(v){return'Rp'+Number(v).toLocaleString('id-ID')}}),beginAtZero:true}}}});
var e2=document.getElementById('chartKategori');
if(e2){var kL=@json($kategoriLabels),kD=@json($kategoriData),dC=[C.green,C.blue,C.amber,C.red,C.purple,C.cyan,C.pink,C.teal,C.gray];new Chart(e2,{type:'doughnut',data:{labels:kL,datasets:[{data:kD.map(function(d){return d.nominal}),backgroundColor:dC.slice(0,kL.length),borderWidth:3,borderColor:'#fff'}]},options:{responsive:true,maintainAspectRatio:false,cutout:'62%',plugins:{legend:{position:'bottom',labels:mL()},tooltip:mT(tK)}}})}
var e3=document.getElementById('chartPerbandingan');
if(e3) new Chart(e3,{type:'doughnut',data:{labels:['Pemasukan','Pengeluaran'],datasets:[{data:[{{$pemasukanBulanIni}},{{$pengeluaranBulanIni}}],backgroundColor:[C.emerald,C.red],borderWidth:3,borderColor:'#fff'}]},options:{responsive:true,maintainAspectRatio:false,cutout:'62%',plugins:{legend:{position:'bottom',labels:mL()},tooltip:mT(tC)}}});
document.querySelectorAll('#tabFilter button').forEach(function(b){b.addEventListener('click',function(){document.querySelectorAll('#tabFilter button').forEach(function(x){x.classList.remove('active')});b.classList.add('active');var t=b.getAttribute('data-tab');document.querySelectorAll('.transaksi-row').forEach(function(r){r.style.display=r.getAttribute('data-jenis')===t?'':'none'})})});
document.querySelectorAll('.progress-fill').forEach(function(e){var t=e.getAttribute('data-target');if(!t||t==='0%'||t==='0')return;setTimeout(function(){e.style.width=t},400)});
});
</script>
@endpush
