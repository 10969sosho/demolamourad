@php
    $siteTitle = data_get($content, 'site.title') ?: (data_get($content, 'navbar.brandName', 'LiefMarket').' — Solusi Perawatan & Produk Asli Terpercaya');
    $siteDesc = data_get($content, 'site.description', data_get($content, 'hero.description', ''));
    $favicon = (string) data_get($content, 'site.favicon', 'favicon.ico');
    $faviconUrl = preg_match('~^https?://~i', $favicon) ? $favicon : (str_starts_with($favicon, 'uploads/') ? asset('storage/'.$favicon) : asset($favicon));
    $selectedFont = data_get($content, 'theme.fontFamily', 'Nunito');
    $fontParam = urlencode($selectedFont).':wght@400;500;600;700;800;900';
    $navbarBg = data_get($content, 'theme.navbarBg', '#ffffff');
    $navbarText = data_get($content, 'theme.navbarText', '#27352a');
    $theme = data_get($content, 'theme', []);
    $themeStyle = sprintf(
        '--primary:%s;--secondary:%s;--accent:%s;--bg:%s;--text:%s;--navbar-bg:%s;--red:%s;--sage:%s;--yellow:%s;--dark:%s',
        data_get($theme, 'primaryColor', '#1b382b'),
        data_get($theme, 'secondaryColor', '#2d5a44'),
        data_get($theme, 'accentColor', '#c5a880'),
        data_get($theme, 'bgColor', '#f4f7f4'),
        data_get($theme, 'textColor', '#18281e'),
        $navbarBg,
        data_get($theme, 'primaryColor', '#1b382b'),
        data_get($theme, 'secondaryColor', '#2d5a44'),
        data_get($theme, 'accentColor', '#c5a880'),
        data_get($theme, 'textColor', '#18281e')
    );
    $whatsappRaw = (string) data_get($content, 'contact.whatsapp', '');
    $whatsappNumber = preg_replace('/\D/', '', $whatsappRaw);
    $whatsappDefaultUrl = $whatsappNumber !== ''
        ? 'https://wa.me/'.$whatsappNumber.'?text='.rawurlencode('Halo admin LiefMarket, saya ingin berkonsultasi mengenai produk dan layanan.')
        : route('contact');
@endphp
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $siteTitle }}</title>
    <meta name="description" content="{{ $siteDesc }}">
    <link rel="icon" href="{{ $faviconUrl }}">
    <link rel="stylesheet" href="{{ asset('css/globals.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family={{ $fontParam }}&display=swap" rel="stylesheet">
    <style>
        :root {
            --font-main: '{{ $selectedFont }}', -apple-system, BlinkMacSystemFont, sans-serif !important;
            --font-serif: var(--font-main) !important;
            --navbar-bg: {{ $navbarBg }} !important;
            --navbar-text: {{ $navbarText }} !important;
        }
        .site-nav { background: var(--navbar-bg) !important; }
        .site-nav-links a { color: var(--navbar-text) !important; }
    </style>
    @stack('head')
</head>
<body style="{{ $themeStyle }}">
    @yield('content')
    <a href="{{ $whatsappDefaultUrl }}" target="_blank" rel="noopener" class="floating-whatsapp-btn" aria-label="Chat WhatsApp Admin LiefMarket">
        <svg viewBox="0 0 24 24" aria-hidden="true" width="28" height="28">
            <path fill="currentColor" d="M20.5 3.5A11.8 11.8 0 0 0 12.1 0C5.6 0 .3 5.3.3 11.8c0 2.1.6 4.2 1.7 6L0 24l6.4-1.7a11.8 11.8 0 0 0 5.7 1.5h.1c6.5 0 11.8-5.3 11.8-11.8 0-3.2-1.2-6.2-3.5-8.5ZM12.1 21.8a9.9 9.9 0 0 1-5-1.4l-.4-.2-3.8 1 1-3.7-.3-.4a9.8 9.8 0 0 1-1.5-5.3c0-5.5 4.5-10 10-10 2.7 0 5.2 1 7.1 2.9a9.9 9.9 0 0 1 2.9 7.1c0 5.5-4.5 10-10 10Zm5.5-7.5c-.3-.2-1.7-.9-2-.9-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.2-.2.2-.4.2-.7.1-.3-.2-1.2-.4-2.3-1.4-.9-.8-1.5-1.7-1.7-2-.2-.3 0-.5.1-.6l.5-.6c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5 0-.2-.7-1.6-1-2.1-.2-.5-.5-.4-.7-.4h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-.9 2.4 0 1.4 1 2.7 1.1 2.9.2.2 2 3.1 4.8 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.7-.7 1.9-1.3.2-.6.2-1.1.2-1.2-.1-.3-.3-.4-.6-.6Z"/>
        </svg>
        <span class="floating-wa-text">Chat WhatsApp</span>
    </a>
    @stack('scripts')
</body>
</html>
