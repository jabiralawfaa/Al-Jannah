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
    <link rel="stylesheet" href="{{ asset('css/bendahara.css') }}">
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
        el.parentElement.style.display = 'flex';
        setTimeout(function() { el.parentElement.style.display = 'none'; }, duration || 3500);
    }
    (function() {
        if (!document.getElementById('modalEdit')) return;
        window.openModal = function() { document.getElementById('modalEdit').classList.add('active'); };
        window.closeModal = function() { document.getElementById('modalEdit').classList.remove('active'); };
        window.requestAccess = function(msg) { closeModal(); showToast(document.getElementById('toastSuccess'), msg || 'Permintaan akses edit berhasil dikirim ke ketua', 4000); };
        document.getElementById('modalEdit').addEventListener('click', function(e) {
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
