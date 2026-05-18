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
            <div style="position: relative; width: 350px;">
                <span class="material-icons" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #4b5563; font-size: 20px;">search</span>
                <input type="text" placeholder="Cari aktivitas..." style="width: 100%; padding: 8px 12px 8px 40px; background-color: #e5e7eb; border: 1px solid #d1d5db; border-radius: 10px; font-size: 13px; outline: none; color: black;">
            </div>
        </div>

        <!-- Activity Header -->
        <div style="background-color: var(--primary-900); padding: 10px 20px;">
            <h2 style="color: white; font-size: 14px; font-weight: 700; margin: 0;">Activity</h2>
        </div>

        <!-- Activity List -->
        <div style="padding: 0; background-color: #d1d5db;">
            @php
                $activities = [
                    [
                        'title' => 'Verifikasi Disetujui - Sekretaris',
                        'subtitle' => 'a.n Ahmad fauzi - ID : RKM-2',
                        'time' => '16 Jan 2026 09:30',
                        'icon' => 'verified',
                        'icon_color' => '#16423c',
                    ],
                    [
                        'title' => 'Update data anggota - Sekretaris',
                        'subtitle' => 'a.n Ahmad fauzi - ID : RKM-2',
                        'time' => '16 Jan 2026 09:30',
                        'icon' => 'info',
                        'icon_color' => '#2563eb',
                    ],
                    [
                        'title' => 'Penonaktifkan anggota - Sekretaris',
                        'subtitle' => 'a.n Ahmad fauzi - ID : RKM-2',
                        'time' => '16 Jan 2026 09:30',
                        'icon' => 'error',
                        'icon_color' => '#b91c1c',
                    ],
                ];
            @endphp

            @foreach($activities as $activity)
            <div style="display: flex; align-items: flex-start; gap: 20px; padding: 15px 20px; border-bottom: 1px solid #9ca3af; background-color: #d1d5db;">
                <div style="margin-top: 5px;">
                    @if($activity['icon'] == 'verified')
                        <span class="material-icons" style="font-size: 32px; color: {{ $activity['icon_color'] }};">verified</span>
                    @elseif($activity['icon'] == 'info')
                        <span class="material-icons" style="font-size: 32px; color: {{ $activity['icon_color'] }};">info</span>
                    @elseif($activity['icon'] == 'error')
                        <span class="material-icons" style="font-size: 32px; color: {{ $activity['icon_color'] }};">error</span>
                    @endif
                </div>
                <div>
                    <h3 style="font-size: 14px; font-weight: 800; color: black; margin: 0 0 4px 0;">{{ $activity['title'] }}</h3>
                    <p style="font-size: 12px; font-weight: 600; color: #374151; margin: 0 0 2px 0;">{{ $activity['subtitle'] }}</p>
                    <span style="font-size: 10px; color: #4b5563;">{{ $activity['time'] }}</span>
                </div>
            </div>
            @endforeach

            <!-- White Empty Space at Bottom -->
            <div style="background-color: white; height: 350px;"></div>
        </div>
    </div>
</div>
@endsection
