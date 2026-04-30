# Rancang Bangun Website Manajemen Keuangan, Anggota, Aset, dan Pusat Informasi RKM Al-Jannah Banyuwangi

## Kelompok GeoDev Creator 

Nama Anggota :
1. Rusydi Jabir Al-awfa
2. M. Rakha Widya Ardhana
3. Alfin Nazatil Kirom
4. Leni Ayu Pratiwi
5. Intan Rahma Safira

resources/views/
│
├── layouts/
│   ├── app.blade.php                 # Layout utama (navbar, sidebar, footer)
│   └── public.blade.php              # Layout untuk halaman publik (tanpa login)
│
├── auth/
│   ├── login.blade.php               # Form login (untuk semua pengurus)
│   ├── register.blade.php            # Pendaftaran calon anggota (via web)
│   ├── forgot-password.blade.php     # Lupa password
│   ├── reset-password.blade.php      # Reset password
│   └── verifikasi-pendaftaran.blade.php  # Halaman info setelah daftar (menunggu verifikasi)
│
├── public/                            # Halaman yang bisa diakses publik
│   ├── index.blade.php                # Beranda (profil singkat, berita terbaru)
│   ├── profil.blade.php               # Profil organisasi (visi, misi, sejarah)
│   ├── struktur.blade.php             # Struktur kepengurusan
│   ├── berita.blade.php               # Daftar artikel/berita kegiatan
│   ├── berita-detail.blade.php        # Detail artikel
│   ├── layanan.blade.php              # Informasi layanan (jenazah, ambulans, dll)
│   ├── kontak.blade.php               # Kontak dan peta lokasi
│   └── pendaftaran.blade.php          # Form pendaftaran anggota (sama dengan auth/register)
│
├── dashboard/
│   ├── index.blade.php                # Redirect ke dashboard sesuai role
│   ├── ketua.blade.php                # Dashboard Ketua (widget, grafik, ringkasan)
│   ├── sekretaris.blade.php           # Dashboard Sekretaris (statistik anggota)
│   ├── bendahara.blade.php            # Dashboard Bendahara (saldo, transaksi terbaru)
│   ├── logistik.blade.php             # Dashboard Logistik (stok barang, pemakaian)
│   ├── adminweb.blade.php             # Dashboard Admin Web (ringkasan artikel)
│   ├── anggota.blade.php              # Dashboard Anggota (profil, iuran)
│   └── superadmin.blade.php           # Dashboard Super Admin (statistik sistem)
│
├── anggota/
│   ├── index.blade.php                # Daftar anggota (dengan fitur filter, search)
│   ├── create.blade.php               # Form tambah anggota (manual oleh sekretaris)
│   ├── edit.blade.php                 # Form edit data anggota
│   ├── show.blade.php                 # Detail profil anggota (riwayat iuran, info pribadi)
│   ├── verifikasi.blade.php           # Daftar calon anggota menunggu verifikasi (sekretaris)
│   ├── verifikasi-detail.blade.php    # Detail calon anggota + aksi (setujui/tolak/perbaiki)
│   ├── tanggungan.blade.php           # Manajemen nama tertanggung (untuk anggota)
│   └── import.blade.php               # Import anggota dari Excel (opsional)
│
├── keuangan/
│   ├── pemasukan/
│   │   ├── index.blade.php            # Daftar transaksi pemasukan
│   │   ├── create.blade.php           # Form catat pemasukan (bendahara)
│   │   └── edit.blade.php             # Edit pemasukan (jika diperlukan)
│   ├── pengeluaran/
│   │   ├── index.blade.php            # Daftar transaksi pengeluaran
│   │   ├── create.blade.php           # Form catat pengeluaran
│   │   └── edit.blade.php             # Edit pengeluaran
│   ├── iuran/
│   │   ├── index.blade.php            # Daftar iuran anggota per bulan/tahun
│   │   ├── create.blade.php           # Input iuran massal (per anggota)
│   │   └── history.blade.php          # Riwayat iuran per anggota
│   ├── laporan/
│   │   ├── keuangan.blade.php         # Laporan keuangan (filter periode)
│   │   ├── iuran.blade.php            # Laporan iuran anggota
│   │   └── preview.blade.php          # Preview laporan sebelum export
│   └── rekapitulasi.blade.php          # Rekap saldo, pemasukan, pengeluaran
│
├── aset/
│   ├── index.blade.php                # Daftar barang aset/inventaris
│   ├── create.blade.php               # Form tambah aset
│   ├── edit.blade.php                 # Edit data aset
│   ├── penggunaan/
│   │   ├── index.blade.php            # Daftar permintaan / penggunaan barang
│   │   ├── create.blade.php           # Form pengajuan penggunaan (logistik)
│   │   ├── konfirmasi.blade.php       # Halaman konfirmasi penggunaan (stok berkurang)
│   │   └── show.blade.php             # Detail penggunaan
│   ├── stok-minimal.blade.php         # Notifikasi barang stok menipis
│   └── kategorisasi.blade.php         # Kategori aset (jika diperlukan)
│
├── konten/
│   ├── artikel/
│   │   ├── index.blade.php            # Daftar artikel (admin web)
│   │   ├── create.blade.php           # Form buat artikel baru
│   │   ├── edit.blade.php             # Edit artikel
│   │   └── show.blade.php             # Preview artikel sebelum publish
│   ├── kategori.blade.php             # Manajemen kategori berita
│   └── pengumuman.blade.php           # Manajemen pengumuman (banner/alert)
│
├── audit/
│   ├── log.blade.php                  # Tabel audit log (filter, pagination)
│   └── detail.blade.php               # Detail suatu log (jika diperlukan)
│
├── user/
│   ├── index.blade.php                # Daftar pengguna sistem (superadmin)
│   ├── create.blade.php               # Tambah pengguna baru
│   ├── edit.blade.php                 # Edit pengguna (role, nama, email)
│   ├── reset-password.blade.php       # Form reset password manual
│   └── role.blade.php                 # Manajemen role (jika ada tambahan)
│
├── laporan/                           # Laporan export (PDF/Excel) – bisa terpisah
│   └── download.blade.php             # Halaman sementara generate download
│
└── partials/
    ├── navbar.blade.php               # Komponen navbar (beda per role)
    ├── sidebar-ketua.blade.php
    ├── sidebar-sekretaris.blade.php
    ├── sidebar-bendahara.blade.php
    ├── sidebar-logistik.blade.php
    ├── sidebar-adminweb.blade.php
    ├── sidebar-superadmin.blade.php
    ├── sidebar-anggota.blade.php
    ├── footer.blade.php
    └── scripts.blade.php              # JS global, notifikasi, konfirmasi
