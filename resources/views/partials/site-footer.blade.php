@php
    $footer = data_get($content, 'footer', []);
    $brand = data_get($content, 'navbar', []);
    $contact = data_get($content, 'contact', []);
    $whatsapp = preg_replace('/\D/', '', (string) data_get($contact, 'whatsapp', ''));
    $address = data_get($contact, 'address', '');
@endphp

<footer class="deck-section deck-footer site-grand-footer">
    <div class="footer-brand">
        <a href="{{ route('home') }}" class="logo logo-white">
            <span class="brand-lief">{{ data_get($brand, 'brandName', 'LiefMarket') }}</span>
        </a>
        <p class="footer-tagline">{{ data_get($footer, 'tagline', '') }}</p>
        <p class="footer-about">{{ data_get($footer, 'about', '') }}</p>
        <div class="socials">
            @foreach (data_get($footer, 'socialLinks', []) as $social)
                <a href="{{ data_get($social, 'href', '#') }}" aria-label="{{ data_get($social, 'label', 'Sosial media') }}">{{ data_get($social, 'label', '') }}</a>
            @endforeach
        </div>
    </div>

    <div class="footer-links">
        @foreach (data_get($footer, 'columns', []) as $column)
            <div>
                <p class="eyebrow">{{ data_get($column, 'title', '') }}</p>
                @foreach (data_get($column, 'links', []) as $link)
                    <a href="{{ data_get($link, 'href', '#') }}">{{ data_get($link, 'label', '') }}</a>
                @endforeach
            </div>
        @endforeach

        <div class="footer-contact">
            <p class="eyebrow">KONTAK RESMI</p>
            @if ($address)
                <a href="https://maps.google.com/?q={{ urlencode($address) }}" target="_blank" rel="noopener">{{ $address }}</a>
            @endif
            @if ($whatsapp !== '')
                <a href="https://wa.me/{{ $whatsapp }}">WhatsApp +{{ $whatsapp }}</a>
            @endif
            @if (data_get($contact, 'email'))
                <a href="mailto:{{ data_get($contact, 'email') }}">{{ data_get($contact, 'email') }}</a>
            @endif
            @if (data_get($contact, 'hours'))
                <p>{{ data_get($contact, 'hours') }}</p>
            @endif
        </div>
    </div>

    <div class="footer-bottom">
        <span>{{ data_get($footer, 'copyright', '© '.date('Y').' LiefMarket') }}</span>
        <span>{{ data_get($footer, 'tagline', '') }}</span>
    </div>
</footer>
