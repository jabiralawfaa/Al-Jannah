@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Beranda', 'url' => '/adminweb', 'active' => 'adminweb'],
        ['label' => 'Posts', 'url' => '/adminweb/posts', 'active' => 'adminweb/posts*'],
        ['label' => 'Pages', 'url' => '/adminweb/pages', 'active' => 'adminweb/pages*'],
        ['label' => 'Menus', 'url' => '/adminweb/menus', 'active' => 'adminweb/menus*'],
        ['label' => 'Files & Images', 'url' => '#', 'active' => 'adminweb/files'],
    ]
])

@section('title', 'Menu Navigasi')

@section('content')
<style>
    .menus-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .menus-title {
        font-size: 24px;
        font-weight: 700;
        color: #16423c;
    }

    .menus-toolbar {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .btn-menus {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 24px;
        border: none;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        font-family: inherit;
        transition: opacity 0.2s;
    }

    .btn-menus:hover {
        opacity: 0.85;
    }

    .btn-menus-primary {
        background-color: #16423c;
        color: #fff;
    }

    .menus-table-wrap {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        background: #fff;
    }

    .menus-table {
        width: 100%;
        border-collapse: collapse;
    }

    .menus-table th {
        background-color: #16423c;
        color: #fff;
        font-size: 13px;
        font-weight: 700;
        text-align: left;
        padding: 14px 16px;
        white-space: nowrap;
    }

    .menus-table td {
        padding: 14px 16px;
        font-size: 13px;
        color: #2b2b2b;
        border-bottom: 1px solid #efefef;
        vertical-align: middle;
    }

    .menus-table tbody tr:hover {
        background-color: #f7f7f7;
    }

    .menus-table tbody tr:last-child td {
        border-bottom: none;
    }

    .menu-label {
        font-weight: 600;
    }

    .menu-label-child {
        padding-left: 32px;
        position: relative;
    }

    .menu-label-child::before {
        content: '└─';
        position: absolute;
        left: 10px;
        color: #16423c;
        font-weight: 400;
        font-size: 14px;
    }

    .menu-url {
        font-size: 12px;
        color: #6b7280;
        max-width: 240px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: block;
    }

    .menu-has-children {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 12px;
        color: #6b7280;
    }

    .menu-toggle-form {
        display: inline;
    }

    .toggle-switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 22px;
        cursor: pointer;
    }

    .toggle-switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .toggle-slider {
        position: absolute;
        inset: 0;
        background-color: #d9d9d9;
        border-radius: 22px;
        transition: 0.3s;
    }

    .toggle-slider::before {
        content: '';
        position: absolute;
        left: 3px;
        bottom: 3px;
        width: 16px;
        height: 16px;
        background-color: #fff;
        border-radius: 50%;
        transition: 0.3s;
    }

    .toggle-switch input:checked + .toggle-slider {
        background-color: #35ab50;
    }

    .toggle-switch input:checked + .toggle-slider::before {
        transform: translateX(18px);
    }

    .menus-actions {
        display: flex;
        gap: 8px;
        flex-wrap: nowrap;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        padding: 6px 14px;
        border: none;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        font-family: inherit;
        transition: opacity 0.2s;
        white-space: nowrap;
    }

    .btn-action:hover {
        opacity: 0.85;
    }

    .btn-action-edit {
        background-color: #16423c;
        color: #fff;
    }

    .btn-action-danger {
        background-color: #9a0000;
        color: #fff;
    }

    .child-row td {
        background-color: #fafbfa;
    }

    .child-row:hover td {
        background-color: #f0f2f0 !important;
    }

    @media (max-width: 768px) {
        .menus-table-wrap {
            overflow-x: auto;
        }
    }
</style>

<div class="menus-header">
    <h1 class="menus-title">Menu Navigasi</h1>
    <div class="menus-toolbar">
        <a href="{{ route('adminweb.menus.create') }}" class="btn-menus btn-menus-primary">
            <span class="material-icons" style="font-size:18px;">add</span>
            Tambah Menu Baru
        </a>
    </div>
</div>

<div class="menus-table-wrap">
    <table class="menus-table">
        <thead>
            <tr>
                <th style="width:60px;">Aktif</th>
                <th>Nama Menu</th>
                <th>URL</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($menus as $menu)
            <tr>
                <td>
                    <form method="POST" action="{{ route('adminweb.menus.toggle', $menu->id) }}" class="menu-toggle-form">
                        @csrf
                        @method('PUT')
                        <label class="toggle-switch">
                            <input type="checkbox" {{ $menu->is_active ? 'checked' : '' }} onchange="this.form.submit()">
                            <span class="toggle-slider"></span>
                        </label>
                    </form>
                </td>
                <td class="menu-label">{{ $menu->label }}</td>
                <td>
                    <span class="menu-url">{{ $menu->custom_url ?: '-' }}</span>
                </td>
                <td>
                    <div class="menus-actions">
                        <a href="{{ route('adminweb.menus.edit', $menu->id) }}" class="btn-action btn-action-edit">
                            <span class="material-icons" style="font-size:14px;">edit</span>
                            Edit
                        </a>
                        <form method="POST" action="{{ route('adminweb.menus.destroy', $menu->id) }}" style="display:inline;" onsubmit="return confirm('Hapus menu ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-action-danger">
                                <span class="material-icons" style="font-size:14px;">delete</span>
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @foreach($menu->children as $child)
            <tr class="child-row">
                <td>
                    <form method="POST" action="{{ route('adminweb.menus.toggle', $child->id) }}" class="menu-toggle-form">
                        @csrf
                        @method('PUT')
                        <label class="toggle-switch">
                            <input type="checkbox" {{ $child->is_active ? 'checked' : '' }} onchange="this.form.submit()">
                            <span class="toggle-slider"></span>
                        </label>
                    </form>
                </td>
                <td class="menu-label-child">{{ $child->label }}</td>
                <td>
                    <span class="menu-url">{{ $child->custom_url ?: '-' }}</span>
                </td>
                <td>
                    <div class="menus-actions">
                        <a href="{{ route('adminweb.menus.edit', $child->id) }}" class="btn-action btn-action-edit">
                            <span class="material-icons" style="font-size:14px;">edit</span>
                            Edit
                        </a>
                        <form method="POST" action="{{ route('adminweb.menus.destroy', $child->id) }}" style="display:inline;" onsubmit="return confirm('Hapus menu ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-action-danger">
                                <span class="material-icons" style="font-size:14px;">delete</span>
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            @empty
            <tr>
                <td colspan="4" style="text-align:center;padding:40px 16px;color:#828282;">
                    <span class="material-icons" style="font-size:40px;display:block;margin-bottom:8px;">menu</span>
                    Belum ada menu. Tambah menu baru untuk mulai.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(session('success'))
<div style="position:fixed;top:20px;right:20px;z-index:9999;background-color:#d8efdd;border:1px solid #35ab50;border-radius:12px;padding:1rem 1.25rem;display:flex;align-items:center;gap:0.75rem;font-family:'Segoe UI',sans-serif;font-size:0.95rem;color:#154420;box-shadow:0 4px 15px rgba(0,0,0,0.1);">
    <span class="material-icons" style="color:#35ab50;font-size:20px;">check_circle</span>
    {{ session('success') }}
</div>
<script>
    setTimeout(function(){ document.querySelector('[style*="position:fixed"][style*="top:20px"]')?.remove(); }, 4000);
</script>
@endif
@endsection
