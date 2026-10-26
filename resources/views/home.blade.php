@extends('layouts.app')

@section('content')
@php
    $hero = $content['hero'];
    $intro = $content['intro'];
    $cta = $content['cta'];
    $footer = $content['footer'];
    $brand = $content['navbar'];

    $heroTitle = explode("\n", $hero['title']);
    $heroTitleFirst = array_shift($heroTitle);
    $heroBadge = explode("\n", $hero['badge']);
    $heroBadgeFirst = array_shift($heroBadge);
    $introTitle = explode("\n", $intro['title']);
    $introTitleFirst = array_shift($introTitle);
    $ctaTitle = explode("\n", $cta['title']);
    $ctaTitleFirst = array_shift($ctaTitle);
@endphp
<main id="top" class="deck-stack-container">
    <div class="loader" id="loader">
        <div class="loader-orbit"></div>
        <div class="loader-logo">
            <span class="brand-lief">{{ $brand['brandName'] }}</span>
            <span class="brand-market">{{ $brand['brandSub'] }}</span>
        </div>
        <div class="loader-bottom">
            <span>MENYIAPKAN KATALOG</span>
            <b id="loader-percent">0%</b>
            <div>
                <i id="loader-bar" style="transform: scaleX(0)"></i>
            </div>
        </div>
    </div>

    <header class="header" id="header">
        <span class="anchor-target" id="explore"></span>
        <span class="anchor-target" id="about"></span>
        <span class="anchor-target" id="class"></span>
        <span class="anchor-target" id="story"></span>
        <span class="anchor-target" id="contact"></span>
        <span class="anchor-target" id="faq"></span>
        <span class="anchor-target" id="community"></span>
        <span class="anchor-target" id="instagram"></span>
        <span class="anchor-target" id="facebook"></span>
        <span class="anchor-target" id="youtube"></span>
        <a href="#top" class="logo">
            <span class="brand-lief">{{ $brand['brandName'] }}</span>
            <span class="brand-market">{{ $brand['brandSub'] }}</span>
        </a>
        <nav class="header-nav">
            @foreach ($menuLinks as $link)
                <a href="{{ $link['href'] }}" {{ request()->is(trim($link['href'], '/') ?: '/') ? 'class="active"' : '' }}>
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>
        <div class="header-actions">
            <a href="/admin" class="admin-link">CMS</a>
            <button class="menu-button" id="menu-open" aria-label="Buka menu">
                <span></span>
                <span></span>
            </button>
        </div>
    </header>

    <div class="menu-overlay" id="menu-overlay" style="display: none">
        <button class="close-menu" id="menu-close">×</button>
        <div class="menu-main">
            <p class="eyebrow">JELAJAHI LIEFMARKET</p>
            @foreach ($menuLinks as $i => $link)
                <a href="{{ $link['href'] }}" data-menu-close>
                    {{ $link['label'] }}<sup>0{{ $i + 1 }}</sup>
                </a>
            @endforeach
        </div>
        <div class="menu-products">
            <p class="eyebrow">PRODUK PILIHAN</p>
            @foreach ($products as $product)
                <a href="{{ $product->link ?: '/products' }}" data-menu-close>
                    {{ $product->name }} <span aria-hidden>→</span>
                </a>
            @endforeach
            <div class="menu-stamp">
                100%<br>
                <span>ASLI</span><br>
                BPOM
            </div>
        </div>
    </div>

    <section class="hero deck-section deck-hero" id="hero">
        <div class="hero-copy">
            <p class="eyebrow">
                LIEFMARKET SURABAYA <span>✦</span>
            </p>
            <h1>
                {{ $heroTitleFirst }}
                @if ($heroTitle)
                    <br>
                    <em>{{ implode(' ', $heroTitle) }}</em>
                @endif
            </h1>
            <p class="hero-desc">{{ $hero['description'] }}</p>
            <div class="hero-actions">
                <a class="red-button" href="{{ $hero['primaryBtnLink'] }}">
                    {{ $hero['primaryBtnText'] }} <span aria-hidden>→</span>
                </a>
                <a class="ghost-button" href="{{ $hero['secondaryBtnLink'] }}">
                    {{ $hero['secondaryBtnText'] }} <span aria-hidden>→</span>
                </a>
            </div>
        </div>

        <div class="hero-art" id="hero-art">
            <div class="sun" id="hero-sun"></div>
            <div class="hero-photo" id="hero-photo">
                <img src="{{ $hero['bgImage'] }}" alt="Paket Perawatan LiefMarket">
            </div>
            <div class="hero-badge" id="hero-badge">
                {{ $heroBadgeFirst }}
                @if ($heroBadge)
                    <br>
                    <span>{{ implode("\n", $heroBadge) }}</span>
                @endif
            </div>
            <div class="floating-spice spice-a" id="spice-a">✦</div>
            <div class="floating-spice spice-b" id="spice-b">✦</div>
            <div class="floating-spice spice-c" id="spice-c">✳</div>
        </div>

        <div class="hero-bottom">
            <span>01</span>
            <div class="hero-progress">
                <i></i>
            </div>
            <span>03</span>
            <p>
                SCROLL KE BAWAH UNTUK MENJELAJAHI <b>↓</b>
            </p>
        </div>
    </section>

    <section class="deck-section deck-intro" id="about">
        <div class="marquee-container marquee-light">
            <div class="marquee-track">
                @foreach (array_merge(
                    ['LIEFMARKET SURABAYA', '100% PRODUK ORIGINAL & BPOM', 'PERAWATAN & KESEHATAN KELUARGA', 'BELANJA AMAN & TERPERCAYA'],
                    ['LIEFMARKET SURABAYA', '100% PRODUK ORIGINAL & BPOM', 'PERAWATAN & KESEHATAN KELUARGA', 'BELANJA AMAN & TERPERCAYA'],
                ) as $index => $marqueeItem)
                    <span class="marquee-item">
                        <span class="star">✦</span> {{ $marqueeItem }}
                    </span>
                @endforeach
            </div>
        </div>

        <div class="intro">
            <div class="intro-mark">✳</div>
            <p class="eyebrow">SEJAK AWAL BERSAMA ANDA</p>
            <h2>
                {{ $introTitleFirst }}
                @if ($introTitle)
                    <br>
                    <em>{{ implode(' ', $introTitle) }}</em>
                @endif
            </h2>
            <p>{{ $intro['subtitle'] }}</p>
            <a class="text-link" href="#story">
                BACA CERITA KAMI <span aria-hidden>→</span>
            </a>

            <div class="intro-stats">
                @foreach ($intro['items'] as $item)
                    <div class="intro-stat-item">
                        <strong>{{ $item['value'] }}</strong>
                        <span>{{ $item['label'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="deck-recipes-wrapper" id="recipes">
        <div class="deck-recipes-sticky">
            <div class="recipe-header-bar">
                <div class="section-heading light">
                    <p class="eyebrow">KATALOG LIEFMARKET ✦</p>
                    <h2>
                        Produk pilihan,<br>
                        <em>favorit keluarga.</em>
                    </h2>
                    <p class="section-copy">
                        Scroll ke bawah untuk menjelajahi katalog produk unggulan secara horizontal.
                    </p>
                </div>

                <div class="recipe-category-pills">
                    @foreach ($categories as $category)
                        <button
                            class="recipe-cat-btn{{ $loop->first ? ' active' : '' }}"
                            data-category="{{ $category }}"
                        >{{ $category }}</button>
                    @endforeach
                </div>
            </div>

            <div class="horizontal-track-container">
                <div class="recipe-horizontal-track" id="recipe-track">
                    @foreach ($products as $product)
                        <article class="recipe-card-modern" data-category="{{ $product->category }}">
                            <div class="recipe-card-photo">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}">
                                <span class="recipe-tag-pill">{{ $product->tag }}</span>
                                <span class="recipe-time-pill">✓ {{ $product->time }}</span>
                            </div>
                            <div class="recipe-card-body">
                                <div>
                                    <h3>{{ $product->name }}</h3>
                                    <p>{{ $product->desc }}</p>
                                </div>
                                <div class="recipe-card-foot">
                                    <span class="recipe-difficulty">★ {{ $product->level }}</span>
                                    <a class="recipe-view-btn" href="{{ $product->link ?: '/products' }}">
                                        LIHAT PRODUK <span aria-hidden>→</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>

            <div class="horizontal-controls-bar">
                <div class="horizontal-progress-bar">
                    <span>01</span>
                    <div class="bar-track">
                        <div class="bar-fill" id="recipe-bar-fill" style="width: 10%"></div>
                    </div>
                    <span id="recipe-count">0{{ $products->count() }}</span>
                    <span class="percent-label" id="recipe-percent">0% SLIDE</span>
                </div>

                <div class="horizontal-nav-arrows">
                    <button class="nav-arrow-btn" id="recipe-prev" aria-label="Slide sebelumnya">←</button>
                    <button class="nav-arrow-btn" id="recipe-next" aria-label="Slide berikutnya">→</button>
                </div>
            </div>
        </div>
    </div>

    <section class="deck-section deck-class" id="class">
        <div class="class-section-inner">
            <div class="class-content">
                <p class="eyebrow">LIEFMARKET WELLNESS CLUB ✦</p>
                <h2>
                    {{ $ctaTitleFirst }}
                    @if ($ctaTitle)
                        <br>
                        <em>{{ implode(' ', $ctaTitle) }}</em>
                    @endif
                </h2>
                <p>{{ $cta['desc'] }}</p>
                <a class="dark-button" href="{{ $cta['btnLink'] }}">
                    {{ $cta['btnText'] }} <span aria-hidden>→</span>
                </a>
            </div>

            <div class="class-photo-wrapper">
                <div class="class-photo">
                    <img src="/images/liefmarket-3/1.webp" alt="Perawatan Kulit LiefMarket">
                </div>
                <div class="class-floating-badge">
                    BEAUTY<br>
                    &amp;<br>
                    HEALTH
                </div>
                <div class="class-stats-pill">
                    <span>★</span> 4.9/5 Rating dari 50,000+ Pelanggan
                </div>
            </div>
        </div>

        <div class="marquee-container marquee-dark marquee-reverse">
            <div class="marquee-track">
                @foreach (array_merge(
                    ['LIEFMARKET WELLNESS CLUB', 'KECANTIKAN ALAMI', 'KESEHATAN KELUARGA', 'PRODUK RESMI & TERPERCAYA'],
                    ['LIEFMARKET WELLNESS CLUB', 'KECANTIKAN ALAMI', 'KESEHATAN KELUARGA', 'PRODUK RESMI & TERPERCAYA'],
                ) as $marqueeItem)
                    <span class="marquee-item">
                        <span class="star">✦</span> {{ $marqueeItem }}
                    </span>
                @endforeach
            </div>
        </div>
    </section>

    <section class="deck-section deck-products" id="products" style="background: {{ $showcase[0]['bg'] ?? '#232833' }}">
        <div class="product-ambient-disc" id="product-disc" style="background: {{ $showcase[0]['color'] ?? '#232833' }}"></div>

        <div class="product-showcase-container">
            <div class="section-heading light">
                <p class="eyebrow">PRODUK UNGGULAN KAMI ✦</p>
                <h2>
                    Pilihan tepat,<br>
                    <em>selalu ada.</em>
                </h2>
            </div>

            <div class="product-3d-stage">
                <div class="product-info-panel">
                    <span class="product-counter-pill" id="product-counter">01 / 0{{ count($showcase) }}</span>
                    <h3 id="product-name">{{ $showcase[0]['name'] ?? '' }}</h3>
                    <p class="product-desc" id="product-desc">{{ $showcase[0]['desc'] ?? '' }}</p>

                    <div class="product-feature-tags" id="product-tags">
                        @foreach ($showcase[0]['tags'] ?? [] as $tag)
                            <span class="feature-tag">{{ $tag }}</span>
                        @endforeach
                    </div>

                    <div class="product-actions">
                        <a class="red-button" href="/products">
                            BELI SEKARANG <span aria-hidden>→</span>
                        </a>
                        <a class="ghost-button" href="/recipes">
                            PRODUK TERKAIT <span aria-hidden>→</span>
                        </a>
                    </div>
                </div>

                <div class="product-cards-carousel" id="product-carousel">
                    @foreach ($showcase as $index => $item)
                        <div class="coverflow-card {{ $index === 0 ? 'is-active' : ($index === count($showcase) - 1 ? 'is-prev' : ($index === 1 ? 'is-next' : 'is-hidden')) }}" data-index="{{ $index }}">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                            <div class="coverflow-card-info">
                                <h4>{{ $item['name'] }}</h4>
                                <span>{{ $item['tagline'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="product-selector-tabs" id="product-tabs">
                @foreach ($showcase as $index => $item)
                    <button class="product-tab-btn{{ $index === 0 ? ' active' : '' }}" data-index="{{ $index }}">
                        <span class="tab-dot" style="background: {{ $item['color'] }}"></span>
                        {{ $item['name'] }}
                    </button>
                @endforeach
            </div>
        </div>
    </section>

    <section class="deck-section deck-story" id="story">
        <div class="story-section-inner">
            <div class="story-image-wrap">
                <img src="/images/liefmarket-3/5.webp" alt="Perawatan keluarga LiefMarket">
            </div>
            <div class="story-copy">
                <p class="eyebrow">CERITA LIEFMARKET</p>
                <h2>
                    Lebih dari<br>
                    <em>sekadar berbelanja.</em>
                </h2>
                <div class="story-quote-card">
                    <p>"Kesehatan dan rasa percaya diri berawal dari produk terbaik yang aman untuk seluruh anggota keluarga."</p>
                </div>
                <p>
                    Bagi kami, merawat keluarga adalah wujud kasih sayang yang paling bermakna. Lewat setiap produk yang terjamin keasliannya dan terdaftar di BPOM, kami siap mendampingi hari-hari Anda dengan rasa tenang.
                </p>
                <a class="text-link" href="/company">
                    PELAJARI PERJALANAN KAMI <span aria-hidden>→</span>
                </a>
            </div>
        </div>
    </section>

    @if ($articles->isNotEmpty())
        <section class="deck-section deck-articles" id="artikel">
            <div class="articles-inner">
                <div class="section-heading">
                    <p class="eyebrow">ARTIKEL & TIPS ✦</p>
                    <h2>
                        Inspirasi sehat,<br>
                        <em>setiap hari.</em>
                    </h2>
                </div>

                <div class="articles-grid">
                    @foreach ($articles as $article)
                        <article class="article-card">
                            <div class="article-card-photo">
                                <img src="{{ $article->image }}" alt="{{ $article->title }}">
                                <span class="recipe-tag-pill">{{ $article->tag }}</span>
                            </div>
                            <div class="article-card-body">
                                <span class="article-card-date">{{ $article->date }}</span>
                                <h3>{{ $article->title }}</h3>
                                <p>{{ $article->desc }}</p>
                                <a class="text-link" href="/articles">
                                    BACA ARTIKEL <span aria-hidden>→</span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <footer class="deck-section deck-footer">
        <div class="footer-brand">
            <a href="#top" class="logo logo-white">
                <span class="brand-lief">{{ $brand['brandName'] }}</span>
                <span class="brand-market">{{ $brand['brandSub'] }}</span>
            </a>
            <p>{{ $footer['about'] }}</p>
            <div class="socials">
                @foreach ($footer['socialLinks'] as $social)
                    <a href="{{ $social['href'] }}" aria-label="{{ $social['label'] }}">{{ $social['label'] }}</a>
                @endforeach
            </div>
        </div>

        <div class="footer-links">
            @foreach ($footer['columns'] as $column)
                <div>
                    <p class="eyebrow">{{ $column['title'] }}</p>
                    @foreach ($column['links'] as $link)
                        <a href="{{ $link['href'] }}">{{ $link['label'] }}</a>
                    @endforeach
                </div>
            @endforeach
            <div class="newsletter">
                <p class="eyebrow">INSPIRASI PERAWATAN</p>
                <p>
                    Dapatkan promo menarik dan tips perawatan kulit langsung ke email kamu setiap minggu.
                </p>
                <div class="email-input">
                    <span>Ketik alamat email kamu</span>
                    <b>→</b>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <span>{{ $footer['copyright'] }}</span>
            <span>AUTHENTIC CARE FOR INDONESIA</span>
        </div>
    </footer>

    <div class="market-widget" id="market-widget">
        <span>✦</span>
        <b>BELI<br>SEKARANG</b>
    </div>

    <button class="chat-button" aria-label="Bantuan">•••</button>

    <button class="top-button" id="top-button" style="display: none" aria-label="Kembali ke atas">↑</button>
</main>
@endsection

@push('scripts')
<script>
(function () {
    var showcase = @json($showcase);

    // Loader
    var loader = document.getElementById('loader');
    var loaderBar = document.getElementById('loader-bar');
    var loaderPercent = document.getElementById('loader-percent');
    var start = performance.now();
    var tick = function (now) {
        var value = Math.min((now - start) / 1100, 1);
        loaderBar.style.transform = 'scaleX(' + value + ')';
        loaderPercent.textContent = Math.round(value * 100) + '%';
        if (value < 1) {
            requestAnimationFrame(tick);
        } else {
            setTimeout(function () { if (loader) loader.remove(); }, 200);
        }
    };
    requestAnimationFrame(tick);

    // Sticky header
    var header = document.getElementById('header');
    window.addEventListener('scroll', function () {
        header.classList.toggle('scrolled', window.scrollY > 40);
    }, { passive: true });

    // Menu overlay
    var overlay = document.getElementById('menu-overlay');
    document.getElementById('menu-open').addEventListener('click', function () { overlay.style.display = 'grid'; });
    document.getElementById('menu-close').addEventListener('click', function () { overlay.style.display = 'none'; });
    overlay.querySelectorAll('[data-menu-close]').forEach(function (link) {
        link.addEventListener('click', function () { overlay.style.display = 'none'; });
    });

    // Hero mouse parallax
    var heroArt = document.getElementById('hero-art');
    var heroSun = document.getElementById('hero-sun');
    var heroPhoto = document.getElementById('hero-photo');
    var heroBadge = document.getElementById('hero-badge');
    var spiceA = document.getElementById('spice-a');
    var spiceB = document.getElementById('spice-b');
    var spiceC = document.getElementById('spice-c');
    heroArt.parentElement.addEventListener('mousemove', function (e) {
        var rect = e.currentTarget.getBoundingClientRect();
        var x = ((e.clientX - rect.left) / rect.width - 0.5) * 26;
        var y = ((e.clientY - rect.top) / rect.height - 0.5) * 26;
        heroSun.style.transform = 'translate(' + -x * 0.7 + 'px, ' + -y * 0.7 + 'px)';
        heroPhoto.style.transform = 'rotate(4deg) translate(' + x * 0.5 + 'px, ' + y * 0.5 + 'px)';
        heroBadge.style.transform = 'rotate(-10deg) translate(' + -x * 1.2 + 'px, ' + -y * 1.2 + 'px)';
        spiceA.style.transform = 'translate(' + x * 1.5 + 'px, ' + y * 1.5 + 'px)';
        spiceB.style.transform = 'translate(' + -x * 1.4 + 'px, ' + -y * 1.4 + 'px)';
        spiceC.style.transform = 'translate(' + x * 1.1 + 'px, ' + y * 1.1 + 'px)';
    });

    // Horizontal catalog slider
    var recipesWrapper = document.getElementById('recipes');
    var recipeTrack = document.getElementById('recipe-track');
    var recipeFill = document.getElementById('recipe-bar-fill');
    var recipePercent = document.getElementById('recipe-percent');
    var recipeCount = document.getElementById('recipe-count');
    var recipeFrame = null;
    var handleRecipeScroll = function () {
        var rect = recipesWrapper.getBoundingClientRect();
        var totalScrollable = recipesWrapper.offsetHeight - window.innerHeight;
        if (totalScrollable > 0) {
            var progress = Math.max(0, Math.min(1, -rect.top / totalScrollable));
            var maxTranslate = Math.max(0, recipeTrack.scrollWidth - window.innerWidth + 140);
            recipeTrack.style.transform = 'translateX(' + -progress * maxTranslate + 'px)';
            recipeFill.style.width = Math.max(10, progress * 100) + '%';
            recipePercent.textContent = Math.round(progress * 100) + '% SLIDE';
        }
    };
    var onRecipeScroll = function () {
        cancelAnimationFrame(recipeFrame);
        recipeFrame = requestAnimationFrame(handleRecipeScroll);
    };
    window.addEventListener('scroll', onRecipeScroll, { passive: true });
    window.addEventListener('resize', onRecipeScroll);
    handleRecipeScroll();

    var stepScroll = function (direction) {
        var step = window.innerHeight * 0.45;
        window.scrollTo({
            top: direction === 'right' ? window.scrollY + step : window.scrollY - step,
            behavior: 'smooth',
        });
    };
    document.getElementById('recipe-prev').addEventListener('click', function () { stepScroll('left'); });
    document.getElementById('recipe-next').addEventListener('click', function () { stepScroll('right'); });

    // Category pills
    var recipeCards = recipeTrack.querySelectorAll('.recipe-card-modern');
    document.querySelectorAll('.recipe-cat-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.recipe-cat-btn').forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');
            var category = btn.dataset.category;
            var visible = 0;
            recipeCards.forEach(function (card) {
                var show = category === 'SEMUA' || card.dataset.category === category;
                card.style.display = show ? '' : 'none';
                if (show) visible++;
            });
            recipeCount.textContent = '0' + visible;
            handleRecipeScroll();
        });
    });

    // 3D product showcase
    var productsSection = document.getElementById('products');
    var productDisc = document.getElementById('product-disc');
    var productCounter = document.getElementById('product-counter');
    var productName = document.getElementById('product-name');
    var productDesc = document.getElementById('product-desc');
    var productTags = document.getElementById('product-tags');
    var coverflowCards = productsSection.querySelectorAll('.coverflow-card');
    var productTabs = productsSection.querySelectorAll('.product-tab-btn');
    var active = 0;
    var paused = false;
    var touchStartX = 0;

    var renderShowcase = function () {
        var item = showcase[active];
        if (!item) return;
        var total = showcase.length;
        productsSection.style.background = item.bg;
        productDisc.style.background = item.color;
        productCounter.textContent = '0' + (active + 1) + ' / 0' + total;
        productName.textContent = item.name;
        productDesc.textContent = item.desc;
        productTags.innerHTML = item.tags.map(function (tag) {
            return '<span class="feature-tag">' + tag + '</span>';
        }).join('');

        coverflowCards.forEach(function (card, idx) {
            var diff = idx - active;
            var cls = 'coverflow-card ';
            if (diff === 0) cls += 'is-active';
            else if (diff === -1 || (active === 0 && idx === total - 1)) cls += 'is-prev';
            else if (diff === 1 || (active === total - 1 && idx === 0)) cls += 'is-next';
            else cls += 'is-hidden';
            card.className = cls;
        });

        productTabs.forEach(function (tab, idx) {
            tab.classList.toggle('active', idx === active);
        });
    };

    setInterval(function () {
        if (paused || showcase.length === 0) return;
        active = (active + 1) % showcase.length;
        renderShowcase();
    }, 4500);

    productsSection.addEventListener('mouseenter', function () { paused = true; });
    productsSection.addEventListener('mouseleave', function () { paused = false; });
    productsSection.addEventListener('touchstart', function (e) { touchStartX = e.touches[0].clientX; }, { passive: true });
    productsSection.addEventListener('touchend', function (e) {
        var delta = e.changedTouches[0].clientX - touchStartX;
        if (delta > 40) {
            active = (active - 1 + showcase.length) % showcase.length;
            renderShowcase();
        } else if (delta < -40) {
            active = (active + 1) % showcase.length;
            renderShowcase();
        }
    }, { passive: true });

    coverflowCards.forEach(function (card) {
        card.addEventListener('click', function () {
            active = parseInt(card.dataset.index, 10);
            renderShowcase();
        });
    });
    productTabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            active = parseInt(tab.dataset.index, 10);
            renderShowcase();
        });
    });

    // Floating widgets
    document.getElementById('market-widget').addEventListener('click', function () {
        window.open('/products', '_self');
    });
    var topButton = document.getElementById('top-button');
    window.addEventListener('scroll', function () {
        topButton.style.display = window.scrollY > 450 ? '' : 'none';
    }, { passive: true });
    topButton.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
})();
</script>
@endpush
