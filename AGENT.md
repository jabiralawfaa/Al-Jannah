# Peraturan AGENT AI
(peraturan ini tidak boleh diubah oleh AI, dan hanya boleh diubah oleh developer)

jangan ubah apapun yang ada di file ini dan juga harus ikut standar dari folder ini untuk beberapa tampilan sesuai dengan kegunaannya
- resources/views/layouts/dashboard.blade.php (untuk layout dashboard)

jangan ubah kode yang sudah ada di file ini tapi boleh menambahkan baris kode baru
- resources/css/dashboard.css (untuk style dashboard)


file html dosboard sekretaris 

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Sekretaris — Pengelolaan Keanggotaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=DM+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        :root {
            --bg:#0b0d13;--bg2:#10131b;--card:#161a25;--card-h:#1c2130;
            --border:#232838;--fg:#eef0f6;--muted:#6b7194;
            --accent:#e59b2a;--accent-d:rgba(229,155,42,.12);
            --ok:#2dd4a0;--ok-d:rgba(45,212,160,.12);
            --err:#f06060;--err-d:rgba(240,96,96,.12);
            --warn:#f5bf24;--warn-d:rgba(245,191,36,.12);
            --info:#5e9ef5;--info-d:rgba(94,158,245,.12);
        }
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--fg);min-height:100vh;overflow-x:hidden}
        h1,h2,h3,h4,h5,h6{font-family:'Outfit',sans-serif}
        ::-webkit-scrollbar{width:5px}
        ::-webkit-scrollbar-track{background:var(--bg)}
        ::-webkit-scrollbar-thumb{background:var(--border);border-radius:3px}

        .amb{position:fixed;inset:0;pointer-events:none;z-index:0;overflow:hidden}
        .amb i{position:absolute;border-radius:50%;filter:blur(130px);animation:orbF 22s ease-in-out infinite}
        .amb i:nth-child(1){width:480px;height:480px;background:var(--accent);top:-8%;left:-4%;opacity:.12}
        .amb i:nth-child(2){width:380px;height:380px;background:var(--ok);bottom:-12%;right:-6%;opacity:.07;animation-delay:-8s}
        .amb i:nth-child(3){width:260px;height:260px;background:var(--err);top:45%;left:55%;opacity:.05;animation-delay:-15s}
        @keyframes orbF{0%,100%{transform:translate(0,0) scale(1)}40%{transform:translate(35px,-25px) scale(1.08)}75%{transform:translate(-20px,18px) scale(.94)}}

        .sb{position:fixed;left:0;top:0;width:250px;height:100vh;background:var(--bg2);border-right:1px solid var(--border);z-index:50;display:flex;flex-direction:column;transition:transform .3s}
        .sb-logo{padding:20px 16px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:11px}
        .sb-logo .ico{width:36px;height:36px;background:linear-gradient(135deg,var(--accent),#c4830f);border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:16px;color:#000;font-weight:900;font-family:'Outfit'}
        .sb-nav{padding:12px 10px;flex:1;overflow-y:auto}
        .sb-label{font-size:9.5px;font-weight:700;text-transform:uppercase;letter-spacing:1.6px;color:var(--muted);padding:14px 12px 6px}
        .sb-item{display:flex;align-items:center;gap:11px;padding:9px 13px;border-radius:9px;color:var(--muted);cursor:pointer;transition:all .2s;font-size:13px;font-weight:500;position:relative}
        .sb-item:hover{background:var(--card);color:var(--fg)}
        .sb-item.on{background:var(--accent-d);color:var(--accent)}
        .sb-item.on::before{content:'';position:absolute;left:0;top:50%;transform:translateY(-50%);width:3px;height:18px;background:var(--accent);border-radius:0 3px 3px 0}
        .sb-item i{width:18px;text-align:center;font-size:14px}
        .sb-badge{margin-left:auto;background:var(--err);color:#fff;font-size:9.5px;font-weight:700;padding:2px 7px;border-radius:8px;line-height:1.4}
        .sb-ft{padding:14px;border-top:1px solid var(--border);display:flex;align-items:center;gap:11px}
        .sb-ft .av{width:34px;height:34px;border-radius:9px;background:linear-gradient(135deg,var(--accent),#c4830f);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:13px;color:#000;font-family:'Outfit'}
        .sb-ft .un{font-size:12.5px;font-weight:600}.sb-ft .ur{font-size:10.5px;color:var(--muted)}

        .mc{margin-left:250px;padding:22px 26px;position:relative;z-index:1;min-height:100vh}

        /* 5 kolom untuk 10 card → 2 baris rapi */
        .sg{display:grid;grid-template-columns:repeat(5,1fr);gap:12px;margin-bottom:20px}
        .sc{background:var(--card);border:1px solid var(--border);border-radius:12px;padding:16px;position:relative;overflow:hidden;transition:all .25s}
        .sc:hover{border-color:rgba(107,113,148,.35);transform:translateY(-2px);box-shadow:0 10px 32px rgba(0,0,0,.28)}
        .sc .si{width:34px;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:15px;margin-bottom:10px}
        .sc .sv{font-family:'Outfit';font-size:24px;font-weight:800;line-height:1;margin-bottom:2px}
        .sc .sl{font-size:11.5px;color:var(--muted);font-weight:500}
        .sc .st{display:inline-flex;align-items:center;gap:4px;font-size:10px;font-weight:600;margin-top:8px;padding:2px 7px;border-radius:5px}
        .sc .gl{position:absolute;top:-25px;right:-25px;width:80px;height:80px;border-radius:50%;filter:blur(45px);opacity:.13}
        .pb{width:100%;height:5px;background:var(--bg);border-radius:3px;overflow:hidden;margin-top:7px}
        .pf{height:100%;border-radius:3px;transition:width 1.4s ease}

        .qr{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:20px}
        .qi{background:var(--card);border:1px solid var(--border);border-radius:10px;padding:12px 14px;display:flex;align-items:center;gap:11px}
        .qi .qi-i{width:34px;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0}
        .qi .qi-v{font-family:'Outfit';font-size:18px;font-weight:700}.qi .qi-l{font-size:10.5px;color:var(--muted)}

        .cg{display:grid;grid-template-columns:5fr 3fr;gap:12px;margin-bottom:20px}
        .cc{background:var(--card);border:1px solid var(--border);border-radius:12px;padding:18px}
        .cc-h{display:flex;align-items:center;justify-content:space-between;margin-bottom:16px}
        .cc-h h3{font-size:14.5px;font-weight:700}
        .cf{display:flex;gap:3px;background:var(--bg);border-radius:7px;padding:2px}
        .cfb{padding:4px 10px;border-radius:5px;font-size:10.5px;font-weight:600;cursor:pointer;border:none;background:transparent;color:var(--muted);transition:all .2s;font-family:'DM Sans'}
        .cfb.on{background:var(--accent);color:#000}

        .tc{background:var(--card);border:1px solid var(--border);border-radius:12px;overflow:hidden;margin-bottom:20px}
        .th{display:flex;align-items:center;justify-content:space-between;padding:14px 18px;border-bottom:1px solid var(--border);flex-wrap:wrap;gap:10px}
        .th h3{font-size:14.5px;font-weight:700}
        .ts{display:flex;align-items:center;gap:7px;background:var(--bg);border:1px solid var(--border);border-radius:7px;padding:7px 12px;min-width:220px}
        .ts i{color:var(--muted);font-size:12px}
        .ts input{background:transparent;border:none;outline:none;color:var(--fg);font-size:12px;width:100%;font-family:'DM Sans'}
        .ts input::placeholder{color:var(--muted)}
        .tf{display:flex;gap:6px}
        .fsel{background:var(--bg);border:1px solid var(--border);border-radius:7px;padding:7px 10px;color:var(--fg);font-size:11px;font-family:'DM Sans';cursor:pointer;outline:none}
        .fsel:focus{border-color:var(--accent)}
        table{width:100%;border-collapse:collapse}
        thead th{text-align:left;padding:10px 18px;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:var(--muted);background:var(--bg2);border-bottom:1px solid var(--border);white-space:nowrap}
        tbody tr{border-bottom:1px solid var(--border);transition:background .12s}
        tbody tr:last-child{border-bottom:none}
        tbody tr:hover{background:var(--card-h)}
        tbody td{padding:12px 18px;font-size:12.5px;white-space:nowrap}
        .mi{display:flex;align-items:center;gap:10px}
        .ma{width:32px;height:32px;border-radius:7px;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:11.5px;font-family:'Outfit';color:#000;flex-shrink:0}
        .mn{font-weight:600;font-size:12.5px}.me{font-size:10.5px;color:var(--muted);margin-top:1px}

        .badge{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:5px;font-size:10.5px;font-weight:600}
        .b-ok{background:var(--ok-d);color:var(--ok)}.b-err{background:var(--err-d);color:var(--err)}
        .b-warn{background:var(--warn-d);color:var(--warn)}.b-info{background:var(--info-d);color:var(--info)}
        .b-mut{background:rgba(107,113,148,.12);color:var(--muted)}
        .bd{width:5px;height:5px;border-radius:50%;display:inline-block}
        .b-ok .bd{background:var(--ok)}.b-err .bd{background:var(--err)}
        .b-warn .bd{background:var(--warn)}.b-info .bd{background:var(--info)}.b-mut .bd{background:var(--muted)}

        .ab{display:flex;gap:5px}
        .btn{display:inline-flex;align-items:center;gap:6px;padding:6px 12px;border-radius:7px;font-size:11px;font-weight:600;cursor:pointer;border:none;transition:all .2s;font-family:'DM Sans'}
        .btn-ok{background:var(--ok);color:#000}.btn-ok:hover{box-shadow:0 4px 14px rgba(45,212,160,.3)}
        .btn-err{background:var(--err);color:#fff}.btn-err:hover{box-shadow:0 4px 14px rgba(240,96,96,.3)}
        .btn-lk{background:var(--card-h);color:var(--muted);cursor:not-allowed;opacity:.55;position:relative}
        .btn-lk::after{content:'Belum membayar biaya pendaftaran';position:absolute;bottom:calc(100% + 6px);left:50%;transform:translateX(-50%) scale(.9);background:var(--err);color:#fff;padding:4px 9px;border-radius:5px;font-size:9.5px;font-weight:600;white-space:nowrap;opacity:0;pointer-events:none;transition:all .2s}
        .btn-lk:hover::after{opacity:1;transform:translateX(-50%) scale(1)}

        .tft{display:flex;align-items:center;justify-content:space-between;padding:12px 18px;border-top:1px solid var(--border);font-size:11px;color:var(--muted)}
        .pgn{display:flex;gap:3px}
        .pb2{width:28px;height:28px;display:flex;align-items:center;justify-content:center;border-radius:6px;border:1px solid var(--border);background:transparent;color:var(--muted);cursor:pointer;font-size:11px;font-weight:600;transition:all .2s;font-family:'DM Sans'}
        .pb2:hover{background:var(--card-h);color:var(--fg)}
        .pb2.on{background:var(--accent);color:#000;border-color:var(--accent)}

        .bg2{display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:20px}
        .al{max-height:310px;overflow-y:auto}
        .ai{display:flex;gap:10px;padding:10px 0;border-bottom:1px solid var(--border)}
        .ai:last-child{border-bottom:none}
        .adw{display:flex;flex-direction:column;align-items:center;padding-top:3px}
        .adt{width:7px;height:7px;border-radius:50%;flex-shrink:0}
        .aln{width:1px;flex:1;background:var(--border);margin-top:5px}
        .atx{font-size:12px;line-height:1.5}.atx strong{font-weight:600}
        .atm{font-size:10px;color:var(--muted);margin-top:1px}

        .btn-p{background:linear-gradient(135deg,var(--accent),#c4830f);color:#000}
        .btn-p:hover{box-shadow:0 6px 20px rgba(229,155,42,.25);transform:translateY(-1px)}
        .btn-o{background:transparent;border:1px solid var(--border);color:var(--fg)}
        .btn-o:hover{background:var(--card);border-color:var(--muted)}

        .toast-c{position:fixed;top:20px;right:20px;z-index:1000;display:flex;flex-direction:column;gap:8px}
        .toast{background:var(--card);border:1px solid var(--border);border-radius:10px;padding:12px 16px;display:flex;align-items:center;gap:10px;min-width:300px;box-shadow:0 14px 44px rgba(0,0,0,.4);animation:tIn .35s ease;font-size:12px}
        .toast.tout{animation:tOut .25s ease forwards}
        .ti{width:28px;height:28px;border-radius:7px;display:flex;align-items:center;justify-content:center;font-size:12px;flex-shrink:0}
        @keyframes tIn{from{opacity:0;transform:translateX(35px)}to{opacity:1;transform:translateX(0)}}
        @keyframes tOut{from{opacity:1;transform:translateX(0)}to{opacity:0;transform:translateX(35px)}}

        .mo{position:fixed;inset:0;background:rgba(0,0,0,.55);backdrop-filter:blur(6px);z-index:100;display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .25s}
        .mo.act{opacity:1;pointer-events:all}
        .md{background:var(--card);border:1px solid var(--border);border-radius:14px;padding:24px;width:90%;max-width:400px;transform:scale(.92) translateY(16px);transition:transform .25s}
        .mo.act .md{transform:scale(1) translateY(0)}
        .md h3{font-size:16px;font-weight:700;margin-bottom:6px}
        .md p{font-size:12.5px;color:var(--muted);line-height:1.6;margin-bottom:18px}
        .md-a{display:flex;gap:8px;justify-content:flex-end}

        .mob-t{display:none;position:fixed;top:14px;left:14px;z-index:60;width:36px;height:36px;background:var(--card);border:1px solid var(--border);border-radius:9px;align-items:center;justify-content:center;cursor:pointer;color:var(--fg);font-size:16px}

        @media(max-width:1200px){.sg{grid-template-columns:repeat(4,1fr)}}
        @media(max-width:1100px){.sg{grid-template-columns:repeat(3,1fr)}.cg{grid-template-columns:1fr}}
        @media(max-width:768px){
            .sb{transform:translateX(-100%)}.sb.open{transform:translateX(0)}.mob-t{display:flex}
            .mc{margin-left:0;padding:64px 14px 20px}
            .sg{grid-template-columns:repeat(2,1fr)}.qr{grid-template-columns:1fr}.bg2{grid-template-columns:1fr}
            .ts{min-width:100%}.tf{width:100%}.fsel{flex:1}
        }
        @media(prefers-reduced-motion:reduce){*,*::before,*::after{animation-duration:.01ms!important;transition-duration:.01ms!important}}
    </style>
</head>
<body>

<div class="amb"><i></i><i></i><i></i></div>
<button class="mob-t" onclick="document.getElementById('sb').classList.toggle('open')" aria-label="Menu"><i class="fas fa-bars"></i></button>
<div class="toast-c" id="toastC"></div>

<div class="mo" id="mo" onclick="if(event.target===this)clModal()">
    <div class="md" role="dialog" aria-modal="true">
        <h3 id="moT">Konfirmasi</h3>
        <p id="moM">Yakin?</p>
        <div class="md-a">
            <button class="btn btn-o" onclick="clModal()">Batal</button>
            <button class="btn" id="moB" onclick="cfModal()">Konfirmasi</button>
        </div>
    </div>
</div>

<aside class="sb" id="sb" role="navigation" aria-label="Menu">
    <div class="sb-logo">
        <div class="ico">KS</div>
        <div><div style="font-family:'Outfit';font-weight:700;font-size:14px">Keanggotaan</div><div style="font-size:10px;color:var(--muted)">Panel Sekretaris</div></div>
    </div>
    <nav class="sb-nav">
        <div class="sb-label">Utama</div>
        <div class="sb-item on"><i class="fas fa-chart-pie"></i>Dashboard</div>
        <div class="sb-item"><i class="fas fa-users"></i>Data Anggota</div>
        <div class="sb-item"><i class="fas fa-user-plus"></i>Calon Anggota<span class="sb-badge" id="sbB">12</span></div>
        <div class="sb-item"><i class="fas fa-clipboard-check"></i>Verifikasi</div>
        <div class="sb-label">Laporan</div>
        <div class="sb-item"><i class="fas fa-file-alt"></i>Laporan Bulanan</div>
        <div class="sb-item"><i class="fas fa-download"></i>Ekspor Data</div>
        <div class="sb-item"><i class="fas fa-history"></i>Riwayat Aktivitas</div>
        <div class="sb-label">Lainnya</div>
        <div class="sb-item"><i class="fas fa-cog"></i>Pengaturan</div>
    </nav>
    <div class="sb-ft">
        <div class="av">SA</div>
        <div style="flex:1"><div class="un">Sari Ayu</div><div class="ur">Sekretaris</div></div>
        <i class="fas fa-ellipsis-v" style="color:var(--muted);cursor:pointer"></i>
    </div>
</aside>

<main class="mc">
    <header style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px">
        <div>
            <h1 style="font-size:24px;font-weight:800;letter-spacing:-.4px">Dashboard Keanggotaan</h1>
            <p style="color:var(--muted);font-size:12.5px;margin-top:2px">Rabu, 18 Juni 2025 — Ringkasan pengelolaan anggota organisasi</p>
        </div>
        <div style="display:flex;gap:8px">
            <button class="btn btn-o" onclick="toast('info','Data berhasil disegarkan')"><i class="fas fa-sync-alt"></i> Segarkan</button>
            <button class="btn btn-p" onclick="toast('ok','Laporan bulanan sedang diunduh...')"><i class="fas fa-download"></i> Unduh Laporan</button>
        </div>
    </header>

    <!-- 10 Kartu Statistik — grid 5 kolom = 2 baris rapi -->
    <section class="sg" aria-label="Statistik utama">
        <!-- 1. Total Anggota Aktif -->
        <div class="sc">
            <div class="gl" style="background:var(--accent)"></div>
            <div class="si" style="background:var(--accent-d);color:var(--accent)"><i class="fas fa-users"></i></div>
            <div class="sv ca" data-t="348">0</div>
            <div class="sl">Total Anggota Aktif</div>
            <div class="st" style="background:var(--ok-d);color:var(--ok)"><i class="fas fa-arrow-up" style="font-size:8px"></i> +12 bulan ini</div>
        </div>
        <!-- 2. Menunggu Verifikasi -->
        <div class="sc">
            <div class="gl" style="background:var(--warn)"></div>
            <div class="si" style="background:var(--warn-d);color:var(--warn)"><i class="fas fa-hourglass-half"></i></div>
            <div class="sv ca" data-t="12">0</div>
            <div class="sl">Menunggu Verifikasi</div>
            <div class="st" style="background:var(--warn-d);color:var(--warn)"><i class="fas fa-minus" style="font-size:8px"></i> 8 sudah bayar</div>
        </div>
        <!-- 3. Diverifikasi Bulan Ini -->
        <div class="sc">
            <div class="gl" style="background:var(--ok)"></div>
            <div class="si" style="background:var(--ok-d);color:var(--ok)"><i class="fas fa-check-double"></i></div>
            <div class="sv ca" data-t="27">0</div>
            <div class="sl">Diverifikasi Bulan Ini</div>
            <div class="st" style="background:var(--ok-d);color:var(--ok)"><i class="fas fa-arrow-up" style="font-size:8px"></i> +35% dari lalu</div>
        </div>
        <!-- 4. Ditolak Bulan Ini -->
        <div class="sc">
            <div class="gl" style="background:var(--err)"></div>
            <div class="si" style="background:var(--err-d);color:var(--err)"><i class="fas fa-user-times"></i></div>
            <div class="sv ca" data-t="5">0</div>
            <div class="sl">Ditolak Bulan Ini</div>
            <div class="st" style="background:var(--ok-d);color:var(--ok)"><i class="fas fa-arrow-down" style="font-size:8px"></i> -2 dari lalu</div>
        </div>
        <!-- 5. Belum Bayar (Terkunci) -->
        <div class="sc">
            <div class="gl" style="background:var(--err)"></div>
            <div class="si" style="background:var(--err-d);color:var(--err)"><i class="fas fa-lock"></i></div>
            <div class="sv ca" data-t="4">0</div>
            <div class="sl">Belum Bayar Pendaftaran</div>
            <div class="st" style="background:var(--err-d);color:var(--err)"><i class="fas fa-lock" style="font-size:8px"></i> Verifikasi terkunci</div>
        </div>
        <!-- 6. Tingkat Persetujuan -->
        <div class="sc">
            <div class="gl" style="background:var(--accent)"></div>
            <div class="si" style="background:var(--accent-d);color:var(--accent)"><i class="fas fa-percentage"></i></div>
            <div class="sv"><span class="ca" data-t="84">0</span>%</div>
            <div class="sl">Tingkat Persetujuan</div>
            <div class="pb"><div class="pf" style="width:0%;background:linear-gradient(90deg,var(--accent),#c4830f)" data-w="84%"></div></div>
        </div>
        <!-- 7. Rata-rata Waktu Verifikasi -->
        <div class="sc">
            <div class="gl" style="background:var(--info)"></div>
            <div class="si" style="background:var(--info-d);color:var(--info)"><i class="fas fa-stopwatch"></i></div>
            <div class="sv"><span class="ca" data-t="1">0</span>.<span class="ca" data-t="8">0</span> hr</div>
            <div class="sl">Rata-rata Waktu Verifikasi</div>
            <div class="st" style="background:var(--ok-d);color:var(--ok)"><i class="fas fa-arrow-down" style="font-size:8px"></i> -0.3 hr dari lalu</div>
        </div>
        <!-- 8. Anggota Baru Bulan Ini -->
        <div class="sc">
            <div class="gl" style="background:var(--ok)"></div>
            <div class="si" style="background:var(--ok-d);color:var(--ok)"><i class="fas fa-user-check"></i></div>
            <div class="sv ca" data-t="12">0</div>
            <div class="sl">Anggota Baru Bulan Ini</div>
            <div class="st" style="background:var(--ok-d);color:var(--ok)"><i class="fas fa-arrow-up" style="font-size:8px"></i> +4 dari lalu</div>
        </div>
        <!-- 9. Pendapatan Pendaftaran (YTD) -->
        <div class="sc">
            <div class="gl" style="background:var(--accent)"></div>
            <div class="si" style="background:var(--accent-d);color:var(--accent)"><i class="fas fa-money-bill-wave"></i></div>
            <div class="sv">Rp <span class="ca" data-t="4400">0</span>K</div>
            <div class="sl">Pendapatan Pendaftaran (YTD)</div>
            <div class="st" style="background:var(--ok-d);color:var(--ok)"><i class="fas fa-arrow-up" style="font-size:8px"></i> +18% dari lalu</div>
        </div>
        <!-- 10. Anggota Non-Aktif -->
        <div class="sc">
            <div class="gl" style="background:var(--muted)"></div>
            <div class="si" style="background:rgba(107,113,148,.12);color:var(--muted)"><i class="fas fa-user-slash"></i></div>
            <div class="sv ca" data-t="7">0</div>
            <div class="sl">Anggota Non-Aktif</div>
            <div class="st" style="background:var(--err-d);color:var(--err)"><i class="fas fa-arrow-up" style="font-size:8px"></i> +2 dari lalu</div>
        </div>
    </section>

    <!-- Quick Stats -->
    <section class="qr" aria-label="Statistik cepat">
        <div class="qi">
            <div class="qi-i" style="background:var(--accent-d);color:var(--accent)"><i class="fas fa-calendar-plus"></i></div>
            <div><div class="qi-v ca" data-t="44">0</div><div class="qi-l">Pendaftar Bulan Ini</div></div>
        </div>
        <div class="qi">
            <div class="qi-i" style="background:var(--ok-d);color:var(--ok)"><i class="fas fa-wallet"></i></div>
            <div><div class="qi-v">Rp <span class="ca" data-t="2200">0</span>K</div><div class="qi-l">Pendapatan Bulan Ini</div></div>
        </div>
        <div class="qi">
            <div class="qi-i" style="background:var(--warn-d);color:var(--warn)"><i class="fas fa-balance-scale"></i></div>
            <div><div class="qi-v"><span class="ca" data-t="87">0</span>%</div><div class="qi-l">Rasio Bayar vs Daftar</div></div>
        </div>
    </section>

    <!-- Charts -->
    <section class="cg" aria-label="Grafik">
        <div class="cc">
            <div class="cc-h">
                <h3>Tren Pendaftaran Bulanan</h3>
                <div class="cf">
                    <button class="cfb on" onclick="swChart(this,'6m')">6 Bulan</button>
                    <button class="cfb" onclick="swChart(this,'1y')">1 Tahun</button>
                </div>
            </div>
            <div style="height:230px"><canvas id="trendC"></canvas></div>
        </div>
        <div class="cc">
            <div class="cc-h"><h3>Status Keanggotaan</h3></div>
            <div style="height:230px"><canvas id="statC"></canvas></div>
            <div style="margin-top:14px;display:flex;flex-direction:column;gap:6px" id="sLeg"></div>
        </div>
    </section>

    <!-- Table -->
    <section class="tc" aria-label="Tabel calon anggota">
        <div class="th">
            <h3><i class="fas fa-user-plus" style="color:var(--accent);margin-right:7px"></i>Daftar Calon Anggota</h3>
            <div style="display:flex;gap:8px;flex-wrap:wrap;width:100%;justify-content:flex-end">
                <div class="ts"><i class="fas fa-search"></i><input type="text" placeholder="Cari nama atau email..." id="sI" oninput="fT()" aria-label="Cari"></div>
                <div class="tf">
                    <select class="fsel" id="fP" onchange="fT()" aria-label="Filter bayar"><option value="all">Semua Bayar</option><option value="paid">Sudah Bayar</option><option value="unpaid">Belum Bayar</option></select>
                    <select class="fsel" id="fS" onchange="fT()" aria-label="Filter status"><option value="all">Semua Status</option><option value="pending">Menunggu</option><option value="verified">Terverifikasi</option><option value="rejected">Ditolak</option></select>
                </div>
            </div>
        </div>
        <div style="overflow-x:auto">
            <table><thead><tr><th>No</th><th>Calon Anggota</th><th>No. Telepon</th><th>Tgl Daftar</th><th>Pembayaran</th><th>Status</th><th>Aksi</th></tr></thead><tbody id="tB"></tbody></table>
        </div>
        <div class="tft"><span id="tI">Menampilkan 1-8 dari 12 data</span><div class="pgn" id="pgn"></div></div>
    </section>

    <!-- Bottom -->
    <section class="bg2" aria-label="Aktivitas dan divisi">
        <div class="cc">
            <div class="cc-h"><h3>Aktivitas Terbaru</h3><span style="font-size:10px;color:var(--muted)">Hari ini</span></div>
            <div class="al" id="aL"></div>
        </div>
        <div class="cc">
            <div class="cc-h"><h3>Pendaftaran per Divisi</h3></div>
            <div style="height:270px"><canvas id="divC"></canvas></div>
        </div>
    </section>
</main>

<script>
const M=[
    {id:1,name:"Andi Pratama",email:"andi.pratama@email.com",phone:"0812-3456-7890",date:"2025-06-17",paid:true,st:"pending",div:"Pendidikan",av:"#e59b2a"},
    {id:2,name:"Bunga Lestari",email:"bunga.l@email.com",phone:"0856-1234-5678",date:"2025-06-17",paid:true,st:"pending",div:"Humas",av:"#2dd4a0"},
    {id:3,name:"Cahya Wibowo",email:"cahya.w@email.com",phone:"0878-9876-5432",date:"2025-06-16",paid:false,st:"pending",div:"Teknologi",av:"#5e9ef5"},
    {id:4,name:"Dewi Sartika",email:"dewi.s@email.com",phone:"0813-4567-8901",date:"2025-06-16",paid:true,st:"pending",div:"Keuangan",av:"#f06060"},
    {id:5,name:"Eka Putra",email:"eka.putra@email.com",phone:"0857-2345-6789",date:"2025-06-15",paid:true,st:"verified",div:"Pendidikan",av:"#a78bfa"},
    {id:6,name:"Fitriani Rahayu",email:"fitri.r@email.com",phone:"0821-6789-0123",date:"2025-06-15",paid:false,st:"pending",div:"Humas",av:"#fb923c"},
    {id:7,name:"Galih Permana",email:"galih.p@email.com",phone:"0838-7890-1234",date:"2025-06-14",paid:true,st:"pending",div:"Teknologi",av:"#2dd4bf"},
    {id:8,name:"Hana Safitri",email:"hana.s@email.com",phone:"0852-8901-2345",date:"2025-06-14",paid:true,st:"rejected",div:"Keuangan",av:"#f472b6"},
    {id:9,name:"Irfan Maulana",email:"irfan.m@email.com",phone:"0819-0123-4567",date:"2025-06-13",paid:false,st:"pending",div:"Pendidikan",av:"#f5bf24"},
    {id:10,name:"Jasmine Putri",email:"jasmine.p@email.com",phone:"0858-1234-5670",date:"2025-06-13",paid:true,st:"pending",div:"Humas",av:"#818cf8"},
    {id:11,name:"Kevin Anggara",email:"kevin.a@email.com",phone:"0877-2345-6781",date:"2025-06-12",paid:true,st:"pending",div:"Teknologi",av:"#4ade80"},
    {id:12,name:"Laras Wulandari",email:"laras.w@email.com",phone:"0811-3456-7892",date:"2025-06-12",paid:false,st:"pending",div:"Keuangan",av:"#fb7185"},
];

const acts=[
    {t:'<strong>Eka Putra</strong> berhasil diverifikasi sebagai anggota baru divisi Pendidikan',tm:"15 menit lalu",c:"var(--ok)"},
    {t:'<strong>Bunga Lestari</strong> mengunggah bukti pembayaran pendaftaran',tm:"32 menit lalu",c:"var(--info)"},
    {t:'<strong>Hana Safitri</strong> ditolak — dokumen tidak lengkap',tm:"1 jam lalu",c:"var(--err)"},
    {t:'<strong>Andi Pratama</strong> mendaftar sebagai calon anggota divisi Pendidikan',tm:"2 jam lalu",c:"var(--accent)"},
    {t:'<strong>Dewi Sartika</strong> mengunggah bukti pembayaran pendaftaran',tm:"2 jam lalu",c:"var(--info)"},
    {t:'<strong>Galih Permana</strong> mendaftar sebagai calon anggota divisi Teknologi',tm:"3 jam lalu",c:"var(--accent)"},
    {t:'<strong>Kevin Anggara</strong> mengunggah bukti pembayaran pendaftaran',tm:"4 jam lalu",c:"var(--info)"},
    {t:'Laporan bulanan Mei 2025 berhasil digenerate otomatis',tm:"6 jam lalu",c:"var(--muted)"},
];

let pg=1;const pp=8;let mCb=null;

function aC(){document.querySelectorAll('.ca').forEach(e=>{const t=+e.dataset.t,d=1400,s=performance.now();(function u(n){const p=Math.min((n-s)/d,1),e2=p===1?1:1-Math.pow(2,-10*p);e.textContent=Math.floor(e2*t);if(p<1)requestAnimationFrame(u);else e.textContent=t})(s)})}
function aP(){document.querySelectorAll('.pf').forEach(e=>{setTimeout(()=>{e.style.width=e.dataset.w},300)})}

function toast(type,msg){
    const c=document.getElementById('toastC'),t=document.createElement('div');t.className='toast';
    const m={ok:{i:'fa-check',b:'var(--ok-d)',c:'var(--ok)'},err:{i:'fa-times',b:'var(--err-d)',c:'var(--err)'},warn:{i:'fa-exclamation',b:'var(--warn-d)',c:'var(--warn)'},info:{i:'fa-info',b:'var(--info-d)',c:'var(--info)'}};
    const cfg=m[type]||m.info;
    t.innerHTML=`<div class="ti" style="background:${cfg.b};color:${cfg.c}"><i class="fas ${cfg.i}"></i></div><span>${msg}</span>`;
    c.appendChild(t);setTimeout(()=>{t.classList.add('tout');setTimeout(()=>t.remove(),250)},3200);
}

function opModal(ti,ms,bt,bc,cb){document.getElementById('moT').textContent=ti;document.getElementById('moM').textContent=ms;const b=document.getElementById('moB');b.textContent=bt;b.className='btn '+bc;mCb=cb;document.getElementById('mo').classList.add('act')}
function clModal(){document.getElementById('mo').classList.remove('act');mCb=null}
function cfModal(){if(mCb)mCb();clModal()}
document.addEventListener('keydown',e=>{if(e.key==='Escape')clModal()});

document.querySelectorAll('.sb-item').forEach(i=>{i.addEventListener('click',function(){document.querySelectorAll('.sb-item').forEach(x=>x.classList.remove('on'));this.classList.add('on');if(innerWidth<=768)document.getElementById('sb').classList.remove('open')})});

function gF(){
    const s=document.getElementById('sI').value.toLowerCase(),pf=document.getElementById('fP').value,sf=document.getElementById('fS').value;
    return M.filter(m=>{const ms=m.name.toLowerCase().includes(s)||m.email.toLowerCase().includes(s);const mp=pf==='all'||(pf==='paid'?m.paid:!m.paid);const mt=sf==='all'||m.st===sf;return ms&&mp&&mt})
}
function rT(){
    const f=gF(),tot=f.length,tp=Math.max(1,Math.ceil(tot/pp));if(pg>tp)pg=tp;
    const st=(pg-1)*pp,pd=f.slice(st,st+pp),tb=document.getElementById('tB');tb.innerHTML='';
    if(!pd.length){tb.innerHTML=`<tr><td colspan="7" style="text-align:center;padding:36px;color:var(--muted)"><i class="fas fa-inbox" style="font-size:24px;display:block;margin-bottom:8px;opacity:.35"></i>Tidak ada data yang cocok</td></tr>`}
    else pd.forEach((m,i)=>{
        const ini=m.name.split(' ').map(w=>w[0]).join('').substring(0,2);
        const pb=m.paid?`<span class="badge b-ok"><span class="bd"></span>Sudah Bayar</span>`:`<span class="badge b-err"><span class="bd"></span>Belum Bayar</span>`;
        let sb='';if(m.st==='pending')sb=`<span class="badge b-warn"><span class="bd"></span>Menunggu</span>`;else if(m.st==='verified')sb=`<span class="badge b-ok"><span class="bd"></span>Terverifikasi</span>`;else sb=`<span class="badge b-err"><span class="bd"></span>Ditolak</span>`;
        let ac='';if(m.st==='pending'){if(m.paid)ac=`<button class="btn btn-ok" onclick="vM(${m.id})"><i class="fas fa-check"></i> Verifikasi</button><button class="btn btn-err" onclick="rM(${m.id})"><i class="fas fa-times"></i></button>`;else ac=`<button class="btn btn-lk" disabled><i class="fas fa-lock"></i> Verifikasi</button><button class="btn btn-err" onclick="rM(${m.id})"><i class="fas fa-times"></i></button>`}else if(m.st==='verified')ac=`<span class="badge b-ok"><i class="fas fa-check-circle"></i> Aktif</span>`;else ac=`<span class="badge b-mut"><i class="fas fa-ban"></i> Ditolak</span>`;
        const r=document.createElement('tr');r.innerHTML=`<td style="color:var(--muted);font-weight:600">${st+i+1}</td><td><div class="mi"><div class="ma" style="background:${m.av}">${ini}</div><div><div class="mn">${m.name}</div><div class="me">${m.email}</div></div></div></td><td style="color:var(--muted)">${m.phone}</td><td style="color:var(--muted)">${fD(m.date)}</td><td>${pb}</td><td>${sb}</td><td><div class="ab">${ac}</div></td>`;tb.appendChild(r)
    });
    document.getElementById('tI').textContent=tot===0?'Tidak ada data':`Menampilkan ${st+1}-${Math.min(st+pp,tot)} dari ${tot} data`;rP(tp)
}
function rP(tp){const c=document.getElementById('pgn');c.innerHTML='';if(tp<=1)return;const p=document.createElement('button');p.className='pb2';p.innerHTML='<i class="fas fa-chevron-left" style="font-size:9px"></i>';p.style.opacity=pg===1?'.3':'1';p.onclick=()=>{if(pg>1){pg--;rT()}};c.appendChild(p);for(let i=1;i<=tp;i++){const b=document.createElement('button');b.className='pb2'+(i===pg?' on':'');b.textContent=i;b.onclick=()=>{pg=i;rT()};c.appendChild(b)}const n=document.createElement('button');n.className='pb2';n.innerHTML='<i class="fas fa-chevron-right" style="font-size:9px"></i>';n.style.opacity=pg===tp?'.3':'1';n.onclick=()=>{if(pg<tp){pg++;rT()}};c.appendChild(n)}
function fT(){pg=1;rT()}
function fD(d){const m=['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],dt=new Date(d);return`${dt.getDate()} ${m[dt.getMonth()]} ${dt.getFullYear()}`}

function vM(id){const m=M.find(x=>x.id===id);if(!m||!m.paid)return;opModal('Verifikasi Anggota',`Apakah Anda yakin ingin memverifikasi ${m.name} sebagai anggota resmi divisi ${m.div}?`,'Ya, Verifikasi','btn-ok',()=>{m.st='verified';rT();uB();toast('ok',`${m.name} berhasil diverifikasi`);acts.unshift({t:`<strong>${m.name}</strong> berhasil diverifikasi sebagai anggota baru divisi ${m.div}`,tm:'Baru saja',c:'var(--ok)'});rA()})}
function rM(id){const m=M.find(x=>x.id===id);if(!m)return;opModal('Tolak Pendaftaran',`Apakah Anda yakin ingin menolak pendaftaran ${m.name}? Tindakan ini tidak dapat dibatalkan.`,'Ya, Tolak','btn-err',()=>{m.st='rejected';rT();uB();toast('err',`Pendaftaran ${m.name} ditolak`);acts.unshift({t:`<strong>${m.name}</strong> ditolak — pendaftaran tidak memenuhi syarat`,tm:'Baru saja',c:'var(--err)'});rA()})}
function uB(){const c=M.filter(m=>m.st==='pending').length,b=document.getElementById('sbB');b.textContent=c;b.style.display=c>0?'inline':'none'}

function rA(){const c=document.getElementById('aL');c.innerHTML='';acts.slice(0,8).forEach((a,i)=>{const l=i===Math.min(acts.length,8)-1;const d=document.createElement('div');d.className='ai';d.innerHTML=`<div class="adw"><div class="adt" style="background:${a.c}"></div>${!l?'<div class="aln"></div>':''}</div><div><div class="atx">${a.t}</div><div class="atm">${a.tm}</div></div>`;c.appendChild(d)})}

let tCh=null;
const d6={l:['Jan','Feb','Mar','Apr','Mei','Jun'],p:[28,35,22,40,38,44],v:[24,30,18,34,32,27],r:[2,3,2,4,3,5]};
const d1={l:['Jul','Agu','Sep','Okt','Nov','Des','Jan','Feb','Mar','Apr','Mei','Jun'],p:[20,25,30,18,32,26,28,35,22,40,38,44],v:[17,22,26,15,28,22,24,30,18,34,32,27],r:[1,1,2,1,2,2,2,3,2,4,3,5]};
function cTC(d){const ctx=document.getElementById('trendC').getContext('2d');if(tCh)tCh.destroy();tCh=new Chart(ctx,{type:'bar',data:{labels:d.l,datasets:[{label:'Pendaftar',data:d.p,backgroundColor:'rgba(229,155,42,.65)',borderColor:'rgba(229,155,42,1)',borderWidth:1,borderRadius:5,borderSkipped:false},{label:'Terverifikasi',data:d.v,backgroundColor:'rgba(45,212,160,.65)',borderColor:'rgba(45,212,160,1)',borderWidth:1,borderRadius:5,borderSkipped:false},{label:'Ditolak',data:d.r,backgroundColor:'rgba(240,96,96,.65)',borderColor:'rgba(240,96,96,1)',borderWidth:1,borderRadius:5,borderSkipped:false}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{position:'top',align:'end',labels:{color:'#6b7194',font:{family:'DM Sans',size:10,weight:'600'},boxWidth:10,boxHeight:10,borderRadius:2,useBorderRadius:true,padding:14}},tooltip:{backgroundColor:'#161a25',titleColor:'#eef0f6',bodyColor:'#6b7194',borderColor:'#232838',borderWidth:1,cornerRadius:7,titleFont:{family:'Outfit',weight:'700'},bodyFont:{family:'DM Sans'},padding:10}},scales:{x:{grid:{color:'rgba(35,40,56,.5)',drawBorder:false},ticks:{color:'#6b7194',font:{family:'DM Sans',size:10}},border:{display:false}},y:{grid:{color:'rgba(35,40,56,.5)',drawBorder:false},ticks:{color:'#6b7194',font:{family:'DM Sans',size:10}},border:{display:false},beginAtZero:true}},interaction:{intersect:false,mode:'index'}})}
function swChart(b,p){document.querySelectorAll('.cfb').forEach(x=>x.classList.remove('on'));b.classList.add('on');cTC(p==='6m'?d6:d1)}

function cSC(){
    const ctx=document.getElementById('statC').getContext('2d'),v=[348,12,27,5,7],l=['Aktif','Menunggu','Baru Diverifikasi','Ditolak','Non-Aktif'],c=['#e59b2a','#f5bf24','#2dd4a0','#f06060','#6b7194'];
    new Chart(ctx,{type:'doughnut',data:{labels:l,datasets:[{data:v,backgroundColor:c,borderWidth:0,spacing:2,borderRadius:3}]},options:{responsive:true,maintainAspectRatio:false,cutout:'72%',plugins:{legend:{display:false},tooltip:{backgroundColor:'#161a25',titleColor:'#eef0f6',bodyColor:'#6b7194',borderColor:'#232838',borderWidth:1,cornerRadius:7,titleFont:{family:'Outfit',weight:'700'},bodyFont:{family:'DM Sans'},padding:10,callbacks:{label:function(ctx){const t=ctx.dataset.data.reduce((a,b)=>a+b,0);return` ${ctx.label}: ${ctx.parsed} (${((ctx.parsed/t)*100).toFixed(1)}%)`}}}}}});
    const lg=document.getElementById('sLeg'),tot=v.reduce((a,b)=>a+b,0);
    l.forEach((lb,i)=>{const pct=((v[i]/tot)*100).toFixed(1);lg.innerHTML+=`<div style="display:flex;align-items:center;justify-content:space-between;font-size:11px"><div style="display:flex;align-items:center;gap:7px"><div style="width:9px;height:9px;border-radius:2px;background:${c[i]}"></div><span style="color:var(--muted)">${lb}</span></div><div style="display:flex;align-items:center;gap:8px"><span style="font-weight:700">${v[i]}</span><span style="color:var(--muted);font-size:10px;width:38px;text-align:right">${pct}%</span></div></div>`})
}

function cDC(){const ctx=document.getElementById('divC').getContext('2d');new Chart(ctx,{type:'bar',data:{labels:['Pendidikan','Humas','Teknologi','Keuangan'],datasets:[{label:'Pendaftar',data:[14,11,10,9],backgroundColor:['rgba(229,155,42,.7)','rgba(45,212,160,.7)','rgba(94,158,245,.7)','rgba(240,96,96,.7)'],borderWidth:0,borderRadius:5,borderSkipped:false}]},options:{indexAxis:'y',responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false},tooltip:{backgroundColor:'#161a25',titleColor:'#eef0f6',bodyColor:'#6b7194',borderColor:'#232838',borderWidth:1,cornerRadius:7,titleFont:{family:'Outfit',weight:'700'},bodyFont:{family:'DM Sans'},padding:10,callbacks:{label:ctx=>` ${ctx.parsed.x} pendaftar`}}},scales:{x:{grid:{color:'rgba(35,40,56,.5)',drawBorder:false},ticks:{color:'#6b7194',font:{family:'DM Sans',size:10}},border:{display:false},beginAtZero:true},y:{grid:{display:false},ticks:{color:'#eef0f6',font:{family:'DM Sans',size:11,weight:'600'}},border:{display:false}}}})}

document.addEventListener('DOMContentLoaded',()=>{aC();aP();rT();rA();cTC(d6);cSC();cDC()});
</script>
</body>
</html>