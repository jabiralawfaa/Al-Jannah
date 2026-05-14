@extends('layouts.dashboard', [
    'menuItems' => [
        ['label' => 'Beranda', 'url' => '/superadmin', 'active' => 'superadmin'],
        ['label' => 'File', 'url' => '/superadmin/file', 'active' => 'superadmin/file'],
        ['label' => 'Log', 'url' => '/superadmin/log', 'active' => 'superadmin/log'],
    ]
])

@section('title', 'Dashboard Super Admin')

@section('content')
    @if(session('success'))
        <div style="background-color: #d8efdd; border: 1px solid #35ab50; border-radius: 12px; padding: 1rem 1.25rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; font-family: 'Segoe UI', sans-serif; font-size: 0.95rem; color: #154420;">
            <span class="material-icons" style="color: #35ab50; font-size: 20px;">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    <h1 style="font-size: 24px; font-weight: 700; color: #16423c; margin-bottom: 30px;">Dashboard</h1>
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-label"><span class="material-icons" style="vertical-align: middle; margin-right: 4px;">people</span> User</div>
            <div class="stat-value">{{ $totalUsers }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label"><span class="material-icons" style="vertical-align: middle; margin-right: 4px;">person_check</span> User Aktif</div>
            <div class="stat-value">{{ $activeUsers }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-label"><span class="material-icons" style="vertical-align: middle; margin-right: 4px;">schedule</span> File diperiksa</div>
            <div class="stat-value">{{ count($files) }}</div>
        </div>
    </div>

    <x-dashboard.data-table
        title="Daftar User"
        :headers="['Nomor', 'Nama User', 'Dibuat', 'Status', 'Role', 'Aksi']"
        :paginator="$users"
        search-placeholder="Cari user..."
        action-url="javascript:void(0)"
        action-label="Tambah User"
        action-icon="add"
        action-id="btnTambahUser"
    >
        @foreach($users as $index => $user)
            <tr>
                <td>{{ $users->firstItem() + $index }}</td>
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
                        <button class="btn btn-sm btn-outline-primary"
                                onclick="openEditModal(this)"
                                data-id="{{ $user->id }}"
                                data-nama="{{ $user->nama }}"
                                data-email="{{ $user->email }}"
                                data-role="{{ $user->role }}"
                                data-status="{{ $user->status }}">
                            <span class="material-icons" style="font-size: 16px;">edit</span>
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-dashboard.data-table>

    <!-- Modal Tambah User -->
    <div class="modal-overlay" id="tambahUserModal">
        <div class="modal" style="max-width: 520px;">
            <div class="modal-header">
                <h3 class="modal-title">Tambah User</h3>
                <button class="modal-close" onclick="closeTambahModal()">&times;</button>
            </div>
            <form id="tambahUserForm" method="POST" action="/superadmin/user">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tambah_nama" class="form-label">Nama User</label>
                        <input type="text" id="tambah_nama" name="nama" class="form-input" required maxlength="255">
                    </div>
                    <div class="form-group">
                        <label for="tambah_email" class="form-label">Email</label>
                        <input type="email" id="tambah_email" name="email" class="form-input" required maxlength="255">
                    </div>
                    <div class="form-group">
                        <label for="tambah_password" class="form-label">Password</label>
                        <input type="password" id="tambah_password" name="password" class="form-input" required minlength="8" autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <label for="tambah_role" class="form-label">Role</label>
                        <select id="tambah_role" name="role" class="form-select" required>
                            <option value="ketua">Ketua</option>
                            <option value="sekretaris">Sekretaris</option>
                            <option value="bendahara">Bendahara</option>
                            <option value="logistik">Logistik</option>
                            <option value="superadmin">Super Admin</option>
                            <option value="adminweb">Admin Web</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tambah_status" class="form-label">Status</label>
                        <select id="tambah_status" name="status" class="form-select" required>
                            <option value="aktif">Aktif</option>
                            <option value="non_aktif">Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" onclick="closeTambahModal()" style="font-weight: 600;">Batal</button>
                    <button type="submit" class="btn btn-primary" style="font-weight: 600;">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit User -->
    <div class="modal-overlay" id="editUserModal">
        <div class="modal" style="max-width: 520px;">
            <div class="modal-header">
                <h3 class="modal-title">Edit User</h3>
                <button class="modal-close" onclick="closeEditModal()">&times;</button>
            </div>
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_nama" class="form-label">Nama User</label>
                        <input type="text" id="edit_nama" name="nama" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" id="edit_email" name="email" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_password" class="form-label">Password <span style="font-weight: 400; color: #828282; font-size: 0.8rem;">(kosongkan jika tidak diubah)</span></label>
                        <input type="password" id="edit_password" name="password" class="form-input" autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <label for="edit_role" class="form-label">Role</label>
                        <select id="edit_role" name="role" class="form-select" required>
                            <option value="ketua">Ketua</option>
                            <option value="sekretaris">Sekretaris</option>
                            <option value="bendahara">Bendahara</option>
                            <option value="logistik">Logistik</option>
                            <option value="superadmin">Super Admin</option>
                            <option value="adminweb">Admin Web</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_status" class="form-label">Status</label>
                        <select id="edit_status" name="status" class="form-select" required>
                            <option value="aktif">Aktif</option>
                            <option value="non_aktif">Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" onclick="closeEditModal()" style="font-weight: 600;">Batal</button>
                    <button type="submit" class="btn btn-primary" style="font-weight: 600;">Edit</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(button) {
            document.getElementById('edit_nama').value = button.dataset.nama;
            document.getElementById('edit_email').value = button.dataset.email;
            document.getElementById('edit_password').value = '';
            document.getElementById('edit_role').value = button.dataset.role;
            document.getElementById('edit_status').value = button.dataset.status;
            document.getElementById('editUserForm').action = '/superadmin/user/' + button.dataset.id;
            document.getElementById('editUserModal').classList.add('active');
        }

        function closeEditModal() {
            document.getElementById('editUserModal').classList.remove('active');
        }

        document.getElementById('editUserModal').addEventListener('click', function(e) {
            if (e.target === this) closeEditModal();
        });

        function openTambahModal() {
            document.getElementById('tambahUserForm').reset();
            document.getElementById('tambahUserModal').classList.add('active');
        }

        function closeTambahModal() {
            document.getElementById('tambahUserModal').classList.remove('active');
        }

        document.getElementById('tambahUserModal').addEventListener('click', function(e) {
            if (e.target === this) closeTambahModal();
        });

        document.getElementById('btnTambahUser').addEventListener('click', function(e) {
            e.preventDefault();
            openTambahModal();
        });
    </script>
@endsection
