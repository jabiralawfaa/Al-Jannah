@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Dashboard', 'url' => '/bendahara', 'active' => 'bendahara'],
        ['label' => 'Catat Transaksi', 'url' => '/bendahara/catat-transaksi', 'active' => 'bendahara/catat-transaksi'],
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
        <div style="display:flex;align-items:center;gap:16px;">
            <button class="btn-primary" onclick="openCariIuranModal()" style="display:inline-flex;align-items:center;gap:6px;padding:10px 20px;font-size:13px;">
                <span class="material-icons" style="font-size:18px;">add</span>
                Tambah Iuran
            </button>
            <div class="year-selector">
                <label>Pilih Tahun</label>
                <select>
                    <option selected>2026</option>
                    <option>2025</option>
                    <option>2024</option>
                </select>
            </div>
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

<!-- Modal Cari Anggota + Tambah Iuran -->
<div id="modalCariIuran" class="modal-overlay">
    <div class="modal-bg" onclick="closeCariIuranModal()"></div>
    <div class="modal-box">
        <div class="modal-icon">
            <span class="material-icons">person_search</span>
        </div>
        <h3>Tambah Iuran Anggota</h3>

        <div class="form-group">
            <label>No Anggota</label>
            <input type="text" id="cariNoAnggota" list="daftarAnggota" placeholder="Ketik nomor atau nama anggota..." autocomplete="off" class="form-input">
            <datalist id="daftarAnggota"></datalist>
        </div>

        <div id="hasilCariAnggota" style="display:none;padding:12px 16px;background:#f0f7f4;border-radius:10px;margin-bottom:16px;">
            <div style="font-size:12px;color:#6b7280;">Nama Anggota</div>
            <div id="cariNamaAnggota" style="font-size:16px;font-weight:700;color:#1f2937;"></div>
        </div>

        <hr style="border:none;border-top:1px solid #e5e7eb;margin:16px 0;">

        <div class="form-group">
            <label>Bulan Mulai</label>
            <select id="cariBulanMulai" class="form-select">
                <option value="0">Januari</option>
                <option value="1">Februari</option>
                <option value="2">Maret</option>
                <option value="3">April</option>
                <option value="4">Mei</option>
                <option value="5">Juni</option>
                <option value="6">Juli</option>
                <option value="7">Agustus</option>
                <option value="8">September</option>
                <option value="9">Oktober</option>
                <option value="10">November</option>
                <option value="11">Desember</option>
            </select>
        </div>

        <div class="form-group">
            <label>Nominal Pembayaran</label>
            <div class="nominal-row">
                <div class="nominal-input-wrap">
                    <span class="nominal-prefix">Rp</span>
                    <input type="text" id="cariNominal" value="10.000">
                </div>
                <div class="month-control">
                    <button type="button" class="month-btn" onclick="decrCariBulan()">−</button>
                    <span class="month-qty" id="cariMonthCount">1 Bulan</span>
                    <button type="button" class="month-btn" onclick="incrCariBulan()">+</button>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Keterangan</label>
            <textarea id="cariKeterangan" placeholder="Tulis keterangan disini..."></textarea>
        </div>

        <div class="form-group">
            <label>Upload Bukti Pembayaran</label>
            <div class="file-upload-custom" onclick="document.getElementById('cariFileInput').click()">
                <span class="upload-placeholder" id="cariFileLabel">Upload here...</span>
                <input type="file" id="cariFileInput" required onchange="document.getElementById('cariFileLabel').textContent = this.files[0].name">
                <div class="upload-icon-box">
                    <span class="material-icons">cloud_upload</span>
                </div>
            </div>
        </div>

        <div class="modal-actions">
            <button class="btn-batal" onclick="closeCariIuranModal()">Batal</button>
            <button class="btn-minta" onclick="submitCariIuran()">Simpan</button>
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
                <input type="file" id="fileInput" required onchange="document.getElementById('fileLabel').textContent = this.files[0].name">
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
    var members = [];
    var selectedMi = -1, selectedBi = -1, monthQty = 1, nominalPerMonth = 10000;
    var currentYear = {{ date('Y') }};

    function fetchIuranData(tahun) {
        fetch('/bendahara/iuran/data?tahun=' + (tahun || currentYear))
            .then(function(r) { return r.json(); })
            .then(function(res) {
                members = res.anggota.map(function(a, i) {
                    return {
                        no: i + 1,
                        id: a.id,
                        noAnggota: a.nomor_anggota,
                        nama: a.nama,
                        telpon: a.telepon,
                        bulan: a.bulan.map(function(b) {
                            return { status: b.status === 'lunas' ? 'paid' : 'unpaid', date: b.tanggal_bayar || '' };
                        })
                    };
                });
                renderIuranTable();
            });
    }

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
        if (!members.length) {
            html = '<tr><td colspan="15" style="padding:60px 32px;text-align:center;color:#9ca3af;">Belum ada data anggota</td></tr>';
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

        var formData = new FormData();
        formData.append('anggota_id', member.id);
        formData.append('tahun', currentYear);
        formData.append('bulan_mulai', selectedBi + 1);
        formData.append('jumlah_bulan', monthQty);
        formData.append('nominal', nominalPerMonth);
        formData.append('keterangan', document.getElementById('modalKeterangan').value);
        var fi = document.getElementById('fileInput');
        if (!fi || !fi.files[0]) { alert('Harap upload bukti pembayaran.'); return; }
        formData.append('file_bukti', fi.files[0]);

        fetch('/bendahara/iuran', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: formData
        })
        .then(function(r) { return r.json(); })
        .then(function(res) {
            if (!res.success) return alert('Gagal menyimpan iuran');
            for (var b = selectedBi; b <= bulanAkhir; b++) {
                member.bulan[b].status = 'paid';
                if (!member.bulan[b].date) member.bulan[b].date = today();
            }
            closeIuranModal();
            renderIuranTable();
            showToast(document.getElementById('toastMsg'), 'Pembayaran ' + member.nama + ' untuk ' + rangeLabel + ' (' + monthQty + ' bln) berhasil dicatat');
        })
        .catch(function() { alert('Terjadi kesalahan'); });
    }

    /* Modal Cari Anggota + Tambah Iuran */
    var cariMemberIdx = -1;
    var cariMonthQty = 1;
    var cariNominalPerMonth = 10000;

    function buildDaftarAnggota() {
        var dl = document.getElementById('daftarAnggota');
        dl.innerHTML = '';
        for (var i = 0; i < members.length; i++) {
            var opt = document.createElement('option');
            opt.value = members[i].noAnggota + ' — ' + members[i].nama;
            dl.appendChild(opt);
        }
    }

    function openCariIuranModal() {
        cariMemberIdx = -1;
        cariMonthQty = 1;
        buildDaftarAnggota();
        document.getElementById('cariNoAnggota').value = '';
        document.getElementById('hasilCariAnggota').style.display = 'none';
        document.getElementById('cariNamaAnggota').textContent = '';
        document.getElementById('cariBulanMulai').value = '0';
        document.getElementById('cariNominal').value = '10.000';
        document.getElementById('cariMonthCount').textContent = '1 Bulan';
        document.getElementById('cariKeterangan').value = '';
        document.getElementById('cariFileLabel').textContent = 'Upload here...';
        document.getElementById('modalCariIuran').classList.add('active');
        setTimeout(function() { document.getElementById('cariNoAnggota').focus(); }, 100);
    }
    function closeCariIuranModal() { document.getElementById('modalCariIuran').classList.remove('active'); }

    document.getElementById('cariNoAnggota').addEventListener('input', function() {
        var val = this.value.trim();
        if (!val) { document.getElementById('hasilCariAnggota').style.display = 'none'; cariMemberIdx = -1; return; }
        var noAnggota = val.split(' — ')[0];
        var idx = -1;
        for (var i = 0; i < members.length; i++) {
            if (members[i].noAnggota === noAnggota) { idx = i; break; }
        }
        if (idx >= 0) {
            cariMemberIdx = idx;
            document.getElementById('cariNamaAnggota').textContent = members[idx].nama;
            document.getElementById('hasilCariAnggota').style.display = 'block';
        } else {
            document.getElementById('hasilCariAnggota').style.display = 'none';
            cariMemberIdx = -1;
        }
    });

    function decrCariBulan() { if (cariMonthQty > 1) { cariMonthQty--; updateCariNominal(); } }
    function incrCariBulan() { if (cariMonthQty < 12) { cariMonthQty++; updateCariNominal(); } }
    function updateCariNominal() {
        document.getElementById('cariNominal').value = formatNominal(cariNominalPerMonth * cariMonthQty);
        document.getElementById('cariMonthCount').textContent = cariMonthQty + ' Bulan';
    }

    function submitCariIuran() {
        if (cariMemberIdx < 0) { alert('Cari anggota terlebih dahulu.'); return; }
        var member = members[cariMemberIdx];
        var bulanMulai = parseInt(document.getElementById('cariBulanMulai').value);
        var bulanAkhir = Math.min(bulanMulai + cariMonthQty - 1, 11);
        var rangeLabel = bulanListIuran[bulanMulai] + (cariMonthQty > 1 ? '-' + bulanListIuran[bulanAkhir] : '');

        var formData = new FormData();
        formData.append('anggota_id', member.id);
        formData.append('tahun', currentYear);
        formData.append('bulan_mulai', bulanMulai + 1);
        formData.append('jumlah_bulan', cariMonthQty);
        formData.append('nominal', cariNominalPerMonth);
        formData.append('keterangan', document.getElementById('cariKeterangan').value);
        var fi = document.getElementById('cariFileInput');
        if (!fi || !fi.files[0]) { alert('Harap upload bukti pembayaran.'); return; }
        formData.append('file_bukti', fi.files[0]);

        fetch('/bendahara/iuran', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: formData
        })
        .then(function(r) { return r.json(); })
        .then(function(res) {
            if (!res.success) return alert('Gagal menyimpan iuran');
            for (var b = bulanMulai; b <= bulanAkhir; b++) {
                member.bulan[b].status = 'paid';
                if (!member.bulan[b].date) member.bulan[b].date = today();
            }
            closeCariIuranModal();
            renderIuranTable();
            showToast(document.getElementById('toastMsg'), 'Pembayaran ' + member.nama + ' untuk ' + rangeLabel + ' (' + cariMonthQty + ' bln) berhasil dicatat');
        })
        .catch(function() { alert('Terjadi kesalahan'); });
    }

    document.querySelector('.year-selector select').addEventListener('change', function() {
        currentYear = parseInt(this.value);
        document.querySelector('.table-header-card h3').textContent = 'Tabel Iuran Tahunan RKM Al-Jannah - Tahun ' + currentYear;
        fetchIuranData(currentYear);
    });

    document.querySelector('.modal-bg-iuran').addEventListener('click', function() { closeIuranModal(); });
    document.addEventListener('keydown', function(e) { if (e.key === 'Escape') { closeIuranModal(); closeCariIuranModal(); } });
    fetchIuranData(currentYear);

    window.decrMonth = decrMonth;
    window.incrMonth = incrMonth;
    window.submitIuran = submitIuran;
    window.decrCariBulan = decrCariBulan;
    window.incrCariBulan = incrCariBulan;
    window.submitCariIuran = submitCariIuran;
</script>
@endsection
