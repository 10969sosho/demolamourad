'use client';

import { useEffect, useState } from 'react';
import type { SiteContent } from '../../lib/content';
import { defaultContent } from '../../lib/content';

const clone = <T,>(v: T): T => JSON.parse(JSON.stringify(v));

const themeFields: { key: keyof SiteContent['theme']; label: string }[] = [
  { key: 'primaryColor', label: 'Warna Utama' },
  { key: 'secondaryColor', label: 'Warna Sekunder' },
  { key: 'accentColor', label: 'Warna Aksen' },
  { key: 'bgColor', label: 'Background' },
  { key: 'textColor', label: 'Teks' },
  { key: 'navbarBg', label: 'Background Navbar' },
];

const emptyProduct = {
  name: 'Produk Baru',
  tag: 'TAG BARU',
  category: 'SKINCARE',
  time: 'Merek',
  level: 'Level',
  desc: 'Deskripsi produk.',
  image: '/images/lamourad-32/70.webp',
  color: '#7f8ca6',
  price: 'Rp 0',
  link: '/products',
};

export default function Admin() {
  const [pin, setPin] = useState('');
  const [authed, setAuthed] = useState(false);
  const [content, setContent] = useState<SiteContent>(clone(defaultContent));
  const [dirty, setDirty] = useState(false);
  const [toast, setToast] = useState('');
  const [tab, setTab] = useState('theme');

  useEffect(() => {
    fetch('/api/content')
      .then((r) => r.json())
      .then((c) => setContent(c))
      .catch(() => {});
  }, []);

  useEffect(() => {
    if (!toast) return;
    const t = setTimeout(() => setToast(''), 2600);
    return () => clearTimeout(t);
  }, [toast]);

  const patch = (fn: (c: SiteContent) => SiteContent) => {
    setContent((c) => fn(clone(c)));
    setDirty(true);
  };
  const upd = <K extends keyof SiteContent>(key: K, value: SiteContent[K]) =>
    patch((c) => ({ ...c, [key]: value }));

  const save = async () => {
    const res = await fetch('/api/content', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'x-pin': pin },
      body: JSON.stringify(content),
    });
    if (res.ok) {
      setDirty(false);
      setToast('✓ Perubahan tersimpan & live');
    } else {
      setToast('✕ Gagal menyimpan — PIN salah atau server error');
    }
  };

  const reset = () => {
    setContent(clone(defaultContent));
    setDirty(true);
    setToast('Konten direset ke default (belum disimpan)');
  };

  if (!authed) {
    return (
      <main className="admin-login">
        <div className="admin-login-card">
          <p className="eyebrow">LAMOURAD STUDIO CMS</p>
          <h1>Masuk Admin</h1>
          <p>Masukkan PIN untuk mengelola konten website.</p>
          <input
            type="password"
            inputMode="numeric"
            placeholder="PIN Akses"
            value={pin}
            onChange={(e) => setPin(e.target.value)}
            onKeyDown={(e) => e.key === 'Enter' && setAuthed(true)}
          />
          <button onClick={() => setAuthed(true)}>MASUK →</button>
          <a href="/">← Kembali ke website</a>
          {toast && <div className="admin-toast">{toast}</div>}
        </div>
      </main>
    );
  }

  return (
    <main className="admin-page">
      <aside className="admin-sidebar">
        <a href="/" className="logo logo-white">
          <span className="brand-lief">{content.navbar.brandName}</span>
          <span className="brand-market">{content.navbar.brandSub}</span>
        </a>
        <p className="admin-eyebrow">CONTENT MANAGEMENT</p>
        {[
          ['theme', '◈', 'Tema & Warna'],
          ['navbar', '⌂', 'Menu Navbar'],
          ['hero', '▣', 'Hero & Teks'],
          ['products', '◇', 'Produk'],
          ['footer', '▤', 'Footer'],
        ].map(([id, icon, label]) => (
          <a
            className={tab === id ? 'admin-nav active' : 'admin-nav'}
            href={'#' + id}
            key={id}
            onClick={(e) => {
              e.preventDefault();
              setTab(id);
              document.getElementById('sec-' + id)?.scrollIntoView({ behavior: 'smooth' });
            }}
          >
            <span>{icon}</span>
            {label}
          </a>
        ))}
        <a href="/" target="_blank" className="back-site">↗ Lihat website live</a>
      </aside>

      <section className="admin-main">
        <div className="admin-top">
          <div>
            <p className="eyebrow">CMS / SEMUA KONTEN</p>
            <h1>Kelola Website</h1>
          </div>
          <div className="admin-user">
            <span>Admin Lamourad</span>
            <i>AL</i>
          </div>
        </div>

        <div className="admin-banner">
          <div>
            <p className="eyebrow">STATUS WEBSITE</p>
            <h3>{dirty ? 'Ada perubahan belum disimpan' : 'Website sedang tayang'}</h3>
            <p>Simpan untuk memperbarui website secara real-time tanpa rebuild.</p>
          </div>
          <span className="live-pill">● LIVE</span>
        </div>

        {/* THEME */}
        <div className="editor-card" id="sec-theme">
          <div className="editor-head">
            <div>
              <p className="eyebrow">01 / TEMA</p>
              <h2>Warna Tema</h2>
            </div>
          </div>
          <div className="color-grid">
            {themeFields.map((f) => (
              <label key={f.key} className="color-field">
                {f.label}
                <span>
                  <input
                    type="color"
                    value={content.theme[f.key]}
                    onChange={(e) => upd('theme', { ...content.theme, [f.key]: e.target.value })}
                  />
                  {content.theme[f.key]}
                </span>
              </label>
            ))}
          </div>
        </div>

        {/* NAVBAR */}
        <div className="editor-card" id="sec-navbar">
          <div className="editor-head">
            <div>
              <p className="eyebrow">02 / NAVBAR</p>
              <h2>Brand & Menu</h2>
            </div>
          </div>
          <div className="field-row">
            <label>
              Nama Brand
              <input value={content.navbar.brandName} onChange={(e) => upd('navbar', { ...content.navbar, brandName: e.target.value })} />
            </label>
            <label>
              Nama Brand (lanjutan)
              <input value={content.navbar.brandSub} onChange={(e) => upd('navbar', { ...content.navbar, brandSub: e.target.value })} />
            </label>
          </div>
          <p className="list-label">Menu Navbar</p>
          {content.navbar.links.map((link, i) => (
            <div className="list-row" key={i}>
              <input
                value={link.label}
                placeholder="Label"
                onChange={(e) =>
                  patch((c) => {
                    c.navbar.links[i] = { ...c.navbar.links[i], label: e.target.value };
                    return c;
                  })
                }
              />
              <input
                value={link.href}
                placeholder="/halaman"
                onChange={(e) =>
                  patch((c) => {
                    c.navbar.links[i] = { ...c.navbar.links[i], href: e.target.value };
                    return c;
                  })
                }
              />
              <button
                className="btn-icon"
                onClick={() =>
                  patch((c) => {
                    c.navbar.links.splice(i, 1);
                    return c;
                  })
                }
              >
                ✕
              </button>
            </div>
          ))}
          <button
            className="btn-add"
            onClick={() =>
              patch((c) => {
                c.navbar.links.push({ label: 'Menu Baru', href: '/' });
                return c;
              })
            }
          >
            + Tambah Menu
          </button>
        </div>

        {/* HERO & TEKS */}
        <div className="editor-card" id="sec-hero">
          <div className="editor-head">
            <div>
              <p className="eyebrow">03 / HERO & TEKS</p>
              <h2>Hero, Intro & CTA</h2>
            </div>
          </div>
          <label>
            Judul Hero (baris baru = enter)
            <textarea value={content.hero.title} onChange={(e) => upd('hero', { ...content.hero, title: e.target.value })} />
          </label>
          <label>
            Deskripsi Hero
            <textarea value={content.hero.description} onChange={(e) => upd('hero', { ...content.hero, description: e.target.value })} />
          </label>
          <div className="field-row">
            <label>
              Teks Tombol Utama
              <input value={content.hero.primaryBtnText} onChange={(e) => upd('hero', { ...content.hero, primaryBtnText: e.target.value })} />
            </label>
            <label>
              Link Tombol Utama
              <input value={content.hero.primaryBtnLink} onChange={(e) => upd('hero', { ...content.hero, primaryBtnLink: e.target.value })} />
            </label>
            <label>
              Teks Tombol Kedua
              <input value={content.hero.secondaryBtnText} onChange={(e) => upd('hero', { ...content.hero, secondaryBtnText: e.target.value })} />
            </label>
            <label>
              Link Tombol Kedua
              <input value={content.hero.secondaryBtnLink} onChange={(e) => upd('hero', { ...content.hero, secondaryBtnLink: e.target.value })} />
            </label>
          </div>
          <label>
            URL Gambar Hero
            <input value={content.hero.bgImage} onChange={(e) => upd('hero', { ...content.hero, bgImage: e.target.value })} />
          </label>
          <label>
            Judul Intro
            <textarea value={content.intro.title} onChange={(e) => upd('intro', { ...content.intro, title: e.target.value })} />
          </label>
          <label>
            Subjudul Intro
            <textarea value={content.intro.subtitle} onChange={(e) => upd('intro', { ...content.intro, subtitle: e.target.value })} />
          </label>
          <p className="list-label">Statistik Intro</p>
          {content.intro.items.map((item, i) => (
            <div className="list-row" key={i}>
              <input
                value={item.value}
                onChange={(e) =>
                  patch((c) => {
                    c.intro.items[i] = { ...c.intro.items[i], value: e.target.value };
                    return c;
                  })
                }
              />
              <input
                value={item.label}
                onChange={(e) =>
                  patch((c) => {
                    c.intro.items[i] = { ...c.intro.items[i], label: e.target.value };
                    return c;
                  })
                }
              />
              <button
                className="btn-icon"
                onClick={() =>
                  patch((c) => {
                    c.intro.items.splice(i, 1);
                    return c;
                  })
                }
              >
                ✕
              </button>
            </div>
          ))}
          <label>
            Judul CTA / Wellness Club
            <textarea value={content.cta.title} onChange={(e) => upd('cta', { ...content.cta, title: e.target.value })} />
          </label>
          <label>
            Deskripsi CTA
            <textarea value={content.cta.desc} onChange={(e) => upd('cta', { ...content.cta, desc: e.target.value })} />
          </label>
          <div className="field-row">
            <label>
              Teks Tombol CTA
              <input value={content.cta.btnText} onChange={(e) => upd('cta', { ...content.cta, btnText: e.target.value })} />
            </label>
            <label>
              Link Tombol CTA
              <input value={content.cta.btnLink} onChange={(e) => upd('cta', { ...content.cta, btnLink: e.target.value })} />
            </label>
          </div>
        </div>

        {/* PRODUCTS */}
        <div className="editor-card" id="sec-products">
          <div className="editor-head">
            <div>
              <p className="eyebrow">04 / PRODUK</p>
              <h2>Katalog Produk ({content.products.length})</h2>
            </div>
          </div>
          {content.products.map((p, i) => (
            <div className="product-editor" key={i}>
              <div className="product-editor-head">
                <strong>{p.name || 'Produk #' + (i + 1)}</strong>
                <button
                  className="btn-icon"
                  onClick={() =>
                    patch((c) => {
                      c.products.splice(i, 1);
                      return c;
                    })
                  }
                >
                  ✕ Hapus
                </button>
              </div>
              <div className="field-row">
                <label>
                  Nama
                  <input value={p.name} onChange={(e) => patch((c) => { c.products[i].name = e.target.value; return c; })} />
                </label>
                <label>
                  Tag
                  <input value={p.tag} onChange={(e) => patch((c) => { c.products[i].tag = e.target.value; return c; })} />
                </label>
                <label>
                  Kategori
                  <input value={p.category} onChange={(e) => patch((c) => { c.products[i].category = e.target.value; return c; })} />
                </label>
              </div>
              <div className="field-row">
                <label>
                  Merek
                  <input value={p.time} onChange={(e) => patch((c) => { c.products[i].time = e.target.value; return c; })} />
                </label>
                <label>
                  Level
                  <input value={p.level} onChange={(e) => patch((c) => { c.products[i].level = e.target.value; return c; })} />
                </label>
                <label>
                  Harga
                  <input value={p.price} onChange={(e) => patch((c) => { c.products[i].price = e.target.value; return c; })} />
                </label>
                <label>
                  Warna
                  <span className="color-inline">
                    <input type="color" value={p.color} onChange={(e) => patch((c) => { c.products[i].color = e.target.value; return c; })} />
                    {p.color}
                  </span>
                </label>
              </div>
              <label>
                Deskripsi
                <textarea value={p.desc} onChange={(e) => patch((c) => { c.products[i].desc = e.target.value; return c; })} />
              </label>
              <div className="field-row">
                <label>
                  URL Gambar
                  <input value={p.image} onChange={(e) => patch((c) => { c.products[i].image = e.target.value; return c; })} />
                </label>
                <label>
                  Link Produk
                  <input value={p.link} onChange={(e) => patch((c) => { c.products[i].link = e.target.value; return c; })} />
                </label>
              </div>
            </div>
          ))}
          <button
            className="btn-add"
            onClick={() =>
              patch((c) => {
                c.products.push(clone(emptyProduct));
                return c;
              })
            }
          >
            + Tambah Produk
          </button>
        </div>

        {/* FOOTER */}
        <div className="editor-card" id="sec-footer">
          <div className="editor-head">
            <div>
              <p className="eyebrow">05 / FOOTER</p>
              <h2>Teks Footer</h2>
            </div>
          </div>
          <label>
            Tentang / About
            <textarea value={content.footer.about} onChange={(e) => upd('footer', { ...content.footer, about: e.target.value })} />
          </label>
          <label>
            Copyright
            <input value={content.footer.copyright} onChange={(e) => upd('footer', { ...content.footer, copyright: e.target.value })} />
          </label>
          <p className="list-label">Social Media</p>
          {content.footer.socialLinks.map((s, i) => (
            <div className="list-row" key={i}>
              <input
                value={s.label}
                onChange={(e) =>
                  patch((c) => {
                    c.footer.socialLinks[i] = { ...c.footer.socialLinks[i], label: e.target.value };
                    return c;
                  })
                }
              />
              <input
                value={s.href}
                onChange={(e) =>
                  patch((c) => {
                    c.footer.socialLinks[i] = { ...c.footer.socialLinks[i], href: e.target.value };
                    return c;
                  })
                }
              />
              <button
                className="btn-icon"
                onClick={() =>
                  patch((c) => {
                    c.footer.socialLinks.splice(i, 1);
                    return c;
                  })
                }
              >
                ✕
              </button>
            </div>
          ))}
          <button
            className="btn-add"
            onClick={() =>
              patch((c) => {
                c.footer.socialLinks.push({ label: 'ig', href: '#' });
                return c;
              })
            }
          >
            + Tambah Social
          </button>
          {content.footer.columns.map((col, ci) => (
            <div key={ci}>
              <p className="list-label">Kolom: {col.title}</p>
              <input
                className="col-title"
                value={col.title}
                onChange={(e) => patch((c) => { c.footer.columns[ci].title = e.target.value; return c; })}
              />
              {col.links.map((l, li) => (
                <div className="list-row" key={li}>
                  <input
                    value={l.label}
                    onChange={(e) => patch((c) => { c.footer.columns[ci].links[li] = { ...l, label: e.target.value }; return c; })}
                  />
                  <input
                    value={l.href}
                    onChange={(e) => patch((c) => { c.footer.columns[ci].links[li] = { ...l, href: e.target.value }; return c; })}
                  />
                  <button
                    className="btn-icon"
                    onClick={() =>
                      patch((c) => {
                        c.footer.columns[ci].links.splice(li, 1);
                        return c;
                      })
                    }
                  >
                    ✕
                  </button>
                </div>
              ))}
              <button
                className="btn-add"
                onClick={() =>
                  patch((c) => {
                    c.footer.columns[ci].links.push({ label: 'Link Baru', href: '/' });
                    return c;
                  })
                }
              >
                + Tambah Link
              </button>
            </div>
          ))}
        </div>

        <div className="admin-actions">
          <span>{dirty ? 'Ada perubahan yang belum disimpan' : '✓ Semua perubahan tersimpan'}</span>
          <div className="admin-actions-buttons">
            <button className="btn-ghost" onClick={reset}>RESET KE DEFAULT</button>
            <a className="btn-ghost" href="/" target="_blank">LIHAT WEBSITE ↗</a>
            <button onClick={save}>SIMPAN PERUBAHAN <span>→</span></button>
          </div>
        </div>
      </section>

      {toast && <div className="admin-toast">{toast}</div>}
    </main>
  );
}
