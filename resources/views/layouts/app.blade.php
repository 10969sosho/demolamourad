<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $content['navbar']['brandName'] . strtoupper($content['navbar']['brandSub']) . ' — Solusi Perawatan & Produk Asli Terpercaya' }}</title>
    <meta name="description" content="{{ $content['hero']['description'] }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/globals.css') }}">
    @stack('head')
</head>
@php
    $theme = $content['theme'];
    $themeStyle = sprintf(
        '--primary:%s;--secondary:%s;--accent:%s;--bg:%s;--text:%s;--navbar-bg:%s;--red:%s;--sage:%s;--yellow:%s;--dark:%s',
        $theme['primaryColor'],
        $theme['secondaryColor'],
        $theme['accentColor'],
        $theme['bgColor'],
        $theme['textColor'],
        $theme['navbarBg'],
        $theme['primaryColor'],
        $theme['secondaryColor'],
        $theme['accentColor'],
        $theme['textColor'],
    );
@endphp
<body style="{{ $themeStyle }}">
    @yield('content')
    @stack('scripts')
</body>
</html>
