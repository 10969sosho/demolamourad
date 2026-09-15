'use client';

import { useState } from 'react';

const initial = {
  heroTitle: 'Perawatan Terbaik Keluarga Anda.',
  heroDescription: 'Menghadirkan produk perawatan diri, kosmetik berkualitas, dan herbal alami nusantara 100% original dan bersertifikasi resmi BPOM.',
  introTitle: 'Pilihan terlengkap, aman & terpercaya.',
  classTitle: 'Rawat diri, percaya diri.',
  newsletter: 'Promo eksklusif dan tips perawatan kulit, langsung ke inbox kamu.'
};

export default function Admin() {
  const [content, setContent] = useState(initial);
  const [saved, setSaved] = useState(false);
  const update = (key: string, value: string) => setContent({ ...content, [key]: value });

  return (
    <main className="admin-page">
      <aside className="admin-sidebar">
        <a href="/" className="logo logo-white">
          <i>L</i>
          <span>LIEFMARKET<small>STUDIO CMS</small></span>
        </a>
        <p className="admin-eyebrow">CONTENT MANAGEMENT</p>
        {['Overview', 'Homepage', 'Products', 'Catalog', 'Articles', 'Settings'].map((item, i) => (
          <a className={i === 1 ? 'admin-nav active' : 'admin-nav'} href="#" key={item}>
            <span>{['◈', '⌂', '▣', '◇', '▤', '⚙'][i]}</span>{item}
          </a>
        ))}
        <a href="/" className="back-site">← Lihat website</a>
      </aside>

      <section className="admin-main">
        <div className="admin-top">
          <div>
            <p className="eyebrow">PAGES / HOMEPAGE</p>
            <h1>Homepage</h1>
          </div>
          <div className="admin-user">
            <span>Admin LiefMarket</span>
            <i>AL</i>
          </div>
        </div>

        <div className="admin-banner">
          <div>
            <p className="eyebrow">STATUS WEBSITE</p>
            <h3>Website sedang tayang</h3>
            <p>Perubahan konten akan tampil setelah dipublikasikan.</p>
          </div>
          <span className="live-pill">● LIVE</span>
        </div>

        <div className="admin-grid">
          <div className="editor-card">
            <div className="editor-head">
              <div>
                <p className="eyebrow">01 / HERO SECTION</p>
                <h2>Hero utama</h2>
              </div>
              <span>⌃</span>
            </div>
            <label>
              Judul hero
              <textarea value={content.heroTitle} onChange={e => update('heroTitle', e.target.value)} />
            </label>
            <label>
              Deskripsi
              <textarea value={content.heroDescription} onChange={e => update('heroDescription', e.target.value)} />
            </label>
            <label>
              Gambar hero
              <div className="upload-box">
                <div>＋</div>
                <span>Ganti gambar<br /><small>JPG, PNG, WEBP max. 5MB</small></span>
                <img src="/images/liefmarket-32/70.webp" alt="Preview" />
              </div>
            </label>
          </div>

          <div className="editor-card">
            <div className="editor-head">
              <div>
                <p className="eyebrow">02 / INTRODUCTION</p>
                <h2>Perkenalan</h2>
              </div>
              <span>⌃</span>
            </div>
            <label>
              Judul section
              <textarea value={content.introTitle} onChange={e => update('introTitle', e.target.value)} />
            </label>
            <div className="mini-preview">
              <span>PREVIEW</span>
              <strong>{content.introTitle}</strong>
            </div>
          </div>

          <div className="editor-card">
            <div className="editor-head">
              <div>
                <p className="eyebrow">03 / WELLNESS CLUB</p>
                <h2>Wellness Club</h2>
              </div>
              <span>⌃</span>
            </div>
            <label>
              Judul section
              <textarea value={content.classTitle} onChange={e => update('classTitle', e.target.value)} />
            </label>
          </div>

          <div className="editor-card">
            <div className="editor-head">
              <div>
                <p className="eyebrow">04 / NEWSLETTER</p>
                <h2>Newsletter</h2>
              </div>
              <span>⌃</span>
            </div>
            <label>
              Deskripsi
              <textarea value={content.newsletter} onChange={e => update('newsletter', e.target.value)} />
            </label>
          </div>
        </div>

        <div className="admin-actions">
          <span>{saved ? '✓ Semua perubahan tersimpan' : 'Ada perubahan yang belum disimpan'}</span>
          <button onClick={() => setSaved(true)}>SIMPAN PERUBAHAN <span>→</span></button>
        </div>
      </section>
    </main>
  );
}
