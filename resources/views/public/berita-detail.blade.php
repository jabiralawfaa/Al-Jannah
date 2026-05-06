<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kegiatan Rutin RKM Al-Jannah Bulan Ini - RKM Al-Jannah</title>
    
    <!-- Google Fonts: Space Grotesk & Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Navbar Component Styles -->
    @vite('resources/css/components/navbar.css')

    <style>
        /* Reset & Base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Poppins", sans-serif;
            font-style: normal;
            background-color: #f5f5f5;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Post Detail Section */
        .post-detail-section {
            padding: 4rem 2rem 6rem;
            background-color: #f5f5f5;
            min-height: 100vh;
        }

        .post-detail-container {
            max-width: 900px;
            margin: 0 auto;
        }

        /* Back Button */
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #16423C;
            font-family: "Poppins", sans-serif;
            font-size: 0.95rem;
            font-weight: 500;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            color: #6A9C89;
            transform: translateX(-5px);
        }

        .back-button svg {
            transition: transform 0.3s ease;
        }

        .back-button:hover svg {
            transform: translateX(-3px);
        }

        /* Post Header */
        .post-header {
            margin-bottom: 2rem;
        }

        .post-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .post-tag {
            font-family: "Poppins", sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            color: #16423C;
            background-color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .post-title {
            font-family: "Poppins", sans-serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #16423C;
            line-height: 1.3;
            margin-bottom: 1.5rem;
        }

        .post-meta {
            display: flex;
            align-items: center;
            gap: 2rem;
            color: #6B7280;
            font-size: 0.95rem;
        }

        .post-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .post-meta-item svg {
            width: 20px;
            height: 20px;
            color: #6A9C89;
        }

        /* Post Featured Image */
        .post-featured-image {
            width: 100%;
            height: 500px;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 3rem;
            box-shadow: 0 10px 40px rgba(22, 66, 60, 0.2);
        }

        .post-featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Post Content */
        .post-content {
            background-color: #ffffff;
            border-radius: 16px;
            padding: 3rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .post-content h2 {
            font-family: "Poppins", sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
            color: #16423C;
            margin: 2rem 0 1rem;
            line-height: 1.4;
        }

        .post-content h3 {
            font-family: "Poppins", sans-serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: #16423C;
            margin: 1.5rem 0 0.75rem;
            line-height: 1.4;
        }

        .post-content p {
            font-family: "Poppins", sans-serif;
            font-size: 1.0625rem;
            line-height: 1.9;
            color: #374151;
            margin-bottom: 1.5rem;
        }

        .post-content ul,
        .post-content ol {
            font-family: "Poppins", sans-serif;
            font-size: 1.0625rem;
            line-height: 1.9;
            color: #374151;
            margin-bottom: 1.5rem;
            padding-left: 2rem;
        }

        .post-content ul li,
        .post-content ol li {
            margin-bottom: 0.75rem;
        }

        .post-content blockquote {
            border-left: 4px solid #6A9C89;
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            color: #6B7280;
        }

        .post-content img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin: 1.5rem 0;
        }

        /* Share Section */
        .share-section {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid #e5e7eb;
        }

        .share-title {
            font-family: "Poppins", sans-serif;
            font-size: 1.125rem;
            font-weight: 600;
            color: #16423C;
            margin-bottom: 1rem;
        }

        .share-buttons {
            display: flex;
            gap: 1rem;
        }

        .share-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: #f3f4f6;
            color: #16423C;
            transition: all 0.3s ease;
        }

        .share-button:hover {
            background-color: #6A9C89;
            color: #ffffff;
            transform: translateY(-3px);
        }

        /* Related Posts */
        .related-posts {
            margin-top: 4rem;
        }

        .related-posts-title {
            font-family: "Poppins", sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #16423C;
            margin-bottom: 2rem;
        }

        /* Footer */
        .footer {
            background: linear-gradient(180deg, #16423C 0%, #0d2b26 100%);
            padding: 2rem;
            margin-top: 0;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
        }

        .footer-brand-title {
            font-family: "Poppins", sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.25rem;
        }

        .footer-brand-text {
            font-family: "Poppins", sans-serif;
            font-size: 0.875rem;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.7);
        }

        .footer-divider {
            width: 1px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.3);
        }

        .footer-developer-text {
            font-family: "Poppins", sans-serif;
            font-size: 0.875rem;
            font-weight: 400;
            color: rgba(255, 255, 255, 0.7);
        }

        .footer-developer-name {
            font-weight: 600;
            color: #98CBBE;
        }

        /* Post Detail Responsive */
        @media (max-width: 768px) {
            .post-detail-section {
                padding: 3rem 1.5rem 4rem;
            }

            .post-title {
                font-size: 1.75rem;
            }

            .post-featured-image {
                height: 300px;
            }

            .post-content {
                padding: 2rem 1.5rem;
            }

            .post-meta {
                flex-direction: column;
                gap: 1rem;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .footer-divider {
                width: 100%;
                height: 1px;
            }
        }

        @media (max-width: 480px) {
            .post-title {
                font-size: 1.5rem;
            }

            .post-content {
                padding: 1.5rem 1rem;
            }

            .post-content h2 {
                font-size: 1.5rem;
            }

            .post-content h3 {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar Component -->
    <x-navbar />

    <!-- Post Detail Section -->
    <section class="post-detail-section">
        <div class="post-detail-container">
            <!-- Back Button -->
            <a href="/#kanal-berita" class="back-button">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Kembali ke Kanal Berita
            </a>

            <!-- Post Header -->
            <div class="post-header">
                <div class="post-tags">
                    <span class="post-tag">Berita</span>
                    <span class="post-tag">Kegiatan</span>
                </div>
                <h1 class="post-title">Kegiatan Rutin RKM Al-Jannah Bulan Ini</h1>
                <div class="post-meta">
                    <div class="post-meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span>17 Maret 2026</span>
                    </div>
                    <div class="post-meta-item">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span>Admin RKM</span>
                    </div>
                </div>
            </div>

            <!-- Post Featured Image -->
            <div class="post-featured-image">
                <img src="https://images.unsplash.com/photo-1585829365295-ab7cd400c167?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&h=600&q=80" alt="Kegiatan Rutin RKM Al-Jannah">
            </div>

            <!-- Post Content -->
            <article class="post-content">
                <p>
                    RKM Al-Jannah kembali menggelar kegiatan rutin bulanan yang dihadiri oleh seluruh anggota dan pengurus yayasan. Kegiatan ini merupakan bagian dari komitmen kami untuk terus meningkatkan kualitas layanan dan mempererat silaturahmi antar anggota.
                </p>

                <h2>Rangkaian Kegiatan</h2>
                <p>
                    Kegiatan rutin bulan ini mencakup beberapa agenda penting yang bertujuan untuk meningkatkan kapasitas pengurus dan memberikan edukasi kepada anggota tentang tata cara pengurusan jenazah sesuai syariat Islam.
                </p>

                <h3>1. Sosialisasi Prosedur Baru</h3>
                <p>
                    Sosialisasi ini membahas tentang prosedur baru dalam penanganan jenazah, mulai dari tahap awal penerimaan laporan hingga proses pemakaman. Para peserta mendapatkan pemahaman yang lebih komprehensif tentang standar operasional yang telah disesuaikan dengan perkembangan terkini.
                </p>

                <h3>2. Pelatihan Praktis</h3>
                <p>
                    Sesi pelatihan praktis memberikan kesempatan kepada peserta untuk langsung mempraktikkan teknik-teknik perawatan jenazah dưới bimbingan instruktur yang berpengalaman. Materi yang disampaikan meliputi:
                </p>
                <ul>
                    <li>Teknik pemandian jenazah yang benar sesuai syariat</li>
                    <li>Cara mengafani jenazah laki-laki dan perempuan</li>
                    <li>Posisi dan tata cara sholat jenazah</li>
                    <li>Proses pemakaman yang sesuai sunnah</li>
                </ul>

                <h3>3. Diskusi dan Tanya Jawab</h3>
                <p>
                    Sesi diskusi memberikan ruang bagi peserta untuk mengajukan pertanyaan dan berbagi pengalaman terkait penanganan jenazah di lapangan. Berbagai studi kasus dibahas untuk menemukan solusi terbaik yang tetap mengacu pada ketentuan syariat.
                </p>

                <blockquote>
                    "Kegiatan rutin seperti ini sangat penting untuk menjaga kualitas layanan kita kepada masyarakat. Semoga ilmu yang didapatkan bermanfaat dan dapat diamalkan dengan baik."
                </blockquote>

                <h2>Komitmen Kami</h2>
                <p>
                    RKM Al-Jannah berkomitmen untuk terus meningkatkan kualitas layanan kepada anggota dan masyarakat. Melalui kegiatan rutin seperti ini, kami berharap dapat memberikan pelayanan yang lebih baik, lebih cepat, dan lebih sesuai dengan tuntunan syariat Islam.
                </p>

                <p>
                    Bagi masyarakat yang ingin bergabung menjadi anggota atau ingin mengetahui lebih lanjut tentang layanan kami, dapat menghubungi kontak yang tersedia di halaman Hubungi Kami.
                </p>

                <!-- Share Section -->
                <div class="share-section">
                    <h3 class="share-title">Bagikan Artikel Ini</h3>
                    <div class="share-buttons">
                        <a href="#" class="share-button" title="Share to Facebook">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a href="#" class="share-button" title="Share to Twitter">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                            </svg>
                        </a>
                        <a href="#" class="share-button" title="Share to WhatsApp">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
                            </svg>
                        </a>
                        <a href="#" class="share-button" title="Copy Link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </article>

            <!-- Related Posts -->
            <div class="related-posts">
                <h2 class="related-posts-title">Berita Terkait</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
                    <!-- Related Post 1 -->
                    <a href="#" style="background: linear-gradient(135deg, #6A9C89 0%, #16423C 100%); border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(22, 66, 60, 0.3); transition: transform 0.3s ease, box-shadow 0.3s ease; display: block;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 25px rgba(22, 66, 60, 0.5)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(22, 66, 60, 0.3)'">
                        <img src="https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=250&q=80" alt="Pengumuman" style="width: 100%; height: 180px; object-fit: cover;">
                        <div style="padding: 1.5rem;">
                            <h3 style="font-family: 'Poppins', sans-serif; font-size: 1rem; font-weight: 700; color: #ffffff; margin-bottom: 0.5rem; line-height: 1.4;">Pengumuman Penting Untuk Anggota Baru</h3>
                            <span style="font-family: 'Poppins', sans-serif; font-size: 0.875rem; color: rgba(255,255,255,0.7);">15 Maret 2026</span>
                        </div>
                    </a>

                    <!-- Related Post 2 -->
                    <a href="#" style="background: linear-gradient(135deg, #6A9C89 0%, #16423C 100%); border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(22, 66, 60, 0.3); transition: transform 0.3s ease, box-shadow 0.3s ease; display: block;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 25px rgba(22, 66, 60, 0.5)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(22, 66, 60, 0.3)'">
                        <img src="https://images.unsplash.com/photo-1517486808906-6ca8b3f04846?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=250&q=80" alt="Bantuan" style="width: 100%; height: 180px; object-fit: cover;">
                        <div style="padding: 1.5rem;">
                            <h3 style="font-family: 'Poppins', sans-serif; font-size: 1rem; font-weight: 700; color: #ffffff; margin-bottom: 0.5rem; line-height: 1.4;">Bantuan Kematian Untuk Keluarga Anggota</h3>
                            <span style="font-family: 'Poppins', sans-serif; font-size: 0.875rem; color: rgba(255,255,255,0.7);">10 Maret 2026</span>
                        </div>
                    </a>

                    <!-- Related Post 3 -->
                    <a href="#" style="background: linear-gradient(135deg, #6A9C89 0%, #16423C 100%); border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(22, 66, 60, 0.3); transition: transform 0.3s ease, box-shadow 0.3s ease; display: block;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 25px rgba(22, 66, 60, 0.5)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(22, 66, 60, 0.3)'">
                        <img src="https://images.unsplash.com/photo-1551818255-e6e10975bc17?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=250&q=80" alt="Rapat" style="width: 100%; height: 180px; object-fit: cover;">
                        <div style="padding: 1.5rem;">
                            <h3 style="font-family: 'Poppins', sans-serif; font-size: 1rem; font-weight: 700; color: #ffffff; margin-bottom: 0.5rem; line-height: 1.4;">Rapat Koordinasi Bulanan Pengurus</h3>
                            <span style="font-family: 'Poppins', sans-serif; font-size: 0.875rem; color: rgba(255,255,255,0.7);">5 Maret 2026</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Component -->
    <x-footer />

    <!-- Register Service Worker for Image Caching -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then((registration) => {
                        console.log('Service Worker registered successfully:', registration.scope);
                    })
                    .catch((error) => {
                        console.log('Service Worker registration failed:', error);
                    });
            });
        }
    </script>
</body>
</html>
