@extends('layouts.app')

@section('content')
<div class="clean-page">
    @include('partials.site-nav')

    <main class="clean-main">
        <header class="clean-page-header">
            <p class="clean-eyebrow">KONTAK KAMI</p>
            <h1>Kami Siap Membantu Anda</h1>
            <p>{{ data_get($contact, 'text', 'Hubungi tim kami untuk informasi produk dan pemesanan.') }}</p>
        </header>

        <section class="clean-contact-layout">
            <div class="clean-contact-info" aria-label="Informasi kontak">
                <a class="clean-contact-card" href="https://maps.google.com/?q={{ urlencode(data_get($contact, 'address', '')) }}" target="_blank" rel="noopener">
                    <span class="contact-card-icon" aria-hidden="true">⌖</span><strong>Alamat</strong><span>{{ data_get($contact, 'address', '—') }}</span><small>Lihat di Google Maps →</small>
                </a>
                @if ($whatsapp !== '')
                    <a class="clean-contact-card" href="https://wa.me/{{ preg_replace('/\D/', '', $whatsapp) }}" target="_blank" rel="noopener">
                        <span class="contact-card-icon" aria-hidden="true">◉</span><strong>WhatsApp</strong><span>+{{ $whatsapp }}</span><small>Chat tim LiefMarket →</small>
                    </a>
                @endif
                <a class="clean-contact-card" href="mailto:{{ data_get($contact, 'email', '') }}">
                    <span class="contact-card-icon" aria-hidden="true">✉</span><strong>Email Resmi</strong><span>{{ data_get($contact, 'email', '—') }}</span>
                </a>
                <div class="clean-contact-card contact-hours-card">
                    <span class="contact-card-icon" aria-hidden="true">◷</span><strong>Jam Layanan Operasional</strong><span>{{ data_get($contact, 'hours', '—') }}</span>
                </div>
            </div>

            <form id="wa-form" class="clean-contact-form">
                <h2>{{ data_get($contact, 'formTitle', 'Kirim Pesan') }}</h2>
                <p>{{ data_get($contact, 'formNote', 'Pesan akan diteruskan langsung ke WhatsApp kami.') }}</p>
                <label>Nama<input type="text" name="nama" required autocomplete="name" placeholder="Nama lengkap Anda"></label>
                <label>Nomor WhatsApp<input type="tel" name="wa" required autocomplete="tel" inputmode="tel" maxlength="20" placeholder="08xxxxxxxxxx"></label>
                <label>Pesan<textarea name="pesan" rows="5" required minlength="5" maxlength="1500" placeholder="Apa yang ingin Anda tanyakan?"></textarea></label>
                <button class="clean-button" type="submit">Kirim Pesan via WhatsApp</button>
            </form>
        </section>
    </main>

    @include('partials.site-footer')
</div>
@endsection

@push('scripts')
<script>
    (function () {
        var form = document.getElementById('wa-form');
        var waNumber = @json(preg_replace('/\D/', '', $whatsapp));

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            if (!form.reportValidity() || !waNumber) return;

            var data = new FormData(form);
            var message = 'Halo LiefMarket, saya ingin bertanya.\n\nNama: ' + data.get('nama') +
                '\nWhatsApp: ' + data.get('wa') + '\nPesan: ' + data.get('pesan');
            window.open('https://wa.me/' + waNumber + '?text=' + encodeURIComponent(message), '_blank', 'noopener');
        });
    })();
</script>
@endpush
