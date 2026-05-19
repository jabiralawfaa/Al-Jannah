@extends('layouts.dashboard')

@section('title', 'Kelola Anggota - Konfirmasi Nonaktif')

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
<div style="background-color: #dcfce7; min-height: 100vh; margin: -30px; padding: 30px; font-family: 'Inter', 'Poppins', sans-serif; position: relative;">
    <h1 style="color: var(--primary-900); font-weight: bold; margin-bottom: 20px; font-size: 24px;">Kelola Anggota</h1>

    <div class="card" style="border: none; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); padding: 0; overflow: hidden; border-radius: 12px; background-color: white;">
        <!-- Filter & Search Area -->
        <div style="padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; background-color: #f3f4f6; border-bottom: 1px solid #e5e7eb;">
            <div style="display: flex; gap: 8px; background-color: white; padding: 4px; border-radius: 10px; border: 1px solid #d1d5db;">
                <div style="background-color: #e5e7eb; padding: 6px 12px; border-radius: 8px; font-weight: 600; font-size: 13px; cursor: pointer; color: black; border: 1px solid #9ca3af;">Semua (5)</div>
                <div style="padding: 6px 12px; border-radius: 8px; font-weight: 500; font-size: 13px; cursor: pointer; color: #4b5563;">Aktif (3)</div>
                <div style="padding: 6px 12px; border-radius: 8px; font-weight: 500; font-size: 13px; cursor: pointer; color: #4b5563;">Non-Aktif (1)</div>
                <div style="padding: 6px 12px; border-radius: 8px; font-weight: 500; font-size: 13px; cursor: pointer; color: #4b5563;">Verifikasi (1)</div>
            </div>
            <div style="position: relative; width: 280px;">
                <span class="material-icons" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #4b5563; font-size: 20px;">search</span>
                <input type="text" placeholder="Cari Nama Anggota..." style="width: 100%; padding: 8px 12px 8px 40px; background-color: #e5e7eb; border: 1px solid #9ca3af; border-radius: 10px; font-size: 13px; outline: none; color: black;">
            </div>
        </div>

        <!-- Table Header -->
        <div style="background-color: var(--primary-900); padding: 10px 20px;">
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
                    <tbody>
                        @php
                            $data = [
                                ['id' => 'RKM-1', 'nama' => 'Ahmad Suryo', 'status' => 'Aktif', 'badge' => '#16423c', 'btn' => '#fca5a5'],
                                ['id' => 'RKM-2', 'nama' => 'Budi Santoso', 'status' => 'Non-Aktif', 'badge' => '#7f1d1d', 'btn' => '#9ca3af'],
                                ['id' => 'RKM-3', 'nama' => 'Siti Aminah', 'status' => 'Verifikasi', 'badge' => '#a16207', 'btn' => '#9ca3af'],
                            ];
                        @endphp
                        @foreach($data as $item)
                        <tr style="border-bottom: 1px solid #94a3b8;">
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #94a3b8;">{{ $item['id'] }}</td>
                            <td style="padding: 12px 20px; font-weight: 500; color: black; font-size: 13px; border: 1px solid #94a3b8;">{{ $item['nama'] }}</td>
                            <td style="padding: 12px 20px; border: 1px solid #94a3b8;">
                                <div style="display: flex; flex-direction: column; color: black; font-size: 13px; line-height: 1.4;">
                                    <span>Rani Ardinata</span>
                                    <span>Ahmad Gilang</span>
                                    <span>Maulana Hakim</span>
                                    <span>Ardian Gading</span>
                                </div>
                            </td>
                            <td style="padding: 12px 20px; border: 1px solid #94a3b8;"><a href="#" style="color: #2563eb; text-decoration: underline; font-size: 13px;">0812345678</a></td>
                            <td style="padding: 12px 20px; color: black; font-size: 13px; border: 1px solid #94a3b8;">15 Jan 2026</td>
                            <td style="padding: 12px 20px; border: 1px solid #94a3b8; text-align: center;">
                                <span style="background-color: {{ $item['badge'] }}; color: white; padding: 4px 20px; border-radius: 20px; font-size: 11px; font-weight: 700; display: inline-block; min-width: 80px;">{{ $item['status'] }}</span>
                            </td>
                            <td style="padding: 12px 20px; border: 1px solid #94a3b8;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <div style="background-color: #fcd34d; border: 1px solid black; width: 28px; height: 28px; border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                                        <span class="material-icons" style="font-size: 16px; color: black;">edit</span>
                                    </div>
                                    <div style="background-color: {{ $item['btn'] }}; border: 1px solid black; width: 28px; height: 28px; border-radius: 6px; display: flex; align-items: center; justify-content: center;">
                                        <span class="material-icons" style="font-size: 16px; color: black;">person_off</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Area Putih Kosong di Bawah -->
            <div style="background-color: white; height: 300px;"></div>
        </div>
    </div>

    <!-- Modal Konfirmasi Nonaktif Overlay (Visible by default in this route) -->
    <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1000; display: flex; align-items: center; justify-content: center;">
        <div style="background-color: white; width: 450px; max-width: 90%; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.3); position: relative; text-align: left;">
            <p style="font-size: 16px; color: black; margin-bottom: 20px;">Apakah Anda yakin ingin menonaktifkan?</p>
            
            <div style="margin-bottom: 30px;">
                <p style="font-size: 14px; font-weight: 800; color: black; margin: 0 0 5px 0;">ID : {{ $anggota->nomor_anggota }}</p>
                <p style="font-size: 14px; font-weight: 800; color: black; margin: 0;">Nama : {{ $anggota->nama }}</p>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 12px;">
                <a href="{{ route('sekretaris.anggota') }}" style="background-color: #374151; color: white; border: none; padding: 10px 25px; border-radius: 8px; font-weight: 800; font-size: 14px; cursor: pointer; text-decoration: none;">Batal</a>
                <a href="{{ route('sekretaris.anggota') }}" style="background-color: #fbbf24; color: black; border: none; padding: 10px 25px; border-radius: 8px; font-weight: 800; font-size: 14px; cursor: pointer; text-decoration: none;">Iya</a>
            </div>
        </div>
    </div>
</div>
@endsection
