@extends('layouts.app')

@section('content')
<main class="inner-page contact-page" style="--page-color: #333735">
    @include('partials.site-nav')

    <section class="inner-hero">
        <div>
            <p class="eyebrow">{{ $contact['eyebrow'] ?? 'KONTAK KAMI' }} ✦</p>
            <h1>{!! nl2br(e($contact['title'] ?? 'Kami siap membantu Anda.')) !!}</h1>
            <p>{{ $contact['text'] ?? '' }}</p>
        </div>
        <div class="inner-image">
            <img src="{{ $contact['heroImage'] ?? '/images/liefmarket-32/2.webp' }}" alt="Kontak LiefMarket">
        </div>
    </section>

    <section class="contact-section">
        <div class="contact-cards">
            <a class="contact-card" href="https://maps.google.com/?q={{ urlencode($contact['address'] ?? '') }}" target="_blank" rel="noopener">
                <span class="contact-card-icon">⌂</span>
                <h3>Alamat</h3>
                <p>{{ $contact['address'] ?? '—' }}</p>
            </a>
            <a class="contact-card" href="https://wa.me/{{ preg_replace('/\D/', '', $whatsapp) }}?text={{ rawurlencode('Halo LiefMarket, saya ingin bertanya.') }}" target="_blank" rel="noopener">
                <span class="contact-card-icon">☎</span>
                <h3>WhatsApp CS</h3>
                <p>+{{ $whatsapp }}</p>
                <span class="contact-card-hint">Klik untuk chat langsung →</span>
            </a>
            <a class="contact-card" href="mailto:{{ $contact['email'] ?? '' }}">
                <span class="contact-card-icon">✉</span>
                <h3>Email</h3>
                <p>{{ $contact['email'] ?? '—' }}</p>
            </a>
            <div class="contact-card">
                <span class="contact-card-icon">◷</span>
                <h3>Jam Operasional</h3>
                <p>{{ $contact['hours'] ?? '—' }}</p>
            </div>
        </div>

        <div class="contact-main">
            <div class="contact-form-wrap">
                <p class="eyebrow">KIRIM PESAN ✦</p>
                <h2>{{ $contact['formTitle'] ?? 'Kirim Pesan' }}</h2>
                <p class="contact-form-note">{{ $contact['formNote'] ?? '' }}</p>

                <form id="wa-form" class="contact-form" novalidate>
                    <div class="form-row">
                        <label>
                            Nama
                            <input type="text" name="nama" required placeholder="Nama lengkap Anda">
                        </label>
                        <label>
                            WhatsApp
                            <input type="text" name="wa" required placeholder="08xxxxxxxxxx">
                        </label>
                    </div>
                    <label>
                        Subjek
                        <input type="text" name="subjek" required placeholder="Contoh: Tanya stok produk">
                    </label>
                    <label>
                        Pesan
                        <textarea name="pesan" rows="5" required placeholder="Tulis pesan Anda…"></textarea>
                    </label>
                    <p class="form-error" id="wa-form-error" style="display: none">Mohon lengkapi semua kolom terlebih dahulu.</p>
                    <button type="submit" class="wa-button wa-button-lg">Kirim Pesan via WhatsApp</button>
                </form>
            </div>

            <div class="contact-faq">
                <p class="eyebrow">FAQ ✦</p>
                <h2>{{ $contact['faqTitle'] ?? 'Pertanyaan Umum' }}</h2>
                @foreach (($contact['faq'] ?? []) as $item)
                    <details class="faq-item">
                        <summary>{{ $item['q'] }}<span aria-hidden>+</span></summary>
                        <p>{{ $item['a'] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    <footer class="inner-footer">
        <p class="eyebrow">Butuh produk?</p>
        <h2>Jelajahi katalog<br><em>kami sekarang.</em></h2>
        <a class="dark-button" href="/products">LIHAT PRODUK <span aria-hidden>→</span></a>
    </footer>
</main>
@endsection

@push('scripts')
<script>
(function () {
    var waNumber = @json(preg_replace('/\D/', '', $whatsapp));
    var form = document.getElementById('wa-form');
    var errorEl = document.getElementById('wa-form-error');

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        var data = new FormData(form);
        var nama = (data.get('nama') || '').toString().trim();
        var wa = (data.get('wa') || '').toString().trim();
        var subjek = (data.get('subjek') || '').toString().trim();
        var pesan = (data.get('pesan') || '').toString().trim();

        if (!nama || !wa || !subjek || !pesan) {
            errorEl.style.display = '';
            return;
        }
        errorEl.style.display = 'none';

        var text = 'Halo LiefMarket, saya ingin mengirim pesan.%0A%0A' +
            '*Nama:* ' + encodeURIComponent(nama) + '%0A' +
            '*WhatsApp:* ' + encodeURIComponent(wa) + '%0A' +
            '*Subjek:* ' + encodeURIComponent(subjek) + '%0A' +
            '*Pesan:*%0A' + encodeURIComponent(pesan);

        window.open('https://wa.me/' + waNumber + '?text=' + text, '_blank', 'noopener');
    });
})();
</script>
@endpush
