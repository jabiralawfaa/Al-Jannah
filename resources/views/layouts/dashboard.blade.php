<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | RKM Al-Jannah</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>
<body>
    <div class="dashboard-container">
        @include('components.dashboard.sidebar', ['menuItems' => $menuItems ?? []])
        <main class="main-content">
            @include('components.dashboard.navbar')
            <div class="content-wrapper">
                @yield('content')
            </div>
        </main>
    </div>
    @stack('modals')
</body>
</html>
