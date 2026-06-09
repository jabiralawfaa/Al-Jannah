@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Dashboard', 'url' => '/bendahara', 'active' => 'bendahara'],
        ['label' => 'Catat Transaksi', 'url' => '/bendahara/catat-transaksi', 'active' => 'bendahara/catat-transaksi'],
        ['label' => 'Iuran Anggota', 'url' => '/bendahara/iuran', 'active' => 'bendahara/iuran'],
        ['label' => 'Laporan Keuangan', 'url' => '/bendahara/laporan', 'active' => 'bendahara/laporan'],
        ['label' => 'Verifikasi Pendaftaran', 'url' => '/bendahara/verifikasi', 'active' => 'bendahara/verifikasi'],
    ]
])

@section('title', 'Catat Transaksi')

@section('content')
<div class="page-transaksi">
<script>
    window._targetTable = 'pemasukan';
@php
    $kPemasukanJson = $kategoriPemasukan->map(fn($k) => ['id' => $k->id, 'nama' => $k->nama])->toJson();
    $kPengeluaranJson = $kategoriPengeluaran->map(fn($k) => ['id' => $k->id, 'nama' => $k->nama])->toJson();
@endphp
    window._kategoriPemasukan = {!! $kPemasukanJson !!};
    window._kategoriPengeluaran = {!! $kPengeluaranJson !!};
</script>
<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
    <div>
        <h1>Catat Transaksi</h1>
        <p class="subtitle">Pencatatan transaksi keuangan RKM Al-Jannah</p>
    </div>
    <button class="btn-primary" onclick="openModalTransaksi()" style="display:inline-flex;align-items:center;gap:6px;">
        <span class="material-icons" style="font-size:18px;">add</span>
        Tambah Transaksi
    </button>
</div>

<div id="toastSuccess" class="toast-success">
    <span class="material-icons">check_circle</span>
    Transaksi berhasil dicatat
</div>

<div class="table-card" style="margin-top:24px;">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Tipe</th>
                    <th>Nominal</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody id="riwayatTransaksiBody">
                @forelse($transaksi as $item)
                <tr>
                    <td>{{ $item['tanggal'] }}</td>
                    <td><span style="display:inline-block;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:600;{{ $item['tipe'] === 'Pemasukan' ? 'background:#d1fae5;color:#065f46;' : 'background:#fee2e2;color:#991b1b;' }}">{{ $item['tipe'] }}</span></td>
                    <td class="nominal-value">Rp {{ number_format($item['jumlah'], 0, ',', '.') }}</td>
                    <td class="name-cell">{{ $item['kategori'] }}</td>
                    <td>{{ $item['keterangan'] ?? '-' }}</td>
                </tr>
                @empty
                <tr id="emptyRowTransaksi">
                    <td colspan="5" style="padding:60px 32px;text-align:center;color:#9ca3af;">
                        <span class="material-icons" style="font-size:40px;display:block;margin-bottom:8px;color:#d1d5db;">receipt_long</span>
                        Belum ada transaksi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:16px 24px;">
        {{ $transaksi->links() }}
    </div>
</div>

</div>

<script>
    function openModalTransaksi() {
        document.getElementById('modalTransaksi').classList.add('active');
        document.getElementById('formTipe').value = 'pemasukan';
        document.getElementById('formTanggal').value = '';
        document.getElementById('formKategori').innerHTML = '<option value="">Pilih kategori</option>';
        document.getElementById('formNominal').value = '';
        document.getElementById('formKeterangan').value = '';
        document.querySelector('#modalTransaksi .upload-placeholder').textContent = 'Upload here...';
        toggleKategori('pemasukan');
    }

    function closeModalTransaksi() {
        document.getElementById('modalTransaksi').classList.remove('active');
    }

    function toggleKategori(tipe) {
        var sel = document.getElementById('formKategori');
        var opts = tipe === 'pemasukan' ? (window._kategoriPemasukan || []) : (window._kategoriPengeluaran || []);
        sel.innerHTML = '<option value="">Pilih kategori</option>';
        for (var i = 0; i < opts.length; i++) {
            sel.innerHTML += '<option value="' + opts[i].id + '">' + opts[i].nama + '</option>';
        }
    }

    document.addEventListener('change', function(e) {
        if (e.target.id === 'formTipe') toggleKategori(e.target.value);
    });

    function simpanTransaksi() {
        var tipe = document.getElementById('formTipe').value;
        var tanggal = document.getElementById('formTanggal').value;
        var kategori = document.getElementById('formKategori').value;
        var nominal = document.getElementById('formNominal').value;
        var keterangan = document.getElementById('formKeterangan').value;
        var file = document.querySelector('#modalTransaksi .file-upload input[type=file]');

        if (!tanggal || !kategori || !nominal) { alert('Harap isi tanggal, kategori, dan nominal.'); return; }

        var formData = new FormData();
        formData.append('tipe', tipe);
        formData.append('tanggal', tanggal);
        formData.append('kategori_id', kategori);
        formData.append('jumlah', nominal.replace(/[^0-9]/g, ''));
        formData.append('keterangan', keterangan);
        if (file && file.files[0]) formData.append('file_bukti', file.files[0]);

        fetch('/bendahara/catat-transaksi', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: formData
        })
        .then(function(r) { return r.json(); })
        .then(function(res) {
            closeModalTransaksi();
            if (!res.success) return alert(res.message || 'Gagal menyimpan');
            var d = res.data;
            var emptyRow = document.getElementById('emptyRowTransaksi');
            if (emptyRow) emptyRow.remove();
            var tbody = document.getElementById('riwayatTransaksiBody');
            var row = document.createElement('tr');
            var tipeClass = d.tipe === 'Pemasukan' ? 'background:#d1fae5;color:#065f46;' : 'background:#fee2e2;color:#991b1b;';
            row.innerHTML = '<td>' + d.tanggal + '</td><td><span style="display:inline-block;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:600;' + tipeClass + '">' + d.tipe + '</span></td><td class="nominal-value">Rp ' + Number(d.jumlah).toLocaleString('id-ID') + '</td><td class="name-cell">' + d.kategori + '</td><td>' + (d.keterangan || '-') + '</td>';
            tbody.insertBefore(row, tbody.firstChild);
            document.getElementById('toastSuccess').style.display = 'flex';
            setTimeout(function() { document.getElementById('toastSuccess').style.display = 'none'; }, 3500);
        })
        .catch(function() { alert('Terjadi kesalahan'); });
    }
</script>
@endsection

@push('modals')
<div id="modalTransaksi" class="modal-overlay">
    <div class="modal-bg"></div>
    <div class="modal-box" style="max-width:520px;">
        <div class="modal-icon">
            <span class="material-icons">receipt_long</span>
        </div>
        <h3>Tambah Transaksi Baru</h3>
        <div class="form-group" style="margin-bottom:12px;">
            <label>Tipe Transaksi</label>
            <select id="formTipe" style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:13px;font-family:'Poppins',sans-serif;outline:none;box-sizing:border-box;background:#fff;appearance:auto;">
                <option value="pemasukan">Pemasukan</option>
                <option value="pengeluaran">Pengeluaran</option>
            </select>
        </div>
        <div class="form-group" style="margin-bottom:12px;">
            <label>Tanggal</label>
            <input type="date" id="formTanggal" style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:13px;font-family:'Poppins',sans-serif;outline:none;box-sizing:border-box;">
        </div>
        <div class="form-group" style="margin-bottom:12px;">
            <label>Kategori</label>
            <div class="select-wrap">
                <select id="formKategori" style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:13px;font-family:'Poppins',sans-serif;outline:none;box-sizing:border-box;background:#fff;appearance:auto;">
                    <option value="">Pilih kategori</option>
                </select>
                <span class="material-icons dropdown-icon">expand_more</span>
            </div>
        </div>
        <div class="form-group" style="margin-bottom:12px;">
            <label>Nominal</label>
            <div class="input-prefix">
                <span class="prefix">Rp</span>
                <input type="text" id="formNominal" placeholder="" style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:13px;font-family:'Poppins',sans-serif;outline:none;box-sizing:border-box;">
                <span class="suffix">.00</span>
            </div>
        </div>
        <div class="form-group" style="margin-bottom:12px;">
            <label>Keterangan</label>
            <textarea id="formKeterangan" placeholder="Tulis keterangan transaksi..." style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:13px;font-family:'Poppins',sans-serif;outline:none;resize:vertical;min-height:80px;box-sizing:border-box;"></textarea>
        </div>
        <div class="form-group" style="margin-bottom:18px;">
            <label>Upload Bukti Transaksi</label>
            <div class="file-upload" onclick="this.querySelector('input').click();" style="width:100%;padding:12px 16px;border:1px dashed #d1d5db;border-radius:8px;text-align:center;cursor:pointer;box-sizing:border-box;">
                <input type="file" onchange="this.parentElement.querySelector('.upload-placeholder').textContent = this.files[0].name;" style="display:none;">
                <span class="upload-placeholder" style="font-size:13px;color:#9ca3af;">Upload here...</span>
                <div class="upload-icon">
                    <span class="material-icons" style="font-size:18px;vertical-align:middle;color:#6b7280;">cloud_upload</span>
                </div>
            </div>
        </div>
        <div class="modal-actions">
            <button class="btn-batal" onclick="closeModalTransaksi()">Batal</button>
            <button class="btn-minta" onclick="simpanTransaksi()">Simpan</button>
        </div>
    </div>
</div>
@endpush
