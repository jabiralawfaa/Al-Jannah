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
                'items' => [
                    [
                        'text' => 'Memberikan pertolongan yang adil dan merata bagi seluruh anggota RKM.',
                        'subheading' => 'Pertolongan yang dimaksud adalah:',
                        'sub_items' => ['Bantuan materi', 'Bantuan Tenaga', 'Bantuan Jasa'],
                    ],
                    [
                        'text' => 'Membantu masyarakat yang membutuhkan bantuan dalam hal kepengurusan jenazah',
                        'subheading' => '',
                        'sub_items' => [],
                    ],
                ],
            ],
            'services' => [
                'title' => 'Layanan Kami',
                'items' => [
                    [
                        'title' => 'Perawatan Jenazah',
                        'description' => 'Melaksanakan proses pemulasaraan jenazah sesuai syariat Islam, meliputi pemandian dan perawatan jenazah oleh petugas yang telah ditetapkan.',
                        'image' => '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>',
                    ],
                    [
                        'title' => 'Pengafanan',
                        'description' => 'Menyediakan 1 (satu) set perlengkapan kain kafan lengkap beserta kebutuhan lainnya, serta pelaksanaan pengafanan sesuai tuntunan syariat.',
                        'image' => '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="6" cy="6" r="3"></circle><circle cx="6" cy="18" r="3"></circle><line x1="20" y1="4" x2="8.12" y2="15.88"></line><line x1="14.47" y1="14.48" x2="20" y2="20"></line><line x1="8.12" y1="8.12" x2="12" y2="12"></line></svg>',
                    ],
                    [
                        'title' => 'Ambulance',
                        'description' => 'Menyediakan layanan mobil ambulance untuk pengantaran jenazah ke tempat pemakaman dengan pengaturan jadwal dan rute yang terkoordinasi.',
                        'image' => '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>',
                    ],
                    [
                        'title' => 'Pemakaman',
                        'description' => 'Mengatur dan mendampingi pelaksanaan sholat jenazah serta proses pemakaman hingga selesai sesuai ketentuan yang berlaku.',
                        'image' => '<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"></path><path d="M5 21V7l8-4 8 4v14"></path><path d="M17 21v-8.5a1.5 1.5 0 0 0-3 0V21"></path></svg>',
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
