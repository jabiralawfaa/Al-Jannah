@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Beranda', 'url' => '/superadmin', 'active' => 'superadmin'],
        ['label' => 'File', 'url' => '/superadmin/file', 'active' => 'superadmin/file'],
        ['label' => 'Log', 'url' => '#', 'active' => 'superadmin/log'],
    ]
])

@section('title', 'File Management')

@section('content')
    @if(session('success'))
        <div style="background-color: #d8efdd; border: 1px solid #35ab50; border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; font-family: 'Segoe UI', sans-serif; font-size: 0.95rem; color: #154420;">
            <span class="material-icons" style="color: #35ab50; font-size: 20px;">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background-color: #fde8e8; border: 1px solid #e53e3e; border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; font-family: 'Segoe UI', sans-serif; font-size: 0.95rem; color: #9b1c1c;">
            <span class="material-icons" style="color: #e53e3e; font-size: 20px;">error</span>
            {{ session('error') }}
        </div>
    @endif

    <h1 style="font-size: 24px; font-weight: 700; color: #16423c; margin-bottom: 30px;">File Management</h1>

    <div class="card" style="margin-bottom: 24px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                <a href="{{ route('superadmin.file') }}" class="btn btn-sm {{ !request('kategori') ? 'btn-primary' : 'btn-outline-primary' }}">
                    Semua
                </a>
                @foreach(config('file-pemilah.labels') as $key => $label)
                    <a href="{{ route('superadmin.file', ['kategori' => $key]) }}"
                       class="btn btn-sm {{ request('kategori') === $key ? 'btn-primary' : 'btn-outline-primary' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
            <button class="btn btn-primary btn-sm" onclick="openUploadModal()" style="display: inline-flex; align-items: center; gap: 4px;">
                <span class="material-icons" style="font-size: 16px;">upload</span> Upload File
            </button>
        </div>
    </div>

    <x-dashboard.data-table
        title="Daftar File"
        :headers="['Nomor', 'Nama File', 'Kategori', 'Status', 'Diupload Oleh', 'Tanggal Upload', 'Aksi']"
        :paginator="$files"
        search-placeholder="Cari file..."
    >
        @forelse($files as $index => $file)
            <tr>
                <td>{{ $files->firstItem() + $index }}</td>
                <td>{{ $file->nama_file }}</td>
                <td>
                    @php
                        $kategoriClass = config("file-pemilah.badge_classes.{$file->kategori}", 'badge-info');
                        $kategoriLabel = $kategoriLabels[$file->kategori] ?? ucfirst($file->kategori);
                    @endphp
                    <span class="badge {{ $kategoriClass }}">{{ $kategoriLabel }}</span>
                </td>
                <td>
                    @php
                        $statusClass = match($file->status) {
                            'aktif' => 'badge-success',
                            'diperiksa' => 'badge-warning',
                            'arsip' => 'badge-info',
                            'dihapus' => 'badge-danger',
                            default => 'badge-info',
                        };
                        $statusLabel = match($file->status) {
                            'aktif' => 'Aktif',
                            'diperiksa' => 'Diperiksa',
                            'arsip' => 'Arsip',
                            'dihapus' => 'Dihapus',
                            default => $file->status,
                        };
                    @endphp
                    <span class="badge {{ $statusClass }}">{{ $statusLabel }}</span>
                </td>
                <td>{{ $file->uploadedBy->nama ?? 'Tidak diketahui' }}</td>
                <td>{{ $file->created_at->format('d/m/Y') }}</td>
                <td>
                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('superadmin.file.download', $file->id) }}" class="btn btn-sm btn-outline-primary">
                            <span class="material-icons" style="font-size: 16px;">download</span>
                        </a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" style="text-align: center; color: var(--secondary-600); padding: 40px 16px;">
                    Tidak ada file ditemukan.
                </td>
            </tr>
        @endforelse
    </x-dashboard.data-table>

    <!-- Modal Upload File -->
    <div class="modal-overlay" id="uploadFileModal">
        <div class="modal" style="max-width: 520px;">
            <div class="modal-header">
                <h3 class="modal-title">Upload File Baru</h3>
                <button class="modal-close" onclick="closeUploadModal()">&times;</button>
            </div>
            <form method="POST" action="{{ route('superadmin.file.upload') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file" class="form-label">Pilih File</label>
                        <input type="file" id="file" name="file" class="form-input" required
                               style="padding: 10px;">
                    </div>
                    <div style="background-color: #f7f9fc; border-radius: 8px; padding: 12px 16px; margin-top: 16px; font-size: 0.85rem; color: #4a5568;">
                        <strong style="display: block; margin-bottom: 8px; color: #16423c;">Informasi Pemilahan:</strong>
                        <p style="margin: 4px 0;">
                            <span class="badge badge-success" style="font-size: 11px;">Diterima</span>
                            Dokumen, gambar, dan file teks aman.
                        </p>
                        <p style="margin: 4px 0;">
                            <span class="badge badge-warning" style="font-size: 11px;">Mencurigakan</span>
                            Executable, script, dan arsip.
                        </p>
                        <p style="margin: 4px 0;">
                            <span class="badge badge-danger" style="font-size: 11px;">Ditolak</span>
                            Script web, SQL, dan file sistem.
                        </p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" onclick="closeUploadModal()" style="font-weight: 600;">Batal</button>
                    <button type="submit" class="btn btn-primary" style="font-weight: 600;">
                        <span class="material-icons" style="font-size: 16px; vertical-align: middle;">upload</span> Upload
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openUploadModal() {
            document.getElementById('uploadFileModal').classList.add('active');
        }

        function closeUploadModal() {
            document.getElementById('uploadFileModal').classList.remove('active');
        }

        document.getElementById('uploadFileModal').addEventListener('click', function(e) {
            if (e.target === this) closeUploadModal();
        });
    </script>
@endsection
