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

    <div class="filter-bar">
        <button class="filter-btn" data-period="hari">Harian</button>
        <button class="filter-btn" data-period="minggu">Mingguan</button>
        <button class="filter-btn active" data-period="bulan">Bulanan</button>
    </div>

    <div class="table-container">
        <div class="table-search">
            <div class="search-wrap">
                <span class="material-icons search-icon">search</span>
                <input type="text" id="searchInput" placeholder="Cari transaksi...">
            </div>
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

    <div class="btn-generate-wrap">
        <button class="btn-generate" onclick="openSaveModal()">Generate Laporan</button>
    </div>
</div>

<script>
    (function() {
        if (!document.getElementById('tableBody')) return;

        var tableBody = document.getElementById('tableBody');
        var searchInput = document.getElementById('searchInput');
        var filterBtns = document.querySelectorAll('.filter-btn');
        var dataCount = document.getElementById('dataCount');
        var allData = [
            {tanggal:'04-04-2026',kategori:'Infaq/Amal',nominal:'+ 200.000',type:'masuk'},
            {tanggal:'04-04-2026',kategori:'Infaq/Amal',nominal:'- 200.000',type:'keluar'},
            {tanggal:'04-04-2026',kategori:'Infaq/Amal',nominal:'+ 300.000',type:'masuk'},
            {tanggal:'03-04-2026',kategori:'Iuran Anggota',nominal:'+ 500.000',type:'masuk'},
            {tanggal:'03-04-2026',kategori:'Operasional',nominal:'- 150.000',type:'keluar'},
            {tanggal:'02-04-2026',kategori:'Infaq/Amal',nominal:'+ 1.000.000',type:'masuk'},
            {tanggal:'02-04-2026',kategori:'Santunan',nominal:'- 500.000',type:'keluar'},
            {tanggal:'01-04-2026',kategori:'Infaq/Amal',nominal:'+ 700.000',type:'masuk'},
            {tanggal:'01-04-2026',kategori:'Operasional',nominal:'- 300.000',type:'keluar'},
            {tanggal:'01-04-2026',kategori:'Iuran Anggota',nominal:'+ 200.000',type:'masuk'},
        ];

        function renderTable(data) {
            if (!data || !data.length) { tableBody.innerHTML = '<tr><td colspan="4" style="padding:40px 22px;text-align:center;color:#9ca3af;">Tidak ada data ditemukan</td></tr>'; dataCount.textContent = '0'; return; }
            var html = '', keluarCount = 0;
            data.forEach(function(row) {
                if (row.type === 'keluar') keluarCount++;
                html += '<tr><td>' + row.tanggal + '</td><td style="font-weight:600;">' + row.kategori + '</td><td class="' + (row.type === 'masuk' ? 'nominal-plus' : 'nominal-minus') + '">' + row.nominal + '</td><td><span class="badge-status ' + (row.type === 'masuk' ? 'masuk' : 'keluar') + '">' + (row.type === 'masuk' ? 'Pemasukan' : 'Pengeluaran') + '</span></td></tr>';
            });
            tableBody.innerHTML = html;
            dataCount.textContent = keluarCount;
        }

        function filterData() {
            var q = searchInput.value.toLowerCase();
            var result = allData.filter(function(row) {
                return row.tanggal.toLowerCase().indexOf(q) > -1 || row.kategori.toLowerCase().indexOf(q) > -1 || row.nominal.indexOf(q) > -1 || (row.type === 'masuk' && 'pemasukan'.indexOf(q) > -1) || (row.type === 'keluar' && 'pengeluaran'.indexOf(q) > -1);
            });
            renderTable(result);
        }

        searchInput.addEventListener('input', filterData);
        filterBtns.forEach(function(btn) { btn.addEventListener('click', function() { filterBtns.forEach(function(b) { b.classList.remove('active'); }); this.classList.add('active'); filterData(); }); });
        document.querySelectorAll('.page-dot').forEach(function(dot) { dot.addEventListener('click', function() { document.querySelectorAll('.page-dot').forEach(function(d) { d.classList.remove('active'); }); this.classList.add('active'); }); });
        renderTable(allData);

        document.getElementById('saveModal').addEventListener('click', function(e) { if (e.target === this) closeSaveModal(); });
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeSaveModal(); });

        window.openSaveModal = function() { document.getElementById('saveModal').classList.add('active'); };
        window.closeSaveModal = function() { document.getElementById('saveModal').classList.remove('active'); };
        window.downloadLaporan = function() {
            var namaFile = document.getElementById('fileNameInput').value || 'Data-laporan-keuangan-2026';
            var format = document.getElementById('fileFormat').value;
            alert('Laporan "' + namaFile + '.' + format.toLowerCase() + '" berhasil di-generate (simulasi).');
            closeSaveModal();
        };
    })();
</script>
@endsection

@push('modals')
<div id="saveModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-title">Save Laporan</div>
        <div class="form-group">
            <label>Nama file yang akan disimpan</label>
            <input type="text" id="fileNameInput" value="Data-laporan-keuangan-2026">
        </div>
        <div class="form-group">
            <label>Format File</label>
            <select id="fileFormat">
                <option value="PDF">PDF</option>
                <option value="Excel">Excel</option>
                <option value="CSV">CSV</option>
            </select>
        </div>
        <div class="modal-actions">
            <button class="btn-batal" onclick="closeSaveModal()">Batal</button>
            <button class="btn-download" onclick="downloadLaporan()">Download</button>
        </div>
    </div>
</div>
@endpush
