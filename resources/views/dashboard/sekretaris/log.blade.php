@extends('layouts.dashboard')

@section('title', 'Log Aktivitas')

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
    <h1 style="color: var(--primary-900); font-weight: bold; margin-bottom: 20px; font-size: 24px;">Log Aktivitas</h1>

    <div class="card" style="border: none; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); padding: 0; overflow: hidden; border-radius: 12px; background-color: white;">
        <!-- Search Area -->
        <div style="padding: 15px 20px; background-color: white; border-bottom: 1px solid #e5e7eb;">
            <form id="logSearchForm" method="GET" action="{{ route('sekretaris.log') }}" style="display:flex;gap:8px;align-items:center;width:420px;">
                <div style="position:relative;flex:1;">
                    <span class="material-icons" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#4b5563;font-size:20px;">search</span>
                    <input type="text" name="search" id="logSearchInput" placeholder="Cari aktivitas..." value="{{ $search ?? '' }}" style="width:100%;padding:8px 12px 8px 40px;background-color:#e5e7eb;border:1px solid #d1d5db;border-radius:10px;font-size:13px;outline:none;color:black;">
                </div>
                <button type="submit" style="padding:8px 16px;background:var(--primary-500);color:white;border:none;border-radius:10px;font-size:13px;font-weight:600;cursor:pointer;white-space:nowrap;">Cari</button>
            </form>
        </div>

        <!-- Activity Header -->
        <div style="background-color: var(--primary-500); padding: 10px 20px;">
            <h2 style="color: white; font-size: 14px; font-weight: 700; margin: 0;">Activity</h2>
        </div>

        <!-- Activity List -->
        <div style="padding: 0; background-color: #d1d5db;" id="activityList">
            @forelse($activities as $activity)
            @php
                $icon = match ($activity->aksi) {
                    'verifikasi' => ['name' => 'verified', 'color' => '#16423c'],
                    'update' => ['name' => 'info', 'color' => '#2563eb'],
                    'nonaktif' => ['name' => 'error', 'color' => '#b91c1c'],
                    'aktif' => ['name' => 'check_circle', 'color' => '#16a34a'],
                    default => ['name' => 'info', 'color' => '#6b7280'],
                };
            @endphp
            <div class="activity-item" style="display: flex; align-items: flex-start; gap: 20px; padding: 15px 20px; border-bottom: 1px solid #9ca3af; background-color: #d1d5db;">
                <div style="margin-top: 5px;">
                    <span class="material-icons" style="font-size: 32px; color: {{ $icon['color'] }};">{{ $icon['name'] }}</span>
                </div>
                <div>
                    <h3 style="font-size: 14px; font-weight: 800; color: black; margin: 0 0 4px 0;">{{ $activity->deskripsi }}</h3>
                    <p style="font-size: 12px; font-weight: 600; color: #374151; margin: 0 0 2px 0;">{{ $activity->modul }}</p>
                    <span style="font-size: 10px; color: #4b5563;">{{ $activity->created_at->format('d M Y H:i') }}</span>
                </div>
            </div>
            @empty
            <div style="padding: 40px 20px; text-align: center; background-color: white;">
                <span class="material-icons" style="font-size: 48px; color: #9ca3af;">history</span>
                <p style="font-size: 14px; color: #6b7280; margin-top: 10px;">Belum ada aktivitas</p>
            </div>
            @endforelse

            <!-- White Empty Space at Bottom -->
            <div style="background-color: white; height: 350px;"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Auto submit log search form with debounce
    let logSearchTimeout;
    document.getElementById('logSearchInput').addEventListener('input', function() {
        clearTimeout(logSearchTimeout);
        logSearchTimeout = setTimeout(() => {
            document.getElementById('logSearchForm').submit();
        }, 500);
    });
</script>
@endsection
