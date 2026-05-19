@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Dashboard', 'url' => '/bendahara', 'active' => 'bendahara'],
        ['label' => 'Catat Pemasukan', 'url' => '/bendahara/pemasukan', 'active' => 'bendahara/pemasukan'],
        ['label' => 'Catat Pengeluaran', 'url' => '/bendahara/pengeluaran', 'active' => 'bendahara/pengeluaran'],
        ['label' => 'Iuran Anggota', 'url' => '/bendahara/iuran', 'active' => 'bendahara/iuran'],
        ['label' => 'Laporan Keuangan', 'url' => '/bendahara/laporan', 'active' => 'bendahara/laporan'],
        ['label' => 'Verifikasi Pendaftaran', 'url' => '/bendahara/verifikasi', 'active' => 'bendahara/verifikasi'],
    ]
])

@section('title', 'Dashboard Keuangan')

@section('content')
@php
$stats = [
    ['icon' => 'trending_up', 'bg' => '#e2f0e9', 'color' => '#1f5c52', 'label' => 'Total Pemasukan', 'value' => 'Rp 3.000.000'],
    ['icon' => 'trending_down', 'bg' => '#fde8e0', 'color' => '#c2410c', 'label' => 'Total Pengeluaran', 'value' => 'Rp 1.250.000'],
    ['icon' => 'account_balance', 'bg' => '#e0f2fe', 'color' => '#0369a1', 'label' => 'Saldo Saat Ini', 'value' => 'Rp 1.750.000'],
];

$transactions = [
    ['no' => '01', 'date' => '10 Jan 2026', 'name' => 'Intan', 'type' => 'masuk', 'nominal' => 'Rp 1.200.000', 'ket' => 'Iuran Anggota'],
    ['no' => '02', 'date' => '11 Jan 2026', 'name' => 'Leny', 'type' => 'keluar', 'nominal' => 'Rp 500.000', 'ket' => 'Santunan'],
    ['no' => '03', 'date' => '14 Jan 2026', 'name' => 'Rakha', 'type' => 'masuk', 'nominal' => 'Rp 300.000', 'ket' => 'Iuran Anggota'],
    ['no' => '04', 'date' => '16 Jan 2026', 'name' => 'Jabir', 'type' => 'masuk', 'nominal' => 'Rp 750.000', 'ket' => 'Iuran Anggota'],
    ['no' => '05', 'date' => '18 Jan 2026', 'name' => 'Naza', 'type' => 'keluar', 'nominal' => 'Rp 750.000', 'ket' => 'Santunan'],
];
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
                @foreach($transactions as $t)
                @php $isMasuk = $t['type'] === 'masuk'; @endphp
                <tr>
                    <td>{{ $t['no'] }}</td>
                    <td>{{ $t['date'] }}</td>
                    <td class="name">{{ $t['name'] }}</td>
                    <td><span class="badge {{ $isMasuk ? 'badge-pemasukan' : 'badge-pengeluaran' }}"><span class="dot"></span>{{ $isMasuk ? 'Pemasukan' : 'Pengeluaran' }}</span></td>
                    <td class="nominal">{{ $t['nominal'] }}</td>
                    <td>{{ $t['ket'] }}</td>
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
