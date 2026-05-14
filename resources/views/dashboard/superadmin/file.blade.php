@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Beranda', 'url' => '/superadmin', 'active' => 'superadmin'],
        ['label' => 'File', 'url' => '/superadmin/file', 'active' => 'superadmin/file'],
        ['label' => 'Log', 'url' => '#', 'active' => 'superadmin/log'],
    ]
])

@section('title', 'File Management')

@section('content')
    <h1 style="font-size: 24px; font-weight: 700; color: #16423c; margin-bottom: 30px;">File Management</h1>

    <x-dashboard.data-table
        title="Daftar File"
        :headers="['Nomor', 'Nama File', 'Status', 'Diupload Oleh', 'Tanggal Upload', 'Aksi']"
        :paginator="$files"
        search-placeholder="Cari file..."
    >
        @forelse($files as $index => $file)
            <tr>
                <td>{{ $files->firstItem() + $index }}</td>
                <td>{{ $file->nama_file }}</td>
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
                        <a href="{{ asset('storage/' . $file->file_path) }}" class="btn btn-sm btn-outline-primary" target="_blank">
                            <span class="material-icons" style="font-size: 16px;">download</span>
                        </a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align: center; color: var(--secondary-600); padding: 40px 16px;">
                    Tidak ada file ditemukan.
                </td>
            </tr>
        @endforelse
    </x-dashboard.data-table>
@endsection
