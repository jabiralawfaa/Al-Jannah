@extends('layouts.dashboard')

@section('title', 'Dashboard Sekretaris')

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
    <h1 style="color: var(--primary-900); font-weight: bold; margin-bottom: 30px; text-transform: lowercase;">dashboard</h1>

    @if(session('success'))
        <div style="background-color: #d8efdd; border: 1px solid #35ab50; border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; font-family: 'Segoe UI', sans-serif; font-size: 0.95rem; color: #154420;">
            <span class="material-icons" style="color: #35ab50; font-size: 20px;">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background-color: #fde8e8; border: 1px solid #e53e3e; border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; font-family: 'Segoe UI', sans-serif; font-size: 0.95rem; color: #742a2a;">
            <span class="material-icons" style="color: #e53e3e; font-size: 20px;">error</span>
            {{ session('error') }}
        </div>
    @endif

    <div class="stats-grid">
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-label">Jumlah Seluruh Anggota</div>
                    <div class="stat-value">{{ $totalAnggota }}</div>
                </div>
                <span class="material-icons" style="font-size: 48px; color: var(--primary-900);">groups</span>
            </div>
        </div>
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-label">Jumlah Anggota Aktif</div>
                    <div class="stat-value">{{ $anggotaAktif }}</div>
                </div>
                <span class="material-icons" style="font-size: 48px; color: var(--success-500);">how_to_reg</span>
            </div>
        </div>
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-label">Jumlah Anggota Perlu Verifikasi</div>
                    <div class="stat-value">{{ $menungguVerifikasi }}</div>
                </div>
                <span class="material-icons" style="font-size: 48px; color: var(--warning-500);">pending_actions</span>
            </div>
        </div>
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-label">Jumlah Anggota Non-Aktif</div>
                    <div class="stat-value">{{ $anggotaNonAktif }}</div>
                </div>
                <span class="material-icons" style="font-size: 48px; color: var(--danger-500);">person_off</span>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 0; overflow: hidden;">
        <div style="background-color: var(--warning-500); padding: 12px 24px;">
            <h2 style="color: var(--black); font-size: 18px; font-weight: bold; margin: 0; text-transform: lowercase;">menunggu verifikasi</h2>
        </div>
        <div style="padding: 24px;">
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>nomor</th>
                            <th>nama calon anggota</th>
                            <th>tanggal daftar</th>
                            <th>status</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($calonAnggota as $index => $calon)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $calon->nama }}</td>
                                <td>{{ $calon->created_at->format('d M Y') }}</td>
                                <td>
                                    @if($calon->status === 'menunggu_verifikasi')
                                        <span class="badge badge-warning">Menunggu Verifikasi</span>
                                    @elseif($calon->status === 'sudah_membayar')
                                        <span class="badge badge-success">Sudah Membayar</span>
                                    @endif
                                </td>
                                <td>
                                    @if($calon->status === 'menunggu_verifikasi')
                                        <button class="btn btn-secondary btn-sm" style="display: flex; align-items: center; gap: 5px;" disabled>
                                            <span class="material-icons" style="font-size: 18px;">lock</span>
                                            Verifikasi
                                        </button>
                                    @elseif($calon->status === 'sudah_membayar')
                                        <form method="POST" action="{{ route('sekretaris.verifikasi', $calon->id) }}" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-primary btn-sm" style="display: flex; align-items: center; gap: 5px;">
                                                <span class="material-icons" style="font-size: 18px;">how_to_reg</span>
                                                Verifikasi
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="text-align: center; padding: 24px; color: #6b7280;">Tidak ada calon anggota yang menunggu verifikasi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
