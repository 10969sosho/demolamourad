'use client';

import { useEffect, useState } from 'react';
import type { Article, NavLink, Product, SiteContent } from '../../lib/content';
import { defaultContent } from '../../lib/content';

const clone = <T,>(v: T): T => JSON.parse(JSON.stringify(v));

const TABS = [
  { id: 'theme', icon: '🎨', label: 'Tema & Warna' },
  { id: 'navbar', icon: '🧭', label: 'Navigasi & Branding' },
  { id: 'hero', icon: '🚀', label: 'Hero & Intro' },
  { id: 'products', icon: '🛍️', label: 'Katalog Produk' },
  { id: 'articles', icon: '📰', label: 'Artikel & Berita' },
  { id: 'footer', icon: '📄', label: 'Footer & Kontak' },
  { id: 'settings', icon: '🔐', label: 'Pengaturan & Keamanan' },
] as const;

type TabId = (typeof TABS)[number]['id'];

const themeFields: { key: keyof SiteContent['theme']; label: string }[] = [
  { key: 'primaryColor', label: 'Primary' },
  { key: 'secondaryColor', label: 'Secondary' },
  { key: 'accentColor', label: 'Accent' },
  { key: 'bgColor', label: 'Background' },
  { key: 'textColor', label: 'Text' },
  { key: 'navbarBg', label: 'Navbar Bg' },
];

const emptyProduct: Product = {
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

const emptyArticle: Article = {
  title: 'Judul Artikel',
  desc: 'Ringkasan singkat artikel.',
  image: '/hero.jpg',
  tag: 'TIPS',
  date: '25 Okt 2026',
};

type PanelProps = {
  c: SiteContent;
  patch: (fn: (c: SiteContent) => SiteContent) => void;
  upd: <K extends keyof SiteContent>(key: K, value: SiteContent[K]) => void;
  notify: (msg: string) => void;
};

const imgFallback = (e: { currentTarget: HTMLImageElement }) => {
  e.currentTarget.style.opacity = '0';
};

function Modal({
  title,
  onClose,
  footer,
  children,
}: {
  title: string;
  onClose: () => void;
  footer?: React.ReactNode;
  children: React.ReactNode;
}) {
  return (
    <div className="modal-overlay" onClick={onClose}>
      <div className="modal" onClick={(e) => e.stopPropagation()}>
        <div className="modal-head">
          <h3>{title}</h3>
          <button className="btn-icon" onClick={onClose}>
            ✕
          </button>
        </div>
        <div className="modal-body">{children}</div>
        {footer && <div className="modal-foot">{footer}</div>}
      </div>
    </div>
  );
}

function LinkList({
  items,
  onChange,
  addLabel,
}: {
  items: NavLink[];
  onChange: (v: NavLink[]) => void;
  addLabel: string;
}) {
  const set = (i: number, patch: Partial<NavLink>) =>
    onChange(items.map((l, j) => (j === i ? { ...l, ...patch } : l)));
  const move = (i: number, d: number) => {
    const j = i + d;
    if (j < 0 || j >= items.length) return;
    const next = [...items];
    [next[i], next[j]] = [next[j], next[i]];
    onChange(next);
  };
  return (
    <>
      {items.map((l, i) => (
        <div className="list-row" key={i}>
          <input value={l.label} placeholder="Label" onChange={(e) => set(i, { label: e.target.value })} />
          <input value={l.href} placeholder="/halaman" onChange={(e) => set(i, { href: e.target.value })} />
          <div className="row-actions">
            <button className="btn-icon btn-move" disabled={i === 0} onClick={() => move(i, -1)} aria-label="Naikkan">
              ↑
            </button>
            <button
              className="btn-icon btn-move"
              disabled={i === items.length - 1}
              onClick={() => move(i, 1)}
              aria-label="Turunkan"
            >
              ↓
            </button>
            <button className="btn-icon" onClick={() => onChange(items.filter((_, j) => j !== i))}>
              ✕
            </button>
          </div>
        </div>
      ))}
      <button className="btn-add" onClick={() => onChange([...items, { label: addLabel, href: '/' }])}>
        + Tambah
      </button>
    </>
  );
}

/* ---------------- TAB 1 : TEMA & WARNA ---------------- */
function ThemePanel({ c, upd }: PanelProps) {
  const t = c.theme;
  const set = (k: keyof SiteContent['theme'], v: string) => upd('theme', { ...t, [k]: v });
  return (
    <div className="panel-grid">
      <div className="editor-card">
        <div className="editor-head">
          <div>
            <p className="eyebrow">01 / TEMA</p>
            <h2>Palet Warna Situs</h2>
          </div>
          <span>6 warna</span>
        </div>
        <div className="color-grid">
          {themeFields.map((f) => (
            <label key={f.key} className="color-field">
              {f.label}
              <span>
                <input type="color" value={t[f.key]} onChange={(e) => set(f.key, e.target.value)} />
                <em className="hex-value">{t[f.key]}</em>
              </span>
            </label>
          ))}
        </div>
        <p className="hint">Warna langsung dipakai ulang oleh navbar, hero, tombol, dan footer.</p>
      </div>

      <div className="editor-card">
        <div className="editor-head">
          <div>
            <p className="eyebrow">LIVE PREVIEW</p>
            <h2>Pratinjau Kilat</h2>
          </div>
        </div>
        <div className="theme-preview" style={{ background: t.bgColor, color: t.textColor }}>
          <div className="tp-nav" style={{ background: t.navbarBg, color: t.textColor }}>
            <b>{c.navbar.brandName}</b>
            <span>{c.navbar.links[0]?.label || 'Menu'}</span>
            <span>{c.navbar.links[1]?.label || 'Tentang'}</span>
          </div>
          <div className="tp-body">
            <em style={{ background: t.accentColor }}>{c.hero.badge || 'NEW'}</em>
            <h4>{(c.hero.title || 'Judul Hero').split('\n')[0]}</h4>
            <div className="tp-btn">
              <i style={{ background: t.primaryColor }}>{c.hero.primaryBtnText || 'CTA'}</i>
              <i style={{ background: t.secondaryColor }}>{c.hero.secondaryBtnText || 'Lainnya'}</i>
            </div>
          </div>
        </div>
        <p className="hint">Pratinjau simulasi — perubahan live setelah tombol SIMPAN ditekan.</p>
      </div>
    </div>
  );
}

/* ---------------- TAB 2 : NAVIGASI & BRANDING ---------------- */
function NavPanel({ c, patch, upd }: PanelProps) {
  return (
    <div className="editor-card">
      <div className="editor-head">
        <div>
          <p className="eyebrow">02 / NAVIGASI</p>
          <h2>Brand &amp; Menu Navbar</h2>
        </div>
        <span>{c.navbar.links.length} menu</span>
      </div>
      <div className="field-row">
        <label>
          Nama Brand
          <input value={c.navbar.brandName} onChange={(e) => upd('navbar', { ...c.navbar, brandName: e.target.value })} />
        </label>
        <label>
          Nama Brand (lanjutan)
          <input value={c.navbar.brandSub} onChange={(e) => upd('navbar', { ...c.navbar, brandSub: e.target.value })} />
        </label>
      </div>
      <p className="list-label">MENU NAVBAR — urutan sesuai tombol ↑ ↓</p>
      <LinkList
        items={c.navbar.links}
        addLabel="Menu Baru"
        onChange={(links) =>
          patch((x) => {
            x.navbar.links = links;
            return x;
          })
        }
      />
    </div>
  );
}

/* ---------------- TAB 3 : HERO & INTRO ---------------- */
function HeroPanel({ c, patch, upd }: PanelProps) {
  const stats = c.intro.items;
  const setStat = (i: number, key: 'value' | 'label', v: string) =>
    patch((x) => {
      x.intro.items[i] = { ...x.intro.items[i], [key]: v };
      return x;
    });
  return (
    <>
      <div className="editor-card">
        <div className="editor-head">
          <div>
            <p className="eyebrow">03 / HERO</p>
            <h2>Hero &amp; Banner</h2>
          </div>
        </div>
        <label>
          Judul Hero (baris baru = enter)
          <textarea value={c.hero.title} onChange={(e) => upd('hero', { ...c.hero, title: e.target.value })} />
        </label>
        <label>
          Deskripsi Hero
          <textarea value={c.hero.description} onChange={(e) => upd('hero', { ...c.hero, description: e.target.value })} />
        </label>
        <div className="field-row">
          <label>
            Badge Teks
            <input value={c.hero.badge} placeholder="NEW ARRIVAL" onChange={(e) => upd('hero', { ...c.hero, badge: e.target.value })} />
          </label>
          <label>
            URL Banner / Gambar Hero
            <input value={c.hero.bgImage} placeholder="/hero.jpg" onChange={(e) => upd('hero', { ...c.hero, bgImage: e.target.value })} />
          </label>
        </div>
        {c.hero.bgImage && <img className="thumb-preview" src={c.hero.bgImage} alt="" onError={imgFallback} />}
        <div className="field-row">
          <label>
            Teks Tombol Utama
            <input value={c.hero.primaryBtnText} onChange={(e) => upd('hero', { ...c.hero, primaryBtnText: e.target.value })} />
          </label>
          <label>
            Link Tombol Utama
            <input value={c.hero.primaryBtnLink} onChange={(e) => upd('hero', { ...c.hero, primaryBtnLink: e.target.value })} />
          </label>
          <label>
            Teks Tombol Kedua
            <input value={c.hero.secondaryBtnText} onChange={(e) => upd('hero', { ...c.hero, secondaryBtnText: e.target.value })} />
          </label>
          <label>
            Link Tombol Kedua
            <input value={c.hero.secondaryBtnLink} onChange={(e) => upd('hero', { ...c.hero, secondaryBtnLink: e.target.value })} />
          </label>
        </div>
      </div>

      <div className="editor-card">
        <div className="editor-head">
          <div>
            <p className="eyebrow">03B / INTRO</p>
            <h2>Intro &amp; Statistik</h2>
          </div>
          <span>{stats.length} angka</span>
        </div>
        <label>
          Judul Intro
          <textarea value={c.intro.title} onChange={(e) => upd('intro', { ...c.intro, title: e.target.value })} />
        </label>
        <label>
          Subjudul Intro
          <textarea value={c.intro.subtitle} onChange={(e) => upd('intro', { ...c.intro, subtitle: e.target.value })} />
        </label>
        <p className="list-label">ANGKA STATISTIK</p>
        {stats.map((item, i) => (
          <div className="list-row" key={i}>
            <input value={item.value} placeholder="Angka" onChange={(e) => setStat(i, 'value', e.target.value)} />
            <input value={item.label} placeholder="Label" onChange={(e) => setStat(i, 'label', e.target.value)} />
            <div className="row-actions">
              <button
                className="btn-icon"
                onClick={() =>
                  patch((x) => {
                    x.intro.items.splice(i, 1);
                    return x;
                  })
                }
              >
                ✕
              </button>
            </div>
          </div>
        ))}
        <button
          className="btn-add"
          onClick={() =>
            patch((x) => {
              x.intro.items.push({ value: '0+', label: 'Label' });
              return x;
            })
          }
        >
          + Tambah Statistik
        </button>
        <p className="list-label">CTA / WELLNESS CLUB</p>
        <label>
          Judul CTA
          <textarea value={c.cta.title} onChange={(e) => upd('cta', { ...c.cta, title: e.target.value })} />
        </label>
        <label>
          Deskripsi CTA
          <textarea value={c.cta.desc} onChange={(e) => upd('cta', { ...c.cta, desc: e.target.value })} />
        </label>
        <div className="field-row">
          <label>
            Teks Tombol CTA
            <input value={c.cta.btnText} onChange={(e) => upd('cta', { ...c.cta, btnText: e.target.value })} />
          </label>
          <label>
            Link Tombol CTA
            <input value={c.cta.btnLink} onChange={(e) => upd('cta', { ...c.cta, btnLink: e.target.value })} />
          </label>
        </div>
      </div>
    </>
  );
}

/* ---------------- TAB 4 : KATALOG PRODUK ---------------- */
function ProductsPanel({ c, patch, notify }: PanelProps) {
  const [draft, setDraft] = useState<Product | null>(null);
  const [idx, setIdx] = useState(-1);

  const open = (i: number) => {
    setIdx(i);
    setDraft(clone(c.products[i]));
  };
  const add = () => {
    setIdx(-1);
    setDraft(clone(emptyProduct));
  };
  const commit = () => {
    if (!draft) return;
    const isNew = idx < 0;
    patch((x) => {
      if (isNew) x.products.push(draft);
      else x.products[idx] = draft;
      return x;
    });
    setDraft(null);
    notify(isNew ? '✓ Produk ditambahkan' : '✓ Produk diperbarui');
  };
  const setField = (k: keyof Product, v: string) => setDraft((d) => (d ? { ...d, [k]: v } : d));

  return (
    <div className="editor-card">
      <div className="editor-head">
        <div>
          <p className="eyebrow">04 / KATALOG</p>
          <h2>Katalog Produk ({c.products.length})</h2>
        </div>
        <button className="btn-add" onClick={add}>
          + Tambah Produk
        </button>
      </div>

      {c.products.length === 0 ? (
        <div className="empty-state">Belum ada produk. Tekan “+ Tambah Produk” untuk memulai.</div>
      ) : (
        <div className="data-table">
          <div className="dt-head">
            <span>Foto</span>
            <span>Produk</span>
            <span>Kategori</span>
            <span>Harga</span>
            <span></span>
          </div>
          {c.products.map((p, i) => (
            <div className="dt-row" key={i}>
              <span className="dt-thumb">
                <img src={p.image} alt="" onError={imgFallback} />
              </span>
              <span className="dt-name">
                <b>{p.name || 'Produk #' + (i + 1)}</b>
                <small>
                  {p.tag} · {p.time} · {p.level}
                </small>
              </span>
              <span>
                <i className="badge" style={{ background: p.color + '26', color: p.color }}>
                  {p.category}
                </i>
              </span>
              <span className="dt-price">{p.price}</span>
              <span className="dt-actions">
                <button className="btn-ghost" onClick={() => open(i)}>
                  EDIT
                </button>
                <button
                  className="btn-icon"
                  onClick={() => {
                    if (!confirm(`Hapus “${p.name}”?`)) return;
                    patch((x) => {
                      x.products.splice(i, 1);
                      return x;
                    });
                    notify('✓ Produk dihapus');
                  }}
                >
                  HAPUS
                </button>
              </span>
            </div>
          ))}
        </div>
      )}

      {draft && (
        <Modal
          title={idx < 0 ? 'Tambah Produk' : 'Edit Produk'}
          onClose={() => setDraft(null)}
          footer={
            <>
              <button className="btn-ghost" onClick={() => setDraft(null)}>
                BATAL
              </button>
              <button className="btn-save" onClick={commit}>
                SIMPAN PRODUK <span>→</span>
              </button>
            </>
          }
        >
          <div className="field-row">
            <label>
              Nama Produk
              <input value={draft.name} onChange={(e) => setField('name', e.target.value)} />
            </label>
            <label>
              Tag
              <input value={draft.tag} onChange={(e) => setField('tag', e.target.value)} />
            </label>
            <label>
              Kategori
              <input value={draft.category} onChange={(e) => setField('category', e.target.value)} />
            </label>
          </div>
          <div className="field-row">
            <label>
              Brand / Merek
              <input value={draft.time} onChange={(e) => setField('time', e.target.value)} />
            </label>
            <label>
              Level
              <input value={draft.level} onChange={(e) => setField('level', e.target.value)} />
            </label>
            <label>
              Harga
              <input value={draft.price} onChange={(e) => setField('price', e.target.value)} />
            </label>
            <label>
              Warna
              <span className="color-inline">
                <input type="color" value={draft.color} onChange={(e) => setField('color', e.target.value)} />
                {draft.color}
              </span>
            </label>
          </div>
          <label>
            Deskripsi
            <textarea value={draft.desc} onChange={(e) => setField('desc', e.target.value)} />
          </label>
          <div className="field-row">
            <label>
              Link Produk
              <input value={draft.link} onChange={(e) => setField('link', e.target.value)} />
            </label>
            <label>
              Foto (URL)
              <input value={draft.image} placeholder="/images/....webp" onChange={(e) => setField('image', e.target.value)} />
              <img className="thumb-preview" src={draft.image} alt="" onError={imgFallback} />
            </label>
          </div>
        </Modal>
      )}
    </div>
  );
}

/* ---------------- TAB 5 : ARTIKEL & BERITA ---------------- */
function ArticlesPanel({ c, patch, notify }: PanelProps) {
  const [draft, setDraft] = useState<Article | null>(null);
  const [idx, setIdx] = useState(-1);

  const open = (i: number) => {
    setIdx(i);
    setDraft(clone(c.articles[i]));
  };
  const add = () => {
    setIdx(-1);
    setDraft(clone(emptyArticle));
  };
  const commit = () => {
    if (!draft) return;
    const isNew = idx < 0;
    patch((x) => {
      if (isNew) x.articles.push(draft);
      else x.articles[idx] = draft;
      return x;
    });
    setDraft(null);
    notify(isNew ? '✓ Artikel ditambahkan' : '✓ Artikel diperbarui');
  };
  const setField = (k: keyof Article, v: string) => setDraft((d) => (d ? { ...d, [k]: v } : d));

  return (
    <div className="editor-card">
      <div className="editor-head">
        <div>
          <p className="eyebrow">05 / ARTIKEL</p>
          <h2>Artikel &amp; Berita ({c.articles.length})</h2>
        </div>
        <button className="btn-add" onClick={add}>
          + Tulis Artikel
        </button>
      </div>

      {c.articles.length === 0 ? (
        <div className="empty-state">Belum ada artikel. Tekan “+ Tulis Artikel”.</div>
      ) : (
        c.articles.map((a, i) => (
          <div className="article-row" key={i}>
            <img src={a.image} alt="" onError={imgFallback} />
            <div>
              <h4>{a.title || 'Tanpa judul'}</h4>
              <div className="article-meta">
                <span>{a.date}</span>
                <span className="badge badge-soft">{a.tag}</span>
                <span>{a.desc}</span>
              </div>
            </div>
            <span className="dt-actions">
              <button className="btn-ghost" onClick={() => open(i)}>
                EDIT
              </button>
              <button
                className="btn-icon"
                onClick={() => {
                  if (!confirm(`Hapus “${a.title}”?`)) return;
                  patch((x) => {
                    x.articles.splice(i, 1);
                    return x;
                  });
                  notify('✓ Artikel dihapus');
                }}
              >
                HAPUS
              </button>
            </span>
          </div>
        ))
      )}

      {draft && (
        <Modal
          title={idx < 0 ? 'Tulis Artikel' : 'Edit Artikel'}
          onClose={() => setDraft(null)}
          footer={
            <>
              <button className="btn-ghost" onClick={() => setDraft(null)}>
                BATAL
              </button>
              <button className="btn-save" onClick={commit}>
                SIMPAN ARTIKEL <span>→</span>
              </button>
            </>
          }
        >
          <label>
            Judul
            <input value={draft.title} onChange={(e) => setField('title', e.target.value)} />
          </label>
          <div className="field-row">
            <label>
              Tanggal
              <input value={draft.date} placeholder="25 Okt 2026" onChange={(e) => setField('date', e.target.value)} />
            </label>
            <label>
              Kategori / Tag
              <input value={draft.tag} placeholder="TIPS" onChange={(e) => setField('tag', e.target.value)} />
            </label>
          </div>
          <label>
            Ringkasan
            <textarea value={draft.desc} onChange={(e) => setField('desc', e.target.value)} />
          </label>
          <div className="field-row">
            <label>
              Gambar (URL)
              <input value={draft.image} onChange={(e) => setField('image', e.target.value)} />
              <img className="thumb-preview" src={draft.image} alt="" onError={imgFallback} />
            </label>
          </div>
        </Modal>
      )}
    </div>
  );
}

/* ---------------- TAB 6 : FOOTER & KONTAK ---------------- */
function FooterPanel({ c, patch, upd }: PanelProps) {
  return (
    <div className="editor-card">
      <div className="editor-head">
        <div>
          <p className="eyebrow">06 / FOOTER</p>
          <h2>Footer, Sosial &amp; Kontak</h2>
        </div>
        <span>{c.footer.columns.length} kolom</span>
      </div>
      <label>
        About / Deskripsi Brand
        <textarea value={c.footer.about} onChange={(e) => upd('footer', { ...c.footer, about: e.target.value })} />
      </label>
      <label>
        Copyright
        <input value={c.footer.copyright} onChange={(e) => upd('footer', { ...c.footer, copyright: e.target.value })} />
      </label>

      <p className="list-label">LINK SOSIAL MEDIA ({c.footer.socialLinks.length})</p>
      <LinkList
        items={c.footer.socialLinks}
        addLabel="Sosial Baru"
        onChange={(v) =>
          patch((x) => {
            x.footer.socialLinks = v;
            return x;
          })
        }
      />

      <p className="list-label">KOLOM NAVIGASI FOOTER ({c.footer.columns.length})</p>
      {c.footer.columns.map((col, ci) => (
        <div className="sub-card" key={ci}>
          <div className="sub-card-head">
            <input
              className="col-title"
              value={col.title}
              placeholder="Judul kolom"
              onChange={(e) =>
                patch((x) => {
                  x.footer.columns[ci].title = e.target.value;
                  return x;
                })
              }
            />
            <button
              className="btn-icon"
              onClick={() =>
                patch((x) => {
                  x.footer.columns.splice(ci, 1);
                  return x;
                })
              }
            >
              ✕ Hapus Kolom
            </button>
          </div>
          <LinkList
            items={col.links}
            addLabel="Link Baru"
            onChange={(v) =>
              patch((x) => {
                x.footer.columns[ci].links = v;
                return x;
              })
            }
          />
        </div>
      ))}
      <button
        className="btn-add"
        onClick={() =>
          patch((x) => {
            x.footer.columns.push({ title: 'Kolom Baru', links: [{ label: 'Link', href: '/' }] });
            return x;
          })
        }
      >
        + Tambah Kolom
      </button>
    </div>
  );
}

/* ---------------- TAB 7 : PENGATURAN & KEAMANAN ---------------- */
function SettingsPanel({ pin, notify, reset }: { pin: string; notify: (m: string) => void; reset: () => void }) {
  const [next, setNext] = useState('');
  const [confirmPin, setConfirmPin] = useState('');

  const changePin = async () => {
    if (next.trim().length < 4) return notify('✕ PIN baru minimal 4 digit');
    if (next !== confirmPin) return notify('✕ Konfirmasi PIN tidak sama');
    const res = await fetch('/api/pin', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json', 'x-pin': pin },
      body: JSON.stringify({ next: next.trim() }),
    });
    if (res.ok) {
      setNext('');
      setConfirmPin('');
      notify('✓ PIN admin berhasil diganti');
    } else {
      notify('✕ Gagal ganti PIN — coba login ulang');
    }
  };

  const backup = async () => {
    const res = await fetch('/api/content');
    const data = await res.json();
    const blob = new Blob([JSON.stringify(data, null, 2)], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = `lamourad-backup-${new Date().toISOString().slice(0, 10)}.json`;
    a.click();
    URL.revokeObjectURL(url);
    notify('✓ Backup JSON diunduh');
  };

  return (
    <div className="settings-grid">
      <div className="editor-card settings-card">
        <p className="eyebrow">07 / KEAMANAN</p>
        <h3>Ganti PIN Admin</h3>
        <p className="desc">PIN dipakai untuk login dan menyimpan perubahan. Minimal 4 digit.</p>
        <label>
          PIN Baru
          <input type="password" inputMode="numeric" value={next} onChange={(e) => setNext(e.target.value)} />
        </label>
        <label>
          Ulangi PIN Baru
          <input type="password" inputMode="numeric" value={confirmPin} onChange={(e) => setConfirmPin(e.target.value)} />
        </label>
        <button className="btn-save" onClick={changePin}>
          SIMPAN PIN BARU <span>→</span>
        </button>
      </div>

      <div className="editor-card settings-card">
        <p className="eyebrow">07B / DATA</p>
        <h3>Backup &amp; Reset</h3>
        <p className="desc">Unduh seluruh konten sebagai JSON, atau kembalikan ke konten bawaan.</p>
        <button className="btn-save" onClick={backup}>
          ⬇ DOWNLOAD JSON
        </button>
        <button
          className="btn-ghost danger"
          onClick={() => {
            if (!confirm('Reset semua konten ke default? Perubahan baru tersimpan setelah tombol SIMPAN ditekan.')) return;
            reset();
          }}
        >
          RESET KE DEFAULT
        </button>
        <p className="hint">Reset hanya mengubah draft di halaman ini — tekan SIMPAN PERUBAHAN untuk menerapkan.</p>
      </div>

      <div className="editor-card settings-card">
        <p className="eyebrow">07C / SISTEM</p>
        <h3>Info Aplikasi</h3>
        <p className="desc">
          Konten disimpan di <b>data/content.json</b> dan langsung tayang tanpa rebuild.
        </p>
        <ul className="info-list">
          <li>Metode simpan: API POST /api/content</li>
          <li>Otorisasi: header PIN admin</li>
          <li>Backup: file JSON lokal</li>
        </ul>
      </div>
    </div>
  );
}

/* ---------------- HALAMAN ADMIN ---------------- */
export default function Admin() {
  const [pin, setPin] = useState('');
  const [authed, setAuthed] = useState(false);
  const [content, setContent] = useState<SiteContent>(clone(defaultContent));
  const [dirty, setDirty] = useState(false);
  const [toast, setToast] = useState('');
  const [tab, setTab] = useState<TabId>('theme');
  const [loggingIn, setLoggingIn] = useState(false);

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

  const login = async () => {
    setLoggingIn(true);
    try {
      const res = await fetch('/api/pin', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'x-pin': pin },
        body: '{}',
      });
      if (res.ok) setAuthed(true);
      else setToast('✕ PIN salah');
    } catch {
      setToast('✕ Tidak bisa terhubung ke server');
    } finally {
      setLoggingIn(false);
    }
  };

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
            onKeyDown={(e) => e.key === 'Enter' && login()}
          />
          <button onClick={login} disabled={loggingIn}>
            {loggingIn ? 'MEMERIKSA…' : 'MASUK →'}
          </button>
          <a href="/">← Kembali ke website</a>
          {toast && <div className="admin-toast">{toast}</div>}
        </div>
      </main>
    );
  }

  const active = TABS.find((t) => t.id === tab) || TABS[0];
  const panelProps: PanelProps = { c: content, patch, upd, notify: setToast };

  return (
    <main className="admin-page">
      <aside className="admin-sidebar">
        <a href="/" className="logo logo-white">
          <span className="brand-lief">{content.navbar.brandName}</span>
          <span className="brand-market">{content.navbar.brandSub}</span>
        </a>
        <p className="admin-eyebrow">CONTENT MANAGEMENT</p>
        <nav className="admin-nav-list">
          {TABS.map((t) => (
            <a
              key={t.id}
              className={tab === t.id ? 'admin-nav active' : 'admin-nav'}
              href={'#' + t.id}
              onClick={(e) => {
                e.preventDefault();
                setTab(t.id);
                window.scrollTo({ top: 0, behavior: 'smooth' });
              }}
            >
              <span>{t.icon}</span>
              {t.label}
            </a>
          ))}
        </nav>
        <a href="/" target="_blank" className="back-site">
          ↗ Lihat website live
        </a>
      </aside>

      <section className="admin-main">
        <header className="admin-topbar">
          <div>
            <p className="admin-crumb">
              CMS <i>/</i> <b>{active.label}</b>
            </p>
            <h1>{active.label}</h1>
          </div>
          <div className="admin-topbar-actions">
            <span className={dirty ? 'save-state dirty' : 'save-state ok'}>
              {dirty ? '● Ada perubahan belum disimpan' : '✓ Tersimpan'}
            </span>
            <a className="btn-ghost" href="/" target="_blank">
              Lihat Website Live ↗
            </a>
            <button className="btn-save" onClick={save} disabled={!dirty}>
              {dirty ? 'SIMPAN PERUBAHAN' : 'TERSIMPAN'} <span>→</span>
            </button>
          </div>
        </header>

        <div className="admin-content">
          {tab === 'theme' && <ThemePanel {...panelProps} />}
          {tab === 'navbar' && <NavPanel {...panelProps} />}
          {tab === 'hero' && <HeroPanel {...panelProps} />}
          {tab === 'products' && <ProductsPanel {...panelProps} />}
          {tab === 'articles' && <ArticlesPanel {...panelProps} />}
          {tab === 'footer' && <FooterPanel {...panelProps} />}
          {tab === 'settings' && <SettingsPanel pin={pin} notify={setToast} reset={reset} />}
        </div>
      </section>

      {toast && <div className="admin-toast">{toast}</div>}
    </main>
  );
}
