@extends('layouts.app')

@section('content')
<main class="inner-page about-page" style="--page-color: #4a5770">
    @include('partials.site-nav')

    <section class="inner-hero">
        <div>
            <p class="eyebrow">{{ $about['eyebrow'] ?? 'TENTANG LAMOURAD' }} ✦</p>
            <h1>{!! nl2br(e($about['title'] ?? 'Solusi terpercaya produk resmi & original.')) !!}</h1>
            <p>{{ data_get($content, 'hero.description') }}</p>
            <a class="dark-button" href="/products">JELAJAHI PRODUK <span aria-hidden>→</span></a>
        </div>
        <div class="inner-image">
            <img src="{{ $about['heroImage'] ?? '/images/lamourad-32/70.webp' }}" alt="Tentang Lamourad">
        </div>
    </section>

    <section class="about-story">
        <div class="story-section-inner">
            <div class="story-image-wrap">
                <img src="{{ $about['storyImage'] ?? '/images/lamourad-3/5.webp' }}" alt="Cerita Lamourad">
            </div>
            <div class="story-copy">
                <p class="eyebrow">{{ $about['storyEyebrow'] ?? 'CERITA KAMI' }}</p>
                <h2>{!! nl2br(e($about['storyTitle'] ?? 'Lebih dari sekadar berbelanja.')) !!}</h2>
                <div class="story-quote-card">
                    <p>"{{ $about['storyQuote'] ?? '' }}"</p>
                </div>
                <p>{{ $about['storyText'] ?? '' }}</p>
            </div>
        </div>
    </section>

    <section class="about-vision">
        <div class="about-vision-inner">
            <div class="about-vision-copy">
                <p class="eyebrow">VISI & MISI ✦</p>
                <h2>{{ $about['visionTitle'] ?? 'Visi & Misi' }}</h2>
                <p>{{ $about['visionText'] ?? '' }}</p>
            </div>
            <ol class="about-mission-list">
                @foreach (($about['missionItems'] ?? []) as $index => $item)
                    <li>
                        <span>0{{ $index + 1 }}</span>
                        <p>{{ is_array($item) ? ($item['value'] ?? '') : $item }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    <section class="about-pillars">
        <div class="about-pillars-inner">
            <div class="section-heading">
                <p class="eyebrow">MENGAPA LAMOURAD ✦</p>
                <h2>{{ $about['pillarsTitle'] ?? '4 Pilar Keunggulan Kami' }}</h2>
            </div>
            <div class="pillar-grid">
                @foreach (($about['pillars'] ?? []) as $pillar)
                    <div class="pillar-card">
                        <div class="pillar-icon">
                            @if (($pillar['icon'] ?? '') === 'leaf')
                                ❋
                            @elseif (($pillar['icon'] ?? '') === 'heart')
                                ♥
                            @elseif (($pillar['icon'] ?? '') === 'star')
                                ★
                            @else
                                ✦
                            @endif
                        </div>
                        <h3>{{ $pillar['title'] }}</h3>
                        <p>{{ $pillar['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="about-quality">
        <div class="story-section-inner about-quality-inner">
            <div class="story-copy">
                <p class="eyebrow">{{ $about['qualityEyebrow'] ?? 'STANDAR KUALITAS' }}</p>
                <h2>{!! nl2br(e($about['qualityTitle'] ?? 'Kualitas yang dijaga di setiap tahap.')) !!}</h2>
                <p>{{ $about['qualityText'] ?? '' }}</p>
                <a class="text-link" href="/contact">HUBUNGI TIM KAMI <span aria-hidden>→</span></a>
            </div>
            <div class="story-image-wrap">
                <img src="{{ $about['qualityImage'] ?? '/images/lamourad-3/2.webp' }}" alt="Standar Kualitas Lamourad">
            </div>
        </div>
    </section>

    <footer class="inner-footer">
        <p class="eyebrow">Siap mencoba produk kami?</p>
        <h2>Temukan pilihan<br><em>favorit keluarga.</em></h2>
        <a class="dark-button" href="/products">LIHAT KATALOG <span aria-hidden>→</span></a>
    </footer>
</main>
@endsection
