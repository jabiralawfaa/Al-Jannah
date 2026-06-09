@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Dashboard', 'url' => '/bendahara', 'active' => 'bendahara'],
        ['label' => 'Catat Transaksi', 'url' => '/bendahara/catat-transaksi', 'active' => 'bendahara/catat-transaksi'],
        ['label' => 'Iuran Anggota', 'url' => '/bendahara/iuran', 'active' => 'bendahara/iuran'],
        ['label' => 'Laporan Keuangan', 'url' => '/bendahara/laporan', 'active' => 'bendahara/laporan'],
        ['label' => 'Verifikasi Pendaftaran', 'url' => '/bendahara/verifikasi', 'active' => 'bendahara/verifikasi'],
    ]
])

@section('title', 'Dashboard Keuangan')

@section('content')
@php
$stats = [
    ['icon' => 'trending_up', 'bg' => '#e2f0e9', 'color' => '#1f5c52', 'label' => 'Total Pemasukan', 'value' => 'Rp ' . number_format($totalPemasukan, 0, ',', '.')],
    ['icon' => 'trending_down', 'bg' => '#fde8e0', 'color' => '#c2410c', 'label' => 'Total Pengeluaran', 'value' => 'Rp ' . number_format($totalPengeluaran, 0, ',', '.')],
    ['icon' => 'account_balance', 'bg' => '#e0f2fe', 'color' => '#0369a1', 'label' => 'Saldo Saat Ini', 'value' => 'Rp ' . number_format($saldo, 0, ',', '.')],
];

$no = 1;
@endphp

<div class="page-index">
<div class="page-header">
    <h1>Dashboard Keuangan</h1>
    <div class="date-badge">
        <span class="material-icons">calendar_today</span>
        <span id="currentDate"></span>
    </div>
</div>

<div class="stat-cards">
    @foreach($stats as $s)
    <div class="stat-card">
        <div class="card-icon-row">
            <div class="icon-wrap" style="background:{{ $s['bg'] }};">
                <span class="material-icons" style="color:{{ $s['color'] }};">{{ $s['icon'] }}</span>
            </div>
            <span class="card-label">{{ $s['label'] }}</span>
        </div>
        <span class="card-value">{{ $s['value'] }}</span>
    </div>
    @endforeach
</div>

<div class="table-card">
    <div class="table-card-header">
        <div class="header-left">
            <div class="icon-box">
                <span class="material-icons">receipt_long</span>
            </div>
            <h3>Daftar Transaksi Baru</h3>
        </div>
        <a href="/bendahara/pemasukan" class="btn-tambah">
            <span class="material-icons">add</span>
            Tambahkan Transaksi
        </a>
    </div>

    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Nominal</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi as $t)
                @php $isMasuk = $t->jenis === 'pemasukan'; @endphp
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $t->created_at->format('d/m/Y') }}</td>
                    <td class="name">{{ $t->nama }}</td>
                    <td><span class="badge {{ $isMasuk ? 'badge-pemasukan' : 'badge-pengeluaran' }}"><span class="dot"></span>{{ $isMasuk ? 'Pemasukan' : 'Pengeluaran' }}</span></td>
                    <td class="nominal">Rp {{ number_format($t->nominal, 0, ',', '.') }}</td>
                    <td>{{ $t->keterangan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

<script>
var d = new Date();
document.getElementById('currentDate').textContent = d.getDate() + ' ' +
    ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'][d.getMonth()] + ' ' + d.getFullYear();
</script>
@endsection
