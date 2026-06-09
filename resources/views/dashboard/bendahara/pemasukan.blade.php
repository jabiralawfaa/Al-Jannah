@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Dashboard', 'url' => '/bendahara', 'active' => 'bendahara'],
        ['label' => 'Catat Transaksi', 'url' => '/bendahara/catat-transaksi', 'active' => 'bendahara/catat-transaksi'],
        ['label' => 'Iuran Anggota', 'url' => '/bendahara/iuran', 'active' => 'bendahara/iuran'],
        ['label' => 'Laporan Keuangan', 'url' => '/bendahara/laporan', 'active' => 'bendahara/laporan'],
        ['label' => 'Verifikasi Pendaftaran', 'url' => '/bendahara/verifikasi', 'active' => 'bendahara/verifikasi'],
    ]
])

@section('title', 'Catat Pemasukan')

@section('content')
<div class="page-pemasukan">
<script>window._targetTable = 'pemasukan'; window._kategoriOptions = @json($kategoriList->pluck('nama'));</script>
<div class="page-header">
    <h1>Catat Pemasukan</h1>
    <p class="subtitle">Form pencatatan pemasukan keuangan RKM Al-Jannah</p>
</div>

<div id="toastSuccess" class="toast-success">
    <span class="material-icons">check_circle</span>
    Permintaan akses edit berhasil dikirim ke ketua
</div>

<div class="form-card">
    <form>
        <div class="form-row">
            <div class="form-group">
                <label>Tanggal masuk</label>
                <input type="date" id="tanggalPemasukan" placeholder="DD/MM/YYYY">
            </div>
            <div class="form-group">
                <label>Jenis pemasukan</label>
                <div class="select-wrap">
                    <select id="jenisPemasukan">
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
                    <input type="text" id="nominalPemasukan" placeholder="">
                    <span class="suffix">.00</span>
                </div>
            </div>
        </div>

        <div class="form-row-2">
            <div class="form-group">
                <label>Keterangan</label>
                <textarea id="keteranganPemasukan" placeholder="Tulis keterangan pemasukan..."></textarea>
            </div>
            <div class="form-group">
                <label>Upload Bukti Transaksi</label>
                <div class="file-upload" onclick="this.querySelector('input').click();">
                    <input type="file" onchange="this.parentElement.querySelector('.upload-placeholder').textContent = this.files[0].name;">
                    <span class="upload-placeholder">Upload here...</span>
                    <div class="upload-icon">
                        <span class="material-icons">cloud_upload</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="btn-row">
            <button type="button" class="btn-primary" onclick="catatPemasukan()">
                <span class="material-icons">print</span>
                Catat dan Cetak Kwitansi
            </button>
        </div>
    </form>
</div>

<h2 class="section-title">Riwayat Pemasukan</h2>

<div class="table-card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                    <th>Jenis Pemasukan</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="riwayatPemasukanBody">
                @forelse($pemasukan as $item)
                <tr data-jumlah="{{ $item->jumlah }}" data-kategori="{{ $item->kategoriPemasukan?->nama ?? '-' }}" data-keterangan="{{ $item->keterangan ?? '' }}">
                    <td data-target-id="{{ $item->id }}">{{ $item->created_at->format('d/m/Y') }}</td>
                    <td class="nominal-value">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    <td class="name-cell">{{ $item->kategoriPemasukan?->nama ?? '-' }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                    <td>
                        <button class="btn-edit-disabled" onclick="openModal(this)">
                            <span class="material-icons">lock</span>
                            Edit
                        </button>
                    </td>
                </tr>
                @empty
                <tr id="emptyRowPemasukan">
                    <td colspan="5" style="padding:60px 32px;text-align:center;color:#9ca3af;">
                        <span class="material-icons" style="font-size:40px;display:block;margin-bottom:8px;color:#d1d5db;">receipt_long</span>
                        Belum ada data pemasukan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</div>

<script>
    function catatPemasukan() {
        var formData = new FormData();
        formData.append('tanggal', document.getElementById('tanggalPemasukan').value);
        formData.append('kategori_pemasukan_id', document.getElementById('jenisPemasukan').value);
        formData.append('jumlah', document.getElementById('nominalPemasukan').value.replace(/[^0-9]/g, ''));
        formData.append('keterangan', document.getElementById('keteranganPemasukan').value);
        var fileInput = document.querySelector('#keteranganPemasukan').closest('.form-row-2').querySelector('.file-upload input[type=file]');
        if (fileInput && fileInput.files[0]) formData.append('file_bukti', fileInput.files[0]);

        fetch('/bendahara/pemasukan', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: formData
        })
        .then(function(r) { return r.json(); })
        .then(function(res) {
            if (!res.success) return alert('Gagal menyimpan data');
            var d = res.data;
            var emptyRow = document.getElementById('emptyRowPemasukan');
            if (emptyRow) emptyRow.remove();
            var tbody = document.getElementById('riwayatPemasukanBody');
            var row = document.createElement('tr');
            row.innerHTML = '<tr data-jumlah="' + d.jumlah + '" data-kategori="' + (d.kategori || '') + '" data-keterangan="' + (d.keterangan || '') + '"><td data-target-id="' + d.id + '">' + d.tanggal + '</td><td class="nominal-value">Rp ' + Number(d.jumlah).toLocaleString('id-ID') + '</td><td class="name-cell">' + d.kategori + '</td><td>' + (d.keterangan || '-') + '</td><td><button class="btn-edit-disabled" onclick="openModal(this)"><span class="material-icons">lock</span> Edit</button></td></tr>';
            tbody.appendChild(row);
            document.getElementById('tanggalPemasukan').value = '';
            document.getElementById('jenisPemasukan').value = '';
            document.getElementById('nominalPemasukan').value = '';
            document.getElementById('keteranganPemasukan').value = '';
            var upl = document.querySelector('.file-upload .upload-placeholder');
            if (upl) upl.textContent = 'Upload here...';
        })
        .catch(function() { alert('Terjadi kesalahan'); });
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
        <p>Anda akan mengirimkan permintaan akses untuk mengedit data pemasukan ini. Ketua akan menyetujui permintaan Anda.</p>
        <input type="hidden" id="modalTargetTable" value="">
        <input type="hidden" id="modalTargetId" value="">
        <div class="form-group" style="margin-bottom:12px;">
            <label>Kolom yang ingin diubah</label>
            <select id="modalFieldName" style="width:100%;padding:10px 14px;border:1px solid #d1d5db;border-radius:8px;font-size:13px;font-family:'Poppins',sans-serif;outline:none;box-sizing:border-box;background:#fff;appearance:auto;">
                <option value="">Pilih kolom</option>
                <option value="nominal">Nominal</option>
                <option value="kategori">Jenis Pemasukan</option>
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
            <button class="btn-minta" onclick="requestAccess()">Kirim Permintaan</button>
        </div>
    </div>
</div>
@endpush
