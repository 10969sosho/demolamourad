@extends('layouts.app')

@push('head')
<style>
    .catalog-page {
        background: #fafcff;
        min-height: 100vh;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    .catalog-main {
        max-width: 1280px;
        margin: 0 auto;
        padding: 40px clamp(20px, 4vw, 48px) 80px;
    }

    .catalog-header {
        margin-bottom: 32px;
    }

    .catalog-eyebrow {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: #a9d2c4;
        margin: 0 0 8px;
    }

    .catalog-title {
        font-size: clamp(28px, 3.5vw, 42px);
        font-weight: 800;
        color: #0f172a;
        letter-spacing: -0.03em;
        margin: 0 0 10px;
    }

    .catalog-desc {
        font-size: 15px;
        color: #64748b;
        margin: 0;
    }

    /* Filter & Toolbar */
    .catalog-toolbar-wrapper {
        background: #ffffff;
        border: 1px solid #edf2f7;
        border-radius: 16px;
        padding: 16px 20px;
        margin-bottom: 32px;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.02);
    }

    .catalog-search-box {
        position: relative;
        flex: 1;
        min-width: 240px;
    }

    .catalog-search-box input {
        width: 100%;
        padding: 10px 16px 10px 38px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 14px;
        font-family: inherit;
        background: #f8fafc;
        color: #0f172a;
        transition: all 0.2s ease;
        outline: none;
    }

    .catalog-search-box input:focus {
        background: #ffffff;
        border-color: #a9d2c4;
        box-shadow: 0 0 0 3px rgba(169, 210, 196, 0.2);
    }

    .catalog-search-icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        pointer-events: none;
    }

    .catalog-sort-box {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 13px;
        color: #64748b;
        font-weight: 600;
    }

    .catalog-sort-box select {
        padding: 8px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 13px;
        font-family: inherit;
        background: #ffffff;
        color: #0f172a;
        outline: none;
        cursor: pointer;
    }

    /* Category Pill Tabs */
    .catalog-category-bar {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 28px;
    }

    .category-pill {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: #64748b;
        font-size: 13px;
        font-weight: 600;
        padding: 8px 18px;
        border-radius: 100px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .category-pill:hover {
        border-color: #cbd5e1;
        color: #0f172a;
    }

    .category-pill.active {
        background: #0f172a;
        color: #ffffff;
        border-color: #0f172a;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12);
    }

    .catalog-count-info {
        font-size: 13px;
        color: #94a3b8;
        margin-bottom: 20px;
    }

    /* Modern Product Grid */
    .catalog-product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-bottom: 48px;
    }

    .catalog-card {
        background: #ffffff;
        border: 1px solid #edf2f7;
        border-radius: 20px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.02);
    }

    .catalog-card:hover {
        transform: translateY(-4px);
        border-color: #cbd5e1;
        box-shadow: 0 16px 32px rgba(15, 23, 42, 0.08);
    }

    .catalog-card-image {
        position: relative;
        aspect-ratio: 1 / 1;
        width: 100%;
        background: radial-gradient(circle at 50% 50%, #ffffff 0%, #f8fafc 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        overflow: hidden;
        border-bottom: 1px solid #f1f5f9;
    }

    .catalog-card-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
        filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.04));
    }

    .catalog-card:hover .catalog-card-image img {
        transform: scale(1.05);
    }

    .catalog-card-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid #edf2f7;
        padding: 4px 10px;
        border-radius: 100px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: #555555;
    }

    .catalog-card-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .catalog-card-category {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #555555;
        margin: 0 0 6px;
    }

    .catalog-card-title {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 12px;
        line-height: 1.4;
    }

    .catalog-card-title a {
        color: inherit;
        text-decoration: none;
        transition: color 0.15s ease;
    }

    .catalog-card-title a:hover {
        color: #555555;
    }

    .catalog-card-price {
        font-size: 17px;
        font-weight: 800;
        color: #0f172a;
        margin-top: auto;
        margin-bottom: 16px;
    }

    .catalog-card-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }

    .btn-catalog-detail {
        padding: 9px 12px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #475569;
        font-size: 13px;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-catalog-detail:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #0f172a;
    }

    .btn-catalog-checkout {
        padding: 9px 12px;
        border-radius: 8px;
        border: none;
        background: #0f172a;
        color: #ffffff;
        font-size: 13px;
        font-weight: 600;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-catalog-checkout:hover {
        background: #273549;
        transform: translateY(-1px);
    }

    /* Empty state */
    .catalog-empty-state {
        text-align: center;
        padding: 60px 20px;
        background: #ffffff;
        border-radius: 20px;
        border: 1px dashed #cbd5e1;
        color: #64748b;
    }

    /* Pager */
    .catalog-pager {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        margin-top: 36px;
    }

    .catalog-pager button {
        padding: 8px 18px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #0f172a;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .catalog-pager button:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    .catalog-pager button:not(:disabled):hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }

    .catalog-page-label {
        font-size: 13px;
        color: #64748b;
        font-weight: 500;
    }

    @media (max-width: 1024px) {
        .catalog-product-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
        }
    }

    @media (max-width: 768px) {
        .catalog-product-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 14px;
        }
    }

    @media (max-width: 480px) {
        .catalog-product-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="catalog-page">
    @include('partials.site-nav')

    <main class="catalog-main">
        <header class="catalog-header">
            <p class="catalog-eyebrow">liefmarket katalog</p>
            <h1 class="catalog-title">Katalog Produk</h1>
            <p class="catalog-desc">Jelajahi produk original pilihan untuk perawatan kecantikan dan kesehatan keluarga Anda.</p>
        </header>

        <div class="catalog-toolbar-wrapper">
            <div class="catalog-search-box">
                <svg class="catalog-search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                <input type="search" id="catalog-search" placeholder="Cari nama produk…" aria-label="Cari nama produk">
            </div>

            <div class="catalog-sort-box">
                <span>Urutkan:</span>
                <select id="catalog-sort">
                    <option value="default">Pilihan Unggulan</option>
                    <option value="name-asc">Nama A–Z</option>
                    <option value="name-desc">Nama Z–A</option>
                </select>
            </div>
        </div>

        <div class="catalog-category-bar" id="catalog-categories" aria-label="Filter kategori">
            <button class="category-pill active" type="button" data-category="SEMUA" aria-pressed="true">Semua</button>
            @foreach ($categories as $category)
                <button class="category-pill" type="button" data-category="{{ $category }}" aria-pressed="false">{{ $category }}</button>
            @endforeach
        </div>

        <p class="catalog-count-info" id="catalog-count" aria-live="polite"></p>

        <div class="catalog-product-grid" id="catalog-grid">
            @foreach ($products as $product)
                <article class="catalog-card catalog-product-item" data-category="{{ $product['category'] }}" data-name="{{ $product['name'] }}" data-order="{{ $loop->index }}">
                    <div class="catalog-card-image">
                        <span class="catalog-card-badge">100% Original BPOM</span>
                        <img src="{{ $product['image'] ? (str_starts_with($product['image'], '/') || preg_match('~^https?://~i', $product['image']) ? $product['image'] : asset('storage/'.$product['image'])) : '/images/liefmarket-3/1.png' }}" 
                             alt="{{ $product['name'] }}" 
                             loading="lazy" 
                             onerror="this.onerror=null;this.src='/images/liefmarket-3/1.png'">
                    </div>
                    <div class="catalog-card-body">
                        <span class="catalog-card-category">{{ $product['category'] }}</span>
                        <h2 class="catalog-card-title">
                            <a href="{{ route('products.detail', $product['id']) }}">{{ $product['name'] }}</a>
                        </h2>
                        <div class="catalog-card-price">{{ $product['price'] ?? 'Rp -' }}</div>
                        <div class="catalog-card-actions">
                            <a class="btn-catalog-detail" href="{{ route('products.detail', $product['id']) }}">Detail</a>
                            <button type="button" class="btn-catalog-checkout" onclick="openCheckoutModal('{{ addslashes($product['name']) }}', '{{ addslashes($product['price'] ?? '') }}')">Checkout</button>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="catalog-empty-state" id="catalog-empty" hidden>
            <p style="font-size: 16px; font-weight: 600; margin: 0 0 6px; color: #0f172a;">Produk tidak ditemukan</p>
            <p style="margin: 0; font-size: 14px;">Coba gunakan kata kunci pencarian atau kategori filter yang lain.</p>
        </div>

        <nav class="catalog-pager" id="catalog-pager" aria-label="Halaman katalog">
            <button type="button" id="catalog-prev">← Sebelumnya</button>
            <span class="catalog-page-label" id="catalog-page" aria-live="polite"></span>
            <button type="button" id="catalog-next">Berikutnya →</button>
        </nav>
    </main>

    @include('partials.checkout-modal')
    @include('partials.site-footer')
</div>
@endsection

@push('scripts')
<script>
    (function () {
        var grid = document.getElementById('catalog-grid');
        var cards = Array.prototype.slice.call(grid.querySelectorAll('.catalog-product-item'));
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

        // Check URL params for category filter (e.g. ?category=KESEHATAN)
        var urlParams = new URLSearchParams(window.location.search);
        var initialCat = urlParams.get('category');
        if (initialCat) {
            var matchingBtn = categories.querySelector('button[data-category="' + initialCat + '"]');
            if (matchingBtn) {
                categories.querySelectorAll('button').forEach(function (btn) {
                    btn.classList.remove('active');
                    btn.setAttribute('aria-pressed', 'false');
                });
                matchingBtn.classList.add('active');
                matchingBtn.setAttribute('aria-pressed', 'true');
                activeCategory = initialCat;
            }
        }

        function updateCatalog() {
            var query = search.value.trim().toLocaleLowerCase('id');
            var visible = cards.filter(function (card) {
                return (activeCategory === 'SEMUA' || card.dataset.category.toUpperCase() === activeCategory.toUpperCase()) && card.dataset.name.toLocaleLowerCase('id').includes(query);
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
