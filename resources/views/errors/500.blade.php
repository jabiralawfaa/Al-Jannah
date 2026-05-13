<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Terjadi Kesalahan - RKM Al-Jannah</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .error-box {
            background: #fff;
            border-radius: 24px;
            padding: 3rem;
            max-width: 480px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(22, 66, 60, 0.2);
        }
        .error-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
        .error-icon svg { width: 50px; height: 50px; }
        .error-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #16423C;
            margin-bottom: 0.75rem;
        }
        .error-message {
            font-size: 0.95rem;
            font-weight: 400;
            color: #6B7280;
            line-height: 1.7;
            margin-bottom: 2rem;
        }
        .btn-home {
            display: inline-block;
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            background: linear-gradient(135deg, #6A9C89 0%, #16423C 100%);
            padding: 0.875rem 2rem;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(22, 66, 60, 0.3);
        }
        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(22, 66, 60, 0.5);
        }
        @media (max-width: 480px) {
            .error-box { padding: 2rem 1.5rem; }
            .error-title { font-size: 1.25rem; }
        }
    </style>
</head>
<body>
    <div class="error-box">
        <div class="error-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
            </svg>
        </div>
        <h1 class="error-title">Terjadi Kesalahan</h1>
        <p class="error-message">Maaf, terjadi kesalahan pada server. Tim kami telah diberitahu dan akan segera memperbaikinya. Silakan coba lagi beberapa saat.</p>
        <a href="{{ route('home') }}" class="btn-home">Kembali ke Beranda</a>
    </div>
</body>
</html>
