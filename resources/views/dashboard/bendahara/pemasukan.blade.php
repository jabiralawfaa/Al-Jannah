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

@section('title', 'Catat Pemasukan')

@section('content')
<div class="page-pemasukan">
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
                        <option value="Iuran Anggota">Iuran Anggota</option>
                        <option value="Infaq/Amal">Infaq/Amal</option>
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
                <tr>
                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
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
    function catatPemasukan() { _catat('Pemasukan', 'emptyRowPemasukan', 'riwayatPemasukanBody'); }
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
        <div class="modal-actions">
            <button class="btn-batal" onclick="closeModal()">Batal</button>
            <button class="btn-minta" onclick="requestAccess()">Minta</button>
        </div>
    </div>
</div>
@endpush
