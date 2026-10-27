@extends('layouts.app')

@section('content')
<main class="inner-page" style="--page-color: {{ $page['color'] }}">
    <header class="inner-header">
        <a href="/" class="logo">
            <span class="brand-lief">{{ data_get($content, 'navbar.brandName', 'LiefMarket') }}</span>
        </a>
        <a href="/" class="back-home">← KEMBALI KE BERANDA</a>
    </header>

    <section class="inner-hero">
        <div>
            <p class="eyebrow">{{ $page['eyebrow'] }}</p>
            <h1>{{ $page['title'] }}</h1>
            <p>{{ $page['text'] }}</p>
            <a class="dark-button" href="/">JELAJAHI LIEFMARKET <span>→</span></a>
        </div>
        <div class="inner-image">
            <img src="{{ str_starts_with($page['image'], '/') || preg_match('~^https?://~i', $page['image']) ? $page['image'] : asset('storage/'.$page['image']) }}" alt="{{ $page['title'] }}" onerror="this.onerror=null;this.src='/images/liefmarket-32/1.webp'">
        </div>
    </section>

    <section class="inner-next">
        <p class="eyebrow">TEMUKAN LEBIH BANYAK</p>
        <h2>Setiap produk punya<br><em>kualitas terpercaya.</em></h2>
        <a class="text-link" href="/">KEMBALI KE BERANDA <span>→</span></a>
    </section>
</main>
@endsection
