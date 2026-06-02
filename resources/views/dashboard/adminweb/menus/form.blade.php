@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Beranda', 'url' => '/adminweb', 'active' => 'adminweb'],
        ['label' => 'Posts', 'url' => '/adminweb/posts', 'active' => 'adminweb/posts*'],
        ['label' => 'Pages', 'url' => '/adminweb/pages', 'active' => 'adminweb/pages*'],
        ['label' => 'Menus', 'url' => '/adminweb/menus', 'active' => 'adminweb/menus*'],
        ['label' => 'Files & Images', 'url' => '#', 'active' => 'adminweb/files'],
    ]
])

@section('title', isset($menu) ? 'Edit Menu' : 'Tambah Menu')

@section('content')
<style>
    .menu-form-wrap {
        max-width: 600px;
        margin: 0 auto;
    }

    .menu-form-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .menu-form-title {
        font-size: 24px;
        font-weight: 700;
        color: #16423c;
    }

    .menu-form-card {
        background: #fff;
        border: 1px solid #d4d4d4;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .menu-form-card-body {
        padding: 24px;
    }

    .menu-form-field {
        margin-bottom: 20px;
    }

    .menu-form-field:last-child {
        margin-bottom: 0;
    }

    .menu-form-field label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 6px;
    }

    .menu-form-field input[type="text"],
    .menu-form-field select {
        width: 100%;
        padding: 10px 14px;
        border: 1.5px solid #e0e0e0;
        border-radius: 8px;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        color: #1a1a1a;
        background: #f8f9fa;
        outline: none;
        transition: border-color 0.2s;
        box-sizing: border-box;
    }

    .menu-form-field input[type="text"]:focus,
    .menu-form-field select:focus {
        border-color: #16423c;
    }

    .menu-form-field .hint {
        font-size: 11px;
        color: #6b7280;
        margin-top: 4px;
    }

    .menu-form-field .hint a {
        color: #16423c;
        text-decoration: underline;
    }

    .menu-form-field input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: #16423c;
        cursor: pointer;
    }

    .checkbox-row {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .menu-form-actions {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        margin-top: 24px;
    }

    .btn-menu-form {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 28px;
        border: none;
        border-radius: 999px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        font-family: inherit;
        transition: opacity 0.2s;
    }

    .btn-menu-form:hover {
        opacity: 0.85;
    }

    .btn-menu-form-primary {
        background-color: #16423c;
        color: #fff;
    }

    .btn-menu-form-secondary {
        background-color: #d9d9d9;
        color: #2b2b2b;
    }

    .field-error {
        color: #9a0000;
        font-size: 12px;
        margin-top: 4px;
    }
</style>

<div class="menu-form-wrap">
    <div class="menu-form-header">
        <h1 class="menu-form-title">{{ isset($menu) ? 'Edit Menu' : 'Tambah Menu Baru' }}</h1>
        <a href="{{ route('adminweb.menus') }}" class="btn-menu-form btn-menu-form-secondary">
            <span class="material-icons" style="font-size:18px;">arrow_back</span>
            Kembali
        </a>
    </div>

    <form method="POST" action="{{ isset($menu) ? route('adminweb.menus.update', $menu->id) : route('adminweb.menus.store') }}">
        @csrf
        @if(isset($menu))
            @method('PUT')
        @endif

        <div class="menu-form-card">
            <div class="menu-form-card-body">
                <div class="menu-form-field">
                    <label for="label">Nama Menu <span style="color:#9a0000;">*</span></label>
                    <input type="text" id="label" name="label" value="{{ old('label', $menu->label ?? '') }}" placeholder="Contoh: Tentang Kami" required>
                    @error('label')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="menu-form-field">
                    <label for="custom_url">URL / Link</label>
                    <input type="text" id="custom_url" name="custom_url" value="{{ old('custom_url', $menu->custom_url ?? '') }}" placeholder="Contoh: /tentang-kami, https://example.com, #section">
                    <div class="hint">
                        Bisa berupa path internal (<code>/tentang-kami</code>), URL eksternal (<code>https://...</code>), 
                        atau anchor (<code>#section</code>). Kosongi jika tidak diperlukan.
                    </div>
                    @error('custom_url')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="menu-form-field">
                    <label for="parent_id">Induk Menu (untuk sub-menu)</label>
                    <select id="parent_id" name="parent_id">
                        <option value="">-- Tidak ada (menu utama) --</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_id', $menu->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->label }}
                            </option>
                        @endforeach
                    </select>
                    <div class="hint">Pilih "Tidak ada" jika ini menu utama. Pilih menu lain jika ini sub-menu.</div>
                    @error('parent_id')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="menu-form-field">
                    <label for="sort_order">Urutan</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $menu->sort_order ?? '') }}" placeholder="Otomatis jika kosong" min="0" style="width:120px;">
                    <div class="hint">Angka lebih kecil tampil lebih dulu.</div>
                    @error('sort_order')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="menu-form-field">
                    <label class="checkbox-row">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $menu->is_active ?? true) ? 'checked' : '' }}>
                        <span>Aktif</span>
                    </label>
                    <div class="hint">Nonaktifkan untuk menyembunyikan menu dari navbar tanpa menghapus.</div>
                </div>
            </div>
        </div>

        <div class="menu-form-actions">
            <a href="{{ route('adminweb.menus') }}" class="btn-menu-form btn-menu-form-secondary">Batal</a>
            <button type="submit" class="btn-menu-form btn-menu-form-primary">
                <span class="material-icons" style="font-size:18px;">save</span>
                {{ isset($menu) ? 'Simpan Perubahan' : 'Tambah Menu' }}
            </button>
        </div>
    </form>
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
