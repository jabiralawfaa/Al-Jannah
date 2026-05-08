@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Beranda', 'url' => '/superadmin', 'active' => 'superadmin'],
        ['label' => 'File', 'url' => '#', 'active' => 'superadmin/file'],
        ['label' => 'Log', 'url' => '#', 'active' => 'superadmin/log'],
    ]
])

@section('title', 'Dashboard Super Admin')

@section('content')
    <h1 style="font-size: 24px; font-weight: 700; color: #16423c; margin-bottom: 30px;">Dashboard</h1>
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label"><span class="material-icons" style="vertical-align: middle; margin-right: 4px;">people</span> User</div>
            <div class="stat-value">{{ count($users) }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label"><span class="material-icons" style="vertical-align: middle; margin-right: 4px;">person_check</span> User Aktif</div>
            <div class="stat-value">{{ $users->where('status', 'aktif')->count() }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label"><span class="material-icons" style="vertical-align: middle; margin-right: 4px;">schedule</span> File diperiksa</div>
            <div class="stat-value">{{ count($files) }}</div>
        </div>
    </div>

    <div class="card" style="margin-top: 30px;">
        <div class="card-header">
            <h2 class="card-title">Daftar User</h2>
            <button class="btn btn-primary">+ Tambah User</button>
        </div>
        
        <div style="margin-bottom: 20px;">
            <input type="text" placeholder="search" class="form-input" style="max-width: 400px;">
        </div>

        <x-dashboard.table :headers="['Nomor', 'Nama User', 'Dibuat', 'Status', 'Role', 'Aksi']">
            @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    <td>
                        <span class="badge {{ $user->status === 'aktif' ? 'badge-success' : 'badge-danger' }}">
                            {{ $user->status === 'aktif' ? 'Aktif' : 'Non-Aktif' }}
                        </span>
                    </td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        <div style="display: flex; gap: 8px;">
                            <button class="btn btn-sm btn-outline-primary"><span class="material-icons" style="font-size: 16px;">edit</span></button>
                            <button class="btn btn-sm btn-danger"><span class="material-icons" style="font-size: 16px;">delete</span></button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-dashboard.table>
    </div>
@endsection
