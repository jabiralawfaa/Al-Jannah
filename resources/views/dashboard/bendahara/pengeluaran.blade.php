@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Dashboard', 'url' => '/bendahara', 'active' => 'bendahara'],
        ['label' => 'Catat Transaksi', 'url' => '/bendahara/catat-transaksi', 'active' => 'bendahara/catat-transaksi'],
        ['label' => 'Iuran Anggota', 'url' => '/bendahara/iuran', 'active' => 'bendahara/iuran'],
        ['label' => 'Laporan Keuangan', 'url' => '/bendahara/laporan', 'active' => 'bendahara/laporan'],
        ['label' => 'Verifikasi Pendaftaran', 'url' => '/bendahara/verifikasi', 'active' => 'bendahara/verifikasi'],
    ]
])

@section('title', 'Catat Pengeluaran')

@section('content')
<div class="page-pengeluaran">
<script>window._targetTable = 'pengeluaran'; window._kategoriOptions = @json($kategoriList->pluck('nama'));</script>
<div class="page-header">
    <h1>Catat Pengeluaran</h1>
    <p class="subtitle">Form pencatatan pengeluaran keuangan RKM Al-Jannah</p>
</div>

<div id="toastSuccess" class="toast-success">
    <span class="material-icons">check_circle</span>
    Permintaan akses edit berhasil dikirim ke ketua
</div>

<div class="form-card">
    <form>
        <div class="form-row">
            <div class="form-group">
                <label>Tanggal keluar</label>
                <input type="date" id="tanggalPengeluaran" placeholder="DD/MM/YYYY">
            </div>
            <div class="form-group">
                <label>Jenis pengeluaran</label>
                <div class="select-wrap">
                    <select id="jenisPengeluaran">
                        <option value="">Pilih salah satu</option>
                        @foreach($kategoriList as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                    <span class="material-icons dropdown-icon">expand_more</span>
                </div>
            </div>
            <div class="form-group">
                <label>Nominal</label>
                <div class="input-prefix">
                    <span class="prefix">Rp</span>
                    <input type="text" id="nominalPengeluaran" placeholder="">
                    <span class="suffix">.00</span>
                </div>
            </div>
        </div>

        <div class="form-row-2">
            <div class="form-group">
                <label>Keterangan</label>
                <textarea id="keteranganPengeluaran" placeholder="Tulis keterangan pengeluaran..."></textarea>
            </div>
            <div class="form-group">
                <label>Upload Bukti Transaksi</label>
                <div class="file-upload" onclick="this.querySelector('input').click();">
                    <input type="file" required onchange="this.parentElement.querySelector('.upload-placeholder').textContent = this.files[0].name;">
                    <span class="upload-placeholder">Upload here...</span>
                    <div class="upload-icon">
                        <span class="material-icons">cloud_upload</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="btn-row">
            <button type="button" class="btn-primary" onclick="catatPengeluaran()" data-loading>
                <span class="material-icons">print</span>
                Catat dan Cetak Kwitansi
            </button>
        </div>
    </form>
</div>

<h2 class="section-title">Riwayat Pengeluaran</h2>

<div class="table-card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Jenis Pengeluaran</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="riwayatPengeluaranBody">
                @forelse($pengeluaran as $item)
                <tr data-jumlah="{{ $item->jumlah }}" data-kategori="{{ $item->kategoriPengeluaran?->nama ?? '-' }}" data-keterangan="{{ $item->keterangan ?? '' }}">
                    <td data-target-id="{{ $item->id }}">{{ $item->created_at->format('d/m/Y') }}</td>
                    <td class="nominal-value">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    <td class="name-cell">{{ $item->kategoriPengeluaran?->nama ?? '-' }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                    <td>
                        <button class="btn-edit-disabled" onclick="openModal(this)">
                            <span class="material-icons">lock</span>
                            Edit
                        </button>
                    </td>
                </tr>
                @empty
                <tr id="emptyRowPengeluaran">
                    <td colspan="5" style="padding:60px 32px;text-align:center;color:#9ca3af;">
                        <span class="material-icons" style="font-size:40px;display:block;margin-bottom:8px;color:#d1d5db;">receipt_long</span>
                        Belum ada data pengeluaran
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</div>

<script>
    function catatPengeluaran() {
        var btn = window._loadingBtn;
        var formData = new FormData();
        formData.append('tanggal', document.getElementById('tanggalPengeluaran').value);
        formData.append('kategori_pengeluaran_id', document.getElementById('jenisPengeluaran').value);
        formData.append('jumlah', document.getElementById('nominalPengeluaran').value.replace(/[^0-9]/g, ''));
        formData.append('keterangan', document.getElementById('keteranganPengeluaran').value);
        var fileInput = document.querySelector('#keteranganPengeluaran').closest('.form-row-2').querySelector('.file-upload input[type=file]');
        if (!fileInput || !fileInput.files[0]) { enableBtn(btn); alert('Harap upload bukti transaksi.'); return; }
        formData.append('file_bukti', fileInput.files[0]);

        fetchAPI('/bendahara/pengeluaran', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: formData
        })
        .then(function(res) {
            if (!res.success) { enableBtn(btn); return alert(res.message || 'Gagal menyimpan data'); }
            var d = res.data;
            var emptyRow = document.getElementById('emptyRowPengeluaran');
            if (emptyRow) emptyRow.remove();
            var tbody = document.getElementById('riwayatPengeluaranBody');
            var row = document.createElement('tr');
            row.innerHTML = '<tr data-jumlah="' + d.jumlah + '" data-kategori="' + (d.kategori || '') + '" data-keterangan="' + (d.keterangan || '') + '"><td data-target-id="' + d.id + '">' + d.tanggal + '</td><td class="nominal-value">Rp ' + Number(d.jumlah).toLocaleString('id-ID') + '</td><td class="name-cell">' + d.kategori + '</td><td>' + (d.keterangan || '-') + '</td><td><button class="btn-edit-disabled" onclick="openModal(this)"><span class="material-icons">lock</span> Edit</button></td></tr>';
            tbody.appendChild(row);
            document.getElementById('tanggalPengeluaran').value = '';
            document.getElementById('jenisPengeluaran').value = '';
            document.getElementById('nominalPengeluaran').value = '';
            document.getElementById('keteranganPengeluaran').value = '';
            var upl = document.querySelector('.file-upload .upload-placeholder');
            if (upl) upl.textContent = 'Upload here...';
            enableBtn(btn);
        })
        .catch(function(e) { console.error(e); alert('Gagal: ' + e.message); enableBtn(btn); });
    }
</script>
@endsection

@push('modals')
<div id="modalEdit" class="modal-overlay">
    <div class="modal-bg"></div>
    <div class="modal-box">
        <div class="modal-icon">
            <span class="material-icons">lock_outline</span>
        </div>
        <h3>Meminta akses edit ke ketua</h3>
        <p>Anda akan mengirimkan permintaan akses untuk mengedit data pengeluaran ini. Ketua akan menyetujui permintaan Anda.</p>
        <input type="hidden" id="modalTargetTable" value="">
        <input type="hidden" id="modalTargetId" value="">
        <div class="form-group" style="margin-bottom:12px;">
            <label>Kolom yang ingin diubah</label>
            <select id="modalFieldName" style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:13px;font-family:'Poppins',sans-serif;outline:none;box-sizing:border-box;background:#fff;appearance:auto;">
                <option value="">Pilih kolom</option>
                <option value="nominal">Nominal</option>
                <option value="kategori">Jenis Pengeluaran</option>
                <option value="keterangan">Keterangan</option>
            </select>
        </div>
        <div class="form-row" style="display:flex;gap:12px;margin-bottom:12px;">
            <div class="form-group" style="flex:1;">
                <label>Nilai Lama</label>
                <input type="text" id="modalOldValue" placeholder="Nilai sebelum diubah" readonly style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:13px;font-family:'Poppins',sans-serif;outline:none;box-sizing:border-box;background:#f3f4f6;cursor:not-allowed;">
            </div>
            <div class="form-group" style="flex:1;">
                <label>Nilai Baru</label>
                <input type="text" id="modalNewValue" placeholder="Nilai setelah diubah" style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:13px;font-family:'Poppins',sans-serif;outline:none;box-sizing:border-box;">
                <select id="modalNewKategori" style="display:none;width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:13px;font-family:'Poppins',sans-serif;outline:none;box-sizing:border-box;background:#fff;appearance:auto;">
                    <option value="">Pilih kategori</option>
                </select>
            </div>
        </div>
        <div class="form-group" style="margin-bottom:18px;">
            <label>Alasan perubahan</label>
            <textarea id="modalAlasan" placeholder="Jelaskan alasan mengapa data ini perlu diubah..." style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:13px;font-family:'Poppins',sans-serif;outline:none;resize:vertical;min-height:80px;box-sizing:border-box;"></textarea>
        </div>
        <div class="modal-actions">
            <button class="btn-batal" onclick="closeModal()">Batal</button>
            <button class="btn-minta" onclick="requestAccess()" data-loading>Kirim Permintaan</button>
        </div>
    </div>
</div>
@endpush
