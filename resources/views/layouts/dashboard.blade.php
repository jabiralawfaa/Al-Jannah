<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | RKM Al-Jannah</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="{{ asset('css/bendahara.css') }}"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @livewireStyles
    @stack('styles')
</head>
<body>
    @include('components.dashboard.navbar')
    <div class="dashboard-container">
        @include('components.dashboard.sidebar', ['menuItems' => $menuItems ?? []])
        <main class="main-content">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </main>
    </div>
    @stack('modals')
    <script>
    function pad(n) { return n < 10 ? '0' + n : '' + n; }
    function today() { var d = new Date(); return pad(d.getDate()) + '/' + pad(d.getMonth() + 1) + '/' + d.getFullYear(); }
    function formatNominal(val) { return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.'); }
    function showToast(el, msg, duration) {
        el.textContent = msg;
        el.style.display = 'flex';
        setTimeout(function() { el.style.display = 'none'; }, duration || 3500);
    }
    (function() {
        var modal = document.getElementById('modalEdit');
        if (!modal) return;
        window.openModal = function(btn) {
            modal.classList.add('active');
            var row = btn ? btn.closest('tr') : null;
            window._editRow = row;
            if (row) {
                var tableName = window._targetTable || '';
                document.getElementById('modalTargetTable').value = tableName;
                var idEl = row.querySelector('[data-target-id]');
                document.getElementById('modalTargetId').value = idEl ? idEl.getAttribute('data-target-id') : '';
                document.getElementById('modalFieldName').value = '';
                document.getElementById('modalOldValue').value = '';
                document.getElementById('modalNewValue').value = '';
                document.getElementById('modalNewValue').style.display = '';
                document.getElementById('modalNewKategori').style.display = 'none';
                document.getElementById('modalNewKategori').value = '';
                document.getElementById('modalAlasan').value = '';
            }
        };
        window.closeModal = function() { modal.classList.remove('active'); window._editRow = null; };
        window.requestAccess = function() {
            var table = document.getElementById('modalTargetTable').value;
            var id = document.getElementById('modalTargetId').value;
            var field = document.getElementById('modalFieldName').value;
            var oldVal = document.getElementById('modalOldValue').value;
            var newVal = field === 'kategori'
                ? document.getElementById('modalNewKategori').value
                : document.getElementById('modalNewValue').value;
            var alasan = document.getElementById('modalAlasan').value;
            if (!field || !alasan) { alert('Harap isi kolom yang ingin diubah dan alasan.'); return; }
            if (!newVal) { alert('Harap isi nilai baru.'); return; }
            if (!table || !id) { alert('Data target tidak ditemukan.'); return; }
            var formData = new FormData();
            formData.append('target_table', table);
            formData.append('target_id', id);
            formData.append('field_name', field);
            formData.append('old_value', oldVal);
            formData.append('new_value', newVal);
            formData.append('alasan', alasan);
            fetch('/bendahara/permintaan-izin', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                body: formData
            })
            .then(function(r) { return r.json(); })
            .then(function(res) {
                closeModal();
                if (res.success) {
                    showToast(document.getElementById('toastSuccess'), res.message, 4000);
                    document.getElementById('modalFieldName').value = '';
                    document.getElementById('modalOldValue').value = '';
                    document.getElementById('modalNewValue').value = '';
                    document.getElementById('modalAlasan').value = '';
                } else {
                    alert(res.message || 'Gagal mengirim permintaan');
                }
            })
            .catch(function() { alert('Terjadi kesalahan'); });
        };
        document.addEventListener('change', function(e) {
            if (e.target.id !== 'modalFieldName') return;
            var row = window._editRow;
            if (!row) { document.getElementById('modalOldValue').value = ''; return; }
            var val = '';
            switch (e.target.value) {
                case 'nominal': val = row.getAttribute('data-jumlah') || ''; break;
                case 'kategori': val = row.getAttribute('data-kategori') || ''; break;
                case 'keterangan': val = row.getAttribute('data-keterangan') || ''; break;
            }
            document.getElementById('modalOldValue').value = val;

            var newValInput = document.getElementById('modalNewValue');
            var newKatSelect = document.getElementById('modalNewKategori');
            if (e.target.value === 'kategori') {
                newValInput.style.display = 'none';
                newKatSelect.style.display = '';
                var opts = window._kategoriOptions || [];
                newKatSelect.innerHTML = '<option value="">Pilih kategori</option>';
                for (var i = 0; i < opts.length; i++) {
                    newKatSelect.innerHTML += '<option value="' + opts[i] + '">' + opts[i] + '</option>';
                }
                newKatSelect.value = '';
            } else {
                newValInput.style.display = '';
                newKatSelect.style.display = 'none';
            }
        });
        modal.addEventListener('click', function(e) {
            if (e.target === this || (e.target.classList && e.target.classList.contains('modal-bg'))) closeModal();
        });
    })();
    function _catat(prefix, emptyRowId, tbodyId) {
        var tanggal = document.getElementById('tanggal' + prefix).value;
        var jenis = document.getElementById('jenis' + prefix).value;
        var nominal = document.getElementById('nominal' + prefix).value;
        var keterangan = document.getElementById('keterangan' + prefix).value;
        if (!tanggal || !jenis || !nominal) { alert('Harap isi tanggal, jenis, dan nominal.'); return; }
        var parts = tanggal.split('-');
        tanggal = parts[2] + '/' + parts[1] + '/' + parts[0];
        var nominalFormat = 'Rp ' + parseInt(nominal.replace(/[^0-9]/g, '') || 0).toLocaleString('id-ID');
        var emptyRow = document.getElementById(emptyRowId);
        if (emptyRow) emptyRow.remove();
        var tbody = document.getElementById(tbodyId);
        var row = document.createElement('tr');
        row.innerHTML = '<td>' + tanggal + '</td><td class="nominal-value">' + nominalFormat + '</td><td class="name-cell">' + jenis + '</td><td>' + (keterangan || '-') + '</td><td><button class="btn-edit-disabled" onclick="openModal(this)"><span class="material-icons">lock</span> Edit</button></td>';
        tbody.appendChild(row);
        document.getElementById('tanggal' + prefix).value = '';
        document.getElementById('jenis' + prefix).value = '';
        document.getElementById('nominal' + prefix).value = '';
        document.getElementById('keterangan' + prefix).value = '';
        document.querySelector('.file-upload .upload-placeholder').textContent = 'Upload here...';
    }
    </script>
    @stack('scripts')
    @livewireScripts
</body>
</html>
