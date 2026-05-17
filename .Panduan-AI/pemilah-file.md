# Pemilah File
### ✅ 1. DITERIMA (Accepted)
File-file ini umumnya aman, digunakan untuk kebutuhan operasional bisnis sehari-hari, dan tidak bisa dieksekusi langsung oleh sistem operasi untuk menjalankan perintah berbahaya.

**Dokumen & Teks:**
*   `.pdf` (Dokumen portabel)
*   `.doc`, `.docx` (Microsoft Word)
*   `.xls`, `.xlsx` (Microsoft Excel)
*   `.ppt`, `.pptx` (Microsoft PowerPoint)
*   `.odt`, `.ods`, `.odp` (OpenDocument / LibreOffice)
*   `.txt`, `.rtf` (Teks biasa & Rich Text)
*   `.csv` (Data terpisah koma)

**Gambar & Desain:**
*   `.jpg`, `.jpeg` (Gambar umum)
*   `.png` (Gambar transparan)
*   `.gif` (Gambar bergerak)
*   `.bmp`, `.tiff`, `.tif` (Gambar mentah/editing)
*   `.webp` (Gambar web modern)
*   `.psd`, `.ai`, `.indd` (File desain Adobe)
*   `.sketch` (File desain UI/UX)
*   `.eps` (Vektor)

**Audio & Video:**
*   `.mp3`, `.wav`, `.ogg`, `.flac`, `.aac` (Audio)
*   `.mp4`, `.avi`, `.mov`, `.mkv`, `.wmv`, `.webm`, `.flv` (Video)

**Arsip & Kompresi (Perlu Scan Antivirus di dalamnya):**
*   `.zip`, `.rar`, `.7z`, `.tar`, `.gz`

**Engineering & 3D (Jika organisasi Anda terkait manufaktur/arsitektur):**
*   `.dwg`, `.dxf` (AutoCAD)
*   `.stl`, `.obj` (3D Printing)

---

### ⚠️ 2. MENCURIGAKAN (Suspicious)
File-file ini **berpotensi sangat berbahaya** karena bisa mengandung skrip otomatis, makro, atau kode yang dieksekusi tanpa sepengetahuan pengguna. Namun, file ini terkadang **sangat dibutuhkan** untuk operasional tertentu (misal: divisi IT, Data, atau Keuangan). 
*Rekomendasi: File ini boleh diunggah, tapi harus melewati proses quarantined, scan antivirus ketat, atau persetujuan manual (approval) dari admin.*

**Dokumen dengan Makro / Kode Tersemat:**
*   `.docm`, `.xlsm`, `.pptm` (Dokumen Office yang mengandung Macro—**sering digunakan untuk malware**)
*   `.dotm`, `.xltm` (Template Office dengan Macro)

**Skrip & Kode Pemrograman (Berbahaya jika dieksekusi, tapi butuh oleh Developer):**
*   `.py` (Python)
*   `.java`, `.jar` (Java—jar bisa dieksekusi)
*   `.c`, `.cpp`, `.h` (C/C++ source code)
*   `.cs` (C# source code)
*   `.rb` (Ruby)
*   `.go` (Golang)
*   `.sh`, `.bash` (Shell script Linux)
*   `.ps1` (PowerShell script—**sangat berbahaya di tangan salah**)

**Web & Database (Berisiko injeksi jika di-host):**
*   `.sql` (Database dump—bisa mengandung malicious query)
*   `.xml`, `.xsd` (Bisa mengandung XXE / External Entity Attack)
*   `.svg` (Vektor web—**bisa disisipi kode JavaScript berbahaya**)
*   `.htm`, `.html` (Bisa mengandung skrip phishing/XSS)

**Image Disk & Virtualisasi:**
*   `.iso`, `.img` (File image—bisa berisi OS atau malware tersembunyi)
*   `.vhd`, `.vhdx` (Virtual Hard Disk)

---

### 🚫 3. DITOLAK (Rejected)
File ini adalah file eksekusi (executable), skrip sisi server, atau file sistem yang **tidak punya alasan bisnis** untuk diunggah ke dalam file management system biasa. File ini hampir pasti digunakan untuk menyusupkan malware, ransomware, atau backdoor.

**Eksekusi Windows:**
*   `.exe` (Executable)
*   `.msi` (Installer Windows)
*   `.bat`, `.cmd` (Batch script—sering dipakai ransomware)
*   `.com` (Executable DOS)
*   `.scr` (Screensaver—sebenarnya adalah file `.exe` yang diganti nama)
*   `.pif` (Program Information File)
*   `.vbs`, `.vbe` (VBScript—paling sering dipakai virus otomatis)
*   `.wsf`, `.wsh` (Windows Script)
*   `.cpl` (Control Panel Item—bisa dieksekusi)
*   `.dll` (Dynamic Link Library—bisa di-inject)
*   `.sys` (Driver Sistem)
*   `.reg` (Registry File—bisa mengubah konfigurasi sistem)
*   `.inf` (Setup Information)

**Eksekusi Apple / macOS:**
*   `.dmg` (Installer macOS)
*   `.app` (Aplikasi macOS)
*   `.pkg` (Installer Package macOS)

**Eksekusi Linux:**
*   `.deb` (Installer Debian/Ubuntu)
*   `.rpm` (Installer RedHat/CentOS)
*   `.run` (Installer Linux executable)

**Skrip Sisi Server (Sangat Berbahaya bagi Web Server):**
*   `.php` (PHP—bisa mengambil alih server)
*   `.aspx`, `.asp` (ASP.NET—bisa mengambil alih server)
*   `.jsp` (JavaServer Pages—bisa mengambil alih server)
*   `.cgi` (Common Gateway Interface)

**Lainnya (Obfuscated / Bypass Tools):**
*   `.hta` (HTML Application—bisa menjalankan perintah sistem)
*   `.lnk` (Shortcut Windows—bisa diarahkan ke malware)
*   `.url` (Internet Shortcut)

---

### 💡 Tips Keamanan Tambahan untuk Sistem Anda:

1.  **Jangan Percaya Ekstensi Saja (Double Extension Trick):** Pengguna jahat mungkin mengunggah file bernama `laporan_keuangan.pdf.exe`. Pastikan sistem Anda memvalidasi **Tipe MIME (MIME Type)** atau membaca header file (Magic Number), bukan hanya melihat nama ekstensinya.
2.  **Arsip Zip/RAR Bisa Menipu:** File `.zip` bisa saja dilindungi password agar antivirus di server tidak bisa memindahkan isi di dalamnya. Jika organisasi Anda menerima `.zip`, pastikan server menolak file zip yang di-password.
3.  **Sanitasi File SVG & PDF:** PDF dan SVG bisa mengandung perintah JavaScript atau jalur eksekusi internal (Launch Action). Gunakan library yang bisa men-strip out JavaScript dari PDF/SVG saat diunggah.
4.  **Penamaan Ulang (Rename):** Saat file diunggah, simpan di server dengan nama acak (misal: UUID atau hash) tanpa ekstensi asli, dan simpan nama asli di database. Ini mencegah file yang lolos validasi untuk langsung dieksekusi jika seseorang menemukan jalur folder server Anda.
