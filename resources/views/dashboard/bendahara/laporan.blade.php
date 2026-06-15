@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Dashboard', 'url' => '/bendahara', 'active' => 'bendahara'],
        ['label' => 'Catat Transaksi', 'url' => '/bendahara/catat-transaksi', 'active' => 'bendahara/catat-transaksi'],
        ['label' => 'Iuran Anggota', 'url' => '/bendahara/iuran', 'active' => 'bendahara/iuran'],
        ['label' => 'Laporan Keuangan', 'url' => '/bendahara/laporan', 'active' => 'bendahara/laporan'],
        ['label' => 'Verifikasi Pendaftaran', 'url' => '/bendahara/verifikasi', 'active' => 'bendahara/verifikasi'],
    ]
])

@section('title', 'Laporan Keuangan')

@section('content')
<div class="page-laporan">
    <div class="laporan-header">
        <h1>Laporan Keuangan</h1>
        <div class="date-dropdown">
            04-04-2026 <span class="arrow">▾</span>
        </div>
    </div>

    <div class="stat-cards">
        <div class="stat-card green">
            <div class="stat-label">Pemasukan</div>
            <div class="stat-value">Rp 3.200.000</div>
        </div>
        <div class="stat-card red">
            <div class="stat-label">Pengeluaran</div>
            <div class="stat-value">Rp 1.800.000</div>
        </div>
        <div class="stat-card blue">
            <div class="stat-label">Saldo Akhir</div>
            <div class="stat-value">Rp 1.400.000</div>
        </div>
    </div>

    <div class="table-container">
        <div class="table-search" style="display:flex;align-items:center;gap:12px;">
            <div class="search-wrap" style="flex:1;">
                <span class="material-icons search-icon">search</span>
                <input type="text" id="searchInput" placeholder="Cari transaksi...">
            </div>
            <div class="filter-select-wrap" style="position:relative;">
                <select id="periodSelect" style="padding:8px 36px 8px 14px;border:1px solid #d1d5db;border-radius:100px;font-size:13px;font-family:'Poppins',sans-serif;outline:none;background:#fff;appearance:none;cursor:pointer;min-width:140px;">
                    <option value="semua">Semua Waktu</option>
                    <option value="hari">Harian</option>
                    <option value="minggu">Mingguan</option>
                    <option value="bulan">Bulanan</option>
                </select>
                <span class="material-icons" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);font-size:18px;color:#6b7280;pointer-events:none;">expand_more</span>
            </div>
            <a href="/bendahara/laporan/export" class="btn-export" onclick="var el=this;el.innerHTML='<span class=\\'btn-spinner\\'></span> Menyiapkan...';setTimeout(function(){el.innerHTML='<span class=\\'material-icons\\' style=\\'font-size:16px;\\'>file_download</span> Export';},8000);" style="display:inline-flex;align-items:center;gap:6px;padding:8px 18px;background:var(--primary-500);color:#fff;border:none;border-radius:100px;font-size:13px;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;transition:background .2s;flex-shrink:0;text-decoration:none;"><span class="material-icons" style="font-size:16px;">file_download</span> Export</a>
        </div>
        <div class="table-scroll">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Nominal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="tableBody"></tbody>
            </table>
        </div>
        <div class="table-footer">
            <div class="pagination">
                <span class="page-arrow">‹</span>
                <span class="page-dot"></span>
                <span class="page-dot"></span>
                <span class="page-dot active"></span>
                <span class="page-dot"></span>
                <span class="page-dot"></span>
                <span class="page-arrow">›</span>
            </div>
            <span>Pengeluaran <span id="dataCount">200</span> data</span>
        </div>
    </div>


</div>

<script>
    (function() {
        if (!document.getElementById('tableBody')) return;

        var tableBody = document.getElementById('tableBody');
        var searchInput = document.getElementById('searchInput');
        var periodSelect = document.getElementById('periodSelect');
        var dataCount = document.getElementById('dataCount');
        var statValueEls = document.querySelectorAll('.stat-value');
        var allData = [];

        function fetchLaporanData(search, period) {
            var params = [];
            if (search) params.push('search=' + encodeURIComponent(search));
            if (period && period !== 'semua') params.push('period=' + encodeURIComponent(period));
            var url = '/bendahara/laporan/data' + (params.length ? '?' + params.join('&') : '');
            fetch(url)
                .then(function(r) { return r.json(); })
                .then(function(res) {
                    if (statValueEls[0]) statValueEls[0].textContent = 'Rp ' + Number(res.totalPemasukan).toLocaleString('id-ID');
                    if (statValueEls[1]) statValueEls[1].textContent = 'Rp ' + Number(res.totalPengeluaran).toLocaleString('id-ID');
                    if (statValueEls[2]) statValueEls[2].textContent = 'Rp ' + Number(res.saldo).toLocaleString('id-ID');
                    allData = res.transaksi;
                    renderTable(allData);
                    dataCount.textContent = res.totalData;
                });
        }

        function renderTable(data) {
            if (!data || !data.length) { tableBody.innerHTML = '<tr><td colspan="4" style="padding:40px 22px;text-align:center;color:#9ca3af;">Tidak ada data ditemukan</td></tr>'; return; }
            var html = '';
            data.forEach(function(row) {
                html += '<tr><td>' + row.tanggal + '</td><td style="font-weight:600;">' + row.kategori + '</td><td class="' + (row.type === 'masuk' ? 'nominal-plus' : 'nominal-minus') + '">' + row.nominal + '</td><td><span class="badge-status ' + (row.type === 'masuk' ? 'masuk' : 'keluar') + '">' + (row.type === 'masuk' ? 'Pemasukan' : 'Pengeluaran') + '</span></td></tr>';
            });
            tableBody.innerHTML = html;
        }

        searchInput.addEventListener('input', function() {
            fetchLaporanData(this.value, periodSelect.value);
        });

        periodSelect.addEventListener('change', function() {
            fetchLaporanData(searchInput.value, this.value);
        });

        document.querySelectorAll('.page-dot').forEach(function(dot) { dot.addEventListener('click', function() { document.querySelectorAll('.page-dot').forEach(function(d) { d.classList.remove('active'); }); this.classList.add('active'); }); });

        fetchLaporanData('', 'semua');

    })();
</script>
@endsection

@push('modals')
@endpush
