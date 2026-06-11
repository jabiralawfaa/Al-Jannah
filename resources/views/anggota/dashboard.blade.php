<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RKM Al-Jannah - Detail Pembayaran</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: { sans: ['Inter', 'sans-serif'] },
          colors: {
            brand: {
              green: '#16a34a',
              'green-light': '#dcfce7',
              'green-dark': '#15803d',
              red: '#dc2626',
              'red-light': '#fee2e2',
              'red-dark': '#b91c1c',
              orange: '#ea580c',
              'orange-light': '#fff7ed',
              blue: '#2563eb',
              'blue-light': '#dbeafe',
            }
          }
        }
      }
    }
  </script>
  <style>
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
      animation: fadeInUp 0.6s ease-out forwards;
    }
    .delay-1 { animation-delay: 0.1s; opacity: 0; }
    .delay-2 { animation-delay: 0.2s; opacity: 0; }
    .delay-3 { animation-delay: 0.3s; opacity: 0; }
    .delay-4 { animation-delay: 0.4s; opacity: 0; }
    .delay-5 { animation-delay: 0.5s; opacity: 0; }

    @keyframes pulse-dot {
      0%, 100% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.4); opacity: 0.6; }
    }
    .pulse-dot { animation: pulse-dot 2s ease-in-out infinite; }

    .status-lunas {
      background: linear-gradient(135deg, #dcfce7, #bbf7d0);
      color: #15803d;
      border: 1px solid #86efac;
    }
    .status-belum {
      background: linear-gradient(135deg, #fee2e2, #fecaca);
      color: #b91c1c;
      border: 1px solid #fca5a5;
    }

    .card-shadow {
      box-shadow: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
    }
    .card-shadow-md {
      box-shadow: 0 4px 6px -1px rgba(0,0,0,0.07), 0 2px 4px -2px rgba(0,0,0,0.05);
    }
    .card-shadow-lg {
      box-shadow: 0 10px 15px -3px rgba(0,0,0,0.08), 0 4px 6px -4px rgba(0,0,0,0.04);
    }

    body {
      background: linear-gradient(160deg, #f0fdf4 0%, #f8fafc 30%, #ffffff 60%, #f0fdf4 100%);
      min-height: 100vh;
    }

    .stat-card {
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .stat-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 4px 6px -4px rgba(0,0,0,0.05);
    }

    .month-row {
      transition: all 0.2s ease;
    }
    .month-row:hover {
      background-color: #f0fdf4;
    }

    .exit-btn {
      transition: all 0.3s ease;
    }
    .exit-btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }

    @media print {
      .no-print { display: none !important; }
      body { background: white !important; }
    }
  </style>
</head>
<body class="font-sans text-slate-900 antialiased">

  <nav class="fixed top-0 left-0 right-0 z-50 h-16 bg-white/85 backdrop-blur-xl border-b border-slate-200/60 card-shadow">
    <div class="max-w-6xl mx-auto h-full px-4 sm:px-6 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center shadow-md">
          <span class="iconify text-white text-lg" data-icon="lucide:mosque"></span>
        </div>
        <div>
          <h1 class="text-base font-semibold text-slate-900 leading-tight">RKM Al-Jannah</h1>
          <p class="text-[10px] text-slate-400 font-medium tracking-wide uppercase">Sistem Pembayaran</p>
        </div>
      </div>
      <div class="flex items-center gap-2 no-print">
        <form method="POST" action="{{ route('anggota.logout') }}" style="display:inline;">
          @csrf
          <button type="submit" class="exit-btn flex items-center gap-2 px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600">
            <span class="iconify text-base" data-icon="lucide:log-out"></span>
            Keluar
          </button>
        </form>
      </div>
    </div>
  </nav>

  <main class="pt-24 pb-12 px-4 sm:px-6">
    <div class="max-w-6xl mx-auto space-y-6">

      <div class="animate-fade-in-up delay-1 bg-white rounded-2xl card-shadow-lg border border-slate-100 overflow-hidden">
        <div class="relative bg-gradient-to-r from-green-600 via-green-500 to-emerald-500 px-6 py-5">
          <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" viewBox="0 0 400 100" preserveAspectRatio="none">
              <path d="M0,50 Q100,0 200,50 T400,50 L400,100 L0,100 Z" fill="white"/>
              <circle cx="350" cy="30" r="40" fill="white" opacity="0.15"/>
              <circle cx="50" cy="20" r="25" fill="white" opacity="0.1"/>
            </svg>
          </div>
          <div class="relative flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30">
              <span class="iconify text-white text-2xl" data-icon="lucide:user-circle-2"></span>
            </div>
            <div class="flex-1">
              <h2 class="text-xl font-semibold text-white">{{ $anggota->nama }}</h2>
              <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-1">
                <span class="text-green-100 text-sm font-medium flex items-center gap-1.5">
                  <span class="iconify text-xs" data-icon="lucide:hash"></span>
                  {{ $anggota->nomor_anggota }}
                </span>
                @if ($anggota->telepon)
                <span class="text-green-100 text-sm font-medium flex items-center gap-1.5">
                  <span class="iconify text-xs" data-icon="lucide:phone"></span>
                  {{ $anggota->telepon }}
                </span>
                @endif
                @if ($anggota->alamat)
                <span class="text-green-100 text-sm font-medium flex items-center gap-1.5">
                  <span class="iconify text-xs" data-icon="lucide:map-pin"></span>
                  {{ $anggota->alamat }}
                </span>
                @endif
              </div>
            </div>
            <div class="hidden sm:flex items-center gap-1.5 bg-white/20 backdrop-blur-sm rounded-full px-3 py-1.5 border border-white/30">
              <span class="w-2 h-2 rounded-full bg-green-300 pulse-dot"></span>
              <span class="text-white text-xs font-medium">{{ $anggota->status === 'aktif' ? 'Aktif' : 'Nonaktif' }}</span>
            </div>
          </div>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 animate-fade-in-up delay-2">
        <div class="stat-card bg-white rounded-2xl card-shadow-md border border-slate-100 p-5 relative overflow-hidden">
          <div class="absolute top-0 right-0 w-20 h-20 bg-orange-50 rounded-bl-[3rem] -mr-2 -mt-2"></div>
          <div class="relative">
            <div class="flex items-center gap-3 mb-3">
              <div class="w-10 h-10 rounded-xl bg-orange-100 flex items-center justify-center">
                <span class="iconify text-orange-600 text-xl" data-icon="lucide:wallet"></span>
              </div>
              <p class="text-sm font-medium text-slate-500">Total Harus Dibayar</p>
            </div>
            <p class="text-2xl font-bold text-slate-900 tracking-tight">Rp {{ number_format($totalHarusDibayar, 0, ',', '.') }}</p>
            <p class="text-xs text-slate-400 mt-1">Sisa kewajiban pembayaran</p>
          </div>
        </div>

        <div class="stat-card bg-white rounded-2xl card-shadow-md border border-slate-100 p-5 relative overflow-hidden">
          <div class="absolute top-0 right-0 w-20 h-20 bg-green-50 rounded-bl-[3rem] -mr-2 -mt-2"></div>
          <div class="relative">
            <div class="flex items-center gap-3 mb-3">
              <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                <span class="iconify text-green-600 text-xl" data-icon="lucide:check-circle-2"></span>
              </div>
              <p class="text-sm font-medium text-slate-500">Sudah Dibayar</p>
            </div>
            <p class="text-2xl font-bold text-green-600 tracking-tight">Rp {{ number_format($totalSudahDibayar, 0, ',', '.') }}</p>
            <p class="text-xs text-slate-400 mt-1">Total pembayaran diterima</p>
          </div>
        </div>

        <div class="stat-card bg-white rounded-2xl card-shadow-md border border-slate-100 p-5 relative overflow-hidden">
          <div class="absolute top-0 right-0 w-20 h-20 bg-blue-50 rounded-bl-[3rem] -mr-2 -mt-2"></div>
          <div class="relative">
            <div class="flex items-center gap-3 mb-3">
              <div class="w-10 h-10 rounded-xl bg-blue-100 flex items-center justify-center">
                <span class="iconify text-blue-600 text-xl" data-icon="lucide:calendar-check"></span>
              </div>
              <p class="text-sm font-medium text-slate-500">Iuran Bulanan</p>
            </div>
            <p class="text-2xl font-bold text-slate-900 tracking-tight">Rp {{ number_format($nominalPerBulan, 0, ',', '.') }}</p>
            <p class="text-xs text-slate-400 mt-1">Per bulan / KK</p>
          </div>
        </div>
      </div>

      <div class="animate-fade-in-up delay-3 bg-white rounded-2xl card-shadow-md border border-slate-100 p-5">
        <div class="flex items-center justify-between mb-3">
          <p class="text-sm font-medium text-slate-600">Progress Pembayaran {{ $tahun }}</p>
          <p class="text-sm font-semibold text-green-600">{{ $totalLunas }} / 12 bulan</p>
        </div>
        <div class="w-full h-3 bg-slate-100 rounded-full overflow-hidden">
          <div class="h-full bg-gradient-to-r from-green-500 to-emerald-400 rounded-full transition-all duration-1000 ease-out" style="width: 0%" id="progressBar"></div>
        </div>
        <div class="flex justify-between mt-2">
          <span class="text-xs text-slate-400">Jan</span>
          <span class="text-xs text-slate-400">Des</span>
        </div>
      </div>

      <div class="animate-fade-in-up delay-4 bg-white rounded-2xl card-shadow-lg border border-slate-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
              <span class="iconify text-green-600 text-base" data-icon="lucide:table-2"></span>
            </div>
            <div>
              <h3 class="text-base font-semibold text-slate-900">Rincian Pembayaran Bulanan</h3>
              <p class="text-xs text-slate-400">Periode Januari - Desember {{ $tahun }}</p>
            </div>
          </div>
          <div class="hidden sm:flex items-center gap-4 text-xs">
            <span class="flex items-center gap-1.5">
              <span class="w-2.5 h-2.5 rounded-full bg-green-500"></span>
              Lunas
            </span>
            <span class="flex items-center gap-1.5">
              <span class="w-2.5 h-2.5 rounded-full bg-red-400"></span>
              Belum Lunas
            </span>
          </div>
        </div>

        <div class="overflow-x-auto">
          <table class="w-full">
            <thead>
              <tr class="bg-slate-50/80">
                <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">No</th>
                <th class="text-left px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Bulan</th>
                <th class="text-center px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Iuran</th>
                <th class="text-center px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                <th class="text-center px-6 py-3 text-xs font-semibold text-slate-500 uppercase tracking-wider">Keterangan</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($iuranBulanan as $index => $ib)
              <tr class="month-row border-b border-slate-50 {{ $index % 2 === 1 ? 'bg-slate-50/30' : '' }}">
                <td class="px-6 py-3.5">
                  <span class="text-sm font-medium text-slate-400">{{ str_pad($ib['bulan'], 2, '0', STR_PAD_LEFT) }}</span>
                </td>
                <td class="px-6 py-3.5">
                  <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg {{ $ib['lunas'] ? 'bg-green-100' : 'bg-red-50' }} flex items-center justify-center">
                      <span class="iconify {{ $ib['lunas'] ? 'text-green-500' : 'text-red-400' }} text-sm" data-icon="{{ $ib['lunas'] ? 'lucide:calendar-check' : 'lucide:calendar-x' }}"></span>
                    </div>
                    <span class="text-sm font-medium text-slate-700">{{ $ib['nama_bulan'] }}</span>
                  </div>
                </td>
                <td class="px-6 py-3.5 text-center">
                  <span class="text-sm {{ $ib['lunas'] ? 'text-slate-700' : 'text-red-500 font-semibold' }}">Rp {{ number_format($ib['nominal'], 0, ',', '.') }}</span>
                </td>
                <td class="px-6 py-3.5 text-center">
                  @if ($ib['lunas'])
                  <span class="status-lunas inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold">
                    <span class="iconify text-xs" data-icon="lucide:check"></span>
                    Lunas
                  </span>
                  @else
                  <span class="status-belum inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold">
                    <span class="iconify text-xs" data-icon="lucide:x"></span>
                    Belum Lunas
                  </span>
                  @endif
                </td>
                <td class="px-6 py-3.5 text-center">
                  @if ($ib['lunas'])
                  <span class="text-xs text-slate-400">Dibayar</span>
                  @else
                  <span class="text-xs text-red-400 font-medium">Menunggu pembayaran</span>
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="px-6 py-4 bg-gradient-to-r from-slate-50 to-green-50/50 border-t border-slate-100">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center">
                <span class="iconify text-orange-600 text-base" data-icon="lucide:calculator"></span>
              </div>
              <div>
                <p class="text-sm font-semibold text-slate-900">Total Harus Dibayar</p>
                <p class="text-xs text-slate-400">{{ $totalBelum }} bulan belum dibayar &times; Rp {{ number_format($nominalPerBulan, 0, ',', '.') }}</p>
               </div>
            </div>
            <p class="text-xl font-bold text-orange-600">Rp {{ number_format($totalHarusDibayar, 0, ',', '.') }}</p>
          </div>
        </div>
      </div>

      <div class="animate-fade-in-up delay-5 text-center py-4">
        <p class="text-xs text-slate-400">RKM Al-Jannah &mdash; Sistem Informasi Pembayaran Iuran &copy; {{ date('Y') }}</p>
        <p class="text-[10px] text-slate-300 mt-1">Dokumen ini dicetak secara otomatis dan tidak memerlukan tanda tangan basah.</p>
      </div>

    </div>
  </main>

  <script>
    window.addEventListener('load', function() {
      var bar = document.getElementById('progressBar');
      if (bar) {
        setTimeout(function() {
          bar.style.width = '{{ $progressPersen }}%';
        }, 500);
      }
    });
  </script>

</body>
</html>
