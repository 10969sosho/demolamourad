@php
    $navigationLinks = collect($menuLinks ?? [])->filter(fn ($link) => data_get($link, 'label') && data_get($link, 'href'));

    if ($navigationLinks->isEmpty()) {
        $navigationLinks = collect([
            ['label' => 'Beranda', 'href' => '/'],
            ['label' => 'Produk', 'href' => '/products'],
            ['label' => 'Artikel', 'href' => '/articles'],
            ['label' => 'Tentang Kami', 'href' => '/about'],
            ['label' => 'Kontak', 'href' => '/contact'],
        ]);
    }

    $siteNavigation = $navigationLinks->map(function ($link) {
        $href = data_get($link, 'href');
        $path = trim(parse_url($href, PHP_URL_PATH) ?: '', '/');

        return [
            'label' => data_get($link, 'label'),
            'href' => $href,
            'isActive' => $path === ''
                ? request()->is('')
                : request()->is($path) || request()->is($path.'/*'),
        ];
    });
@endphp

@push('head')
<style>
    .clean-page{min-height:100vh;background:#f4f7f4;color:#252820;font-family:var(--font-main,Nunito,sans-serif)}
    .clean-page *{box-sizing:border-box}
    .site-nav{position:sticky;top:0;z-index:20;background:rgba(255,255,255,.96);border-bottom:1px solid #e9e9e3;backdrop-filter:blur(12px)}
    .site-nav-inner{width:100%;min-height:74px;padding:0 clamp(24px,6vw,112px);margin:auto;display:flex;align-items:center;justify-content:space-between;gap:28px}
    .site-logo{display:flex;align-items:baseline;color:#27352a;font-size:25px;font-weight:800;letter-spacing:-1.5px;text-decoration:none}
    .site-logo span+span{color:#829276}
    .site-nav-links{display:flex;align-items:center;gap:32px}
    .site-nav-links a{color:#51564e;font-size:14px;text-decoration:none}
    .site-nav-links a:hover,.site-nav-links a.active{color:#526b4d}
    .site-menu-toggle{display:none;width:42px;height:42px;border:1px solid #e5e7df;border-radius:10px;background:#fff;color:#27352a;font-size:22px;cursor:pointer}
    .clean-main{width:100%;margin:auto;padding-inline:clamp(24px,6vw,112px)}
    .clean-eyebrow{margin:0 0 14px;color:#687c5f;font-size:12px;font-weight:700;letter-spacing:.12em;text-transform:uppercase}
    .clean-button{display:inline-flex;min-height:46px;align-items:center;justify-content:center;gap:9px;padding:0 20px;border:0;border-radius:8px;background:#526b4d;color:#fff;font-size:14px;font-weight:700;text-decoration:none;cursor:pointer}
    .clean-button:hover{background:#41563d}
    .clean-section{padding:76px 0}
    .clean-section-heading{max-width:620px;margin:0 0 30px}
    .clean-section-heading h2{margin:0;color:#27352a;font-size:clamp(28px,4vw,42px);letter-spacing:-1.3px;line-height:1.12}
    .clean-section-heading p:not(.clean-eyebrow){color:#687067;line-height:1.7}
    .clean-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:22px}
    .clean-product-card,.clean-article-card,.clean-value-card,.clean-contact-card{overflow:hidden;border:1px solid #e8eae4;border-radius:12px;background:#fff}
    .clean-product-image,.clean-article-image{aspect-ratio:1/1;background:#f3f4f0}
    .clean-product-image img,.clean-article-image img{display:block;width:100%;height:100%;object-fit:cover}
    .clean-product-body,.clean-article-body{padding:18px}
    .clean-product-category{margin:0 0 7px;color:#718267;font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase}
    .clean-product-body h3,.clean-article-body h3{margin:0;color:#27352a;font-size:17px;line-height:1.35}
    .clean-product-price{display:block;margin:12px 0;color:#27352a;font-size:16px}
    .clean-card-actions{display:flex;flex-wrap:wrap;gap:9px}
    .clean-card-actions a{font-size:12px;text-decoration:none}
    .clean-secondary-link{display:inline-flex;min-height:42px;align-items:center;padding:0 12px;border:1px solid #dfe4da;border-radius:8px;color:#526b4d}
    .clean-stat-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px}
    .clean-stat{padding:24px;border-radius:10px;background:#f5f6f2}
    .clean-stat strong{display:block;color:#526b4d;font-size:32px;letter-spacing:-1px}
    .clean-stat span{color:#5c6259;font-size:12px;font-weight:700;letter-spacing:.06em}
    .clean-hero{display:grid;grid-template-columns:1.05fr .95fr;align-items:center;gap:56px;padding:78px 0 64px}
    .clean-hero h1{max-width:660px;margin:0;color:#27352a;font-size:clamp(40px,6vw,68px);letter-spacing:-2.8px;line-height:1.02}
    .clean-hero-copy{max-width:540px;margin:20px 0 26px;color:#687067;font-size:17px;line-height:1.7}
    .clean-hero-image{overflow:hidden;aspect-ratio:1.08/1;border-radius:16px;background:#f3f4f0}
    .clean-hero-image img{width:100%;height:100%;object-fit:cover}
    .clean-page-header{padding:46px 0 20px}
    .clean-page-header h1{margin:0;color:#27352a;font-size:clamp(32px,5vw,48px);letter-spacing:-1.8px}
    .clean-page-header p:not(.clean-eyebrow){max-width:680px;color:#687067;line-height:1.7}
    .clean-about-profile{display:grid;grid-template-columns:1fr 1fr;align-items:center;gap:54px}
    .clean-about-profile h2,.clean-quality h2{margin:0 0 16px;color:#27352a;font-size:clamp(27px,4vw,40px);letter-spacing:-1.2px;line-height:1.15}
    .clean-about-profile p:not(.clean-eyebrow),.clean-quality p:not(.clean-eyebrow){color:#687067;line-height:1.8}
    .clean-about-image{overflow:hidden;aspect-ratio:1.2/1;border-radius:14px;background:#f3f4f0}
    .clean-about-image img{width:100%;height:100%;object-fit:cover}
    .clean-value-card{padding:24px}
    .clean-value-card h3{margin:0 0 10px;color:#27352a;font-size:17px}
    .clean-value-card p{margin:0;color:#687067;font-size:14px;line-height:1.7}
    .clean-quality{display:grid;grid-template-columns:1fr 1fr;align-items:center;gap:48px;padding:30px;border-radius:14px;background:#f5f6f2}
    .clean-quality-mark{display:grid;min-height:210px;place-items:center;border-radius:12px;background:#e6ebdf;color:#526b4d;font-size:58px;font-weight:800;letter-spacing:-3px}
    .clean-footer{margin-top:30px;padding:38px 0;border-top:1px solid #e8eae4}
    .clean-footer-inner{display:flex;align-items:center;justify-content:space-between;gap:24px;color:#687067;font-size:13px}
    .clean-footer-inner p{margin:4px 0}
    .clean-footer-links{display:flex;flex-wrap:wrap;gap:18px}
    .clean-footer-links a{color:#526b4d;text-decoration:none}
    .clean-toolbar{display:grid;grid-template-columns:1fr auto;gap:14px;margin:20px 0}
    .clean-search,.clean-sort select{min-height:46px;padding:0 14px;border:1px solid #e0e4dc;border-radius:8px;background:#fff;color:#333;font:inherit}
    .clean-search{width:100%}
    .clean-sort{display:flex;align-items:center;gap:10px;color:#596057;font-size:13px}
    .clean-category-list{display:flex;flex-wrap:wrap;gap:9px;margin:0 0 22px}
    .clean-category-button{min-height:36px;padding:0 14px;border:1px solid #dfe4da;border-radius:20px;background:#fff;color:#596057;font-size:12px;cursor:pointer}
    .clean-category-button.active{border-color:#526b4d;background:#526b4d;color:#fff}
    .clean-catalog .clean-grid{grid-template-columns:repeat(4,minmax(0,1fr));gap:18px}
    .clean-catalog .clean-product-body{padding:15px}
    .clean-catalog .clean-product-body h2{margin:0;color:#27352a;font-size:15px;line-height:1.4}
    .clean-catalog .clean-product-price{margin:9px 0 12px}
    .clean-pager{display:flex;align-items:center;justify-content:center;gap:14px;padding:26px 0}
    .clean-pager button{min-width:78px;min-height:38px;border:1px solid #dfe4da;border-radius:7px;background:#fff;color:#526b4d;cursor:pointer}
    .clean-pager button:disabled{opacity:.45;cursor:default}
    .clean-pager span,.clean-result-count{color:#687067;font-size:13px}
    .clean-contact-layout{display:grid;grid-template-columns:.8fr 1.2fr;align-items:start;gap:28px;padding:28px 0 70px}
    .clean-contact-info{display:grid;gap:14px}
    .clean-contact-card{padding:20px;color:#27352a;text-decoration:none}
    .clean-contact-card strong{display:block;margin-bottom:7px;color:#687c5f;font-size:12px;letter-spacing:.08em;text-transform:uppercase}
    .clean-contact-card span{color:#4f574e;font-size:14px;line-height:1.6}
    .clean-contact-form{padding:26px;border:1px solid #e8eae4;border-radius:12px;background:#f9faf7}
    .clean-contact-form h2{margin:0 0 8px;color:#27352a;font-size:26px}
    .clean-contact-form>p{margin:0 0 20px;color:#687067;font-size:14px}
    .clean-contact-form label{display:block;margin:0 0 14px;color:#51594f;font-size:13px;font-weight:700}
    .clean-contact-form input,.clean-contact-form textarea{display:block;width:100%;margin-top:7px;padding:12px;border:1px solid #dfe4da;border-radius:7px;background:#fff;color:#252820;font:inherit}
    .clean-contact-form textarea{resize:vertical}
    .clean-home .clean-main{padding-inline:0}
    .clean-home .clean-hero{position:relative;isolation:isolate;overflow:hidden;min-height:90vh;padding:clamp(32px,6vw,112px);border-radius:0;background:linear-gradient(125deg,#1b382b,#2d5a44);color:#fff}
    .clean-home .clean-hero:before{position:absolute;z-index:-1;right:34%;bottom:-42%;width:390px;aspect-ratio:1;border:1px solid rgba(197,168,128,.28);border-radius:50%;content:""}
    .clean-home .clean-eyebrow{color:#c5a880}
    .clean-home .clean-hero h1{color:#fff;font-family:var(--font-serif,Georgia,serif);font-weight:700;letter-spacing:-1.8px}
    .clean-home .clean-hero-copy{color:rgba(255,255,255,.82)}
    .clean-home .clean-hero .clean-button{background:#c5a880;color:#1b382b}
    .clean-home .clean-hero-image{border:1px solid rgba(255,255,255,.2);border-radius:180px 180px 22px 22px;box-shadow:0 22px 48px rgba(0,0,0,.22)}
    .clean-home .clean-section{position:relative;margin:0;padding:clamp(48px,7vw,112px) clamp(24px,6vw,112px);border-radius:0;background:#f4f7f4}
    .clean-home .clean-showcase{background:#1b382b;color:#fff}
    .clean-home .clean-showcase .clean-section-heading h2{color:#fff}
    .clean-home .clean-showcase .clean-section-heading p:not(.clean-eyebrow){color:rgba(255,255,255,.76)}
    .clean-product-track{display:flex;gap:18px;overflow-x:auto;padding:4px 4px 20px;scroll-snap-type:x mandatory;scroll-padding:4px;overscroll-behavior-inline:contain;-webkit-overflow-scrolling:touch;scrollbar-color:#c5a880 rgba(255,255,255,.12);scrollbar-width:thin}
    .clean-product-track>.clean-product-card{flex:0 0 clamp(250px,28vw,310px);scroll-snap-align:start;box-shadow:0 10px 28px rgba(0,0,0,.15)}
    .clean-showcase-link{margin:18px 0 0}
    .clean-showcase .clean-secondary-link{border-color:rgba(255,255,255,.45);color:#fff}
    .clean-home .clean-article-card{box-shadow:0 8px 24px rgba(27,56,43,.06)}
    @media(max-width:900px){.clean-home .clean-hero{min-height:80vh}.clean-home .clean-hero-image{max-height:560px}}
    @media(max-width:680px){.clean-home .clean-hero{min-height:0;gap:24px;padding:28px 24px}.clean-home .clean-hero-image{grid-row:1;max-height:320px}.clean-home .clean-section{padding:38px 24px}.clean-product-track{gap:12px}.clean-product-track>.clean-product-card{flex-basis:min(78vw,310px)}}
    @media(max-width:900px){.clean-catalog .clean-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.clean-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.clean-hero{gap:30px}.clean-nav-links{gap:20px}}
    @media(max-width:680px){.site-nav-inner{min-height:66px;flex-wrap:wrap;gap:0;padding-inline:24px}.site-menu-toggle{display:block}.site-nav-links{display:none;order:3;width:100%;align-items:stretch;gap:0;padding:4px 0 12px}.site-nav-links.is-open{display:flex;flex-direction:column}.site-nav-links a{padding:12px 4px;border-top:1px solid #f0f1ed}.clean-main{padding-inline:24px}.clean-home .clean-main{padding-inline:0}.clean-hero,.clean-about-profile,.clean-quality,.clean-contact-layout{grid-template-columns:1fr}.clean-hero{padding:48px 0 28px}.clean-hero-image{grid-row:1;max-height:350px}.clean-section{padding:54px 0}.clean-grid,.clean-catalog .clean-grid,.clean-stat-grid{grid-template-columns:1fr 1fr;gap:12px}.clean-product-body,.clean-article-body{padding:13px}.clean-product-body h3{font-size:15px}.clean-card-actions{flex-direction:column;align-items:stretch}.clean-card-actions .clean-button,.clean-card-actions .clean-secondary-link{justify-content:center}.clean-toolbar{grid-template-columns:1fr}.clean-sort{justify-content:space-between}.clean-sort select{flex:1}.clean-contact-layout{gap:18px}.clean-contact-form{padding:20px}.clean-footer-inner{align-items:flex-start;flex-direction:column}.clean-quality{padding:20px}}
    @media(max-width:390px){.clean-grid,.clean-catalog .clean-grid,.clean-stat-grid{grid-template-columns:1fr}}
</style>
@endpush

<header class="site-nav">
    <div class="site-nav-inner">
        <a href="/" class="site-logo" aria-label="LiefMarket, beranda">
            <span>{{ data_get($content, 'navbar.brandName', 'LiefMarket') }}</span>
        </a>
        <button class="site-menu-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="site-nav-links">☰</button>
        <nav class="site-nav-links" id="site-nav-links" aria-label="Navigasi utama">
            @foreach ($siteNavigation as $link)
                <a href="{{ $link['href'] }}" @class(['active' => $link['isActive']])>{{ $link['label'] }}</a>
            @endforeach
        </nav>
    </div>
</header>

@push('scripts')
<script>
    (function () {
        var toggle = document.querySelector('.site-menu-toggle');
        var menu = document.getElementById('site-nav-links');

        toggle.addEventListener('click', function () {
            var isOpen = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', String(!isOpen));
            toggle.setAttribute('aria-label', isOpen ? 'Buka menu' : 'Tutup menu');
            menu.classList.toggle('is-open', !isOpen);
        });
    })();
</script>
@endpush
