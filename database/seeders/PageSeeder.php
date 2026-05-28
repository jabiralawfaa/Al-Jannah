<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $content = [
            'hero' => [
                'title' => 'RKM Al-Jannah',
                'subtitle' => 'Bersama dalam Kepedulian, Hadir saat Masa Duka dengan Amanah dan Transparan',
            ],
            'about' => [
                'title' => 'Apa itu RKM AL JANNAH ?',
                'content' => 'Rukun Kematian (RKM) AL Jannah adalah bentuk kerjasama antara yayasan Sa\'ad Bin Abi Waqqosh dengan sanggar Ma\'e, sebagai tanda bakti kepada masyarakat dalam memberikan pertolongan kepada anggota Rukun Kematian yang meninggal dunia yang sesuai Sunnah (tata cara yang rosululloh shallallahu Aalaihi wasallam ajarkan).',
                'footer' => 'Berdiri sejak: 2017<br>Di bawah naungan Yayasan Sa\'ad Bin Abi Waqqash',
            ],
            'vision' => 'Rukun kematian yang mampu mengangkat harkat dan martabat keluarga anggotanya yang meninggal dunia.',
            'mission' => [
                'heading' => 'Memberikan pertolongan yang adil dan merata bagi seluruh anggota RKM.',
                'subheading' => 'Pertolongan yang dimaksud adalah:',
                'items' => ['Bantuan materi', 'Bantuan Tenaga', 'Bantuan Jasa'],
                'closing' => 'Membantu masyarakat yang membutuhkan bantuan dalam hal kepengurusan jenazah',
            ],
            'services' => [
                'title' => 'Layanan Kami',
                'items' => [
                    [
                        'title' => 'Perawatan Jenazah',
                        'description' => 'Melaksanakan proses pemulasaraan jenazah sesuai syariat Islam, meliputi pemandian dan perawatan jenazah oleh petugas yang telah ditetapkan.',
                    ],
                    [
                        'title' => 'Pengafanan',
                        'description' => 'Menyediakan 1 (satu) set perlengkapan kain kafan lengkap beserta kebutuhan lainnya, serta pelaksanaan pengafanan sesuai tuntunan syariat.',
                    ],
                    [
                        'title' => 'Ambulance',
                        'description' => 'Menyediakan layanan mobil ambulance untuk pengantaran jenazah ke tempat pemakaman dengan pengaturan jadwal dan rute yang terkoordinasi.',
                    ],
                    [
                        'title' => 'Pemakaman',
                        'description' => 'Mengatur dan mendampingi pelaksanaan sholat jenazah serta proses pemakaman hingga selesai sesuai ketentuan yang berlaku.',
                    ],
                ],
            ],
            'member_benefits' => [
                'title' => 'Keuntungan Anggota',
                'items' => [
                    ['title' => 'Santunan', 'image' => 'santunan.png'],
                    ['title' => 'Paket Pengurusan Jenazah', 'image' => 'paket-pengurusan-jenazah.png'],
                    ['title' => 'Hak Suara dalam Rapat', 'image' => 'hak-suara.png'],
                    ['title' => 'Pelayanan Setara', 'image' => 'pelayanan-setara.png'],
                ],
            ],
            'contact' => [
                'title' => 'Hubungi Kami',
                'address' => 'Yayasan Sa\'ad Bin Abi Waqqosh<br>Sanggar Ma\'e<br>Indonesia',
                'email' => 'info@aljannah.org',
                'phone' => '+62 812-3456-7890',
            ],
        ];

        Page::create([
            'title' => 'Beranda',
            'slug' => 'beranda',
            'content' => json_encode($content, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT),
            'status' => 'published',
            'published_at' => now(),
        ]);
    }
}
