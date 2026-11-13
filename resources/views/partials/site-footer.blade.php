@php
    $footer = data_get($content, 'footer', []);
    $brand = data_get($content, 'navbar', []);
    $contact = data_get($content, 'contact', []);
    $whatsapp = preg_replace('/\D/', '', (string) data_get($contact, 'whatsapp', ''));
    $address = data_get($contact, 'address', '');
@endphp

@push('head')
<style>
    .lief-footer {
        background: #f7f9fc;
        color: #4a5568;
        border-top: 1px solid #eef1f6;
        padding: 72px 0 36px;
        font-family: 'Inter', sans-serif;
    }
    .lief-footer-inner {
        max-width: 1360px;
        margin: 0 auto;
        padding: 0 clamp(20px, 4vw, 48px);
    }
    .lief-footer-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1.5fr;
        gap: 48px;
        margin-bottom: 56px;
    }
    .lief-footer-brand .brand-logo {
        font-size: 24px;
        font-weight: 800;
        color: #5b8fa8;
        text-decoration: none;
        letter-spacing: -0.5px;
        display: inline-block;
        margin-bottom: 16px;
    }
    .lief-footer-brand .brand-logo span {
        color: #1a1f2c;
    }
    .lief-footer-brand p {
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
        max-width: 340px;
        margin: 0 0 20px;
    }
    .lief-footer-col h4 {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #1a1f2c;
        margin: 0 0 20px;
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
        transition: color 0.15s;
    }
    .lief-footer-col a:hover {
        color: #5b8fa8;
    }
    .lief-footer-bottom {
        padding-top: 32px;
        border-top: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 13px;
        color: #94a3b8;
    }
    @media (max-width: 860px) {
        .lief-footer-grid {
            grid-template-columns: 1fr 1fr;
            gap: 36px;
        }
        .lief-footer-bottom {
            flex-direction: column;
            gap: 12px;
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
                <p>{{ data_get($footer, 'about') ?: 'Kurasi produk perawatan diri, kesehatan herbal, dan kebutuhan harian keluarga berkualitas tinggi 100% original berizin resmi BPOM.' }}</p>
                <div style="font-size: 13px; color: #64748b;">
                    <strong>Office / Hub:</strong><br>
                    {{ $address ?: 'Surabaya, Jawa Timur, Indonesia' }}
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
                    <li><span style="color: #64748b; font-size: 14px;">Buka: Senin - Sabtu (08.00 - 17.00 WIB)</span></li>
                </ul>
            </div>
        </div>

        <div class="lief-footer-bottom">
            <span>{{ data_get($footer, 'copyright') ?: '© '.date('Y').' LiefMarket Indonesia. All Rights Reserved.' }}</span>
            <span>GOOD THINGS FOR YOUR EVERYDAY</span>
        </div>
    </div>
</footer>
