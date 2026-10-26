@extends('layouts.app')

@section('content')
@php
    $pageColor = '#333735';
@endphp
<main class="inner-page catalog-page" style="--page-color: {{ $pageColor }}">
    @include('partials.site-nav')

    <section class="inner-hero catalog-hero">
        <div>
            <p class="eyebrow">PRODUK LIEFMARKET ✦</p>
            <h1>Sahabat terbaik untuk perawatan keluarga.</h1>
            <p>Temukan berbagai produk perawatan kulit, kecantikan, dan herbal berkualitas dengan jaminan 100% original dan terdaftar BPOM.</p>
        </div>
        <div class="inner-image">
            <img src="/images/liefmarket-32/10.webp" alt="Katalog Produk LiefMarket">
        </div>
    </section>

    <section class="catalog-section">
        <div class="catalog-toolbar">
            <div class="catalog-search">
                <span aria-hidden>⌕</span>
                <input type="search" id="catalog-search" placeholder="Cari produk (nama atau deskripsi)…" autocomplete="off">
            </div>
            <label class="catalog-sort">
                <span>Urutkan</span>
                <select id="catalog-sort">
                    <option value="default">Urutan Standar</option>
                    <option value="price-asc">Harga Terendah → Tertinggi</option>
                    <option value="price-desc">Harga Tertinggi → Terendah</option>
                    <option value="name-asc">Nama A–Z</option>
                </select>
            </label>
        </div>

        <div class="catalog-pills" id="catalog-pills">
            <button class="catalog-pill active" data-category="SEMUA">SEMUA</button>
            @foreach ($categories as $category)
                <button class="catalog-pill" data-category="{{ $category }}">{{ strtoupper($category) }}</button>
            @endforeach
        </div>

        <p class="catalog-count" id="catalog-count">{{ count($products) }} produk ditemukan</p>

        <div class="catalog-grid" id="catalog-grid">
            @foreach ($products as $product)
                <article
                    class="catalog-card"
                    data-id="{{ $product['id'] }}"
                    data-category="{{ $product['category'] }}"
                    data-name="{{ $product['name'] }}"
                    data-desc="{{ $product['desc'] }}"
                    data-price="{{ $product['priceValue'] }}"
                >
                    <div class="catalog-card-photo">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" loading="lazy">
                        <span class="catalog-badge">✓ BPOM</span>
                        @if ($product['tag'])
                            <span class="recipe-tag-pill">{{ $product['tag'] }}</span>
                        @endif
                    </div>
                    <div class="catalog-card-body">
                        <span class="catalog-card-category">{{ $product['category'] }}</span>
                        <h3>{{ $product['name'] }}</h3>
                        <p>{{ $product['desc'] }}</p>
                        <div class="catalog-card-foot">
                            <strong class="catalog-card-price">{{ $product['price'] }}</strong>
                            <a
                                class="wa-button"
                                href="https://wa.me/{{ preg_replace('/\D/', '', $whatsapp) }}?text={{ rawurlencode('Halo LiefMarket, saya ingin memesan: '.$product['name'].' ('.$product['price'].'). Apakah ready?') }}"
                                target="_blank"
                                rel="noopener"
                            >Pesan Sekarang</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <p class="catalog-empty" id="catalog-empty" style="display: none">Produk tidak ditemukan. Coba kata kunci lain.</p>
    </section>

    <footer class="inner-footer">
        <p class="eyebrow">Butuh bantuan memilih produk?</p>
        <h2>Tim kami siap<br><em>membantu Anda.</em></h2>
        <a class="dark-button" href="/contact">HUBUNGI KAMI <span aria-hidden>→</span></a>
    </footer>
</main>

<div class="modal-overlay" id="product-modal" style="display: none">
    <div class="modal product-modal">
        <div class="modal-head">
            <h3 id="pm-title">Detail Produk</h3>
            <button class="modal-close" id="pm-close" aria-label="Tutup">×</button>
        </div>
        <div class="modal-body product-modal-body">
            <div class="product-modal-photo">
                <img id="pm-image" src="" alt="">
                <span class="catalog-badge">✓ BPOM</span>
            </div>
            <div class="product-modal-info">
                <span class="catalog-card-category" id="pm-category"></span>
                <h4 id="pm-name"></h4>
                <strong class="catalog-card-price" id="pm-price"></strong>
                <p id="pm-desc"></p>
                <div class="product-modal-meta">
                    <span id="pm-brand"></span>
                    <span id="pm-level"></span>
                </div>
                <a class="wa-button wa-button-lg" id="pm-wa" href="#" target="_blank" rel="noopener">Pesan via WhatsApp</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    var waNumber = @json(preg_replace('/\D/', '', $whatsapp));
    var products = @json($products->keyBy('id'));

    var searchInput = document.getElementById('catalog-search');
    var sortSelect = document.getElementById('catalog-sort');
    var grid = document.getElementById('catalog-grid');
    var cards = Array.prototype.slice.call(grid.querySelectorAll('.catalog-card'));
    var countEl = document.getElementById('catalog-count');
    var emptyEl = document.getElementById('catalog-empty');
    var activeCategory = 'SEMUA';

    function apply() {
        var query = searchInput.value.trim().toLowerCase();
        var sort = sortSelect.value;

        var visible = cards.filter(function (card) {
            var matchCategory = activeCategory === 'SEMUA' || card.dataset.category === activeCategory;
            var haystack = (card.dataset.name + ' ' + card.dataset.desc).toLowerCase();
            var matchSearch = query === '' || haystack.indexOf(query) !== -1;
            var show = matchCategory && matchSearch;
            card.style.display = show ? '' : 'none';
            return show;
        });

        visible.sort(function (a, b) {
            if (sort === 'price-asc') return (+a.dataset.price) - (+b.dataset.price);
            if (sort === 'price-desc') return (+b.dataset.price) - (+a.dataset.price);
            if (sort === 'name-asc') return a.dataset.name.localeCompare(b.dataset.name, 'id');
            return (+a.dataset.id) - (+b.dataset.id);
        });

        visible.forEach(function (card) { grid.appendChild(card); });

        countEl.textContent = visible.length + ' produk ditemukan';
        emptyEl.style.display = visible.length ? 'none' : '';
    }

    searchInput.addEventListener('input', apply);
    sortSelect.addEventListener('change', apply);

    document.getElementById('catalog-pills').addEventListener('click', function (e) {
        var btn = e.target.closest('.catalog-pill');
        if (!btn) return;
        this.querySelectorAll('.catalog-pill').forEach(function (b) { b.classList.remove('active'); });
        btn.classList.add('active');
        activeCategory = btn.dataset.category;
        apply();
    });

    // Modal
    var modal = document.getElementById('product-modal');

    function openModal(id) {
        var p = products[id];
        if (!p) return;
        document.getElementById('pm-title').textContent = p.category || 'Detail Produk';
        document.getElementById('pm-name').textContent = p.name;
        document.getElementById('pm-category').textContent = p.category || '';
        document.getElementById('pm-price').textContent = p.price || '';
        document.getElementById('pm-desc').textContent = p.desc || '';
        document.getElementById('pm-brand').textContent = p.brand ? 'Brand: ' + p.brand : '';
        document.getElementById('pm-level').textContent = p.level || '';
        var img = document.getElementById('pm-image');
        img.src = p.image || '';
        img.alt = p.name;
        document.getElementById('pm-wa').href = 'https://wa.me/' + waNumber +
            '?text=' + encodeURIComponent('Halo LiefMarket, saya ingin memesan: ' + p.name + ' (' + p.price + '). Apakah ready?');
        modal.style.display = 'grid';
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }

    grid.addEventListener('click', function (e) {
        if (e.target.closest('a')) return;
        var card = e.target.closest('.catalog-card');
        if (card) openModal(card.dataset.id);
    });

    document.getElementById('pm-close').addEventListener('click', closeModal);
    modal.addEventListener('click', function (e) { if (e.target === modal) closeModal(); });
    document.addEventListener('keydown', function (e) { if (e.key === 'Escape') closeModal(); });
})();
</script>
@endpush
