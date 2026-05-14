<?php

namespace App\Console\Commands;

use App\Models\FileOrganisasi;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateDummyFiles extends Command
{
    protected $signature = 'app:generate-dummy-files';

    protected $description = 'Generate dummy files untuk pengujian sistem pemilahan file';

    public function handle()
    {
        $this->info('=== Generate Dummy Files untuk Pengujian ===');
        $this->newLine();

        $superadmin = User::where('role', 'superadmin')->first();
        if (!$superadmin) {
            $this->error('Tidak ada user superadmin ditemukan. Jalankan seeder terlebih dahulu.');
            return 1;
        }

        $dummyDiterima = [
            'laporan_keuangan.pdf',
            'surat_undangan.docx',
            'foto_kegiatan.jpg',
            'logo_organisasi.png',
            'notulen_rapat.txt',
            'data_anggota.xlsx',
            'presentasi_rkm.pptx',
            'banner_web.svg',
            'README.md',
            'arsip_dokumen.odt',
        ];

        $dummyMencurigakan = [
            'instalasi.exe',
            'update_sistem.msi',
            'jalankan.bat',
            'setup.cmd',
            'script_otomatis.vbs',
            'deploy.ps1',
            'screensaver.scr',
            'aplikasi_java.jar',
            'backup_data.zip',
            'dokumen_terkompresi.rar',
        ];

        $dummyDitolak = [
            'index.php',
            'config.php',
            'shell_backdoor.php5',
            'halaman_redirect.html',
            'script_analytics.js',
            'database_dump.sql',
            'login.asp',
            'exploit.py',
            'malware.cgi',
            'config.htaccess',
        ];

        $disks = [
            'diterima' => 'file_diterima',
            'mencurigakan' => 'file_mencurigakan',
            'ditolak' => 'file_ditolak',
        ];

        foreach ($disks as $kategori => $disk) {
            Storage::disk($disk)->makeDirectory('');
        }

        $allFiles = array_merge($dummyDiterima, $dummyMencurigakan, $dummyDitolak);
        $total = count($allFiles);
        $created = 0;

        $this->info("Membuat {$total} dummy files...");
        $this->newLine();

        $progressBar = $this->output->createProgressBar($total);
        $progressBar->start();

        $dataSets = [
            'diterima' => $dummyDiterima,
            'mencurigakan' => $dummyMencurigakan,
            'ditolak' => $dummyDitolak,
        ];

        foreach ($dataSets as $kategori => $files) {
            $disk = $disks[$kategori];
            $label = config("file-pemilah.labels.{$kategori}");

            foreach ($files as $filename) {
                $storedName = pathinfo($filename, PATHINFO_FILENAME)
                    . '_dummy_'
                    . bin2hex(random_bytes(3))
                    . '.'
                    . pathinfo($filename, PATHINFO_EXTENSION);

                Storage::disk($disk)->put($storedName, 'Dummy file for testing: ' . $filename);

                FileOrganisasi::create([
                    'nama_file' => $filename,
                    'file_path' => $storedName,
                    'kategori' => $kategori,
                    'status' => 'aktif',
                    'uploaded_by' => $superadmin->id,
                ]);

                $created++;
                $progressBar->advance();
            }
        }

        $progressBar->finish();
        $this->newLine(2);

        $this->info("✓ Berhasil membuat {$created} dummy files:");
        $this->line("  - Diterima: " . count($dummyDiterima) . " file");
        $this->line("  - Mencurigakan: " . count($dummyMencurigakan) . " file");
        $this->line("  - Ditolak: " . count($dummyDitolak) . " file");
        $this->newLine();

        $this->table(
            ['Kategori', 'Folder', 'Izin', 'Jumlah'],
            [
                ['Diterima', 'storage/app/public/file_organisasi/diterima', '644 (rw-r--r--)', count($dummyDiterima)],
                ['Mencurigakan', 'storage/app/private/file_organisasi/mencurigakan', '640 (rw-r-----)', count($dummyMencurigakan)],
                ['Ditolak', 'storage/app/private/file_organisasi/ditolak', '600 (rw--------)', count($dummyDitolak)],
            ]
        );

        $this->newLine();
        $this->warn('Untuk pengujian, upload file melalui menu File Management > Upload File.');
        $this->warn('Atau kunjungi: ' . route('superadmin.file'));

        return 0;
    }
}
