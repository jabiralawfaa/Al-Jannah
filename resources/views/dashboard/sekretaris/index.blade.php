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

    <div class="stats-grid">
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-label">Jumlah Seluruh Anggota</div>
                    <div class="stat-value">150</div>
                </div>
                <span class="material-icons" style="font-size: 48px; color: var(--primary-900);">groups</span>
            </div>
        </div>
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-label">Jumlah Anggota Aktif</div>
                    <div class="stat-value">120</div>
                </div>
                <span class="material-icons" style="font-size: 48px; color: var(--success-500);">how_to_reg</span>
            </div>
        </div>
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-label">Jumlah Anggota Perlu Verifikasi</div>
                    <div class="stat-value">10</div>
                </div>
                <span class="material-icons" style="font-size: 48px; color: var(--warning-500);">pending_actions</span>
            </div>
        </div>
        <div class="stat-card">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div class="stat-label">Jumlah Anggota Non-Aktif</div>
                    <div class="stat-value">20</div>
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
                        <tr>
                            <td>1</td>
                            <td>Ahmad Fauzi</td>
                            <td>12 Mei 2026</td>
                            <td><span class="badge badge-warning">Pending</span></td>
                            <td>
                                <button class="btn btn-secondary btn-sm" style="display: flex; align-items: center; gap: 5px;">
                                    <span class="material-icons" style="font-size: 18px;">lock</span>
                                    Verifikasi
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Siti Aminah</td>
                            <td>13 Mei 2026</td>
                            <td><span class="badge badge-warning">Pending</span></td>
                            <td>
                                <button class="btn btn-primary btn-sm">Verifikasi</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
