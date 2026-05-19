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

@section('title', 'Iuran Anggota')

@section('content')
<div class="page-iuran">
    <div class="iuran-header">
        <div>
            <h1>Iuran Tahunan RKM Al-Jannah</h1>
            <p class="subtitle">Monitoring pembayaran iuran anggota</p>
        </div>
        <div class="year-selector">
            <label>Pilih Tahun</label>
            <select>
                <option selected>2026</option>
                <option>2025</option>
                <option>2024</option>
            </select>
        </div>
    </div>

    <div id="alertSuccess" class="alert-success" style="display:none;">
        <span class="material-icons">check_circle</span>
        <span id="alertMsg">Status pembayaran berhasil diperbarui</span>
    </div>

    <div id="toastNotif" class="toast-notif">
        <span class="material-icons">check_circle</span>
        <span id="toastMsg">Pembayaran berhasil dicatat</span>
    </div>

    <div class="table-header-card">
        <h3>Tabel Iuran Tahunan RKM Al-Jannah - Tahun 2026</h3>
    </div>

    <div class="table-card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Anggota</th>
                        <th>Nama Anggota</th>
                        @foreach(['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'] as $bln)
                        <th class="month-cell">{{ $bln }}</th>
                        @endforeach
                        <th>No Telpon</th>
                    </tr>
                </thead>
                <tbody id="iuranBody"></tbody>
            </table>
        </div>
    </div>
</div>

<div id="iuranModal">
    <div class="modal-bg-iuran"></div>
    <div class="modal-box">
        <div class="modal-title">
            Pendataan Iuran tahun 2026
            <button type="button" class="modal-close-iuran" onclick="closeIuranModal()">
                <span class="material-icons">close</span>
            </button>
        </div>

        <div class="form-group">
            <label>Atas Nama Anggota</label>
            <input type="text" id="modalNama" class="input-readonly" readonly>
        </div>

        <div class="form-group">
            <label>Nominal Pembayaran</label>
            <div class="nominal-row">
                <div class="nominal-input-wrap">
                    <span class="nominal-prefix">Rp</span>
                    <input type="text" id="modalNominal" value="10.000">
                </div>
                <div class="month-control">
                    <button type="button" class="month-btn" onclick="decrMonth()">−</button>
                    <span class="month-qty" id="monthCount">1 Bulan</span>
                    <button type="button" class="month-btn" onclick="incrMonth()">+</button>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <textarea id="modalKeterangan" placeholder="Tulis keterangan disini..."></textarea>
        </div>

        <div class="form-group">
            <label>Upload Bukti Pembayaran</label>
            <div class="file-upload-custom" onclick="document.getElementById('fileInput').click()">
                <span class="upload-placeholder" id="fileLabel">Upload here...</span>
                <input type="file" id="fileInput" onchange="document.getElementById('fileLabel').textContent = this.files[0].name">
                <div class="upload-icon-box">
                    <span class="material-icons">cloud_upload</span>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn-batal" onclick="closeIuranModal()">Batal</button>
            <button type="button" class="btn-catat" onclick="submitIuran()">Catat &amp; Cetak Kwitansi</button>
        </div>
    </div>
</div>

<script>
    var bulanListIuran = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
    var members = [
        { no:1,noAnggota:'RKM-001',nama:'Ahmad Fauzi',telpon:'081234567890',bulan:[
            {status:'paid',date:'02/01/2026'},{status:'paid',date:'03/02/2026'},{status:'paid',date:'05/03/2026'},{status:'paid',date:'01/04/2026'},
            {status:'unpaid',date:''},{status:'unpaid',date:''},{status:'unpaid',date:''},{status:'unpaid',date:''},
            {status:'unpaid',date:''},{status:'unpaid',date:''},{status:'unpaid',date:''},{status:'unpaid',date:''}]},
        { no:2,noAnggota:'RKM-003',nama:'Siti Nurhaliza',telpon:'082112233445',bulan:[
            {status:'paid',date:'10/01/2026'},{status:'paid',date:'12/02/2026'},{status:'unpaid',date:''},{status:'paid',date:'08/04/2026'},
            {status:'unpaid',date:''},{status:'unpaid',date:''},{status:'unpaid',date:''},{status:'unpaid',date:''},
            {status:'unpaid',date:''},{status:'unpaid',date:''},{status:'unpaid',date:''},{status:'unpaid',date:''}]},
        { no:3,noAnggota:'RKM-005',nama:'Bambang Suprapto',telpon:'085712345678',bulan:[
            {status:'paid',date:'15/01/2026'},{status:'paid',date:'14/02/2026'},{status:'paid',date:'12/03/2026'},{status:'paid',date:'11/04/2026'},
            {status:'paid',date:'10/05/2026'},{status:'paid',date:'09/06/2026'},{status:'unpaid',date:''},{status:'unpaid',date:''},
            {status:'unpaid',date:''},{status:'unpaid',date:''},{status:'unpaid',date:''},{status:'unpaid',date:''}]},
    ];
    var selectedMi = -1, selectedBi = -1, monthQty = 1, nominalPerMonth = 10000;

    function renderIuranTable() {
        var tbody = document.getElementById('iuranBody'), html = '';
        for (var i = 0; i < members.length; i++) {
            var m = members[i];
            html += '<tr><td>' + m.no + '</td><td>' + m.noAnggota + '</td><td class="name-cell">' + m.nama + '</td>';
            for (var b = 0; b < 12; b++) {
                var bln = m.bulan[b], isPaid = bln.status === 'paid';
                html += '<td class="month-cell"><span class="status-dot" data-mi="' + i + '" data-bi="' + b + '" data-paid="' + (isPaid ? '1' : '0') + '"><span class="dot ' + (isPaid ? 'paid' : 'unpaid') + '"></span>' + (bln.date ? '<span class="date-label">' + bln.date + '</span>' : '') + '</span></td>';
            }
            html += '<td><a href="tel:' + m.telpon + '" class="phone-link"><span class="material-icons" style="font-size:14px;">phone</span>' + m.telpon + '</a></td></tr>';
        }
        tbody.innerHTML = html;
        document.querySelectorAll('.status-dot').forEach(function(el) {
            el.addEventListener('click', function() {
                if (this.getAttribute('data-paid') === '1') return;
                openIuranModal(parseInt(this.getAttribute('data-mi')), parseInt(this.getAttribute('data-bi')));
            });
        });
    }

    function openIuranModal(mi, bi) {
        selectedMi = mi; selectedBi = bi; monthQty = 1;
        document.getElementById('modalNama').value = members[mi].nama;
        document.getElementById('modalNominal').value = '10.000';
        document.getElementById('monthCount').textContent = '1 Bulan';
        document.getElementById('modalKeterangan').value = '';
        document.getElementById('fileLabel').textContent = 'Upload here...';
        document.getElementById('iuranModal').classList.add('active');
    }
    function closeIuranModal() { document.getElementById('iuranModal').classList.remove('active'); }
    function decrMonth() { if (monthQty > 1) { monthQty--; updateNominal(); } }
    function incrMonth() { var maxQty = 12 - selectedBi; if (monthQty < maxQty) { monthQty++; updateNominal(); } }
    function updateNominal() { document.getElementById('modalNominal').value = formatNominal(nominalPerMonth * monthQty); document.getElementById('monthCount').textContent = monthQty + ' Bulan'; }
    function submitIuran() {
        var member = members[selectedMi];
        var bulanAkhir = Math.min(selectedBi + monthQty - 1, 11);
        var rangeLabel = bulanListIuran[selectedBi] + (monthQty > 1 ? '-' + bulanListIuran[bulanAkhir] : '');
        for (var b = selectedBi; b <= bulanAkhir; b++) {
            member.bulan[b].status = 'paid';
            if (!member.bulan[b].date) member.bulan[b].date = today();
        }
        closeIuranModal(); renderIuranTable();
        showToast(document.getElementById('toastMsg'), 'Pembayaran ' + member.nama + ' untuk ' + rangeLabel + ' (' + monthQty + ' bln) berhasil dicatat');
    }

    document.querySelector('.modal-bg-iuran').addEventListener('click', function() { closeIuranModal(); });
    document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeIuranModal(); });
    renderIuranTable();

    window.decrMonth = decrMonth;
    window.incrMonth = incrMonth;
    window.submitIuran = submitIuran;
</script>
@endsection
