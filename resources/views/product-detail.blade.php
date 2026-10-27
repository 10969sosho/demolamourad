@extends('layouts.app')

@section('content')
<div class="clean-page product-detail-page">
    @include('partials.site-nav')

    <main class="clean-main">
        <nav class="product-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Beranda</a><span>/</span>
            <a href="{{ route('products') }}">Produk</a><span>/</span>
            <span aria-current="page">{{ $product->name }}</span>
        </nav>

        <section class="product-detail-layout">
            <div class="product-detail-image">
                <img src="{{ $product->image ? (str_starts_with($product->image, '/') || preg_match('~^https?://~i', $product->image) ? $product->image : asset('storage/'.$product->image)) : '/images/liefmarket-32/1.webp' }}" alt="{{ $product->name }}" onerror="this.onerror=null;this.src='/images/liefmarket-32/1.webp'">
            </div>
            <div class="product-detail-copy">
                <div class="product-detail-badges">
                    @if ($product->category)<span>{{ $product->category }}</span>@endif
                    @if ($product->time)<span>{{ $product->time }}</span>@endif
                </div>
                <h1>{{ $product->name }}</h1>
                <p class="product-detail-description">{{ $product->desc ?: 'Produk pilihan LiefMarket untuk menemani kebutuhan perawatan Anda.' }}</p>
                <div class="product-authenticity"><span aria-hidden="true">✓</span><p><strong>100% Original & Terpercaya</strong><br>Produk dijamin asli dan sesuai informasi resmi BPOM.</p></div>
                <div class="product-detail-actions">
                    <a class="clean-button product-whatsapp-button" href="{{ $whatsappUrl }}" target="_blank" rel="noopener"><svg aria-hidden="true" viewBox="0 0 24 24"><path d="M20.5 3.5A11.8 11.8 0 0 0 12.1 0C5.6 0 .3 5.3.3 11.8c0 2.1.6 4.2 1.7 6L0 24l6.4-1.7a11.8 11.8 0 0 0 5.7 1.5h.1c6.5 0 11.8-5.3 11.8-11.8 0-3.2-1.2-6.2-3.5-8.5ZM12.1 21.8a9.9 9.9 0 0 1-5-1.4l-.4-.2-3.8 1 1-3.7-.3-.4a9.8 9.8 0 0 1-1.5-5.3c0-5.5 4.5-10 10-10 2.7 0 5.2 1 7.1 2.9a9.9 9.9 0 0 1 2.9 7.1c0 5.5-4.5 10-10 10Zm5.5-7.5c-.3-.2-1.7-.9-2-.9-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.2-.2.2-.4.2-.7.1-.3-.2-1.2-.4-2.3-1.4-.9-.8-1.5-1.7-1.7-2-.2-.3 0-.5.1-.6l.5-.6c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5 0-.2-.7-1.6-1-2.1-.2-.5-.5-.4-.7-.4h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-.9 2.4 0 1.4 1 2.7 1.1 2.9.2.2 2 3.1 4.8 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.7-.7 1.9-1.3.2-.6.2-1.1.2-1.2-.1-.3-.3-.4-.6-.6Z"/></svg>Pesan via WhatsApp Langsung</a>
                    <a class="clean-secondary-link" href="{{ route('products') }}">Kembali ke Produk</a>
                </div>
            </div>
        </section>

        @if ($relatedProducts->isNotEmpty())
            <section class="clean-section product-related">
                <div class="clean-section-heading">
                    <p class="clean-eyebrow">PILIHAN LAIN</p>
                    <h2>Rekomendasi produk lainnya</h2>
                </div>
                <div class="clean-grid">
                    @foreach ($relatedProducts as $relatedProduct)
                        <article class="clean-product-card">
                            <a class="clean-product-image" href="{{ route('products.detail', $relatedProduct->id) }}">
                                <img src="{{ $relatedProduct->image ? (str_starts_with($relatedProduct->image, '/') || preg_match('~^https?://~i', $relatedProduct->image) ? $relatedProduct->image : asset('storage/'.$relatedProduct->image)) : '/images/liefmarket-32/1.webp' }}" alt="{{ $relatedProduct->name }}" loading="lazy" onerror="this.onerror=null;this.src='/images/liefmarket-32/1.webp'">
                            </a>
                            <div class="clean-product-body">
                                <p class="clean-product-category">{{ $relatedProduct->category }}</p>
                                <h3><a href="{{ route('products.detail', $relatedProduct->id) }}">{{ $relatedProduct->name }}</a></h3>
                                <a class="clean-secondary-link" href="{{ route('products.detail', $relatedProduct->id) }}">Lihat detail</a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    </main>

    @include('partials.site-footer')
</div>
@endsection
