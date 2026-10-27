@extends('layouts.app')

@section('content')
@php
    $storyImage = data_get($about, 'storyImage') ?: data_get($about, 'heroImage') ?: '/images/liefmarket-32/70.webp';
    $qualityImage = data_get($about, 'qualityImage') ?: data_get($about, 'heroImage') ?: '/images/liefmarket-32/70.webp';
    $storyImage = str_starts_with($storyImage, '/') || preg_match('~^https?://~i', $storyImage) ? $storyImage : asset('storage/'.$storyImage);
    $qualityImage = str_starts_with($qualityImage, '/') || preg_match('~^https?://~i', $qualityImage) ? $qualityImage : asset('storage/'.$qualityImage);
@endphp
<div class="clean-page about-page">
    @include('partials.site-nav')

    <main class="clean-main about-editorial-main">
        <header class="clean-page-header about-editorial-header">
            <p class="clean-eyebrow">{{ data_get($about, 'eyebrow', 'TENTANG LIEFMARKET') }}</p>
            <h1>{{ data_get($about, 'title', 'Solusi Terpercaya Produk Resmi & Original untuk Keluarga Indonesia') }}</h1>
            <p class="about-editorial-lead">
                <span>{{ data_get($about, 'storyEyebrow') }}</span>
                {{ data_get($about, 'storyTitle') }}
            </p>
        </header>

        <figure class="about-article-figure">
            <img
                src="{{ $storyImage }}"
                alt="{{ data_get($about, 'storyImageAlt', data_get($about, 'storyTitle', 'CERITA LIEFMARKET')) }}"
                loading="lazy"
                onerror="this.onerror=null;this.src='/images/liefmarket-32/70.webp'"
            >
            <figcaption>{{ data_get($about, 'storyImageCaption', 'Cerita dan komitmen LiefMarket untuk keluarga Indonesia.') }}</figcaption>
        </figure>

        <section class="about-article-body" aria-label="{{ data_get($about, 'storyEyebrow', 'Cerita dan komitmen') }}">
            <p>{{ data_get($about, 'storyText') }}</p>
            @if (data_get($about, 'storyQuote'))
                <blockquote class="about-article-quote">“{{ data_get($about, 'storyQuote') }}”</blockquote>
            @endif
            <p>{{ data_get($about, 'authenticityText', 'Kami berkomitmen menghadirkan produk 100% original dengan izin edar dan sertifikasi BPOM yang terverifikasi, agar setiap pilihan terasa aman dan tepercaya.') }}</p>
        </section>

        <figure class="about-article-figure">
            <img
                src="{{ $qualityImage }}"
                alt="{{ data_get($about, 'qualityImageAlt', data_get($about, 'qualityTitle', 'Standar kualitas LiefMarket')) }}"
                loading="lazy"
                onerror="this.onerror=null;this.src='/images/liefmarket-32/70.webp'"
            >
            <figcaption>{{ data_get($about, 'qualityImageCaption', 'Standar kualitas dan kurasi PRODUK LIEFMARKET.') }}</figcaption>
        </figure>

        <section class="about-article-body about-article-vision">
            <h2>{{ data_get($about, 'visionTitle', 'Visi & Nilai Layanan Kami') }}</h2>
            <p>{{ data_get($about, 'visionText') }}</p>
            <p>{{ data_get($about, 'qualityText') }}</p>
            @if (data_get($about, 'pillars', []))
                <p class="about-pillars-inline" aria-label="{{ data_get($about, 'pillarsTitle', 'Pilar nilai layanan') }}">
                    @foreach (data_get($about, 'pillars', []) as $pillar)
                        @if (data_get($pillar, 'title'))
                            <span>{{ data_get($pillar, 'title') }}</span>@if (! $loop->last)<span aria-hidden="true">·</span>@endif
                        @endif
                    @endforeach
                </p>
            @endif
        </section>

        <nav class="about-editorial-actions" aria-label="{{ data_get($about, 'actionsLabel', 'JELAJAHI LIEFMARKET') }}">
            <a class="clean-button" href="/products">{{ data_get($about, 'productsBtnText', 'Jelajahi Katalog Produk →') }}</a>
            <a class="about-contact-link" href="/contact">{{ data_get($about, 'contactBtnText', 'Hubungi Tim Kami') }}</a>
        </nav>
    </main>

    @include('partials.site-footer')
</div>
@endsection
