@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Dashboard', 'url' => '/bendahara', 'active' => 'bendahara'],
        ['label' => 'Catat Pemasukan', 'url' => '/bendahara/pemasukan', 'active' => 'bendahara/pemasukan'],
        ['label' => 'Catat Pengeluaran', 'url' => '/bendahara/pengeluaran', 'active' => 'bendahara/pengeluaran'],
        ['label' => 'Iuran Anggota', 'url' => '/bendahara/iuran', 'active' => 'bendahara/iuran'],
        ['label' => 'Laporan Keuangan', 'url' => '/bendahara/laporan', 'active' => 'bendahara/laporan'],
        ['label' => 'Verifikasi Pembayaran', 'url' => '/bendahara/verifikasi', 'active' => 'bendahara/verifikasi'],
    ]
])

@section('title', 'Verifikasi Pembayaran Anggota')

@section('content')
<div class="page-vp">
    <div class="vp-header">
        <h1>Verifikasi Pembayaran Anggota</h1>
    </div>

    <div class="vp-card">
        <div class="vp-card-header">
            <h3>Pendaftaran</h3>
        </div>
        <div class="vp-table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Daftar</th>
                        <th>Nama</th>
                        <th>Nominal Pendaftaran</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="vpBody"></tbody>
            </table>
        </div>
    </div>
</div>

<script>
    (function() {
        if (!document.getElementById('vpBody')) return;

        var data = [{no:1,tanggal:'4/22/2026',nama:'Budi Santoso',nominal:'Rp. 30.000',status:'Belum Lunas'}];

        function renderVerifikasiTable() {
            var tbody = document.getElementById('vpBody'), html = '';
            for (var i = 0; i < data.length; i++) {
                var row = data[i], isLunas = row.status === 'Lunas';
                html += '<tr><td>' + row.no + '</td><td>' + row.tanggal + '</td><td style="font-weight:600;">' + row.nama + '</td><td>' + row.nominal + '</td><td><span class="badge-status ' + (isLunas ? 'lunas' : 'belum-lunas') + '">' + row.status + '</span></td><td><button class="btn-action sudah-dibayar"' + (isLunas ? ' disabled' : '') + ' onclick="verifikasi(' + i + ')">' + (isLunas ? 'Terverifikasi' : 'Sudah Dibayar') + '</button></td></tr>';
            }
            tbody.innerHTML = html;
        }

        window.verifikasi = function(index) { data[index].status = 'Lunas'; renderVerifikasiTable(); };
        renderVerifikasiTable();
    })();
</script>
@endsection
