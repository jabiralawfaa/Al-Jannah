@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Beranda', 'url' => '/superadmin', 'active' => 'superadmin'],
        ['label' => 'File', 'url' => '/superadmin/file', 'active' => 'superadmin/file'],
        ['label' => 'Log', 'url' => '/superadmin/log', 'active' => 'superadmin/log'],
    ]
])

@section('title', 'Log Superadmin')

@section('content')
    @if(session('success'))
        <div style="background-color: #d8efdd; border: 1px solid #35ab50; border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; font-family: 'Segoe UI', sans-serif; font-size: 0.95rem; color: #154420;">
            <span class="material-icons" style="color: #35ab50; font-size: 20px;">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    <h1 style="font-size: 24px; font-weight: 700; color: #16423c; margin-bottom: 30px;">Log</h1>

    <x-dashboard.data-table
        title="Daftar Log"
        :headers="['Waktu', 'User', 'Aksi', 'IP Address']"
        :paginator="$logs"
        search-placeholder="Cari log..."
    >
        @forelse($logs as $log)
            <tr>
                <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                <td>{{ $log->user->nama ?? 'Tidak diketahui' }}</td>
                <td>
                    {{ $log->deskripsi }}
                </td>
                <td>
                    <code style="background-color: #f0f0f0; padding: 2px 8px; border-radius: 4px; font-size: 0.85rem;">
                        {{ $log->ip_address ?? '-' }}
                    </code>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align: center; color: var(--secondary-600); padding: 40px 16px;">
                    Tidak ada log ditemukan.
                </td>
            </tr>
        @endforelse
    </x-dashboard.data-table>
@endsection
