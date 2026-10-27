@extends('layouts.app')

@section('content')
@php
    $hero = $content['hero'];
    $intro = $content['intro'];
    $brand = $content['navbar'];
    $heroTitle = explode("\n", $hero['title']);
    $heroTitleFirst = array_shift($heroTitle);
    $introTitle = explode("\n", $intro['title']);
    $introTitleFirst = array_shift($introTitle);
    $marqueeList = [
        'LIEFMARKET SURABAYA',
        '100% PRODUK ORIGINAL & BPOM',
        'PERAWATAN KULIT & KESEHATAN KELUARGA',
        'LAYANAN CEPAT & TERPERCAYA',
        'PRODUK ASLI DARI DISTRIBUTOR RESMI',
        'AMAN UNTUK SELURUH KELUARGA',
        'GARANSI KEASLIAN PRODUK',
        'PENGIRIMAN AMAN SELURUH INDONESIA',
    ];
@endphp

@push('head')
<style>
    .clean-home .site-nav{position:fixed;top:0;right:0;left:0;z-index:100}
    .clean-home .loader-logo .brand-lief{color:var(--sage-light)}
</style>
@endpush

<div class="clean-home">
    <div class="loader" id="loader" role="status" aria-label="Memuat LiefMarket">
        <div class="loader-orbit" aria-hidden="true"></div>
        <div class="loader-logo"><span class="brand-lief">{{ data_get($brand, 'brandName', 'LiefMarket') }}</span></div>
        <div class="loader-bottom">
            <span>MENYIAPKAN KATALOG</span>
            <b id="loader-percent">0%</b>
            <div role="progressbar" aria-label="Memuat halaman" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <i id="loader-bar" style="transform:scaleX(0)"></i>
            </div>
        </div>
    </div>

    @include('partials.site-nav')

    <main id="top" class="deck-stack-container">
        <section class="hero deck-section deck-hero" id="hero">
            <div class="hero-copy">
                <p class="eyebrow hero-eyebrow">LIEFMARKET SURABAYA <span>✦</span> 100% ORIGINAL BPOM</p>
                <h1>{{ $heroTitleFirst }}@if ($heroTitle)<br><em>{{ implode(' ', $heroTitle) }}</em>@endif</h1>
                <p class="hero-desc">{{ $hero['description'] }}</p>
                <div class="hero-actions">
                    <a class="red-button" href="{{ route('products') }}">JELAJAHI PRODUK <span aria-hidden>→</span></a>
                    <a class="ghost-button" href="{{ route('contact') }}">HUBUNGI KAMI <span aria-hidden>→</span></a>
                </div>
            </div>
            <div class="hero-art" id="hero-art">
                <div class="hero-photo" id="hero-photo"><img src="{{ ! empty($hero['bgImage']) ? (str_starts_with($hero['bgImage'], '/') || preg_match('~^https?://~i', $hero['bgImage']) ? $hero['bgImage'] : asset('storage/'.$hero['bgImage'])) : '/images/liefmarket-32/70.webp' }}" alt="Paket Perawatan LiefMarket" onerror="this.onerror=null;this.src='/images/liefmarket-32/70.webp'"></div>
                <div class="hero-badge">✓ 100% ORIGINAL BPOM</div>
            </div>
        </section>

        <section class="deck-section deck-intro" id="about">
            <div class="marquee-container marquee-light">
                <div class="marquee-track">
                    @foreach ($marqueeList as $item)
                        <span class="marquee-item"><span class="star">✦</span> {{ $item }}</span>
                    @endforeach
                </div>
                <div class="marquee-track" aria-hidden="true">
                    @foreach ($marqueeList as $item)
                        <span class="marquee-item"><span class="star">✦</span> {{ $item }}</span>
                    @endforeach
                </div>
            </div>
            <div class="intro">
                <div class="intro-mark">✳</div>
                <p class="eyebrow">SEJAK AWAL BERSAMA ANDA</p>
                <h2>{{ $introTitleFirst }}@if ($introTitle)<br><em>{{ implode(' ', $introTitle) }}</em>@endif</h2>
                <p>{{ $intro['subtitle'] }}</p>
                <a class="text-link" href="#products">JELAJAHI PRODUK <span aria-hidden>→</span></a>
                <div class="intro-stats">
                    @foreach ($intro['items'] as $item)
                        <div class="intro-stat-item"><strong>{{ $item['value'] }}</strong><span>{{ $item['label'] }}</span></div>
                    @endforeach
                </div>
            </div>
        </section>

        <div class="deck-recipes-wrapper" id="recipes">
            <div class="deck-recipes-sticky">
                <div class="recipe-header-bar">
                    <div class="section-heading light">
                        <p class="eyebrow">KATALOG LIEFMARKET ✦</p>
                        <h2>PRODUK PILIHAN</h2>
                        <p class="section-copy">Pilihan Terbaik untuk Anda</p>
                    </div>
                </div>
                <div class="horizontal-track-container">
                    <div class="recipe-horizontal-track" id="recipe-track">
                        @foreach ($products as $product)
                            <article class="recipe-card-modern">
                                <div class="recipe-card-photo">
                                    <img src="{{ $product->image ? (str_starts_with($product->image, '/') || preg_match('~^https?://~i', $product->image) ? $product->image : asset('storage/'.$product->image)) : '/images/liefmarket-32/1.webp' }}" alt="{{ $product->name }}" loading="lazy" onerror="this.onerror=null;this.src='/images/liefmarket-32/1.webp'">
                                </div>
                                <div class="recipe-card-body">
                                    <div class="recipe-card-meta"><span>{{ $product->category }}</span><span>{{ $product->time }}</span></div>
                                    <h3>{{ $product->name }}</h3>
                                    <div class="recipe-card-foot">
                                        <a class="recipe-view-btn" href="{{ route('products.detail', $product->id) }}">Lihat Detail <span aria-hidden>→</span></a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div class="horizontal-controls-bar">
                    <div class="horizontal-progress-bar">
                        <span>01</span><div class="bar-track"><div class="bar-fill" id="recipe-bar-fill" style="width:10%"></div></div>
                        <span id="recipe-count">{{ str_pad((string) $products->count(), 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="percent-label" id="recipe-percent">0% SLIDE</span>
                    </div>
                    <div class="horizontal-nav-arrows">
                        <button class="nav-arrow-btn" id="recipe-prev" aria-label="Slide sebelumnya">←</button>
                        <button class="nav-arrow-btn" id="recipe-next" aria-label="Slide berikutnya">→</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="deck-products-wrapper" id="products-wrapper">
            <section class="deck-products-sticky deck-section deck-products" id="products" style="background:#0f2117">
                <div class="product-ambient-disc" id="product-disc" style="background:#2d5a44"></div>
                <div class="product-showcase-container">
                    <div class="section-heading light">
                        <p class="eyebrow">PRODUK UNGGULAN KAMI ✦</p>
                        <h2>PILIHAN TEPAT,<br>SELALU ADA</h2>
                    </div>
                    <div class="product-3d-stage">
                        <div class="product-info-panel">
                            <h3 id="product-name">{{ $showcase[0]['name'] ?? '' }}</h3>
                            <p class="product-showcase-brand" id="product-brand">{{ $showcase[0]['brand'] ?? '' }}</p>
                            <p class="product-desc" id="product-desc">{{ $showcase[0]['desc'] ?? '' }}</p>
                            <div class="product-actions">
                                <a class="red-button" id="product-detail-link" href="{{ $showcase[0]['detailUrl'] ?? route('products') }}">LIHAT DETAIL <span aria-hidden>→</span></a>
                                <a class="ghost-button" id="product-whatsapp-link" href="{{ $showcase[0]['whatsappUrl'] ?? route('contact') }}" target="_blank" rel="noopener">BELI SEKARANG VIA WHATSAPP</a>
                            </div>
                        </div>
                        <div class="product-cards-carousel" id="product-carousel">
                            @foreach ($showcase as $index => $item)
                                <div class="coverflow-card {{ $index === 0 ? 'is-active' : ($index === count($showcase) - 1 ? 'is-prev' : ($index === 1 ? 'is-next' : 'is-hidden')) }}" data-index="{{ $index }}">
                                    <img src="{{ ! empty($item['image']) ? (str_starts_with($item['image'], '/') || preg_match('~^https?://~i', $item['image']) ? $item['image'] : asset('storage/'.$item['image'])) : '/images/liefmarket-32/1.webp' }}" alt="{{ $item['name'] }}" loading="lazy" onerror="this.onerror=null;this.src='/images/liefmarket-32/1.webp'">
                                    <div class="coverflow-card-info"><h4>{{ $item['name'] }}</h4><span>{{ $item['tagline'] }}</span></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="product-selector-tabs" id="product-tabs">
                        @foreach ($showcase as $index => $item)
                            <button class="product-tab-btn{{ $index === 0 ? ' active' : '' }}" data-index="{{ $index }}"><span class="tab-dot" style="background:{{ $item['color'] }}"></span>{{ $item['name'] }}</button>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>

        @include('partials.site-footer')
    </main>
</div>
@endsection

@push('scripts')
<script>
(function () {
    var showcase = @json($showcase);
    var loader = document.getElementById('loader');
    var loaderBar = document.getElementById('loader-bar');
    var loaderPercent = document.getElementById('loader-percent');
    var progressTrack = loaderBar.parentElement;
    var start = performance.now();

    function updateLoader(now) {
        var value = Math.min((now - start) / 1100, 1);
        var percentage = Math.round(value * 100);
        loaderBar.style.transform = 'scaleX(' + value + ')';
        loaderPercent.textContent = percentage + '%';
        progressTrack.setAttribute('aria-valuenow', String(percentage));
        if (value < 1) {
            requestAnimationFrame(updateLoader);
        } else {
            setTimeout(function () { loader.remove(); }, 250);
        }
    }
    requestAnimationFrame(updateLoader);

    var recipesWrapper = document.getElementById('recipes');
    var recipeTrack = document.getElementById('recipe-track');
    var recipeFill = document.getElementById('recipe-bar-fill');
    var recipePercent = document.getElementById('recipe-percent');
    var recipeFrame;

    function handleRecipeScroll() {
        var totalScrollable = recipesWrapper.offsetHeight - window.innerHeight;
        var progress = totalScrollable > 0 ? Math.max(0, Math.min(1, -recipesWrapper.getBoundingClientRect().top / totalScrollable)) : 0;
        var viewportWidth = recipeTrack.parentElement.clientWidth;
        var maxTranslate = Math.max(0, recipeTrack.scrollWidth - viewportWidth);
        recipeTrack.style.transform = 'translateX(' + -progress * maxTranslate + 'px)';
        recipeFill.style.width = Math.max(10, progress * 100) + '%';
        recipePercent.textContent = Math.round(progress * 100) + '% SLIDE';
    }

    function scheduleRecipeScroll() {
        cancelAnimationFrame(recipeFrame);
        recipeFrame = requestAnimationFrame(handleRecipeScroll);
    }

    window.addEventListener('scroll', scheduleRecipeScroll, { passive: true });
    window.addEventListener('resize', scheduleRecipeScroll);
    handleRecipeScroll();

    function stepScroll(direction) {
        window.scrollTo({ top: window.scrollY + direction * window.innerHeight * 0.45, behavior: 'smooth' });
    }
    document.getElementById('recipe-prev').addEventListener('click', function () { stepScroll(-1); });
    document.getElementById('recipe-next').addEventListener('click', function () { stepScroll(1); });

    var productsSection = document.getElementById('products');
    var productName = document.getElementById('product-name');
    var productBrand = document.getElementById('product-brand');
    var productDesc = document.getElementById('product-desc');
    var productDetailLink = document.getElementById('product-detail-link');
    var productWhatsappLink = document.getElementById('product-whatsapp-link');
    var coverflowCards = productsSection.querySelectorAll('.coverflow-card');
    var productTabs = productsSection.querySelectorAll('.product-tab-btn');
    var productsWrapper = document.getElementById('products-wrapper');
    var active = 0;
    var touchStartX = 0;
    var showcaseFrame;

    function renderShowcase() {
        var item = showcase[active];
        if (!item) {
            return;
        }
        var total = showcase.length;
        productName.textContent = item.name;
        productBrand.textContent = item.brand || '';
        productDesc.textContent = item.desc;
        productDetailLink.href = item.detailUrl;
        productWhatsappLink.href = item.whatsappUrl;

        coverflowCards.forEach(function (card, index) {
            var difference = index - active;
            var className = 'coverflow-card ';
            if (difference === 0) {
                className += 'is-active';
            } else if (difference === -1 || (active === 0 && index === total - 1)) {
                className += 'is-prev';
            } else if (difference === 1 || (active === total - 1 && index === 0)) {
                className += 'is-next';
            } else {
                className += 'is-hidden';
            }
            card.className = className;
        });
        productTabs.forEach(function (tab, index) { tab.classList.toggle('active', index === active); });
    }

    if (showcase.length > 0) {
        renderShowcase();
        function handleShowcaseScroll() {
            var scrollableDistance = productsWrapper.offsetHeight - window.innerHeight;
            if (scrollableDistance <= 0) {
                return;
            }
            var progress = Math.max(0, Math.min(1, -productsWrapper.getBoundingClientRect().top / scrollableDistance));
            var targetIndex = Math.min(showcase.length - 1, Math.floor(progress * showcase.length));
            if (targetIndex !== active) {
                active = targetIndex;
                renderShowcase();
            }
        }
        function scheduleShowcaseScroll() {
            cancelAnimationFrame(showcaseFrame);
            showcaseFrame = requestAnimationFrame(handleShowcaseScroll);
        }
        window.addEventListener('scroll', scheduleShowcaseScroll, { passive: true });
        window.addEventListener('resize', scheduleShowcaseScroll);
        handleShowcaseScroll();
        productsSection.addEventListener('touchstart', function (event) { touchStartX = event.touches[0].clientX; }, { passive: true });
        productsSection.addEventListener('touchend', function (event) {
            var delta = event.changedTouches[0].clientX - touchStartX;
            if (Math.abs(delta) > 40) {
                active = (active + (delta < 0 ? 1 : -1) + showcase.length) % showcase.length;
                renderShowcase();
            }
        }, { passive: true });
        coverflowCards.forEach(function (card) {
            card.addEventListener('click', function () { active = Number(card.dataset.index); renderShowcase(); });
        });
        productTabs.forEach(function (tab) {
            tab.addEventListener('click', function () { active = Number(tab.dataset.index); renderShowcase(); });
        });
    }
})();
</script>
@endpush
