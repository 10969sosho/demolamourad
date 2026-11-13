@extends('layouts.app')

@section('content')
@php
    $hero = data_get($content, 'hero', []);
    $intro = data_get($content, 'intro', []);
    $brand = data_get($content, 'navbar', []);
    $whatsappNumber = preg_replace('/\D/', '', (string) data_get($content, 'contact.whatsapp', ''));

    // Brands partner in LiefMarket
    $brands = [
        ['name' => 'Viva Cosmetics', 'desc' => 'Perawatan Tradisional Legendaris Indonesia', 'badge' => 'Since 1962'],
        ['name' => 'Ovale Official', 'desc' => 'Pembersih Wajah Ekstrak Alami', 'badge' => 'BPOM Certified'],
        ['name' => 'Dragon Menthol', 'desc' => 'Herbal & Minyak Gosok Tradisi Nusantara', 'badge' => '100% Herbal'],
        ['name' => 'Garnier Natural', 'desc' => 'Serum & Masker Ekstrak Sakura Cerah', 'badge' => 'Dermatologist Tested'],
        ['name' => 'Harmony Soap', 'desc' => 'Sabun Mandi Buah Aromaterapi Segar', 'badge' => 'Family Care'],
        ['name' => 'Mini Kidi Care', 'desc' => 'Tisu Basah Lembut Khusus Ibu & Bayi', 'badge' => 'Safe for Sensitive'],
    ];

    // Categories
    $categories = [
        ['title' => 'Skincare & Glow', 'slug' => 'SKINCARE', 'desc' => 'Serum, toner, dan masker pelembap', 'img' => '/images/liefmarket-3/10.png', 'color' => '#f0f5ff'],
        ['title' => 'Body & Bath', 'slug' => 'BODY CARE', 'desc' => 'Sabun aromaterapi dan lotion badan', 'img' => '/images/liefmarket-3/12.png', 'color' => '#f8f9fc'],
        ['title' => 'Herbal Nusantara', 'slug' => 'KESEHATAN', 'desc' => 'Minyak gosok, balsem, dan menthol', 'img' => '/images/liefmarket-3/3.png', 'color' => '#f0fdf4'],
        ['title' => 'Kosmetik Alami', 'slug' => 'KOSMETIK', 'desc' => 'Cushion, bedak, dan pewarna bibir', 'img' => '/images/liefmarket-3/1.png', 'color' => '#fdf2f8'],
        ['title' => 'Ibu & Bayi Sehat', 'slug' => 'IBU & BAYI', 'desc' => 'Tisu basah dan perawatan anak aman', 'img' => '/images/liefmarket-3/14.png', 'color' => '#eff6ff'],
    ];
@endphp

@push('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,400;1,600;1,700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* Reset & Base modern styling */
    .lm-home {
        background: #ffffff;
        color: #1a1f2c;
        overflow-x: hidden;
    }

    /* 1. HERO SECTION FULL SCREEN */
    .lm-hero-fullscreen {
        position: relative;
        min-height: calc(100vh - 105px);
        display: flex;
        align-items: center;
        background: radial-gradient(circle at 80% 20%, #223348 0%, #151f2e 50%, #0d1520 100%);
        color: #ffffff;
        overflow: hidden;
        padding: 60px clamp(20px, 4vw, 64px);
    }
    .lm-hero-fullscreen::before {
        content: '';
        position: absolute;
        width: 600px;
        height: 600px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(91, 143, 168, 0.15) 0%, transparent 70%);
        top: -100px;
        right: -100px;
        pointer-events: none;
    }
    .lm-hero-container {
        max-width: 1360px;
        width: 100%;
        margin: 0 auto;
        display: grid;
        grid-template-columns: 1.1fr 1fr;
        align-items: center;
        gap: 48px;
        position: relative;
        z-index: 2;
    }
    .lm-hero-left {
        max-width: 580px;
    }
    .lm-hero-tagline {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #7eaec4;
        letter-spacing: 0.15em;
        margin-bottom: 20px;
    }
    .lm-hero-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(40px, 5.5vw, 76px);
        font-weight: 700;
        line-height: 1.08;
        letter-spacing: -0.02em;
        color: #ffffff;
        margin: 0 0 24px;
    }
    .lm-hero-title em {
        font-style: italic;
        font-weight: 400;
        color: #cbd5e1;
    }
    .lm-hero-title span.blue-text {
        color: #5b8fa8;
    }
    .lm-hero-desc {
        font-size: clamp(16px, 1.8vw, 18px);
        line-height: 1.65;
        color: #94a3b8;
        margin: 0 0 36px;
    }
    .lm-hero-actions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
    }
    .lm-btn-primary {
        background: #5b8fa8;
        color: #ffffff;
        font-size: 15px;
        font-weight: 700;
        padding: 16px 32px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        box-shadow: 0 10px 24px rgba(13, 85, 255, 0.25);
    }
    .lm-btn-primary:hover {
        background: #4a778c;
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(13, 85, 255, 0.35);
    }
    .lm-btn-outline {
        border: 1.5px solid rgba(255, 255, 255, 0.25);
        background: rgba(255, 255, 255, 0.05);
        color: #ffffff;
        font-size: 15px;
        font-weight: 600;
        padding: 15px 28px;
        border-radius: 50px;
        text-decoration: none;
        backdrop-filter: blur(8px);
        transition: all 0.2s;
    }
    .lm-btn-primary {
        border-radius: 50px !important;
    }
    .lm-btn-outline:hover {
        border-color: #5b8fa8;
        color: #5b8fa8;
    }

    .lm-hero-right {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .lm-hero-img-wrapper {
        position: relative;
        width: 100%;
        max-width: 480px;
        aspect-ratio: 1/1;
        border-radius: 28px;
        overflow: hidden;
        background: #ffffff;
        padding: 12px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 24px 60px rgba(0, 0, 0, 0.35), 0 0 40px rgba(91, 143, 168, 0.15);
    }
    .lm-hero-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;
        display: block;
    }
    .lm-hero-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .lm-hero-badge {
        position: absolute;
        top: 24px;
        left: -20px;
        width: 110px;
        height: 110px;
        border-radius: 50%;
        background: #5b8fa8;
        color: #fff;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
        box-shadow: 0 12px 24px rgba(13, 85, 255, 0.35);
        border: 4px solid #ffffff;
        z-index: 3;
    }

    /* 2. BRANDS SECTION */
    .lm-brands-section {
        background: #ffffff;
        border-top: 1px solid #f1f5f9;
        border-bottom: 1px solid #f1f5f9;
        padding: 56px 0;
    }
    .lm-section-head-center {
        text-align: center;
        max-width: 640px;
        margin: 0 auto 40px;
        padding: 0 20px;
    }
    .lm-eyebrow {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #5b8fa8;
        margin: 0 0 10px;
    }
    .lm-section-title {
        font-size: clamp(26px, 3.5vw, 40px);
        font-weight: 800;
        letter-spacing: -0.02em;
        color: #0f172a;
        margin: 0;
    }
    .lm-section-title span.blue-text {
        color: #5b8fa8;
    }
    .lm-brands-grid {
        max-width: 1360px;
        margin: 0 auto;
        padding: 0 clamp(20px, 4vw, 48px);
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
    }
    .lm-brand-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 24px 20px;
        text-align: center;
        transition: all 0.25s ease;
    }
    .lm-brand-card:hover {
        border-color: #5b8fa8;
        background: #ffffff;
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(13, 85, 255, 0.08);
    }
    .lm-brand-badge {
        display: inline-block;
        background: #e0e7ff;
        color: #5b8fa8;
        font-size: 10px;
        font-weight: 700;
        padding: 4px 8px;
        border-radius: 99px;
        margin-bottom: 12px;
    }
    .lm-brand-card h4 {
        margin: 0 0 6px;
        font-size: 16px;
        font-weight: 800;
        color: #1e293b;
    }
    .lm-brand-card p {
        margin: 0;
        font-size: 12px;
        color: #64748b;
        line-height: 1.4;
    }

    /* 3. SHOP BY CATEGORIES */
    .lm-categories-section {
        background: #fbfcfe;
        padding: 80px 0;
    }
    .lm-categories-grid {
        max-width: 1360px;
        margin: 0 auto;
        padding: 0 clamp(20px, 4vw, 48px);
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 24px;
    }
    .lm-cat-card {
        background: #ffffff;
        border: 1px solid #e8eef6;
        border-radius: 16px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        transition: all 0.25s ease;
        display: flex;
        flex-direction: column;
    }
    .lm-cat-card:hover {
        border-color: #5b8fa8;
        transform: translateY(-4px);
        box-shadow: 0 16px 32px rgba(13, 85, 255, 0.08);
    }
    .lm-cat-img-box {
        aspect-ratio: 1/1;
        width: 100%;
        background: #f1f5f9;
        overflow: hidden;
    }
    .lm-cat-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .lm-cat-card:hover .lm-cat-img-box img {
        transform: scale(1.05);
    }
    .lm-cat-info {
        padding: 20px;
        text-align: center;
    }
    .lm-cat-info h3 {
        margin: 0 0 6px;
        font-size: 16px;
        font-weight: 800;
        color: #0f172a;
    }
    .lm-cat-info p {
        margin: 0 0 12px;
        font-size: 13px;
        color: #64748b;
        line-height: 1.4;
    }
    .lm-cat-link {
        font-size: 13px;
        font-weight: 700;
        color: #5b8fa8;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    /* 4. PRODUCT HIGHLIGHT / FAVORITES */
    .lm-products-section {
        background: #ffffff;
        padding: 80px 0 100px;
    }
    .lm-products-head-row {
        max-width: 1360px;
        margin: 0 auto 40px;
        padding: 0 clamp(20px, 4vw, 48px);
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 24px;
    }
    .lm-products-grid {
        max-width: 1360px;
        margin: 0 auto;
        padding: 0 clamp(20px, 4vw, 48px);
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }
    .lm-prod-card {
        background: #ffffff;
        border: 1px solid #eef2f7;
        border-radius: 14px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: all 0.25s ease;
        position: relative;
    }
    .lm-prod-card:hover {
        border-color: #5b8fa8;
        box-shadow: 0 14px 30px rgba(13, 85, 255, 0.08);
        transform: translateY(-4px);
    }
    .lm-prod-badge {
        position: absolute;
        top: 14px;
        left: 14px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        color: #5b8fa8;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 99px;
        z-index: 2;
        border: 1px solid #e0e7ff;
    }
    .lm-prod-img-box {
        aspect-ratio: 1/1;
        width: 100%;
        background: #f8fafc;
        position: relative;
        overflow: hidden;
    }
    .lm-prod-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.35s ease;
    }
    .lm-prod-card:hover .lm-prod-img-box img {
        transform: scale(1.04);
    }
    .lm-prod-body {
        padding: 18px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    .lm-prod-brand {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #64748b;
        margin-bottom: 6px;
    }
    .lm-prod-title {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 8px;
        line-height: 1.4;
    }
    .lm-prod-title a {
        color: inherit;
        text-decoration: none;
    }
    .lm-prod-title a:hover {
        color: #5b8fa8;
    }
    .lm-prod-price {
        font-size: 16px;
        font-weight: 800;
        color: #5b8fa8;
        margin-top: auto;
        margin-bottom: 14px;
    }
    .lm-prod-actions {
        display: flex;
        gap: 8px;
    }
    .lm-btn-order-wa {
        flex: 1;
        background: #5b8fa8;
        color: #ffffff;
        font-size: 13px;
        font-weight: 700;
        padding: 10px;
        border-radius: 6px;
        text-align: center;
        text-decoration: none;
        transition: background 0.15s;
    }
    .lm-btn-order-wa:hover {
        background: #4a778c;
    }
    .lm-btn-detail {
        background: #f1f5f9;
        color: #475569;
        font-size: 13px;
        font-weight: 700;
        padding: 10px 14px;
        border-radius: 6px;
        text-decoration: none;
        transition: background 0.15s;
    }
    .lm-btn-detail:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    /* 5. PROMO BANNER BLUE SECTION */
    .lm-upgrade-banner {
        background: linear-gradient(135deg, #151f2e 0%, #1e2d3e 100%); border-top: 1px solid rgba(255,255,255,0.08); border-bottom: 1px solid rgba(255,255,255,0.08);
        color: #ffffff;
        padding: 64px 0;
        margin: 20px 0;
    }
    .lm-upgrade-container {
        max-width: 1360px;
        margin: 0 auto;
        padding: 0 clamp(20px, 4vw, 48px);
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        gap: 40px;
    }
    .lm-upgrade-text h2 {
        font-size: clamp(28px, 4vw, 44px);
        font-weight: 800;
        line-height: 1.15;
        margin: 0 0 16px;
    }
    .lm-upgrade-text p {
        font-size: 16px;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.9);
        margin: 0 0 28px;
    }
    .lm-btn-white {
        background: #ffffff;
        color: #5b8fa8;
        font-size: 14px;
        font-weight: 800;
        padding: 14px 28px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.2s;
    }
    .lm-btn-white:hover {
        background: #f0f5ff;
        transform: translateY(-2px);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .lm-products-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    @media (max-width: 820px) {
        .lm-hero-fullscreen {
            min-height: auto;
            padding: 40px 20px 60px;
        }
        .lm-hero-container {
            grid-template-columns: 1fr;
            text-align: center;
            gap: 36px;
        }
        .lm-hero-left {
            max-width: 100%;
        }
        .lm-hero-actions {
            justify-content: center;
        }
        .lm-hero-badge {
            left: 20px;
        }
        .lm-products-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
        .lm-upgrade-container {
            grid-template-columns: 1fr;
            text-align: center;
        }
    }
    @media (max-width: 480px) {
        .lm-products-grid {
            grid-template-columns: 1fr;
        }
        .lm-brands-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endpush

<div class="lm-home">
    @include('partials.site-nav')

    {{-- 1. HERO SECTION FULL SCREEN --}}
    <section class="lm-hero-fullscreen" id="hero">
        <div class="lm-hero-container">
            <div class="lm-hero-left">
                <div class="lm-hero-tagline">
                    <span>✦</span> LIEFMARKET OFFICIAL STORE <span>✦</span>
                </div>
                <h1 class="lm-hero-title">
                    Perawatan Terbaik<br><em>Keluarga Anda.</em>
                </h1>
                <p class="lm-hero-desc">
                    {{ data_get($hero, 'description') ?: 'Belanja kebutuhan perawatan kulit, tubuh, dan kesehatan keluarga dengan jaminan 100% produk asli berizin resmi BPOM.' }}
                </p>
                <div class="lm-hero-actions">
                    <a href="/products" class="lm-btn-primary">
                        Jelajahi Produk <span>→</span>
                    </a>
                    <a href="#brands" class="lm-btn-outline">
                        Pilihan Brand
                    </a>
                </div>
            </div>

            <div class="lm-hero-right">
                <div class="lm-hero-img-wrapper">
                    <img src="{{ !empty($hero['bgImage']) ? (str_starts_with($hero['bgImage'], '/') || preg_match('~^https?://~i', $hero['bgImage']) ? $hero['bgImage'] : asset('storage/'.$hero['bgImage'])) : '/images/liefmarket-3/1.png' }}" alt="LiefMarket Hero Collection">
                    <div class="lm-hero-badge">
                        <span>100%</span>
                        <span style="font-size: 8px;">ORIGINAL</span>
                        <span>BPOM</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 2. BRAND BRAND YANG ADA DI LIEFMARKET --}}
    <section class="lm-brands-section" id="brands">
        <div class="lm-section-head-center">
            <p class="lm-eyebrow">PARTNER RESMI & DISTRIBUTOR</p>
            <h2 class="lm-section-title">Brand terpercaya di <span class="blue-text">LiefMarket.</span></h2>
        </div>
        <div class="lm-brands-grid">
            @foreach ($brands as $b)
                <div class="lm-brand-card">
                    <span class="lm-brand-badge">{{ $b['badge'] }}</span>
                    <h4>{{ $b['name'] }}</h4>
                    <p>{{ $b['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 3. SHOP BY CATEGORIES --}}
    <section class="lm-categories-section" id="categories">
        <div class="lm-section-head-center">
            <p class="lm-eyebrow">KATEGORI PRODUK</p>
            <h2 class="lm-section-title">Shop by <span class="blue-text">category.</span></h2>
        </div>
        <div class="lm-categories-grid">
            @foreach ($categories as $cat)
                <a href="/products?category={{ urlencode($cat['slug']) }}" class="lm-cat-card">
                    <div class="lm-cat-img-box">
                        <img src="{{ $cat['img'] }}" alt="{{ $cat['title'] }}" loading="lazy">
                    </div>
                    <div class="lm-cat-info">
                        <h3>{{ $cat['title'] }}</h3>
                        <p>{{ $cat['desc'] }}</p>
                        <span class="lm-cat-link">Lihat Produk →</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- BANNER PROMO BLUE SECTION (SESUAI GAMBAR) --}}
    <section class="lm-upgrade-banner">
        <div class="lm-upgrade-container">
            <div class="lm-upgrade-text">
                <h2>A little upgrade to your daily routine.</h2>
                <p>Temukan rangkaian produk perawatan dan herbal alami pilihan yang aman untuk seluruh anggota keluarga tercinta.</p>
                <a href="/products" class="lm-btn-white">Mulai Belanja Sekarang →</a>
            </div>
            <div style="text-align: center;">
                <img src="/images/liefmarket-32/70.webp" alt="Routine upgrade" style="max-width: 320px; border-radius: 16px; box-shadow: 0 16px 32px rgba(0,0,0,0.2);">
            </div>
        </div>
    </section>

    {{-- 4. PRODUCT HIGHLIGHT / FAVORITES --}}
    <section class="lm-products-section" id="highlights">
        <div class="lm-products-head-row">
            <div>
                <p class="lm-eyebrow">PILIHAN TERBAIK MINGGU INI</p>
                <h2 class="lm-section-title">Your everyday <span class="blue-text">favorites.</span></h2>
            </div>
            <div>
                <a href="/products" class="lm-btn-outline" style="font-size: 13px; padding: 10px 18px;">
                    Lihat Semua ({{ count($products) }}+) →
                </a>
            </div>
        </div>

        <div class="lm-products-grid">
            @foreach ($products as $p)
                @php
                    $prodWaUrl = $whatsappNumber !== ''
                        ? 'https://wa.me/'.$whatsappNumber.'?text='.rawurlencode('Halo admin LiefMarket, saya ingin berkonsultasi / memesan '.$p->name.' ('.$p->price.'). Apakah stok masih tersedia?')
                        : route('contact');
                    $imgSrc = $p->image ? (str_starts_with($p->image, '/') || preg_match('~^https?://~i', $p->image) ? $p->image : asset('storage/'.$p->image)) : '/images/liefmarket-3/2.png';
                @endphp
                <article class="lm-prod-card">
                    <span class="lm-prod-badge">{{ $p->tag ?: 'PRODUK PILIHAN' }}</span>
                    <div class="lm-prod-img-box">
                        <img src="{{ $imgSrc }}" alt="{{ $p->name }}" loading="lazy" onerror="this.onerror=null;this.src='/images/liefmarket-3/2.png'">
                    </div>
                    <div class="lm-prod-body">
                        <span class="lm-prod-brand">{{ $p->time ?: 'LiefMarket Official' }}</span>
                        <h3 class="lm-prod-title">
                            <a href="{{ route('products.detail', $p->id) }}">{{ $p->name }}</a>
                        </h3>
                        <div class="lm-prod-price">{{ $p->price }}</div>
                        <div class="lm-prod-actions">
                            <a href="{{ $prodWaUrl }}" target="_blank" rel="noopener" class="lm-btn-order-wa">Pesan WA</a>
                            <a href="{{ route('products.detail', $p->id) }}" class="lm-btn-detail">Detail</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- 5. FOOTER --}}
    @include('partials.site-footer')
</div>
@endsection
