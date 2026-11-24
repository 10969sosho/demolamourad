@php
    $footer = data_get($content, 'footer', []);
    $brand = data_get($content, 'navbar', []);
    $contact = data_get($content, 'contact', []);
    $whatsapp = preg_replace('/\D/', '', (string) data_get($contact, 'whatsapp', ''));
    $address = data_get($contact, 'address', '');
@endphp

@push('head')
<style>
    /* Complete removal of background watermark */
    footer:before, 
    footer:after, 
    .lief-footer:before, 
    .lief-footer:after {
        display: none !important;
        content: none !important;
    }

    .lief-footer {
        background: #ffffff;
        color: #475569;
        border-top: 1px solid #edf2f7;
        padding: 64px 0 32px;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        position: relative;
        overflow: hidden;
    }
    .lief-footer-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 clamp(20px, 4vw, 48px);
    }
    .lief-footer-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1.4fr;
        gap: clamp(32px, 4vw, 48px);
        margin-bottom: 48px;
    }
    .lief-footer-brand .brand-logo {
        font-size: 24px;
        font-weight: 800;
        color: #5b8fa8;
        text-decoration: none;
        letter-spacing: -0.03em;
        display: inline-block;
        margin-bottom: 14px;
    }
    .lief-footer-brand .brand-logo span {
        color: #0f172a;
        font-weight: 700;
        margin-left: 2px;
    }
    .lief-footer-brand p {
        color: #64748b;
        font-size: 14px;
        line-height: 1.65;
        max-width: 320px;
        margin: 0 0 16px;
    }
    .lief-footer-office {
        font-size: 13px;
        color: #64748b;
        line-height: 1.5;
    }
    .lief-footer-office strong {
        color: #0f172a;
        font-weight: 600;
    }
    .lief-footer-col h4 {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #0f172a;
        margin: 0 0 18px;
    }
    .lief-footer-col ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    .lief-footer-col a {
        color: #64748b;
        font-size: 14px;
        text-decoration: none;
        transition: color 0.15s ease;
    }
    .lief-footer-col a:hover {
        color: #5b8fa8;
    }
    .lief-footer-bottom {
        padding-top: 28px;
        border-top: 1px solid #edf2f7;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13px;
        color: #94a3b8;
    }
    .lief-footer-tagline {
        font-weight: 600;
        letter-spacing: 0.04em;
        color: #64748b;
    }
    @media (max-width: 860px) {
        .lief-footer-grid {
            grid-template-columns: 1fr 1fr;
            gap: 32px;
        }
        .lief-footer-bottom {
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }
    }
    @media (max-width: 520px) {
        .lief-footer-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

<footer class="lief-footer">
    <div class="lief-footer-inner">
        <div class="lief-footer-grid">
            <div class="lief-footer-brand">
                <a href="/" class="brand-logo">LIEF<span>Market</span></a>
                <p>{{ data_get($footer, 'about') ?: 'Solusi terpercaya produk perawatan kecantikan, kesehatan herbal, dan kebutuhan harian keluarga Indonesia.' }}</p>
                <div class="lief-footer-office">
                    <strong>Office / Hub:</strong><br>
                    {{ $address ?: 'Jl. Raya Gubeng No. 123, Surabaya, Jawa Timur' }}
                </div>
            </div>

            <div class="lief-footer-col">
                <h4>Belanja</h4>
                <ul>
                    <li><a href="/products">Semua Produk</a></li>
                    <li><a href="/products?category=SKINCARE">Perawatan Wajah</a></li>
                    <li><a href="/products?category=BODY+CARE">Perawatan Tubuh</a></li>
                    <li><a href="/products?category=KESEHATAN">Herbal & Kesehatan</a></li>
                    <li><a href="/products?category=KOSMETIK">Kosmetik Pilihan</a></li>
                </ul>
            </div>

            <div class="lief-footer-col">
                <h4>Bantuan</h4>
                <ul>
                    <li><a href="/about">Tentang LiefMarket</a></li>
                    <li><a href="/articles">Artikel & Tips</a></li>
                    <li><a href="/contact">Hubungi Kami</a></li>
                    <li><a href="/faq">FAQ & Pengiriman</a></li>
                </ul>
            </div>

            <div class="lief-footer-col">
                <h4>Official Contact</h4>
                <ul>
                    @if ($whatsapp !== '')
                        <li><a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener">WhatsApp: +{{ $whatsapp }}</a></li>
                    @endif
                    @if (data_get($contact, 'email'))
                        <li><a href="mailto:{{ data_get($contact, 'email') }}">{{ data_get($contact, 'email') }}</a></li>
                    @endif
                    <li><span style="color: #64748b; font-size: 13px;">Buka: Senin - Sabtu (08.00 - 17.00 WIB)</span></li>
                </ul>
            </div>
        </div>

        <div class="lief-footer-bottom">
            <span>{{ data_get($footer, 'copyright') ?: '© '.date('Y').' LIEFMARKET INDONESIA. ALL RIGHTS RESERVED.' }}</span>
            <span class="lief-footer-tagline">GOOD THINGS FOR YOUR EVERYDAY</span>
        </div>
    </div>
</footer>
