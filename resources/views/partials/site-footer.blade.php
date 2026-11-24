@php
    $footer = data_get($content, 'footer', []);
    $brand = data_get($content, 'navbar', []);
    $contact = data_get($content, 'contact', []);
    $whatsapp = '6282342143876';
    $shopeeUrl = 'https://s.shopee.co.id/gRsyUWuFe';
    $tiktokUrl = 'https://vt.tiktok.com/ZS9P5oKrj9pX7-Ujjty/';
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
        width: 100%;
        background: #ffffff;
        color: #475569;
        border-top: 1px solid #edf2f7;
        padding: 72px 0 36px;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        position: relative;
        overflow: hidden;
    }
    .lief-footer-inner {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0 clamp(24px, 5vw, 80px);
        box-sizing: border-box;
    }
    .lief-footer-grid {
        display: grid;
        grid-template-columns: 2.2fr 1fr 1fr 1.6fr;
        gap: clamp(32px, 4vw, 64px);
        margin-bottom: 56px;
    }
    .lief-footer-brand .brand-logo {
        display: inline-flex;
        align-items: baseline;
        font-size: 28px;
        font-weight: 800;
        letter-spacing: -0.04em;
        text-decoration: none;
        line-height: 1;
        margin-bottom: 16px;
    }
    .lief-footer-brand .brand-logo .logo-lief {
        color: #a9d2c4;
        font-weight: 800;
    }
    .lief-footer-brand .brand-logo .logo-market {
        color: #555555;
        font-weight: 800;
        margin-left: 1px;
    }
    .lief-footer-brand p {
        color: #64748b;
        font-size: 14px;
        line-height: 1.65;
        max-width: 380px;
        margin: 0 0 20px;
    }
    .lief-footer-office {
        font-size: 13px;
        color: #64748b;
        line-height: 1.6;
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
        color: #555555;
    }

    /* Social / Channel buttons in Footer */
    .lief-footer-socials {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 14px;
    }
    .footer-channel-link {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 10px;
        border: 1px solid #edf2f7;
        background: #f8fafc;
        color: #1e293b !important;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .footer-channel-link:hover {
        background: #ffffff;
        border-color: #cbd5e1;
        transform: translateX(3px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
    }
    .footer-channel-link svg {
        flex-shrink: 0;
    }

    .lief-footer-bottom {
        padding-top: 32px;
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
    @media (max-width: 960px) {
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
    @media (max-width: 580px) {
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
                <a href="/" class="brand-logo">
                    <span class="logo-lief">lief</span><span class="logo-market">market</span>
                </a>
                <p>{{ data_get($footer, 'about') ?: 'Solusi terpercaya produk perawatan kecantikan, kesehatan herbal, dan kebutuhan harian keluarga Indonesia.' }}</p>
                <div class="lief-footer-office">
                    <strong>Office / Hub:</strong><br>
                    Jl. Raya Gubeng No. 123, Surabaya, Jawa Timur
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
                    <li><a href="/about">Tentang liefmarket</a></li>
                    <li><a href="/articles">Artikel & Tips</a></li>
                    <li><a href="/contact">Hubungi Kami</a></li>
                    <li><a href="/faq">FAQ & Pengiriman</a></li>
                </ul>
            </div>

            <div class="lief-footer-col">
                <h4>Official Stores & Contact</h4>
                <div class="lief-footer-socials">
                    <a href="{{ $shopeeUrl }}" target="_blank" rel="noopener" class="footer-channel-link">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="#ee4d2d"><path d="M19.5 7.05h-2.17c-.36-2.91-2.4-4.8-5.33-4.8s-4.97 1.89-5.33 4.8H4.5c-.83 0-1.5.67-1.5 1.5l1.09 11.96C4.16 21.36 4.99 22 6 22h12c1.01 0 1.84-.64 1.91-1.69L21 8.55c0-.83-.67-1.5-1.5-1.5zm-7.5-3.3c1.97 0 3.48 1.25 3.82 3.3H8.18c.34-2.05 1.85-3.3 3.82-3.3zm6.5 16.75H5.5L4.55 8.55h14.9l-.95 11.95zM12 11.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"/></svg>
                        <span>Shopee: liefmarket Official</span>
                    </a>
                    <a href="{{ $tiktokUrl }}" target="_blank" rel="noopener" class="footer-channel-link">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="#0f172a"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64c.29 0 .58.04.86.12V9.42a6.34 6.34 0 0 0-.86-.06 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.34-6.34V7.93a8.28 8.28 0 0 0 4.84 1.57v-3.4c-.38.01-.73-.2-1.07-.41z"/></svg>
                        <span>TikTok: @liefmarket</span>
                    </a>
                    <a href="https://wa.me/{{ $whatsapp }}" target="_blank" rel="noopener" class="footer-channel-link">
                        <svg viewBox="0 0 24 24" width="18" height="18" fill="#16a34a"><path d="M20.5 3.5A11.8 11.8 0 0 0 12.1 0C5.6 0 .3 5.3.3 11.8c0 2.1.6 4.2 1.7 6L0 24l6.4-1.7a11.8 11.8 0 0 0 5.7 1.5h.1c6.5 0 11.8-5.3 11.8-11.8 0-3.2-1.2-6.2-3.5-8.5ZM12.1 21.8a9.9 9.9 0 0 1-5-1.4l-.4-.2-3.8 1 1-3.7-.3-.4a9.8 9.8 0 0 1-1.5-5.3c0-5.5 4.5-10 10-10 2.7 0 5.2 1 7.1 2.9a9.9 9.9 0 0 1 2.9 7.1c0 5.5-4.5 10-10 10Zm5.5-7.5c-.3-.2-1.7-.9-2-.9-.3-.1-.5-.2-.7.2-.2.3-.8 1-1 1.2-.2.2-.4.2-.7.1-.3-.2-1.2-.4-2.3-1.4-.9-.8-1.5-1.7-1.7-2-.2-.3 0-.5.1-.6l.5-.6c.2-.2.2-.3.3-.5.1-.2 0-.4 0-.5 0-.2-.7-1.6-1-2.1-.2-.5-.5-.4-.7-.4h-.6c-.2 0-.5.1-.8.4-.3.3-1 1-.9 2.4 0 1.4 1 2.7 1.1 2.9.2.2 2 3.1 4.8 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.7-.7 1.9-1.3.2-.6.2-1.1.2-1.2-.1-.3-.3-.4-.6-.6Z"/></svg>
                        <span>WhatsApp: 082342143876</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="lief-footer-bottom">
            <span>{{ data_get($footer, 'copyright') ?: '© '.date('Y').' liefmarket indonesia. all rights reserved.' }}</span>
            <span class="lief-footer-tagline">GOOD THINGS FOR YOUR EVERYDAY</span>
        </div>
    </div>
</footer>
