@extends('layouts.app')

@section('content')
<div class="clean-page">
    @include('partials.site-nav')

    <main class="clean-main clean-catalog">
        <header class="clean-page-header">
            <p class="clean-eyebrow">LiefMarket</p>
            <h1>Katalog Produk</h1>
            <p>Jelajahi produk original untuk perawatan dan kebutuhan keluarga.</p>
        </header>

        <div class="clean-toolbar">
            <input class="clean-search" type="search" id="catalog-search" placeholder="Cari nama produk…" aria-label="Cari nama produk">
            <label class="clean-sort">
                Urutkan
                <select id="catalog-sort">
                    <option value="default">Pilihan</option>
                    <option value="name-asc">Nama A–Z</option>
                    <option value="name-desc">Nama Z–A</option>
                </select>
            </label>
        </div>

        <div class="clean-category-list" id="catalog-categories" aria-label="Filter kategori">
            <button class="clean-category-button active" type="button" data-category="SEMUA" aria-pressed="true">Semua</button>
            @foreach ($categories as $category)
                <button class="clean-category-button" type="button" data-category="{{ $category }}" aria-pressed="false">{{ $category }}</button>
            @endforeach
        </div>

        <p class="clean-result-count" id="catalog-count" aria-live="polite"></p>
        <div class="clean-grid" id="catalog-grid">
            @foreach ($products as $product)
                <article class="clean-product-card catalog-product" data-category="{{ $product['category'] }}" data-name="{{ $product['name'] }}" data-order="{{ $loop->index }}">
                    <div class="clean-product-image">
                        <img src="{{ $product['image'] ? (str_starts_with($product['image'], '/') || preg_match('~^https?://~i', $product['image']) ? $product['image'] : asset('storage/'.$product['image'])) : '/images/liefmarket-32/1.webp' }}" alt="{{ $product['name'] }}" loading="lazy" onerror="this.onerror=null;this.src='/images/liefmarket-32/1.webp'">
                    </div>
                    <div class="clean-product-body">
                        <p class="clean-product-category">{{ $product['category'] }}</p>
                        <h2><a href="{{ route('products.detail', $product['id']) }}">{{ $product['name'] }}</a></h2>
                        <div class="clean-card-actions">
                            <a class="clean-secondary-link" href="{{ route('products.detail', $product['id']) }}">Lihat detail</a>
                            @if ($whatsapp !== '')
                                <a class="clean-button" href="https://wa.me/{{ preg_replace('/\D/', '', $whatsapp) }}?text={{ rawurlencode('Halo LiefMarket, saya ingin memesan '.$product['name'].'.') }}" target="_blank" rel="noopener">Pesan via WhatsApp</a>
                            @else
                                <a class="clean-button" href="/contact">Tanya produk</a>
                            @endif
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        <p class="clean-page-header" id="catalog-empty" hidden>Produk tidak ditemukan. Coba kata kunci atau kategori lain.</p>
        <nav class="clean-pager" id="catalog-pager" aria-label="Halaman katalog">
            <button type="button" id="catalog-prev">Sebelumnya</button>
            <span id="catalog-page" aria-live="polite"></span>
            <button type="button" id="catalog-next">Berikutnya</button>
        </nav>
    </main>

    @include('partials.site-footer')
</div>
@endsection

@push('scripts')
<script>
    (function () {
        var grid = document.getElementById('catalog-grid');
        var cards = Array.prototype.slice.call(grid.querySelectorAll('.catalog-product'));
        var search = document.getElementById('catalog-search');
        var sort = document.getElementById('catalog-sort');
        var categories = document.getElementById('catalog-categories');
        var count = document.getElementById('catalog-count');
        var empty = document.getElementById('catalog-empty');
        var pageLabel = document.getElementById('catalog-page');
        var previous = document.getElementById('catalog-prev');
        var next = document.getElementById('catalog-next');
        var activeCategory = 'SEMUA';
        var currentPage = 1;
        var pageSize = 12;

        function updateCatalog() {
            var query = search.value.trim().toLocaleLowerCase('id');
            var visible = cards.filter(function (card) {
                return (activeCategory === 'SEMUA' || card.dataset.category === activeCategory) && card.dataset.name.toLocaleLowerCase('id').includes(query);
            });
            var direction = sort.value;

            visible.sort(function (a, b) {
                if (direction === 'name-asc') return a.dataset.name.localeCompare(b.dataset.name, 'id');
                if (direction === 'name-desc') return b.dataset.name.localeCompare(a.dataset.name, 'id');
                return Number(a.dataset.order) - Number(b.dataset.order);
            });

            var pageCount = Math.ceil(visible.length / pageSize);
            currentPage = Math.min(currentPage, Math.max(pageCount, 1));
            var start = (currentPage - 1) * pageSize;
            var visiblePage = visible.slice(start, start + pageSize);
            cards.forEach(function (card) { card.hidden = true; });
            visiblePage.forEach(function (card) {
                card.hidden = false;
                grid.appendChild(card);
            });

            count.textContent = visible.length ? (start + 1) + '–' + Math.min(start + pageSize, visible.length) + ' dari ' + visible.length + ' produk' : '0 produk';
            empty.hidden = visible.length > 0;
            pageLabel.textContent = 'Halaman ' + currentPage + ' dari ' + Math.max(pageCount, 1);
            previous.disabled = currentPage <= 1;
            next.disabled = currentPage >= pageCount;
            document.getElementById('catalog-pager').hidden = pageCount <= 1;
        }

        search.addEventListener('input', function () { currentPage = 1; updateCatalog(); });
        sort.addEventListener('change', function () { currentPage = 1; updateCatalog(); });
        categories.addEventListener('click', function (event) {
            var button = event.target.closest('button[data-category]');
            if (!button) return;
            categories.querySelectorAll('button').forEach(function (item) {
                item.classList.toggle('active', item === button);
                item.setAttribute('aria-pressed', String(item === button));
            });
            activeCategory = button.dataset.category;
            currentPage = 1;
            updateCatalog();
        });
        previous.addEventListener('click', function () { currentPage--; updateCatalog(); });
        next.addEventListener('click', function () { currentPage++; updateCatalog(); });

        updateCatalog();
    })();
</script>
@endpush
