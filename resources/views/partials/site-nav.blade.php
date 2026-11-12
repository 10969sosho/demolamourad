@php
    $navigationLinks = collect($menuLinks ?? [])->filter(fn ($link) => data_get($link, 'label') && data_get($link, 'href'));

    if ($navigationLinks->isEmpty()) {
        $navigationLinks = collect([
            ['label' => 'Products', 'href' => '/products'],
            ['label' => 'Brands', 'href' => '#brands'],
            ['label' => 'Stories', 'href' => '/articles'],
            ['label' => 'Promotion', 'href' => '#highlights'],
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

    $whatsappNumber = preg_replace('/\D/', '', (string) data_get($content, 'contact.whatsapp', ''));
    $whatsappUrl = $whatsappNumber !== ''
        ? 'https://wa.me/'.$whatsappNumber.'?text='.rawurlencode('Halo LiefMarket, saya ingin berkonsultasi produk.')
        : '/contact';
@endphp

@push('head')
<style>
    /* Top announcement bar */
    .top-announcement-bar {
        background: #0d55ff;
        color: #ffffff;
        font-size: 12px;
        font-weight: 500;
        text-align: center;
        padding: 8px 16px;
        letter-spacing: 0.02em;
    }
    .top-announcement-bar a {
        color: #fff;
        text-decoration: underline;
        margin-left: 8px;
    }

    .site-nav {
        position: sticky;
        top: 0;
        z-index: 100;
        background: #ffffff;
        border-bottom: 1px solid #eef1f6;
        transition: all 0.25s ease;
    }
    .site-nav-inner {
        max-width: 1360px;
        margin: 0 auto;
        padding: 0 clamp(20px, 4vw, 48px);
        min-height: 72px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 32px;
    }
    .site-logo {
        display: inline-flex;
        align-items: center;
        gap: 2px;
        font-size: 22px;
        font-weight: 800;
        color: #0d55ff;
        letter-spacing: -0.5px;
        text-decoration: none;
    }
    .site-logo .brand-market {
        color: #1a1f2c;
        font-weight: 700;
    }
    .site-nav-links {
        display: flex;
        align-items: center;
        gap: 32px;
    }
    .site-nav-links a {
        color: #4a5568;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.15s ease;
    }
    .site-nav-links a:hover, .site-nav-links a.active {
        color: #0d55ff;
    }
    .site-nav-actions {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .nav-action-icon {
        color: #4a5568;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        transition: color 0.15s;
    }
    .nav-action-icon:hover {
        color: #0d55ff;
    }
    .site-menu-toggle {
        display: none;
        background: transparent;
        border: none;
        font-size: 24px;
        color: #1a1f2c;
        cursor: pointer;
    }

    @media (max-width: 820px) {
        .site-menu-toggle { display: block; }
        .site-nav-links {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #ffffff;
            flex-direction: column;
            padding: 20px 24px;
            gap: 16px;
            border-bottom: 1px solid #eef1f6;
            box-shadow: 0 12px 24px rgba(0,0,0,0.06);
        }
        .site-nav-links.is-open { display: flex; }
    }
</style>
@endpush

<div class="top-announcement-bar">
    <span>✦ GRATIS ONGKIR SELURUH INDONESIA DENGAN MINIMAL BELANJA ✦</span>
</div>

<header class="site-nav">
    <div class="site-nav-inner">
        <a href="/" class="site-logo" aria-label="LiefMarket Beranda">
            <span class="brand-lief">LIEF</span><span class="brand-market">Market</span>
        </a>

        <nav class="site-nav-links" id="site-nav-links" aria-label="Navigasi Utama">
            @foreach ($siteNavigation as $link)
                <a href="{{ $link['href'] }}" @class(['active' => $link['isActive']])>{{ $link['label'] }}</a>
            @endforeach
        </nav>

        <div class="site-nav-actions">
            <a href="/products" class="nav-action-icon" title="Cari Produk" aria-label="Search">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
            </a>
            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="nav-action-icon" title="Konsultasi WhatsApp" aria-label="WhatsApp">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 1 0-8 0 4 4 0 0 0 8 0Zm0 0v1.5a2.5 2.5 0 0 0 5 0V12a9 9 0 1 0-9 9m4.5-1.206a8.959 8.959 0 0 1-4.5 1.207"/></svg>
            </a>
            <a href="/products" class="nav-action-icon" title="Keranjang Belanja" aria-label="Bag">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25c-.67 0-1.19-.578-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
            </a>
            <button class="site-menu-toggle" type="button" aria-label="Menu" aria-expanded="false" aria-controls="site-nav-links">☰</button>
        </div>
    </div>
</header>

@push('scripts')
<script>
    (function () {
        var toggle = document.querySelector('.site-menu-toggle');
        var menu = document.getElementById('site-nav-links');
        if (toggle && menu) {
            toggle.addEventListener('click', function () {
                var isOpen = toggle.getAttribute('aria-expanded') === 'true';
                toggle.setAttribute('aria-expanded', String(!isOpen));
                menu.classList.toggle('is-open', !isOpen);
            });
        }
    })();
</script>
@endpush
