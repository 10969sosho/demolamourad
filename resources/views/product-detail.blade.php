@extends('layouts.app')

@push('head')
<style>
    .product-detail-page {
        background: #fafcff;
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .clean-main {
        max-width: 1280px;
        margin: 0 auto;
        padding: 32px clamp(20px, 4vw, 48px) 80px;
    }

    /* Breadcrumb */
    .product-breadcrumb {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #94a3b8;
        margin-bottom: 36px;
    }
    .product-breadcrumb a {
        color: #64748b;
        text-decoration: none;
        transition: color 0.15s ease;
    }
    .product-breadcrumb a:hover {
        color: #5b8fa8;
    }
    .product-breadcrumb span[aria-current="page"] {
        color: #0f172a;
        font-weight: 600;
    }

    /* Main Product Layout */
    .product-detail-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr);
        gap: clamp(36px, 5vw, 64px);
        align-items: start;
        background: #ffffff;
        border: 1px solid #edf2f7;
        border-radius: 28px;
        padding: clamp(24px, 4vw, 48px);
        box-shadow: 0 12px 36px rgba(15, 23, 42, 0.04);
        margin-bottom: 64px;
    }

    /* Left: Product Showcase & Image */
    .product-showcase-container {
        position: sticky;
        top: 100px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .product-detail-image-box {
        position: relative;
        width: 100%;
        aspect-ratio: 1 / 1;
        background: radial-gradient(circle at 50% 50%, #ffffff 0%, #f8fafc 100%);
        border: 1px solid #edf2f7;
        border-radius: 20px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
        box-shadow: inset 0 2px 10px rgba(0, 0, 0, 0.02);
    }

    .product-detail-image-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        filter: drop-shadow(0 12px 24px rgba(0, 0, 0, 0.08));
    }

    .product-detail-image-box:hover img {
        transform: scale(1.04);
    }

    .product-badge-float {
        position: absolute;
        top: 16px;
        left: 16px;
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid #e2e8f0;
        backdrop-filter: blur(8px);
        padding: 6px 14px;
        border-radius: 100px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: #5b8fa8;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        z-index: 2;
    }

    .product-badge-float span.dot {
        width: 6px;
        height: 6px;
        background: #5b8fa8;
        border-radius: 50%;
    }

    /* Right: Product Details */
    .product-detail-copy {
        display: flex;
        flex-direction: column;
    }

    .product-detail-meta-top {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 14px;
    }

    .product-category-tag {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #5b8fa8;
        background: #f0f5f9;
        padding: 5px 12px;
        border-radius: 6px;
    }

    .product-brand-tag {
        font-size: 13px;
        color: #64748b;
        font-weight: 500;
    }

    .product-detail-copy h1 {
        font-size: clamp(26px, 3.2vw, 36px);
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.03em;
        color: #0f172a;
        margin: 0 0 16px;
    }

    .product-detail-price-box {
        display: flex;
        align-items: baseline;
        gap: 12px;
        padding: 16px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #f1f5f9;
    }

    .product-current-price {
        font-size: clamp(28px, 3.5vw, 38px);
        font-weight: 900;
        color: #0f172a;
        letter-spacing: -0.02em;
    }

    .product-price-label {
        font-size: 13px;
        color: #94a3b8;
        font-weight: 500;
    }

    .product-desc-title {
        font-size: 14px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #475569;
        margin: 0 0 8px;
    }

    .product-detail-description {
        font-size: 15px;
        line-height: 1.7;
        color: #64748b;
        margin: 0 0 28px;
    }

    /* Trust Guarantee Card */
    .product-trust-card {
        display: grid;
        grid-template-columns: auto 1fr;
        gap: 16px;
        align-items: center;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 16px 20px;
        margin-bottom: 32px;
    }

    .product-trust-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: #e0edf3;
        color: #3b6074;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .product-trust-text h4 {
        margin: 0 0 4px;
        font-size: 14px;
        font-weight: 700;
        color: #0f172a;
    }

    .product-trust-text p {
        margin: 0;
        font-size: 12px;
        color: #64748b;
        line-height: 1.5;
    }

    /* Actions */
    .product-detail-actions {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .product-btn-whatsapp {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: #5b8fa8;
        color: #ffffff;
        font-size: 15px;
        font-weight: 700;
        text-decoration: none;
        padding: 16px 28px;
        border-radius: 50px;
        transition: all 0.2s ease;
        box-shadow: 0 10px 24px rgba(91, 143, 168, 0.25);
    }

    .product-btn-whatsapp:hover {
        background: #4a778c;
        transform: translateY(-2px);
        box-shadow: 0 14px 28px rgba(91, 143, 168, 0.35);
        color: #ffffff;
    }

    .product-btn-whatsapp svg {
        width: 20px;
        height: 20px;
        fill: currentColor;
    }

    .product-btn-back {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: #64748b;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        padding: 10px;
        transition: color 0.15s ease;
    }

    .product-btn-back:hover {
        color: #0f172a;
    }

    /* Related Products Section */
    .product-related-section {
        margin-top: 48px;
    }

    .product-related-head {
        margin-bottom: 28px;
    }

    .product-related-eyebrow {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: #5b8fa8;
        margin: 0 0 6px;
    }

    .product-related-title {
        font-size: 24px;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
        letter-spacing: -0.02em;
    }

    .product-related-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }

    .related-card {
        background: #ffffff;
        border: 1px solid #edf2f7;
        border-radius: 18px;
        overflow: hidden;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        transition: all 0.25s ease;
    }

    .related-card:hover {
        transform: translateY(-4px);
        border-color: #cbd5e1;
        box-shadow: 0 16px 32px rgba(15, 23, 42, 0.06);
    }

    .related-card-img {
        aspect-ratio: 1 / 1;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 16px;
        overflow: hidden;
    }

    .related-card-img img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .related-card:hover .related-card-img img {
        transform: scale(1.05);
    }

    .related-card-body {
        padding: 18px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .related-card-category {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        color: #5b8fa8;
        margin: 0 0 6px;
    }

    .related-card-title {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 10px;
        line-height: 1.4;
    }

    .related-card-price {
        font-size: 16px;
        font-weight: 800;
        color: #0f172a;
        margin-top: auto;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .product-detail-layout {
            grid-template-columns: 1fr;
            gap: 32px;
            padding: 24px;
        }
        .product-showcase-container {
            position: static;
            max-width: 480px;
            margin: 0 auto;
            width: 100%;
        }
        .product-related-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }
    }

    @media (max-width: 540px) {
        .product-related-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="product-detail-page">
    @include('partials.site-nav')

    <main class="clean-main">
        <nav class="product-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Beranda</a>
            <span>/</span>
            <a href="{{ route('products') }}">Produk</a>
            <span>/</span>
            <span aria-current="page">{{ $product->name }}</span>
        </nav>

        <section class="product-detail-layout">
            <div class="product-showcase-container">
                <div class="product-detail-image-box">
                    <div class="product-badge-float">
                        <span class="dot"></span> 100% Original BPOM
                    </div>
                    <img src="{{ $product->image ? (str_starts_with($product->image, '/') || preg_match('~^https?://~i', $product->image) ? $product->image : asset('storage/'.$product->image)) : '/images/liefmarket-3/1.png' }}" 
                         alt="{{ $product->name }}" 
                         onerror="this.onerror=null;this.src='/images/liefmarket-3/1.png'">
                </div>
            </div>

            <div class="product-detail-copy">
                <div class="product-detail-meta-top">
                    @if ($product->category)
                        <span class="product-category-tag">{{ $product->category }}</span>
                    @endif
                    <span class="product-brand-tag">{{ $product->time ?: 'liefmarket official store' }}</span>
                </div>

                <h1>{{ $product->name }}</h1>

                <div class="product-detail-price-box">
                    <span class="product-current-price">{{ $product->price ?: 'Hubungi Admin' }}</span>
                    <span class="product-price-label">/ harga resmi terverifikasi</span>
                </div>

                <div class="product-desc-title">Deskripsi Produk</div>
                <p class="product-detail-description">
                    {{ $product->desc ?: 'Produk pilihan liefmarket untuk menemani kebutuhan perawatan kulit, tubuh, dan kesehatan keluarga Anda dengan jaminan mutu dan keaslian 100%.' }}
                </p>

                <div class="product-trust-card">
                    <div class="product-trust-icon">✓</div>
                    <div class="product-trust-text">
                        <h4>Jaminan Keaslian Produk 100%</h4>
                        <p>Produk resmi bersertifikasi BPOM, tersegel rapat dari distributor terpercaya, dan aman untuk pemakaian harian.</p>
                    </div>
                </div>

                <div class="product-detail-actions">
                    <button type="button" class="product-btn-whatsapp" onclick="openCheckoutModal('{{ addslashes($product->name) }}', '{{ addslashes($product->price) }}')" style="border: none; cursor: pointer;">
                        <svg aria-hidden="true" viewBox="0 0 24 24"><path d="M19.5 7.05h-2.17c-.36-2.91-2.4-4.8-5.33-4.8s-4.97 1.89-5.33 4.8H4.5c-.83 0-1.5.67-1.5 1.5l1.09 11.96C4.16 21.36 4.99 22 6 22h12c1.01 0 1.84-.64 1.91-1.69L21 8.55c0-.83-.67-1.5-1.5-1.5zm-7.5-3.3c1.97 0 3.48 1.25 3.82 3.3H8.18c.34-2.05 1.85-3.3 3.82-3.3zm6.5 16.75H5.5L4.55 8.55h14.9l-.95 11.95zM12 11.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"/></svg>
                        Checkout Sekarang (Shopee, TikTok, WhatsApp)
                    </button>
                    <a class="product-btn-back" href="{{ route('products') }}">
                        ← Kembali ke Katalog Produk
                    </a>
                </div>
            </div>
        </section>

        @if ($relatedProducts->isNotEmpty())
            <section class="product-related-section">
                <div class="product-related-head">
                    <p class="product-related-eyebrow">REKOMENDASI LAINNYA</p>
                    <h2 class="product-related-title">Produk Pilihan untuk Anda</h2>
                </div>
                <div class="product-related-grid">
                    @foreach ($relatedProducts as $relatedProduct)
                        <a href="{{ route('products.detail', $relatedProduct->id) }}" class="related-card">
                            <div class="related-card-img">
                                <img src="{{ $relatedProduct->image ? (str_starts_with($relatedProduct->image, '/') || preg_match('~^https?://~i', $relatedProduct->image) ? $relatedProduct->image : asset('storage/'.$relatedProduct->image)) : '/images/liefmarket-3/1.png' }}" 
                                     alt="{{ $relatedProduct->name }}" 
                                     loading="lazy" 
                                     onerror="this.onerror=null;this.src='/images/liefmarket-3/1.png'">
                            </div>
                            <div class="related-card-body">
                                <span class="related-card-category">{{ $relatedProduct->category }}</span>
                                <h3 class="related-card-title">{{ $relatedProduct->name }}</h3>
                                <div class="related-card-price">{{ $relatedProduct->price }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </main>

    @include('partials.checkout-modal')
    @include('partials.site-footer')
</div>
@endsection
