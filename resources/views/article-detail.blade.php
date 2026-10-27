@extends('layouts.app')

@section('content')
@php
    $articleParagraphs = preg_split('/\R{2,}/', trim((string) $article->desc), -1, PREG_SPLIT_NO_EMPTY) ?: [];
    $readingMinutes = max(1, (int) ceil(str_word_count(strip_tags((string) $article->desc)) / 200));
    $articleUrl = url()->current();
@endphp
<div class="clean-page article-detail-page">
    @include('partials.site-nav')

    <main class="clean-main article-detail">
        <nav class="article-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Beranda</a><span aria-hidden="true">/</span>
            <a href="{{ route('articles') }}">Artikel</a><span aria-hidden="true">/</span>
            <span aria-current="page">{{ $article->title }}</span>
        </nav>

        <article>
            <header class="article-detail-header">
                <div class="article-meta">
                    @if ($article->tag)<span class="article-tag">{{ $article->tag }}</span>@endif
                    @if ($article->date)<span class="article-date">{{ $article->date }}</span>@endif
                    <span class="article-reading-time">{{ $readingMinutes }} menit baca</span>
                </div>
                <h1>{{ $article->title }}</h1>
            </header>

            <figure class="article-detail-image">
                <img src="{{ $article->image ? (str_starts_with($article->image, '/') || preg_match('~^https?://~i', $article->image) ? $article->image : asset('storage/'.$article->image)) : '/images/liefmarket-32/50.webp' }}" alt="{{ $article->title }}" onerror="this.onerror=null;this.src='/images/liefmarket-32/50.webp'">
            </figure>

            <div class="article-detail-body">
                @forelse ($articleParagraphs as $paragraph)
                    <p>{{ $paragraph }}</p>
                @empty
                    <p>Informasi artikel ini akan segera diperbarui.</p>
                @endforelse
            </div>

            <div class="article-detail-actions">
                <a class="clean-button" href="https://wa.me/?text={{ rawurlencode($article->title.' '.$articleUrl) }}" target="_blank" rel="noopener">Bagikan ke WhatsApp</a>
                <a class="article-back-link" href="{{ route('articles') }}">Kembali ke Semua Artikel</a>
            </div>
        </article>

        @if ($relatedArticles->isNotEmpty())
            <section class="article-related" aria-labelledby="related-articles-title">
                <div class="clean-section-heading">
                    <p class="clean-eyebrow">BACA JUGA</p>
                    <h2 id="related-articles-title">Artikel Terkait</h2>
                </div>
                <div class="article-related-compact-grid">
                    @foreach ($relatedArticles as $relatedArticle)
                        <article class="related-compact-card">
                            <a class="related-compact-image" href="{{ route('articles.detail', $relatedArticle->id) }}" tabindex="-1" aria-hidden="true">
                                <img src="{{ $relatedArticle->image ? (str_starts_with($relatedArticle->image, '/') || preg_match('~^https?://~i', $relatedArticle->image) ? $relatedArticle->image : asset('storage/'.$relatedArticle->image)) : '/images/liefmarket-32/50.webp' }}" alt="" loading="lazy" onerror="this.onerror=null;this.src='/images/liefmarket-32/50.webp'">
                            </a>
                            <div class="related-compact-content">
                                <div class="article-meta">
                                    @if ($relatedArticle->tag)<span class="article-tag">{{ $relatedArticle->tag }}</span>@endif
                                    @if ($relatedArticle->date)<span class="article-date">{{ $relatedArticle->date }}</span>@endif
                                </div>
                                <h3><a href="{{ route('articles.detail', $relatedArticle->id) }}">{{ $relatedArticle->title }}</a></h3>
                                <a class="related-compact-read-more" href="{{ route('articles.detail', $relatedArticle->id) }}">Baca artikel <span aria-hidden="true">→</span></a>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif
    </main>

    @include('partials.site-footer')
</div>
@endsection
