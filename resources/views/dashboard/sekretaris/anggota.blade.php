@extends('layouts.dashboard')

@section('title', 'Kelola Anggota')

@php
    $menuItems = [
        [
            'label' => 'Beranda',
            'url' => route('sekretaris.dashboard'),
            'active' => 'sekretaris'
        ],
        [
            'label' => 'Kelola Anggota',
            'url' => route('sekretaris.anggota'),
            'active' => 'sekretaris/anggota*'
        ],
        [
            'label' => 'Log Aktivitas',
            'url' => route('sekretaris.log'),
            'active' => 'sekretaris/log*'
        ],
    ];
@endphp

@section('content')
<div style="background-color: #dcfce7; min-height: 100vh; margin: -30px; padding: 30px; font-family: 'Inter', 'Poppins', sans-serif;">
    <h1 style="color: var(--primary-900); font-weight: bold; margin-bottom: 20px; font-size: 24px;">Kelola Anggota</h1>

    <div class="card" style="border: none; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); padding: 0; overflow: hidden; border-radius: 12px; background-color: white;">
        <!-- Filter & Search Area -->
        <div style="padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; background-color: #f3f4f6; border-bottom: 1px solid #e5e7eb; flex-wrap: wrap; gap: 10px;">
            <form id="filterForm" method="GET" action="{{ route('sekretaris.anggota') }}" style="display: flex; gap: 8px; background-color: white; padding: 4px; border-radius: 10px; border: 1px solid #d1d5db;">
                <button type="submit" name="status" value="all" style="background-color: {{ $statusFilter === 'all' ? '#e5e7eb' : 'transparent' }}; padding: 6px 12px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; color: black; border: 1px solid {{ $statusFilter === 'all' ? '#9ca3af' : 'transparent' }};">Semua ({{ $totalAnggota }})</button>
                <button type="submit" name="status" value="aktif" style="background-color: {{ $statusFilter === 'aktif' ? '#e5e7eb' : 'transparent' }}; padding: 6px 12px; border-radius: 8px; font-weight: 500; font-size: 13px; cursor: pointer; color: #4b5563; border: 1px solid {{ $statusFilter === 'aktif' ? '#9ca3af' : 'transparent' }};">Aktif ({{ $anggotaAktif }})</button>
                <button type="submit" name="status" value="non_aktif" style="background-color: {{ $statusFilter === 'non_aktif' ? '#e5e7eb' : 'transparent' }}; padding: 6px 12px; border-radius: 8px; font-weight: 500; font-size: 13px; cursor: pointer; color: #4b5563; border: 1px solid {{ $statusFilter === 'non_aktif' ? '#9ca3af' : 'transparent' }};">Non-Aktif ({{ $anggotaNonAktif }})</button>
                <input type="hidden" name="search" value="{{ $search }}">
            </form>
            <form id="searchForm" method="GET" action="{{ route('sekretaris.anggota') }}" style="position: relative; width: 280px;">
                <span class="material-icons" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #4b5563; font-size: 20px;">search</span>
                <input type="text" name="search" id="searchInput" placeholder="Cari Nama Anggota..." value="{{ $search }}" style="width: 100%; padding: 8px 12px 8px 40px; background-color: #e5e7eb; border: 1px solid #9ca3af; border-radius: 10px; font-size: 13px; outline: none; color: black;">
                <input type="hidden" name="status" value="{{ $statusFilter }}">
            </form>
        </div>

        <!-- Table Header -->
        <div style="background-color: var(--primary-500); padding: 10px 20px;">
            <h2 style="color: white; font-size: 14px; font-weight: 700; margin: 0;">Anggota</h2>
        </div>

        <!-- Table Body -->
        <div style="padding: 0; background-color: #dcfce7;">
            <div class="table-container">
                <table class="table" style="width: 100%; border-collapse: collapse; background-color: transparent;">
                    <thead>
                        <tr style="border-bottom: 2px solid var(--primary-900);">
                            <th style="background-color: transparent; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #94a3b8;">ID</th>
                            <th style="background-color: transparent; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #94a3b8;">Nama Anggota</th>
                            <th style="background-color: transparent; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #94a3b8;">Nama Ditanggung</th>
                            <th style="background-color: transparent; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #94a3b8;">Telepon</th>
                            <th style="background-color: transparent; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #94a3b8;">Tanggal Daftar</th>
                            <th style="background-color: transparent; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #94a3b8;">Status</th>
                            <th style="background-color: transparent; color: black; font-weight: 800; font-size: 12px; padding: 12px 20px; border: 1px solid #94a3b8;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="anggotaTableBody">
                        @forelse($anggota as $item)
                        @php
                            $keluarga = optional($item->calonAnggota)->keluargaAnggota ?? collect();
                            $statusLower = strtolower($item->status);
                            $badge = $statusLower === 'aktif' ? '#16423c' : '#7f1d1d';
                            $btn = $statusLower === 'aktif' ? '#fca5a5' : '#9ca3af';
                            $label = $statusLower === 'aktif' ? 'Aktif' : 'Non-Aktif';
                        @endphp
                        <tr style="border-bottom: 1px solid #94a3b8;">
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #94a3b8;">{{ $item->nomor_anggota }}</td>
                            <td style="padding: 12px 20px; font-weight: 500; color: black; font-size: 13px; border: 1px solid #94a3b8;">{{ $item->nama }}</td>
                            <td style="padding: 12px 20px; border: 1px solid #94a3b8;">
                                <div style="display: flex; flex-direction: column; color: black; font-size: 13px; line-height: 1.4;">
                                    @forelse($keluarga as $k)
                                    <span>{{ $k->nama }}</span>
                                    @empty
                                    <span style="color: #9ca3af;">-</span>
                                    @endforelse
                                </div>
                            </td>
                            <td style="padding: 12px 20px; border: 1px solid #94a3b8;"><a href="#" style="color: #2563eb; text-decoration: underline; font-size: 13px;">{{ $item->telepon }}</a></td>
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #94a3b8;">{{ $item->created_at->format('d M Y') }}</td>
                            <td style="padding: 12px 20px; border: 1px solid #94a3b8; text-align: center;">
                                <span style="background-color: {{ $badge }}; color: white; padding: 4px 20px; border-radius: 20px; font-size: 11px; font-weight: 700; display: inline-block; min-width: 80px;">{{ $label }}</span>
                            </td>
                            <td style="padding: 12px 20px; border: 1px solid #94a3b8;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="{{ route('sekretaris.anggota.edit', $item->id) }}" style="background-color: #fcd34d; border: 1px solid black; width: 28px; height: 28px; border-radius: 6px; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                                        <span class="material-icons" style="font-size: 16px; color: black;">edit</span>
                                    </a>
                                    @if($statusLower === 'aktif')
                                    <a href="javascript:void(0)" data-id="{{ $item->id }}" data-nama="{{ $item->nama }}" data-no="{{ $item->nomor_anggota }}" onclick="openNonaktifModal(this)" style="background-color: #fca5a5; border: 1px solid black; width: 28px; height: 28px; border-radius: 6px; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                                        <span class="material-icons" style="font-size: 16px; color: black;">person_off</span>
                                    </a>
                                    @else
                                    <a href="javascript:void(0)" data-id="{{ $item->id }}" data-nama="{{ $item->nama }}" data-no="{{ $item->nomor_anggota }}" onclick="openAktifkanModal(this)" style="background-color: #86efac; border: 1px solid black; width: 28px; height: 28px; border-radius: 6px; display: flex; align-items: center; justify-content: center; text-decoration: none;">
                                        <span class="material-icons" style="font-size: 16px; color: black;">person_add</span>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="padding: 40px 20px; text-align: center; color: #6b7280; font-size: 14px;">Belum ada anggota terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div style="background-color: white; padding: 15px 20px;">
                {{ $anggota->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Nonaktif -->
<div id="modalNonaktif" class="modal-bg" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.5);z-index:1000;align-items:center;justify-content:center;">
    <div style="background:white;width:420px;max-width:90%;padding:28px;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.3);">
        <h3 style="margin:0 0 8px;font-size:16px;font-weight:700;color:#1f2937;">Konfirmasi Nonaktifkan</h3>
        <p style="font-size:14px;color:#4b5563;margin:0 0 16px;">Apakah Anda yakin ingin menonaktifkan anggota berikut?</p>
        <div style="padding:12px;background:#f9fafb;border-radius:8px;margin-bottom:20px;">
            <p style="margin:0 0 4px;font-size:13px;color:#6b7280;">ID: <strong id="nonaktifId" style="color:#111827;"></strong></p>
            <p style="margin:0;font-size:13px;color:#6b7280;">Nama: <strong id="nonaktifNama" style="color:#111827;"></strong></p>
        </div>
        <div style="display:flex;justify-content:flex-end;gap:10px;">
            <button onclick="closeNonaktifModal()" style="padding:8px 20px;background:#374151;color:white;border:none;border-radius:8px;font-weight:600;font-size:13px;cursor:pointer;">Batal</button>
            <button id="btnKonfirmasiNonaktif" onclick="konfirmasiNonaktif()" style="padding:8px 20px;background:#dc2626;color:white;border:none;border-radius:8px;font-weight:600;font-size:13px;cursor:pointer;">Ya, Nonaktifkan</button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Aktifkan -->
<div id="modalAktifkan" class="modal-bg" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.5);z-index:1000;align-items:center;justify-content:center;">
    <div style="background:white;width:420px;max-width:90%;padding:28px;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.3);">
        <h3 style="margin:0 0 8px;font-size:16px;font-weight:700;color:#1f2937;">Konfirmasi Aktifkan</h3>
        <p style="font-size:14px;color:#4b5563;margin:0 0 16px;">Apakah Anda yakin ingin mengaktifkan kembali anggota berikut?</p>
        <div style="padding:12px;background:#f9fafb;border-radius:8px;margin-bottom:20px;">
            <p style="margin:0 0 4px;font-size:13px;color:#6b7280;">ID: <strong id="aktifkanId" style="color:#111827;"></strong></p>
            <p style="margin:0;font-size:13px;color:#6b7280;">Nama: <strong id="aktifkanNama" style="color:#111827;"></strong></p>
        </div>
        <div style="display:flex;justify-content:flex-end;gap:10px;">
            <button onclick="closeAktifkanModal()" style="padding:8px 20px;background:#374151;color:white;border:none;border-radius:8px;font-weight:600;font-size:13px;cursor:pointer;">Batal</button>
            <button id="btnKonfirmasiAktifkan" onclick="konfirmasiAktifkan()" style="padding:8px 20px;background:#16a34a;color:white;border:none;border-radius:8px;font-weight:600;font-size:13px;cursor:pointer;">Ya, Aktifkan</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    var _nonaktifId = null;

    function openNonaktifModal(el) {
        _nonaktifId = el.getAttribute('data-id');
        document.getElementById('nonaktifId').textContent = el.getAttribute('data-no');
        document.getElementById('nonaktifNama').textContent = el.getAttribute('data-nama');
        document.getElementById('modalNonaktif').style.display = 'flex';
    }

    function closeNonaktifModal() {
        document.getElementById('modalNonaktif').style.display = 'none';
        _nonaktifId = null;
    }

    function konfirmasiNonaktif() {
        if (!_nonaktifId) return;
        var btn = document.getElementById('btnKonfirmasiNonaktif');
        btn.disabled = true;
        btn.innerHTML = '<span class="btn-spinner"></span> Memproses...';

        fetchAPI('/sekretaris/anggota/' + _nonaktifId + '/nonaktif', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
            }
        })
        .then(function(res) {
            if (!res.success) { alert(res.message); btn.disabled = false; btn.innerHTML = 'Ya, Nonaktifkan'; return; }
            closeNonaktifModal();
            alert(res.message);
            location.reload();
        })
        .catch(function(e) {
            console.error(e);
            alert('Gagal: ' + e.message);
            btn.disabled = false;
            btn.innerHTML = 'Ya, Nonaktifkan';
        });
    }

    document.getElementById('modalNonaktif').addEventListener('click', function(e) {
        if (e.target === this) closeNonaktifModal();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') { closeNonaktifModal(); closeAktifkanModal(); }
    });

    /* ── Reactivate Modal ── */
    var _aktifkanId = null;

    function openAktifkanModal(el) {
        _aktifkanId = el.getAttribute('data-id');
        document.getElementById('aktifkanId').textContent = el.getAttribute('data-no');
        document.getElementById('aktifkanNama').textContent = el.getAttribute('data-nama');
        document.getElementById('modalAktifkan').style.display = 'flex';
    }

    function closeAktifkanModal() {
        document.getElementById('modalAktifkan').style.display = 'none';
        _aktifkanId = null;
    }

    function konfirmasiAktifkan() {
        if (!_aktifkanId) return;
        var btn = document.getElementById('btnKonfirmasiAktifkan');
        btn.disabled = true;
        btn.innerHTML = '<span class="btn-spinner"></span> Memproses...';

        fetchAPI('/sekretaris/anggota/' + _aktifkanId + '/aktifkan', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
            }
        })
        .then(function(res) {
            if (!res.success) { alert(res.message); btn.disabled = false; btn.innerHTML = 'Ya, Aktifkan'; return; }
            closeAktifkanModal();
            alert(res.message);
            location.reload();
        })
        .catch(function(e) {
            console.error(e);
            alert('Gagal: ' + e.message);
            btn.disabled = false;
            btn.innerHTML = 'Ya, Aktifkan';
        });
    }

    document.getElementById('modalAktifkan').addEventListener('click', function(e) {
        if (e.target === this) closeAktifkanModal();
    });
</script>
@endpush
@endsection

@section('scripts')
<script>
    // Auto submit search form with debounce
    let searchTimeout;
    document.getElementById('searchInput').addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            document.getElementById('searchForm').submit();
        }, 500);
    });
</script>
@endsection
