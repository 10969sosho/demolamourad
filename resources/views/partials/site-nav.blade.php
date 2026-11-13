@php
    $siteNavigation = [
        ['label' => 'Produk', 'href' => '/products', 'isActive' => request()->is('products*')],
        ['label' => 'Tentang Kami', 'href' => '/about', 'isActive' => request()->is('about*')],
        ['label' => 'Contact', 'href' => '/contact', 'isActive' => request()->is('contact*')],
    ];

    $whatsappNumber = preg_replace('/\D/', '', (string) data_get($content, 'contact.whatsapp', ''));
    $whatsappUrl = $whatsappNumber !== ''
        ? 'https://wa.me/'.$whatsappNumber.'?text='.rawurlencode('Halo LiefMarket, saya ingin berkonsultasi produk.')
        : '/contact';
@endphp

@push('head')
<style>
    /* Top announcement bar: Soft steel blue tone */
    .top-announcement-bar {
        background: #f0f5f9;
        color: #3b6074;
        font-size: 11px;
        font-weight: 700;
        text-align: center;
        padding: 9px 16px;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        border-bottom: 1px solid #e2eaf1;
    }

    /* Navbar: Clean Crisp White, Gen Z minimal modern */
    .site-nav {
        position: sticky;
        top: 0;
        z-index: 100;
        background: #ffffff;
        border-bottom: 1px solid #edf2f7;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
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
        font-size: 24px;
        font-weight: 900;
        letter-spacing: -0.04em;
        text-decoration: none;
        color: #5b8fa8;
    }
    .site-logo .brand-market {
        color: #0f172a;
        font-weight: 700;
        margin-left: 2px;
    }
    .site-nav-links {
        display: flex;
        align-items: center;
        gap: 40px;
    }
    .site-nav-links a {
        color: #475569;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: -0.01em;
        text-decoration: none;
        transition: all 0.2s ease;
        padding: 6px 0;
        position: relative;
    }
    .site-nav-links a:hover {
        color: #5b8fa8;
    }
    .site-nav-links a.active {
        color: #5b8fa8;
        font-weight: 700;
    }
    .site-nav-links a.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background: #5b8fa8;
        border-radius: 2px;
    }
    .site-nav-actions {
        display: flex;
        align-items: center;
        gap: 20px;
    }
    .nav-action-icon {
        color: #334155;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        padding: 8px;
        border-radius: 50%;
        background: #f8fafc;
    }
    .nav-action-icon:hover {
        color: #5b8fa8;
        background: #f1f5f9;
        transform: translateY(-1px);
    }
    .site-menu-toggle {
        display: none;
        background: transparent;
        border: none;
        font-size: 24px;
        color: #0f172a;
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
            padding: 24px;
            gap: 18px;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 16px 32px rgba(0,0,0,0.08);
        }
        .site-nav-links.is-open { display: flex; }
    }
</style>
@endpush

<div class="top-announcement-bar">
    <span>✦ Gratis Ongkir Seluruh Indonesia Dengan Minimal Belanja ✦</span>
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
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
            </a>
            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener" class="nav-action-icon" title="Konsultasi WhatsApp" aria-label="WhatsApp">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 1 0-8 0 4 4 0 0 0 8 0Zm0 0v1.5a2.5 2.5 0 0 0 5 0V12a9 9 0 1 0-9 9m4.5-1.206a8.959 8.959 0 0 1-4.5 1.207"/></svg>
            </a>
            <a href="/products" class="nav-action-icon" title="Keranjang Belanja" aria-label="Bag">
                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25c-.67 0-1.19-.578-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z"/></svg>
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
