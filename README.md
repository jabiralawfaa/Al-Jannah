# Rancang Bangun Website Manajemen Keuangan, Anggota, Aset, dan Pusat Informasi RKM Al-Jannah Banyuwangi

## Kelompok GeoDev Creator 

Nama Anggota :
1. Rusydi Jabir Al-awfa
2. M. Rakha Widya Ardhana
3. Alfin Nazatil Kirom
4. Leni Ayu Pratiwi
5. Intan Rahma Safira


# 📋 Sistem Informasi Organisasi — Struktur Views

> Dokumentasi lengkap struktur file `resources/views/` untuk aplikasi manajemen organisasi berbasis **Laravel Blade**. Sistem ini mendukung **multi-role** dengan antarmuka yang disesuaikan berdasarkan jabatan pengguna.

---

## 🗂️ Ringkasan Struktur

```
resources/views/
├── layouts/          → Template layout utama
├── auth/             → Autentikasi & pendaftaran
├── public/           → Halaman publik (tanpa login)
├── dashboard/        → Dashboard per role
├── anggota/          → Manajemen data anggota
├── keuangan/         → Keuangan, iuran & laporan
├── aset/             → Inventaris & logistik
├── konten/           → Artikel, kategori & pengumuman
├── audit/            → Log aktivitas sistem
├── user/             → Manajemen pengguna sistem
├── laporan/          → Halaman download laporan
└── partials/         → Komponen UI reusable
```

---

## 🧱 Layouts

| File | Deskripsi |
|---|---|
| `layouts/app.blade.php` | Layout utama untuk halaman yang memerlukan autentikasi. Menyediakan struktur konsisten: **navbar → sidebar (dinamis per role) → konten → footer → scripts**. |
| `layouts/public.blade.php` | Layout khusus halaman publik. Lebih sederhana, tanpa sidebar, fokus pada navigasi umum dan footer. |

> **Catatan:** Kedua layout menggunakan `@yield('title')`, `@yield('content')`, dan `@stack('scripts')` sebagai slot utama.

---

## 🔐 Auth

Modul autentikasi untuk seluruh pengurus dan pendaftaran calon anggota baru.

| File | Deskripsi |
|---|---|
| `login.blade.php` | Form login tunggal untuk semua role. Redirect otomatis ke dashboard sesuai role setelah berhasil. |
| `register.blade.php` | Form pendaftaran calon anggota via web publik. Field meliputi data pribadi, alamat, kontak darurat, dan tanggungan. |
| `forgot-password.blade.php` | Form input email untuk meminta link reset password. |
| `reset-password.blade.php` | Form set password baru dari link yang dikirim via email. |
| `verifikasi-pendaftaran.blade.php` | Halaman informasi setelah pendaftaran berhasil, menampilkan pesan untuk menunggu verifikasi dari sekretaris. |

---

## 🌐 Public

Halaman-halaman yang dapat diakses tanpa login oleh siapa saja.

| File | Deskripsi |
|---|---|
| `index.blade.php` | **Beranda.** Menampilkan profil singkat organisasi, berita/kegiatan terbaru (3–5 item), dan CTA pendaftaran anggota. |
| `profil.blade.php` | Halaman profil lengkap: visi, misi, sejarah, dan tujuan organisasi. |
| `struktur.blade.php` | Visualisasi struktur kepengurusan (ketua, sekretaris, bendahara, dll.) dengan foto dan nama. |
| `berita.blade.php` | Daftar artikel/berita kegiatan dengan pagination, filter kategori, dan pencarian. |
| `berita-detail.blade.php` | Halaman detail artikel: judul, gambar, konten, tanggal, penulis, dan artikel terkait. |
| `layanan.blade.php` | Informasi layanan organisasi (pengurusan jenazah, ambulans, bantuan sosial, dll.). |
| `kontak.blade.php` | Informasi kontak, alamat, dan embed peta lokasi (Google Maps). |
| `pendaftaran.blade.php` | Mirror dari `auth/register.blade.php` — form pendaftaran anggota yang diakses dari halaman publik. |

---

## 📊 Dashboard

Setiap role memiliki dashboard tersendiri dengan widget dan ringkasan data yang relevan.

| File | Role | Konten Utama |
|---|---|---|
| `index.blade.php` | — | **Router view.** Tidak menampilkan apapun, langsung redirect ke dashboard sesuai role pengguna yang login. |
| `ketua.blade.php` | Ketua | Widget ringkasan: total anggota, saldo kas, kegiatan bulan ini, grafik pertumbuhan anggota. |
| `sekretaris.blade.php` | Sekretaris | Statistik anggota: aktif vs nonaktif, calon anggota menunggu verifikasi, anggota baru bulan ini. |
| `bendahara.blade.php` | Bendahara | Saldo kas saat ini, pemasukan vs pengeluaran bulan ini, transaksi 5 terakhir, grafik arus kas. |
| `logistik.blade.php` | Logistik | Stok barang total, barang menipis (stok < minimum), permintaan penggunaan pending. |
| `adminweb.blade.php` | Admin Web | Total artikel, draft vs published, pengumuman aktif, komentar terbaru (jika ada). |
| `anggota.blade.php` | Anggota | Profil singkat diri sendiri, status iuran bulan ini dan bulan lalu, pengumuman terbaru. |
| `superadmin.blade.php` | Super Admin | Statistik keseluruhan sistem: jumlah user per role, log aktivitas terbaru, status server/aplikasi. |

---

## 👥 Anggota

CRUD dan manajemen data anggota organisasi.

| File | Deskripsi |
|---|---|
| `index.blade.php` | Tabel daftar anggota dengan fitur **search**, **filter** (status: aktif/nonaktif), **sort**, dan **pagination**. Aksi: lihat detail, edit, hapus. |
| `create.blade.php` | Form tambah anggota secara manual oleh sekretaris (untuk input dari pendaftaran offline). |
| `edit.blade.php` | Form edit data anggota: data pribadi, alamat, pekerjaan, status keanggotaan. |
| `show.blade.php` | Detail profil anggota: data pribadi lengkap, riwayat pembayaran iuran, daftar tanggungan, catatan admin. |
| `verifikasi.blade.php` | Daftar calon anggota yang menunggu verifikasi. Hanya bisa diakses oleh **sekretaris**. |
| `verifikasi-detail.blade.php` | Detail calon anggota + aksi: **Setujui**, **Tolak** (dengan alasan), atau **Minta Perbaikan Data**. |
| `tanggungan.blade.php` | Manajemen nama-nama tertanggung yang terdaftar di bawah seorang anggota (untuk keperluan layanan kematian, dll.). |
| `import.blade.php` | Form upload file Excel untuk import data anggota massal (opsional, fitur tambahan). |

---

## 💰 Keuangan

Modul pencatatan keuangan, iuran anggota, dan pelaporan.

### Pemasukan
| File | Deskripsi |
|---|---|
| `pemasukan/index.blade.php` | Tabel daftar transaksi pemasukan dengan filter tanggal, kategori, dan sumber dana. |
| `pemasukan/create.blade.php` | Form catat pemasukan: tanggal, jumlah, kategori (iuran, donasi, dll.), keterangan, bukti transfer. |
| `pemasukan/edit.blade.php` | Form edit transaksi pemasukan yang sudah tercatat. |

### Pengeluaran
| File | Deskripsi |
|---|---|
| `pengeluaran/index.blade.php` | Tabel daftar transaksi pengeluaran dengan filter tanggal dan kategori. |
| `pengeluaran/create.blade.php` | Form catat pengeluaran: tanggal, jumlah, kategori (operasional, logistik, dll.), keterangan, bukti. |
| `pengeluaran/edit.blade.php` | Form edit transaksi pengeluaran. |

### Iuran
| File | Deskripsi |
|---|---|
| `iuran/index.blade.php` | Daftar status iuran per anggota, filter per bulan/tahun. Tampilan tabel checklist: ✓ lunas, ✗ belum. |
| `iuran/create.blade.php` | Form input pembayaran iuran: pilih anggota, bulan, tahun, jumlah, metode bayar. Mendukung **input massal**. |
| `iuran/history.blade.php` | Riwayat pembayaran iuran untuk satu anggota tertentu (diakses dari detail anggota). |

### Laporan
| File | Deskripsi |
|---|---|
| `laporan/keuangan.blade.php` | Halaman laporan keuangan umum: filter periode, tampilkan total pemasukan/pengeluaran/saldo. |
| `laporan/iuran.blade.php` | Laporan iuran anggota: filter per bulan/tahun, ringkasan lunas vs belum lunas. |
| `laporan/preview.blade.php` | Preview laporan dalam format tabel sebelum di-export ke PDF/Excel. |
| `rekapitulasi.blade.php` | Halaman rekapitulasi: saldo awal, total pemasukan, total pengeluaran, saldo akhir per periode. |

---

## 📦 Aset / Logistik

Manajemen inventaris dan penggunaan barang organisasi.

| File | Deskripsi |
|---|---|
| `index.blade.php` | Tabel daftar seluruh aset/inventaris dengan filter kategori dan kondisi (baik/rusak). |
| `create.blade.php` | Form tambah aset baru: nama, kategori, jumlah, kondisi, lokasi penyimpanan, foto. |
| `edit.blade.php` | Form edit data aset: update jumlah, kondisi, lokasi. |
| `penggunaan/index.blade.php` | Daftar permintaan/penggunaan barang dengan status (pending/dikembalikan). |
| `penggunaan/create.blade.php` | Form pengajuan penggunaan barang: pilih aset, jumlah, tanggal pinjam, tujuan. |
| `penggunaan/konfirmasi.blade.php` | Halaman konfirmasi penggunaan oleh logistik — menampilkan detail dan tombol **konfirmasi** (stok berkurang). |
| `penggunaan/show.blade.php` | Detail penggunaan: siapa peminjam, barang apa, kapan dikembalikan, catatan. |
| `stok-minimal.blade.php` | Daftar barang yang stoknya di bawah batas minimum. Berfungsi sebagai **early warning**. |
| `kategorisasi.blade.php` | Manajemen kategori aset (misal: Perlengkapan Rumah Tangga, Peralatan Kantor, dll.). |

---

## 📝 Konten

Modul pengelolaan konten website (CMS sederhana).

### Artikel
| File | Deskripsi |
|---|---|
| `artikel/index.blade.php` | Tabel daftar semua artikel dengan status (draft/published), filter kategori, aksi edit/hapus/publish. |
| `artikel/create.blade.php` | Form buat artikel: judul, slug, kategori, gambar cover, konten (editor WYSIWYG), status draft/publish. |
| `artikel/edit.blade.php` | Form edit artikel yang sudah ada. |
| `artikel/show.blade.php` | Preview artikel sebelum dipublish (tampilan sama dengan halaman publik). |

### Lainnya
| File | Deskripsi |
|---|---|
| `kategori.blade.php` | CRUD kategori berita/artikel (misal: Kegiatan, Pengumuman, Sosial). |
| `pengumuman.blade.php` | Manajemen pengumuman: banner slider di beranda, alert bar, pengumuman popup. Konfigurasi: aktif/nonaktif, tanggal tampil. |

---

## 📜 Audit

Pencatatan log aktivitas pengguna untuk keperluan transparansi dan keamanan.

| File | Deskripsi |
|---|---|
| `log.blade.php` | Tabel audit log dengan filter: user, aksi (create/read/update/delete), modul, tanggal. Pagination. |
| `detail.blade.php` | Detail satu log: siapa, kapan, modul apa, data sebelum dan sesudah perubahan (old vs new values). |

---

## 👤 User

Manajemen akun pengguna sistem. Hanya bisa diakses oleh **Super Admin**.

| File | Deskripsi |
|---|---|
| `index.blade.php` | Tabel daftar seluruh pengguna sistem dengan filter role dan status aktif. |
| `create.blade.php` | Form tambah pengguna baru: nama, email, role, password awal. |
| `edit.blade.php` | Form edit pengguna: ubah nama, email, role, status aktif/nonaktif. |
| `reset-password.blade.php` | Form reset password manual oleh super admin (untuk user yang lupa password dan tidak punya akses email). |
| `role.blade.php` | Manajemen role & permission tambahan jika diperlukan (opsional). |

---

## 📥 Laporan

| File | Deskripsi |
|---|---|
| `download.blade.php` | Halaman sementara saat generate laporan (PDF/Excel). Menampilkan loading spinner atau progress bar, lalu redirect ke file download. |

---

## 🧩 Partials

Komponen UI yang di-`@include` ke dalam layout atau view lain.

| File | Deskripsi |
|---|---|
| `navbar.blade.php` | Navigasi atas: logo, menu utama, notifikasi, dropdown profil user (logout). |
| `sidebar-ketua.blade.php` | Menu sidebar khusus **Ketua**: Dashboard, Anggota, Keuangan, Laporan, Audit Log. |
| `sidebar-sekretaris.blade.php` | Menu sidebar khusus **Sekretaris**: Dashboard, Anggota, Verifikasi, Import, Laporan. |
| `sidebar-bendahara.blade.php` | Menu sidebar khusus **Bendahara**: Dashboard, Pemasukan, Pengeluaran, Iuran, Laporan. |
| `sidebar-logistik.blade.php` | Menu sidebar khusus **Logistik**: Dashboard, Aset, Penggunaan Barang, Stok Minimal. |
| `sidebar-adminweb.blade.php` | Menu sidebar khusus **Admin Web**: Dashboard, Artikel, Kategori, Pengumuman. |
| `sidebar-superadmin.blade.php` | Menu sidebar khusus **Super Admin**: Dashboard, User, Role, Audit Log, Pengaturan Sistem. |
| `sidebar-anggota.blade.php` | Menu sidebar khusus **Anggota**: Dashboard, Profil Saya, Iuran Saya, Pengumuman. |
| `footer.blade.php` | Footer: copyright, link navigasi bawah, informasi kontak singkat. |
| `scripts.blade.php` | Script JS global: notifikasi SweetAlert2/Tostify, konfirmasi hapus, toggle sidebar, dan inisialisasi plugin. |

---

## 🔀 Alur Akses per Role

```
┌─────────────────────────────────────────────────────────────────┐
│                        LOGIN                                    │
│                          │                                      │
│            ┌─────────────┼─────────────┐                        │
│            ▼             ▼             ▼                        │
│     Publik          Calon Anggota   Pengurus                    │
│   (tanpa login)   (menunggu verif)  (punya akun)                │
│       │                 │               │                       │
│  public/*     verifikasi-pendaftaran  ──┤                       │
│                                    ┌────┴────┐                 │
│                                    ▼         ▼                 │
│                              Ketua      Sekretaris             │
│                            dashboard   dashboard               │
│                            sidebar     sidebar                 │
│                                    │         │                 │
│                              Bendahara  Logistik               │
│                              dashboard  dashboard               │
│                              sidebar    sidebar                 │
│                                    │         │                 │
│                             Admin Web   Anggota                │
│                             dashboard   dashboard               │
│                             sidebar     sidebar                 │
│                                    │                          │
│                              Super Admin                       │
│                              dashboard                         │
│                              sidebar                           │
└─────────────────────────────────────────────────────────────────┘
```

---

## 🛠️ Teknologi & Konvensi

| Aspek | Detail |
|---|---|
| **Framework** | Laravel (Blade Templating Engine) |
| **CSS Framework** | Bootstrap 5 / Tailwind CSS *(sesuaikan dengan proyek)* |
| **Icon** | Font Awesome / Heroicons |
| **Chart** | Chart.js / ApexCharts (untuk widget dashboard) |
| **Editor** | TinyMCE / Trix (untuk form artikel) |
| **Table** | DataTables / Livewire (untuk tabel dengan search & pagination) |
| **Notifikasi** | SweetAlert2 / Toastify |
| **Naming** | `kebab-case` untuk nama file, `snake_case` untuk variabel Blade |

---

## 📌 Catatan Penting

1. **Sidebar dinamis** — Layout `app.blade.php` harus mendeteksi role user yang login lalu meng-`@include` sidebar yang sesuai. Contoh:
   ```blade
   @if(auth()->user()->role === 'ketua')
       @include('partials.sidebar-ketua')
   @elseif(auth()->user()->role === 'sekretaris')
       @include('partials.sidebar-sekretaris')
   @endif
   ```

2. **Middleware** — Pastikan setiap route group dashboard dilindungi oleh middleware `auth` dan role-specific middleware agar tidak bisa diakses lintas role.

3. **Authorization** — Selain middleware route, tambahkan `@can` atau `@role` directive di dalam Blade untuk menyembunyikan tombol aksi yang tidak seharusnya terlihat.

4. **Halaman publik vs pendaftaran** — `public/pendaftaran.blade.php` dan `auth/register.blade.php` sebaiknya menggunakan view yang sama untuk menghindari duplikasi. Gunakan `@include` atau arahkan ke satu file.

5. **Export laporan** — File `laporan/download.blade.php` bersifat intermediate. Proses generate sebaiknya dilakukan di background (queue job) agar tidak blocking request.

---

## 📄 Lisensi

Proyek ini bersifat **internal** untuk keperluan organisasi. Distribusi tanpa izin tidak diperkenankan.

---

*Dokumentasi ini dibuat berdasarkan struktur `resources/views/`. Untuk dokumentasi API, database schema, dan panduan deployment, lihat dokumen terpisah.*
