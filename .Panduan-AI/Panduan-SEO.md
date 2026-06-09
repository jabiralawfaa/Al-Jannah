# 🚀 Panduan Lengkap SEO: Membuat Website Mudah Terdeteksi Google

---

## 📑 Daftar Isi

1. [Apa Itu SEO?](#1-apa-itu-seo)
2. [Jenis-Jenis SEO](#2-jenis-jenis-seo)
3. [SEO On-Page](#3-seo-on-page)
4. [SEO Teknikal](#4-seo-teknikal)
5. [SEO Off-Page](#5-seo-off-page)
6. [Riset Keyword](#6-riset-keyword)
7. [Optimasi Konten](#7-optimasi-konten)
8. [Struktur Website](#8-struktur-website)
9. [Kecepatan & Performa](#9-kecepatan--performa)
10. [Mobile-Friendly](#10-mobile-friendly)
11. [Schema Markup & Rich Snippets](#11-schema-markup--rich-snippets)
12. [Google Search Console](#12-google-search-console)
13. [Tools SEO Wajib](#13-tools-seo-wajib)
14. [Checklist SEO Lengkap](#14-checklist-seo-lengkap)
15. [Kesalahan SEO yang Harus Dihindari](#15-kesalahan-seo-yang-harus-dihindari)
16. [Timeline & Strategi SEO](#16-timeline--strategi-seo)

---

## 1. Apa Itu SEO?

**SEO (Search Engine Optimization)** adalah proses mengoptimasi website agar muncul di halaman pertama hasil pencarian Google secara **organik** (tanpa berbayar).

### Mengapa SEO Penting?

| Fakta | Data |
|---|---|
| Traffic dari Google | 53% traffic website berasal dari pencarian organik |
| Halaman pertama | 90% pengguna tidak melihat halaman kedua |
| Posisi #1 | Mendapatkan 31.7% klik |
| CTR posisi #1 vs #10 | 10x lebih banyak |

### 3 Pilar Utama SEO

```
┌─────────────────────────────────────────┐
│              SEO SUCCESS                │
├─────────────┬──────────────┬───────────┤
│  On-Page    │  Technical   │  Off-Page │
│  (Konten)   │  (Struktur)  │  (Otoritas)│
└─────────────┴──────────────┴───────────┘
```

---

## 2. Jenis-Jenis SEO

### 🔵 SEO On-Page
Optimasi yang dilakukan **di dalam** website
- Keyword, konten, title tag, meta description, heading, internal link, gambar

### 🟢 SEO Technical
Optimasi **infrastruktur** website
- Kecepatan, crawlability, indexing, sitemap, robots.txt, HTTPS, structured data

### 🟠 SEO Off-Page
Optimasi dari **luar** website
- Backlink, social signal, brand mention, guest posting, local SEO

### 🟣 SEO Lokal
Optimasi untuk pencarian **berbasis lokasi**
- Google Business Profile, NAP consistency, review lokal

---

## 3. SEO On-Page

### 3.1 Title Tag

```html
<title>Keyword Utama - Nama Brand | Deskripsi Singkat</title>
```

**Best Practice:**
- ✅ Panjang: 50-60 karakter
- ✅ Keyword utama di awal
- ✅ Setiap halaman punya title unik
- ✅ Menarik untuk diklik (click-worthy)

**Contoh:**
```html
<!-- ❌ Buruk -->
<title>Home</title>
<title>Produk Kami</title>

<!-- ✅ Baik -->
<title>Jual Sepatu Running Premium - SportZone | Gratis Ongkir</title>
<title>Cara Membuat Website dari Nol [Panduan 2024]</title>
```

### 3.2 Meta Description

```html
<meta name="description" content="Deskripsi halaman yang menarik dan mengandung keyword utama, panjang 150-160 karakter.">
```

**Best Practice:**
- ✅ Panjang: 150-160 karakter
- ✅ Mengandung keyword utama
- ✅ Mengandung Call-to-Action (CTA)
- ✅ Setiap halaman unik

**Contoh:**
```html
<!-- ❌ Buruk -->
<meta name="description" content="Website kami menjual berbagai produk.">

<!-- ✅ Baik -->
<meta name="description" content="Beli sepatu running premium dengan harga terbaik. Gratis ongkir ke seluruh Indonesia. Garansi resmi. Pesan sekarang!">
```

### 3.3 Heading Tag (H1-H6)

```html
<!-- Struktur Heading yang Benar -->
<h1>Judul Utama Halaman (Hanya 1 per halaman)</h1>
  <h2>Sub-judul Utama</h2>
    <h3>Sub-point dari H2</h3>
    <h3>Sub-point lainnya</h3>
  <h2>Sub-judul Kedua</h2>
    <h3>Detail</h3>
      <h4>Sub-detail</h4>
```

**Aturan:**
| Tag | Fungsi | Jumlah |
|-----|--------|--------|
| H1 | Judul utama halaman | 1x per halaman |
| H2 | Pembagian section utama | Bebas |
| H3 | Sub dari H2 | Bebas |
| H4-H6 | Detail lebih lanjut | Separuhnya |

### 3.4 Optimasi Gambar

```html
<!-- ❌ Buruk -->
<img src="IMG001.jpg">

<!-- ✅ Baik -->
<img src="sepatu-running-hitam-nike.jpg" 
     alt="Sepatu running hitam Nike Air Zoom series untuk lari jarak jauh" 
     width="800" 
     height="600"
     loading="lazy"
     decoding="async">
```

**Checklist gambar:**
- ✅ Nama file deskriptif (bukan IMG001.jpg)
- ✅ Alt text mengandung keyword secara natural
- ✅ Dimensi width & height ditentukan (mencegah CLS)
- ✅ Lazy loading untuk gambar di bawah fold
- ✅ Format modern: WebP atau AVIF
- ✅ Kompres ukuran file (< 100KB jika memungkinkan)

### 3.5 Internal Linking

```html
<!-- Contoh internal link yang baik -->
<p>Baca juga <a href="/panduan-seo-pemula">panduan SEO untuk pemula</a> 
sebelum melanjutkan ke materi lanjutan.</p>
```

**Strategi Internal Link:**
```
Homepage
├── Kategori A
│   ├── Artikel 1 ←─── link dari Artikel 2
│   └── Artikel 2 ←─── link dari Artikel 1
├── Kategori B
│   ├── Artikel 3 ←─── link dari Artikel 1 (topical cluster)
│   └── Artikel 4
└── Pillar Page
    └── Links ke semua artikel terkait
```

**Tips:**
- ✅ Gunakan anchor text deskriptif (bukan "klik di sini")
- ✅ Link ke halaman penting dari banyak halaman
- ✅ 3-5 internal link per artikel (minimal)
- ✅ Buat topical cluster / hub and spoke model

### 3.6 URL Structure

```
❌ https://example.com/p/12345?cat=2&ref=home
❌ https://example.com/produk/kategori/sub/page1.html

✅ https://example.com/sepatu-running-nike
✅ https://example.com/blog/cara-memilih-sepatu-running
```

**Aturan URL:**
- ✅ Pendek dan deskriptif
- ✅ Mengandung keyword
- ✅ Gunakan hyphen (-) bukan underscore (_)
- ✅ Huruf kecil semua
- ✅ Hindari parameter & karakter khusus

---

## 4. SEO Technical

### 4.1 Robots.txt

```txt
# robots.txt - Contoh
User-agent: *
Allow: /

# Blokir halaman admin
Disallow: /admin/
Disallow: /login/
Disallow: /cart/
Disallow: /checkout/

# Blokir parameter pencarian internal
Disallow: /search?q=

# Sitemap
Sitemap: https://example.com/sitemap.xml
```

### 4.2 XML Sitemap

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  <url>
    <loc>https://example.com/</loc>
    <lastmod>2024-01-15</lastmod>
    <changefreq>weekly</changefreq>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>https://example.com/sepatu-running</loc>
    <lastmod>2024-01-14</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.8</priority>
  </url>
  <url>
    <loc>https://example.com/blog/cara-memilih-sepatu</loc>
    <lastmod>2024-01-13</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
</urlset>
```

### 4.3 Canonical Tag

```html
<!-- Mencegah konten duplikat -->
<link rel="canonical" href="https://example.com/sepatu-running-nike">

<!-- Penting untuk: -->
<!-- - Halaman dengan parameter URL -->
<!-- - Versi mobile terpisah -->
<!-- - Konten yang mirip/seri -->
```

### 4.4 HTTPS

```html
<!-- Redirect HTTP ke HTTPS via .htaccess -->
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

### 4.5 Redirect yang Benar

```
301 = Permanen (transfer SEO juice) ✅ untuk perpindahan halaman
302 = Sementara (TIDAK transfer SEO juice) ❌ jangan untuk halaman yang dipindah permanen
```

### 4.6 Struktur HTML yang SEO-Friendly

```html
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- SEO Meta -->
  <title>Judul Halaman - Brand</title>
  <meta name="description" content="Deskripsi halaman...">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="https://example.com/halaman">
  
  <!-- Open Graph (Social Media) -->
  <meta property="og:title" content="Judul Halaman">
  <meta property="og:description" content="Deskripsi...">
  <meta property="og:image" content="https://example.com/image.jpg">
  <meta property="og:url" content="https://example.com/halaman">
  <meta property="og:type" content="article">
  
  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Judul Halaman">
  <meta name="twitter:description" content="Deskripsi...">
  <meta name="twitter:image" content="https://example.com/image.jpg">
  
  <!-- Technical -->
  <link rel="sitemap" type="application/xml" href="/sitemap.xml">
  
  <!-- Preconnect untuk performa -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://www.googletagmanager.com">
  
  <!-- Structured Data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "Judul Artikel",
    "author": { "@type": "Person", "name": "Nama Penulis" },
    "datePublished": "2024-01-15",
    "dateModified": "2024-01-16"
  }
  </script>
</head>
<body>
  <!-- Konten halaman -->
</body>
</html>
```

### 4.7 Hreflang Tag (Website Multi-Bahasa)

```html
<link rel="alternate" hreflang="id" href="https://example.com/id/">
<link rel="alternate" hreflang="en" href="https://example.com/en/">
<link rel="alternate" hreflang="x-default" href="https://example.com/">
```

---

## 5. SEO Off-Page

### 5.1 Backlink Strategy

**Kualitas Backlink > Kuantitas**

```
Backlink Berkualitas:
┌──────────────────────────────────────────────┐
│ ✅ Relevan topik                             │
│ ✅ Dari website ber-DA/DR tinggi              │
│ ✅ Konteks editorial (di dalam konten)        │
│ ✅ Anchor text natural                        │
│ ✅ Dofollow (tapi nofollow juga berguna)      │
│ ✅ Traffic organik tinggi                     │
└──────────────────────────────────────────────┘

Backlink Buruk:
┌──────────────────────────────────────────────┐
│ ❌ Spam / farm link                          │
│ ❌ Tidak relevan topik                       │
│ ❌ Footer link massal                        │
│ ❌ Situs judi / adult / phising              │
│ ❌ Link exchange berlebihan                  │
└──────────────────────────────────────────────┘
```

### 5.2 Strategi Mendapatkan Backlink

| Strategi | Tingkat Kesulitan | Kualitas |
|----------|-------------------|----------|
| Guest Posting | ⭐⭐⭐ | ⭐⭐⭐⭐ |
| Skyscraper Technique | ⭐⭐⭐⭐ | ⭐⭐⭐⭐⭐ |
| Broken Link Building | ⭐⭐⭐ | ⭐⭐⭐⭐ |
| Resource Page Link | ⭐⭐ | ⭐⭐⭐ |
| HARO / Journalist Query | ⭐⭐⭐⭐ | ⭐⭐⭐⭐⭐ |
| Infographic Sharing | ⭐⭐ | ⭐⭐⭐ |
| Testimonial Link | ⭐ | ⭐⭐ |
| Brand Mention → Link | ⭐⭐⭐ | ⭐⭐⭐⭐ |

### 5.3 Skyscraper Technique

```
Step 1: Cari konten populer di industri Anda
        → Gunakan Ahrefs/BuzzSumo untuk top performers
        
Step 2: Buat konten yang LEBIH BAIK
        → Lebih lengkap, lebih update, lebih berguna
        
Step 3: Outreach ke yang nge-link konten original
        → "Hei, konten Anda link ke [X]. Saya buat versi 
           yang lebih update & lengkap di [Y]."
```

### 5.4 Google Business Profile (SEO Lokal)

```
✅ Klaim & verifikasi bisnis
✅ Nama bisnis konsisten (NAP: Name, Address, Phone)
✅ Kategori bisnis tepat
✅ Foto bisnis (minimal 10)
✅ Jam operasional akurat
✅ Posting update rutin
✅ Minta review dari pelanggan
✅ Balas semua review (positif & negatif)
```

---

## 6. Riset Keyword

### 6.1 Tipe Keyword

```
┌─────────────────────────────────────────────────────┐
│              HEAD KEYWORD (1-2 kata)                │
│         "sepatu running"  (Volume: Tinggi)          │
│         Competiton: Sangat Tinggi                    │
│         Conversion: Rendah                           │
├─────────────────────────────────────────────────────┤
│           BODY KEYWORD (2-3 kata)                   │
│    "sepatu running nike"  (Volume: Sedang)          │
│    Competition: Sedang                               │
│    Conversion: Sedang                                │
├─────────────────────────────────────────────────────┤
│         LONG-TAIL KEYWORD (4+ kata)                 │
│  "sepatu running nike untuk lari jarak jauh"        │
│  Volume: Rendah | Competition: Rendah               │
│  Conversion: Tinggi ✅ ← MULAI DARI SINI            │
└─────────────────────────────────────────────────────┘
```

### 6.2 Intent Pencarian

| Intent | Tujuan User | Contoh Keyword | Tipe Konten |
|--------|-------------|----------------|-------------|
| **Informational** | Mencari info | "cara merawat sepatu" | Blog/Artikel |
| **Navigational** | Mencari website tertentu | "nike official store" | Halaman Brand |
| **Commercial** | Riset sebelum beli | "sepatu running terbaik 2024" | Review/Komparasi |
| **Transactional** | Siap beli | "beli sepatu running nike online" | Produk/Checkout |

### 6.3 Proses Riset Keyword

```
Step 1: Brainstorming
        → Daftar topik utama bisnis Anda
        → Tulis pertanyaan yang sering ditanyakan pelanggan

Step 2: Expand dengan Tools
        → Google Keyword Planner (gratis)
        → Google Autocomplete & Related Searches
        → AnswerThePublic
        → Ahrefs / SEMrush / Ubersuggest

Step 3: Filter & Prioritaskan
        → Volume pencarian ≥ 100/bulan
        → Keyword Difficulty ≤ 30 (untuk website baru)
        → Relevan dengan bisnis
        → Sesuai intent pencarian

Step 4: Mapping
        → 1 keyword utama per halaman
        → 2-5 keyword sekunder per halaman
        → Kelompokkan berdasarkan topik
```

### 6.4 Template Keyword Mapping

| Halaman | Keyword Utama | Keyword Sekunder | Intent | Volume | KD |
|---------|---------------|------------------|--------|--------|----|
| /sepatu-running | sepatu running | sepatu lari, sepatu jogging | Commercial | 2.4K | 35 |
| /blog/cara-merawat | cara merawat sepatu | tips merawat sepatu, membersihkan sepatu putih | Informational | 890 | 22 |
| /sepatu-running-nike | sepatu running nike | nike running shoes, sepatu nike lari | Transactional | 1.8K | 45 |

---

## 7. Optimasi Konten

### 7.1 Formula Konten SEO

```
KONTEN YANG RANKING = E-E-A-T + Intent Match + Depth + User Experience

E-E-A-T:
  Experience  → Pengalaman langsung
  Expertise   → Keahlian di bidangnya
  Authoritativeness → Otoritas / diakui
  Trustworthiness  → Dapat dipercaya
```

### 7.2 Struktur Artikel SEO

```markdown
# H1: Judul Utama Mengandung Keyword [Tahun]

## Intro (100-150 kata)
- Hook: tarik perhatian pembaca
- Masalah yang dijawab
- Preview isi artikel

## H2: Keyword Utama dalam Subjudul
### H3: Poin Detail
### H3: Poin Detail

## H2: Keyword Sekunder dalam Subjudul
### H3: Step-by-step / Detail
### H3: Tips & Trik

## H2: FAQ (Pertanyaan yang Sering Diajukan)
### H3: Pertanyaan 1?
### H3: Pertanyaan 2?

## Kesimpulan
- Ringkasan
- CTA
```

### 7.3 Penempatan Keyword

```
┌─────────────────────────────────────────────────┐
│ TEMPATKAN KEYWORD DI:                           │
├─────────────────────────────────────────────────┤
│ ✅ Title Tag              (wajib)               │
│ ✅ Meta Description       (wajib)               │
│ ✅ H1                     (wajib)               │
│ ✅ 100 kata pertama       (wajib)               │
│ ✅ Minimal 1 H2          (wajib)               │
│ ✅ URL / Slug            (wajib)               │
│ ✅ Alt text gambar       (natural)              │
│ ✅ Body konten            (natural, jangan over) │
│ ✅ Internal link anchor   (natural)              │
└─────────────────────────────────────────────────┘
```

### 7.4 Keyword Density

```
Panduan:
──────────────────────────────────────────
Keyword Density Ideal: 1% - 2%
Artinya: Dalam 1000 kata, keyword muncul 10-20x

⚠️ JANGAN keyword stuffing!
❌ "Sepatu running kami adalah sepatu running terbaik 
    untuk sepatu running karena sepatu running ini 
    sangat sepatu running"

✅ "Sepatu running pilihan kami menawarkan kenyamanan 
    optimal untuk aktivitas lari Anda..."
──────────────────────────────────────────
```

### 7.5 Panjang Konten Ideal

| Tipe Konten | Panjang Ideal |
|-------------|---------------|
| Blog post dasar | 1.000 - 1.500 kata |
| In-depth article | 2.000 - 3.000 kata |
| Pillar page | 3.000 - 5.000+ kata |
| Produk page | 500 - 1.000 kata |
| Landing page | 800 - 1.200 kata |

> 💡 **Tips**: Cek 10 hasil teratas Google untuk keyword Anda, hitung rata-rata panjang konten mereka, lalu buat konten Anda **10-20% lebih panjang dan lebih mendalam**.

### 7.6 Tips Konten Tambahan

- ✅ **Update konten lama** secara berkala (tambah tahun, data baru)
- ✅ **Gunakan gambar original** (bukan stock photo generik)
- ✅ **Sisipkan video** (meningkatkan dwell time)
- ✅ **Buat list/table** (mudah di-scrape untuk featured snippet)
- ✅ **Tambahkan TOC** (Table of Contents dengan anchor link)
- ✅ **Tulis paragraf pendek** (2-3 kalimat per paragraf)

---

## 8. Struktur Website

### 8.1 Hierarki Website

```
Homepage (Depth 0)
├── Kategori Utama (Depth 1)
│   ├── Sub-Kategori (Depth 2)
│   │   ├── Produk/Artikel (Depth 3)  ← MAKSIMAL Depth 3!
│   │   └── Produk/Artikel
│   └── Sub-Kategori
│       └── Produk/Artikel
├── Kategori Utama
│   └── ...
├── Blog
│   ├── Kategori Blog
│   │   └── Artikel
│   └── Artikel
├── About
├── Contact
└── Sitemap
```

**Aturan:**
- ✅ Setiap halaman bisa diakses dalam **3 klik** dari homepage
- ✅ Struktur rata (flat), tidak terlalu dalam
- ✅ Breadcrumb di setiap halaman
- ✅ Navigation menu yang jelas

### 8.2 Breadcrumb

```html
<!-- Breadcrumb dengan Schema Markup -->
<nav aria-label="Breadcrumb">
  <ol itemscope itemtype="https://schema.org/BreadcrumbList">
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <a itemprop="item" href="/"><span itemprop="name">Home</span></a>
      <meta itemprop="position" content="1">
    </li>
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <a itemprop="item" href="/sepatu"><span itemprop="name">Sepatu</span></a>
      <meta itemprop="position" content="2">
    </li>
    <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
      <a itemprop="item" href="/sepatu-running"><span itemprop="name">Running</span></a>
      <meta itemprop="position" content="3">
    </li>
  </ol>
</nav>
```

### 8.3 Navigation SEO-Friendly

```html
<!-- ✅ Gunakan teks, bukan gambar/JS untuk navigasi -->
<nav>
  <ul>
    <li><a href="/">Home</a></li>
    <li><a href="/sepatu-running">Sepatu Running</a></li>
    <li><a href="/sepatu-casual">Sepatu Casual</a></li>
    <li><a href="/blog">Blog</a></li>
    <li><a href="/tentang-kami">Tentang Kami</a></li>
  </ul>
</nav>

<!-- ❌ Jangan: -->
<!-- <a href="#" onclick="navigate('page')">Link</a> -->
<!-- <a href="javascript:void(0)">Link</a> -->
<!-- <div onclick="location.href='/page'">Link</div> -->
```

### 8.4 Pagination

```html
<!-- Rel prev/next untuk pagination -->
<link rel="prev" href="/blog/page/1">
<link rel="next" href="/blog/page/3">

<!-- Atau: canonical ke view-all jika memungkinkan -->
<link rel="canonical" href="/blog/all">
```

---

## 9. Kecepatan & Performa

### 9.1 Core Web Vitals

```
┌─────────────────────────────────────────────────────────┐
│                 CORE WEB VITALS                         │
├──────────────┬──────────────┬───────────────────────────┤
│    LCP       │    INP       │       CLS                │
│  (Loading)   │(Interactivity)│   (Visual Stability)    │
├──────────────┼──────────────┼───────────────────────────┤
│ Good: ≤2.5s  │ Good: ≤200ms │ Good: ≤0.1              │
│ Needs: ≤4s   │ Needs: ≤500ms│ Needs: ≤0.25            │
│ Poor: >4s    │ Poor: >500ms │ Poor: >0.25             │
└──────────────┴──────────────┴───────────────────────────┘
```

**LCP (Largest Contentful Paint)** - Seberapa cepat konten terbesar tampil
```
Optimasi LCP:
✅ Kompres gambar (WebP/AVIF)
✅ Gunakan CDN
✅ Implementasi lazy loading
✅ Hindari render-blocking resources
✅ Optimasi server response time (TTFB < 800ms)
✅ Preload hero images
✅ Gunakan next-gen image formats
```

**INP (Interaction to Next Paint)** - Seberapa responsif interaksi user
```
Optimasi INP:
✅ Minimasi JavaScript
✅ Code splitting
✅ Defer non-critical JS
✅ Gunakan web workers untuk task berat
✅ Hindari layout thrashing
```

**CLS (Cumulative Layout Shift)** - Seberapa stabil visual halaman
```
Optimasi CLS:
✅ Tentukan width & height pada <img> dan <video>
✅ Reservasi space untuk ads/dynamic content
✅ Gunakan font-display: swap atau optional
✅ Preload web fonts
✅ Hindari menyisipkan konten di atas viewport
✅ Gunakan CSS aspect-ratio
```

### 9.2 Optimasi Kecepatan Praktis

```html
<!-- 1. Preload Critical Resources -->
<link rel="preload" href="/fonts/main.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="/images/hero.webp" as="image">

<!-- 2. Defer Non-Critical JS -->
<script src="app.js" defer></script>
<script src="analytics.js" async></script>

<!-- 3. DNS Prefetch & Preconnect -->
<link rel="dns-prefetch" href="https://cdn.example.com">
<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>

<!-- 4. Critical CSS Inline -->
<style>
  /* Critical above-the-fold CSS here */
  .hero { display: flex; min-height: 60vh; }
</style>
<link rel="stylesheet" href="/css/main.css" media="print" onload="this.media='all'">
```

```txt
# .htaccess - GZIP Compression
<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE text/html
  AddOutputFilterByType DEFLATE text/css
  AddOutputFilterByType DEFLATE text/javascript
  AddOutputFilterByType DEFLATE application/javascript
  AddOutputFilterByType DEFLATE application/json
</IfModule>

# Browser Caching
<IfModule mod_expires.c>
  ExpiresActive On
  ExpiresByType image/webp "access plus 1 year"
  ExpiresByType image/jpeg "access plus 1 year"
  ExpiresByType text/css "access plus 1 month"
  ExpiresByType application/javascript "access plus 1 month"
</IfModule>
```

### 9.3 Target Kecepatan

| Metrik | Target | Tools Cek |
|--------|--------|-----------|
| Page Speed Score | ≥ 90 | PageSpeed Insights |
| TTFB | < 800ms | WebPageTest |
| Fully Loaded | < 3 detik | GTmetrix |
| Total Page Weight | < 1.5MB | Chrome DevTools |

---

## 10. Mobile-Friendly

### 10.1 Mobile-First Indexing

```
Google menggunakan VERSI MOBILE website untuk indexing!

Artinya:
- Jika website Anda tidak mobile-friendly → ranking turun
- Konten mobile harus sama dengan desktop
- Meta tags harus ada di versi mobile
```

### 10.2 Responsive Design

```css
/* ✅ Responsive Meta Tag (wajib) */
/* <meta name="viewport" content="width=device-width, initial-scale=1.0"> */

/* Responsive Design Best Practices */
body {
  font-size: 16px; /* Minimum readable font size */
  line-height: 1.6;
}

/* Touch-friendly */
a, button {
  min-height: 44px;  /* Apple's recommended touch target */
  min-width: 44px;
}

/* Avoid horizontal scroll */
* {
  max-width: 100%;
  box-sizing: border-box;
}

/* Media Queries */
@media (max-width: 768px) {
  .hero-title { font-size: 2rem; }
  .content { padding: 1rem; }
}
```

### 10.3 Checklist Mobile-Friendly

- ✅ Viewport meta tag
- ✅ Teks bisa dibaca tanpa zoom (font ≥ 16px)
- ✅ Tap target cukup besar (≥ 44px)
- ✅ Tidak ada horizontal scroll
- ✅ Gambar responsive (srcset)
- ✅ Pop-up tidak menutupi konten utama
- ✅ Form mudah diisi di mobile

```html
<!-- Responsive Images -->
<img srcset="/images/hero-480.webp 480w,
             /images/hero-800.webp 800w,
             /images/hero-1200.webp 1200w"
     sizes="(max-width: 600px) 480px,
            (max-width: 900px) 800px,
            1200px"
     src="/images/hero-800.webp"
     alt="Hero image description"
     width="800"
     height="450"
     loading="eager">
```

---

## 11. Schema Markup & Rich Snippets

### 11.1 Mengapa Schema Penting?

```
Tanpa Schema:    [Title] [URL] [Description]

Dengan Schema:   ⭐⭐⭐⭐⭐ (4.8/5 - 2,340 reviews)
                 [Title] [URL] [Description]
                 💰 Rp 899.000 - Rp 1.299.000
                 📦 In Stock

→ CTR meningkat 20-30% dengan rich snippets!
```

### 11.2 Schema Article

```json
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "Panduan Lengkap Memilih Sepatu Running",
  "image": "https://example.com/images/sepatu-running.jpg",
  "author": {
    "@type": "Person",
    "name": "Ahmad Fauzi",
    "url": "https://example.com/author/ahmad"
  },
  "publisher": {
    "@type": "Organization",
    "name": "SportZone",
    "logo": {
      "@type": "ImageObject",
      "url": "https://example.com/logo.png"
    }
  },
  "datePublished": "2024-01-15T08:00:00+07:00",
  "dateModified": "2024-01-20T10:30:00+07:00",
  "description": "Panduan lengkap cara memilih sepatu running yang tepat sesuai kebutuhan Anda.",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "https://example.com/blog/cara-memilih-sepatu-running"
  }
}
```

### 11.3 Schema Product

```json
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "Nike Air Zoom Pegasus 40",
  "image": [
    "https://example.com/images/nike-pegasus-1.jpg",
    "https://example.com/images/nike-pegasus-2.jpg"
  ],
  "description": "Sepatu running Nike Air Zoom Pegasus 40 untuk lari jarak menengah hingga jauh.",
  "brand": {
    "@type": "Brand",
    "name": "Nike"
  },
  "offers": {
    "@type": "Offer",
    "url": "https://example.com/nike-air-zoom-pegasus-40",
    "priceCurrency": "IDR",
    "price": "1599000",
    "priceValidUntil": "2024-12-31",
    "availability": "https://schema.org/InStock",
    "seller": {
      "@type": "Organization",
      "name": "SportZone"
    }
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.8",
    "reviewCount": "234"
  }
}
```

### 11.4 Schema FAQ

```json
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "Berapa lama umur sepatu running?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Rata-rata sepatu running memiliki umur 400-600 km pemakaian, atau sekitar 4-6 bulan untuk pelari reguler."
      }
    },
    {
      "@type": "Question",
      "name": "Apa bedanya sepatu running road dan trail?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Sepatu running road dirancang untuk permukaan aspal/halus, sementara trail dirancang untuk medan tanah/batuan dengan sol yang lebih kasar dan proteksi lebih."
      }
    }
  ]
}
```

### 11.5 Schema Lainnya

| Tipe Schema | Digunakan Untuk |
|-------------|-----------------|
| `LocalBusiness` | Bisnis lokal |
| `BreadcrumbList` | Breadcrumb navigasi |
| `HowTo` | Tutorial langkah-langkah |
| `VideoObject` | Halaman video |
| `Recipe` | Resep makanan |
| `Event` | Acara / event |
| `Organization` | Info perusahaan |
| `Person` | Profil penulis |
| `WebSite` + `SearchAction` | Sitelink search box |

---

## 12. Google Search Console

### 12.1 Setup

```
Step 1: Buka https://search.google.com/search-console
Step 2: Tambahkan property (domain atau URL prefix)
Step 3: Verifikasi kepemilikan:
        → DNS record (recommended)
        → HTML file upload
        → HTML tag
        → Google Analytics
        → Google Tag Manager
Step 4: Tunggu data masuk (1-3 hari)
```

### 12.2 Fitur Wajib Digunakan

```
📊 Performance Report
   → Klik, impression, CTR, average position
   → Filter: query, page, country, device, date
   → Compare periods untuk melihat tren

🔍 URL Inspection Tool
   → Cek indexing status halaman
   → Request indexing untuk halaman baru
   → View crawled page (how Google sees it)

📋 Coverage Report
   → Halaman yang ter-index
   → Error (halaman gagal di-index)
   → Warning
   → Excluded (dan alasannya)

⚙️ Sitemaps
   → Submit sitemap.xml
   → Monitor status indexing sitemap

🔗 Links Report
   → Top linking sites (backlink)
   → Top linked pages
   → Internal links

📱 Mobile Usability
   → Cek masalah mobile
   → Text too small, tap targets too close, dll

🌐 Core Web Vitals
   → LCP, INP, CLS report
   → URLs yang perlu diperbaiki
```

### 12.3 Monitoring Rutin

| Aktivitas | Frekuensi |
|-----------|-----------|
| Cek Performance Report | Mingguan |
| Review Coverage Errors | Mingguan |
| Submit URL baru | Saat publish |
| Cek Core Web Vitals | Bulanan |
| Review Links | Bulanan |
| Update Sitemap | Saat ada perubahan besar |

---

## 13. Tools SEO Wajib

### 13.1 Tools Gratis

| Tool | Fungsi | URL |
|------|--------|-----|
| Google Search Console | Monitoring & indexing | search.google.com/search-console |
| Google Analytics | Traffic analysis | analytics.google.com |
| Google Keyword Planner | Riset keyword | ads.google.com |
| Google PageSpeed Insights | Cek kecepatan | pagespeed.web.dev |
| Google Trends | Tren keyword | trends.google.com |
| Screaming Frog (500 URL) | Crawl & audit | screamingfrog.co.uk |
| Ubersuggest (limited) | Riset keyword | neilpatel.com/ubersuggest |
| AnswerThePublic | Ide konten | answerthepublic.com |
| GTmetrix | Cek kecepatan | gtmetrix.com |
| WebPageTest | Performance test | webpagetest.org |
| Schema Markup Validator | Validasi schema | validator.schema.org |
| Rich Results Test | Test rich snippets | search.google.com/test/rich-results |
| Chrome Lighthouse | Audit komprehensif | Chrome DevTools |
| AlsoAsked | Pertanyaan terkait | alsoasked.com |

### 13.2 Tools Berbayar (Premium)

| Tool | Keunggulan | Harga mulai |
|------|------------|-------------|
| Ahrefs | Backlink analysis terbaik | $99/bulan |
| SEMrush | All-in-one SEO suite | $119/bulan |
| Moz Pro | Domain Authority, keyword | $99/bulan |
| Surfer SEO | Content optimization | $89/bulan |
| Screaming Frog (full) | Unlimited crawl | £149/tahun |

### 13.3 Chrome Extensions

- **SEO Meta in 1 Click** — Cek meta tags cepat
- **Keywords Everywhere** — Volume keyword di SERP
- **Ahrefs SEO Toolbar** — DA, backlink count di SERP
- **Detailed SEO Extension** — On-page analysis
- **Lighthouse** — Quick performance audit

---

## 14. Checklist SEO Lengkap

### ✅ Pre-Launch Checklist

```
□ Google Search Console terpasang
□ Google Analytics terpasang
□ Sitemap.xml dibuat & disubmit
□ Robots.txt dikonfigurasi
□ HTTPS aktif & redirect HTTP→HTTPS
□ 301 redirect untuk URL yang berubah
□ Canonical tag di setiap halaman
□ Custom 404 page
□ Meta robots (index/follow) di halaman yang benar
□ Semua halaman accessible < 3 klik dari homepage
□ Breadcrumb terpasang
□ Schema markup ditambahkan
□ Open Graph tags untuk social sharing
□ Favicon & app icons
```

### ✅ On-Page Checklist (Per Halaman)

```
□ Title tag 50-60 karakter, keyword di depan
□ Meta description 150-160 karakter dengan CTA
□ H1 unik per halaman, mengandung keyword
□ URL pendek & deskriptif, mengandung keyword
□ Keyword di 100 kata pertama
□ Keyword tersebar natural di konten
□ LSI / keyword sekunder digunakan
□ Heading H2-H6 terstruktur
□ Minimal 1 gambar dengan alt text
□ Internal link 3-5 per halaman
□ External link ke sumber otoritatif 1-2
□ Konten > kompetitor (length & depth)
□ No broken links
□ Konten original (tidak copy-paste)
```

### ✅ Technical Checklist

```
□ Core Web Vitals hijau (LCP, INP, CLS)
□ Page speed < 3 detik
□ Mobile-friendly / responsive
□ GZIP compression aktif
□ Browser caching dikonfigurasi
□ Gambar terkompresi (WebP/AVIF)
□ Lazy loading pada gambar & video
□ No render-blocking resources
□ CSS & JS minimized
□ No duplicate content issues
□ Hreflang (jika multi-bahasa)
□ No JavaScript-only rendering (SSR/SSG preferred)
□ Clean HTML, valid markup
```

### ✅ Off-Page Checklist

```
□ Google Business Profile diklaim (lokal)
□ NAP konsisten di seluruh direktori
□ Backlink profile mulai dibangun
□ Social media profiles lengkap & aktif
□ Brand monitoring setup
□ Guest post outreach dimulai
□ Review pelanggan dikumpulkan
```

---

## 15. Kesalahan SEO yang Harus Dihindari

### 🔴 Fatal Errors

| Kesalahan | Dampak | Solusi |
|-----------|--------|--------|
| Keyword stuffing | Penalty Google | Gunakan keyword natural, 1-2% density |
| Cloaking | Banned dari index | Tampilkan konten sama ke user & bot |
| Hidden text | Penalty | Jangan sembunyikan teks (white-on-white dll) |
| Duplicate content | Tidak terindex | Canonical tag, konten original |
| Buying backlink | Penalty / deindex | Bangun backlink secara organik |
| Auto-generated content | Penalty | Tulis konten manual & berkualitas |
| Doorway pages | Penalty | Buat halaman yang benar-benar berguna |

### 🟡 Common Mistakes

```
❌ Tidak punya meta description → Google ambil snippet acak
❌ Semua halaman punya title yang sama → Bingung mana yang ditampilkan
❌ Gambar tanpa alt text → Tidak bisa muncul di Google Images
❌ Mengabaikan internal linking → Otoritas tidak mengalir
❌ Konten tipis (thin content) → Tidak bisa ranking
❌ Tidak update konten lama → Outranked oleh konten yang lebih segar
❌ Block CSS/JS di robots.txt → Google tidak render dengan benar
❌ Tidak submit sitemap → Indexing lambat
❌ Mengubah URL tanpa redirect → 404 errors, loss SEO juice
❌ Tidak monitor Search Console → Tidak tahu ada masalah
```

### 🟠 JavaScript SEO Mistakes

```
❌ Render entire page dengan client-side JS tanpa SSR/SSG
   → Google bisa render JS, tapi lambat & tidak optimal
   → Solusi: SSR (Next.js, Nuxt.js) atau SSG

❌ Lazy-load konten penting tanpa SEO consideration
   → Konten harus accessible tanpa user interaction
   → Solusi: Server-side render konten utama

❌ Hash-based routing (#/page)
   → Google tidak crawl hash routes
   → Solusi: Gunakan History API (/page)
```

---

## 16. Timeline & Strategi SEO

### 16.1 Roadmap SEO (0-12 Bulan)

```
BULAN 1-2: FOUNDATION
├── Setup Google Search Console & Analytics
├── Riset keyword komprehensif
├── Audit website (technical + on-page)
├── Perbaiki masalah teknis kritis
├── Buat sitemap.xml & robots.txt
├── Setup Google Business Profile
└── Buat keyword mapping document

BULAN 3-4: OPTIMASI
├── Optimasi semua halaman existing
│   ├── Title & meta description
│   ├── Heading structure
│   ├── Internal linking
│   ├── Image optimization
│   └── URL structure
├── Perbaiki Core Web Vitals
├── Tambahkan Schema markup
├── Mulai produksi konten baru (4-8 artikel)
└── Mulai outreach backlink

BULAN 5-8: CONTENT & AUTHORITY
├── Publikasi rutin (2-4 artikel/bulan)
├── Bangun topical clusters
├── Guest posting aktif
├── Update konten lama yang menurun
├── Monitor & optimasi berdasarkan data
├── A/B test title & meta description
└── Bangun internal link network

BULAN 9-12: GROWTH
├── Scale konten production
├── Target keyword yang lebih kompetitif
├── Advanced link building
├── Optimize CTR dari Search Console data
├── Expand ke konten video
├── Monitor algorithm updates
└── Refine strategy berdasarkan ROI
```

### 16.2 Harapan Realistis

```
⏰ SEO BUTUH WAKTU. Ini ekspektasi realistis:

Bulan 1-3:   Mulai terindex, data muncul di GSC
Bulan 3-6:   Mulai ranking untuk long-tail keywords
Bulan 6-9:   Traffic mulai naik signifikan
Bulan 9-12:  Hasil lebih konsisten & terukur
Bulan 12+:   Compound effect, growth akseleratif

⚠️ Jangan percaya yang bilang "ranking 1 minggu"
   Itu pasti pakai cara black-hat yang berisiko penalty!
```

### 16.3 KPI SEO

| Metrik | Target Realistis (6 bulan) | Target (12 bulan) |
|--------|---------------------------|-------------------|
| Halaman terindex | 80-100% | 95-100% |
| Keyword ranking top 10 | 20-50 | 100+ |
| Organic traffic | +50-100% | +200-500% |
| Domain Authority | Naik 5-10 poin | Naik 15-25 poin |
| Backlink referring domains | 20-50 | 100+ |
| Organic CTR | 2-5% | 5-10% |

---

## 📚 Bonus: Template & Cheat Sheet

### Template Robots.txt Lengkap

```txt
# robots.txt untuk website umum
User-agent: *

# Allow crawling
Allow: /

# Disallow sensitive areas
Disallow: /admin/
Disallow: /login/
Disallow: /register/
Disallow: /cart/
Disallow: /checkout/
Disallow: /account/
Disallow: /search
Disallow: /*?q=
Disallow: /*&sort=
Disallow: /*&page=
Disallow: /*?filter=

# Disallow file types
Disallow: /*.pdf$
Disallow: /*.zip$

# Sitemaps
Sitemap: https://example.com/sitemap.xml
Sitemap: https://example.com/sitemap-images.xml
Sitemap: https://example.com/sitemap-video.xml

# Block specific bots (optional)
User-agent: AhrefsBot
Crawl-delay: 10

User-agent: SemrushBot
Crawl-delay: 10

User-agent: GPTBot
Disallow: /
```

### Template Meta Tags Lengkap

```html
<head>
  <!-- Basic SEO -->
  <title>{Title} - {Brand}</title>
  <meta name="description" content="{Description 150-160 chars}">
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
  <link rel="canonical" href="{Canonical URL}">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="{OG Title}">
  <meta property="og:description" content="{OG Description}">
  <meta property="og:image" content="{OG Image 1200x630}">
  <meta property="og:url" content="{Page URL}">
  <meta property="og:site_name" content="{Brand Name}">
  <meta property="og:locale" content="id_ID">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{Twitter Title}">
  <meta name="twitter:description" content="{Twitter Desc}">
  <meta name="twitter:image" content="{Twitter Image}">
  <meta name="twitter:site" content="@{Twitter Handle}">

  <!-- Technical -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <link rel="manifest" href="/manifest.json">
  <meta name="theme-color" content="#ffffff">
</head>
```

### Quick Audit Checklist

```
🔍 QUICK SEO AUDIT (30 Menit)

1. [ ] Cek apakah website terindex: site:domain.com
2. [ ] Cek HTTPS aktif
3. [ ] Cek mobile-friendly: Chrome DevTools atau Mobile-Friendly Test
4. [ ] Cek PageSpeed: pagespeed.web.dev
5. [ ] Cek title tag unik setiap halaman
6. [ ] Cek meta description setiap halaman
7. [ ] Cek H1 hanya 1 per halaman
8. [ ] Cek gambar punya alt text
9. [ ] Cek broken links (Screaming Frog)
10. [ ] Cek sitemap.xml accessible
11. [ ] Cek robots.txt accessible
12. [ ] Cek canonical tags
13. [ ] Cek 404 page exists
14. [ ] Cek redirect chains (maksimal 1 redirect)
15. [ ] Cek Search Console untuk errors
```

---

## 🎯 Kesimpulan

```
SEO SUCCESS FORMULA:

┌──────────────────────────────────────────────────────────┐
│                                                          │
│   SEO = KONTEN BAGUS + TEKNIK BENAR + OTORITAS + WAKTU  │
│                                                          │
│   📝 Konten  → Jawab intent user lebih baik dari kompetitor│
│   🔧 Teknik  → Pastikan Google bisa crawl & index        │
│   🔗 Otoritas → Bangun kepercayaan melalui backlink      │
│   ⏰ Waktu   → Konsisten dan sabar (6-12 bulan)          │
│                                                          │
└──────────────────────────────────────────────────────────┘
```

> **Ingat**: SEO bukan sprint, tapi maraton. Konsistensi menghasilkan konten berkualitas dan memperbaiki hal-hal teknis akan memberikan hasil yang berkelanjutan.

---

*Dokumen ini akan terus diupdate mengikuti perubahan algoritma Google. Terakhir diperbarui: 2024.*

**Sumber referensi**: [Google Search Central](https://developers.google.com/search) | [Ahrefs Blog](https://ahrefs.com/blog) | [Moz Beginner's Guide](https://moz.com/beginners-guide-to-seo) | [Search Engine Journal](https://www.searchenginejournal.com)