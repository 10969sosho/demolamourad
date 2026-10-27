@extends('layouts.app')

@section('content')
<div class="clean-page articles-page">
    @include('partials.site-nav')

    <main class="clean-main">
        <header class="clean-page-header articles-header">
            <p class="clean-eyebrow">ARTIKEL & INFORMASI</p>
            <h1>Inspirasi &amp; Tips Perawatan Keluarga</h1>
            <p>Temukan tips kesehatan, panduan memilih skincare aman BPOM, dan informasi khasiat herbal untuk menemani keluarga.</p>
        </header>

        <section class="articles-listing" aria-label="Daftar artikel">
            <div class="articles-toolbar">
                <div class="article-filters" id="article-filters" aria-label="Filter kategori artikel">
                    <button class="article-filter is-active" type="button" data-tag="SEMUA" aria-pressed="true">Semua</button>
                    @foreach ($tags as $tag)
                        <button class="article-filter" type="button" data-tag="{{ $tag }}" aria-pressed="false">{{ $tag }}</button>
                    @endforeach
                </div>
                <label class="article-search-wrap">
                    <span class="sr-only">Cari artikel</span>
                    <input class="article-search" id="article-search" type="search" placeholder="Cari artikel…" autocomplete="off">
                    <span aria-hidden="true">⌕</span>
                </label>
            </div>

            <div class="article-grid" id="article-grid">
                @foreach ($articles as $article)
                    <article class="article-card" data-tag="{{ $article->tag }}" data-search="{{ $article->title }} {{ $article->tag }} {{ $article->desc }}">
                        <a class="article-card-image" href="{{ route('articles.detail', $article->id) }}" tabindex="-1" aria-hidden="true">
                            <img src="{{ $article->image ? (str_starts_with($article->image, '/') || preg_match('~^https?://~i', $article->image) ? $article->image : asset('storage/'.$article->image)) : '/images/liefmarket-32/50.webp' }}" alt="" loading="lazy" onerror="this.onerror=null;this.src='/images/liefmarket-32/50.webp'">
                        </a>
                        <div class="article-card-content">
                            <div class="article-meta">
                                @if ($article->tag)<span class="article-tag">{{ $article->tag }}</span>@endif
                                @if ($article->date)<span class="article-date">{{ $article->date }}</span>@endif
                            </div>
                            <h2><a href="{{ route('articles.detail', $article->id) }}">{{ $article->title }}</a></h2>
                            <p>{{ $article->desc }}</p>
                            <a class="article-read-more" href="{{ route('articles.detail', $article->id) }}">Baca Selengkapnya <span aria-hidden="true">→</span></a>
                        </div>
                    </article>
                @endforeach
            </div>
            <p class="article-empty" id="article-empty" hidden>Artikel tidak ditemukan. Coba kata kunci atau kategori lain.</p>
        </section>
    </main>

    @include('partials.site-footer')
</div>
@endsection

@push('scripts')
<script>
    (function () {
        var grid = document.getElementById('article-grid');
        var cards = Array.prototype.slice.call(grid.querySelectorAll('.article-card'));
        var filters = document.getElementById('article-filters');
        var search = document.getElementById('article-search');
        var empty = document.getElementById('article-empty');
        var activeTag = 'SEMUA';

        function updateArticles() {
            var query = search.value.trim().toLocaleLowerCase('id');
            var visibleCount = 0;

            cards.forEach(function (card) {
                var matches = (activeTag === 'SEMUA' || card.dataset.tag === activeTag) && card.dataset.search.toLocaleLowerCase('id').includes(query);
                card.hidden = !matches;
                if (matches) visibleCount++;
            });

            empty.hidden = visibleCount > 0;
        }

        filters.addEventListener('click', function (event) {
            var button = event.target.closest('button[data-tag]');
            if (!button) return;

            activeTag = button.dataset.tag;
            filters.querySelectorAll('button').forEach(function (filter) {
                var isActive = filter === button;
                filter.classList.toggle('is-active', isActive);
                filter.setAttribute('aria-pressed', String(isActive));
            });
            updateArticles();
        });

        search.addEventListener('input', updateArticles);
        updateArticles();
    })();
</script>
@endpush
