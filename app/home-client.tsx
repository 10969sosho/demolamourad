'use client';

import { useEffect, useState, useRef, useMemo } from "react";
import type { SiteContent, Product } from "../lib/content";

function Arrow({ direction = "right" }: { direction?: "left" | "right" }) {
  return <span aria-hidden>{direction === "left" ? "←" : "→"}</span>;
}

function Header({ onMenu, brand }: { onMenu: () => void; brand: { brandName: string; brandSub: string } }) {
  const [scrolled, setScrolled] = useState(false);
  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 40);
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  return (
    <header className={scrolled ? "header scrolled" : "header"}>
      <span className="anchor-target" id="explore"></span>
      <span className="anchor-target" id="about"></span>
      <span className="anchor-target" id="class"></span>
      <span className="anchor-target" id="story"></span>
      <span className="anchor-target" id="contact"></span>
      <span className="anchor-target" id="faq"></span>
      <span className="anchor-target" id="community"></span>
      <span className="anchor-target" id="instagram"></span>
      <span className="anchor-target" id="facebook"></span>
      <span className="anchor-target" id="youtube"></span>
      <a href="#top" className="logo">
        <span className="brand-lief">{brand.brandName}</span>
        <span className="brand-market">{brand.brandSub}</span>
      </a>
      <div className="header-actions">
        <a href="/admin" className="admin-link">CMS</a>
        <a href="/community" className="register">DAFTAR</a>
        <a href="/recipes" className="icon-button" aria-label="Cari">⌕</a>
        <button className="menu-button" onClick={onMenu} aria-label="Buka menu">
          <span></span>
          <span></span>
        </button>
      </div>
    </header>
  );
}

function Menu({ close, links, products }: { close: () => void; links: { label: string; href: string }[]; products: Product[] }) {
  return (
    <div className="menu-overlay">
      <button className="close-menu" onClick={close}>×</button>
      <div className="menu-main">
        <p className="eyebrow">JELAJAHI LAMOURAD</p>
        {links.map((item, i) => (
          <a href={item.href} onClick={close} key={item.label + i}>
            {item.label}<sup>0{i + 1}</sup>
          </a>
        ))}
      </div>
      <div className="menu-products">
        <p className="eyebrow">PRODUK PILIHAN</p>
        {products.map((p) => (
          <a href={p.link} onClick={close} key={p.name}>
            {p.name} <Arrow />
          </a>
        ))}
        <div className="menu-stamp">
          100%<br />
          <span>ASLI</span><br />
          BPOM
        </div>
      </div>
    </div>
  );
}

function KineticMarquee({
  theme = "light",
  reverse = false,
  items,
}: {
  theme?: "light" | "dark";
  reverse?: boolean;
  items: string[];
}) {
  return (
    <div className={"marquee-container " + (theme === "light" ? "marquee-light" : "marquee-dark") + (reverse ? " marquee-reverse" : "")}>
      <div className="marquee-track">
        {items.concat(items).map((text, idx) => (
          <span className="marquee-item" key={idx}>
            <span className="star">✦</span> {text}
          </span>
        ))}
      </div>
    </div>
  );
}

function HeroSection({ hero }: { hero: SiteContent["hero"] }) {
  const [mouseOffset, setMouseOffset] = useState({ x: 0, y: 0 });
  const [titleFirst, ...titleRest] = hero.title.split("\n");
  const [badgeFirst, ...badgeRest] = hero.badge.split("\n");

  const handleMouseMove = (e: React.MouseEvent<HTMLElement>) => {
    const { clientX, clientY, currentTarget } = e;
    const rect = currentTarget.getBoundingClientRect();
    const x = (clientX - rect.left) / rect.width - 0.5;
    const y = (clientY - rect.top) / rect.height - 0.5;
    setMouseOffset({ x: x * 26, y: y * 26 });
  };

  return (
    <section className="hero deck-section deck-hero" onMouseMove={handleMouseMove}>
      <div className="hero-copy">
        <p className="eyebrow">
          LAMOURAD SURABAYA <span>✦</span>
        </p>
        <h1>
          {titleFirst}
          {titleRest.length > 0 && (
            <>
              <br />
              <em>{titleRest.join(" ")}</em>
            </>
          )}
        </h1>
        <p className="hero-desc">{hero.description}</p>
        <div className="hero-actions">
          <a className="red-button" href={hero.primaryBtnLink}>
            {hero.primaryBtnText} <Arrow />
          </a>
          <a className="ghost-button" href={hero.secondaryBtnLink}>
            {hero.secondaryBtnText} <Arrow />
          </a>
        </div>
      </div>

      <div className="hero-art">
        <div
          className="sun"
          style={{
            transform: "translate(" + -mouseOffset.x * 0.7 + "px, " + -mouseOffset.y * 0.7 + "px)",
          }}
        ></div>
        <div
          className="hero-photo"
          style={{
            transform: "rotate(4deg) translate(" + mouseOffset.x * 0.5 + "px, " + mouseOffset.y * 0.5 + "px)",
          }}
        >
          <img src={hero.bgImage} alt="Paket Perawatan Lamourad" />
        </div>
        <div
          className="hero-badge"
          style={{
            transform: "rotate(-10deg) translate(" + -mouseOffset.x * 1.2 + "px, " + -mouseOffset.y * 1.2 + "px)",
          }}
        >
          {badgeFirst}
          {badgeRest.length > 0 && (
            <>
              <br />
              <span>{badgeRest.join("\n")}</span>
            </>
          )}
        </div>
        <div
          className="floating-spice spice-a"
          style={{
            transform: "translate(" + mouseOffset.x * 1.5 + "px, " + mouseOffset.y * 1.5 + "px)",
          }}
        >
          ✦
        </div>
        <div
          className="floating-spice spice-b"
          style={{
            transform: "translate(" + -mouseOffset.x * 1.4 + "px, " + -mouseOffset.y * 1.4 + "px)",
          }}
        >
          ✦
        </div>
        <div
          className="floating-spice spice-c"
          style={{
            transform: "translate(" + mouseOffset.x * 1.1 + "px, " + mouseOffset.y * 1.1 + "px)",
          }}
        >
          ✳
        </div>
      </div>

      <div className="hero-bottom">
        <span>01</span>
        <div className="hero-progress">
          <i></i>
        </div>
        <span>03</span>
        <p>
          SCROLL KE BAWAH UNTUK MENJELAJAHI <b>↓</b>
        </p>
      </div>
    </section>
  );
}

function IntroSection({ intro }: { intro: SiteContent["intro"] }) {
  const [titleFirst, ...titleRest] = intro.title.split("\n");
  return (
    <section className="deck-section deck-intro" id="about">
      <KineticMarquee
        theme="light"
        items={[
          "LAMOURAD SURABAYA",
          "100% PRODUK ORIGINAL & BPOM",
          "PERAWATAN & KESEHATAN KELUARGA",
          "BELANJA AMAN & TERPERCAYA",
        ]}
      />

      <div className="intro">
        <div className="intro-mark">✳</div>
        <p className="eyebrow">SEJAK AWAL BERSAMA ANDA</p>
        <h2>
          {titleFirst}
          {titleRest.length > 0 && (
            <>
              <br />
              <em>{titleRest.join(" ")}</em>
            </>
          )}
        </h2>
        <p>{intro.subtitle}</p>
        <a className="text-link" href="#story">
          BACA CERITA KAMI <Arrow />
        </a>

        <div className="intro-stats">
          {intro.items.map((item) => (
            <div className="intro-stat-item" key={item.label}>
              <strong>{item.value}</strong>
              <span>{item.label}</span>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}

function HorizontalRecipeSection({ products }: { products: Product[] }) {
  const containerRef = useRef<HTMLDivElement>(null);
  const trackRef = useRef<HTMLDivElement>(null);
  const [scrollProgress, setScrollProgress] = useState(0);
  const [activeCategory, setActiveCategory] = useState("SEMUA");

  const categories = useMemo(
    () => ["SEMUA", ...Array.from(new Set(products.map((p) => p.category)))],
    [products]
  );

  const filteredRecipes = useMemo(() => {
    if (activeCategory === "SEMUA") return products;
    return products.filter((r) => r.category === activeCategory);
  }, [activeCategory, products]);

  useEffect(() => {
    let animationFrameId: number;

    const handleScroll = () => {
      if (!containerRef.current || !trackRef.current) return;
      const rect = containerRef.current.getBoundingClientRect();
      const totalScrollable = containerRef.current.offsetHeight - window.innerHeight;

      if (totalScrollable > 0) {
        const scrolled = -rect.top;
        const progress = Math.max(0, Math.min(1, scrolled / totalScrollable));
        setScrollProgress(progress);

        const track = trackRef.current;
        const maxTranslate = Math.max(0, track.scrollWidth - window.innerWidth + 140);
        track.style.transform = "translateX(" + -progress * maxTranslate + "px)";
      }
    };

    const onScroll = () => {
      cancelAnimationFrame(animationFrameId);
      animationFrameId = requestAnimationFrame(handleScroll);
    };

    window.addEventListener("scroll", onScroll, { passive: true });
    window.addEventListener("resize", onScroll);
    handleScroll();

    return () => {
      window.removeEventListener("scroll", onScroll);
      window.removeEventListener("resize", onScroll);
      cancelAnimationFrame(animationFrameId);
    };
  }, [filteredRecipes]);

  const stepScroll = (direction: "left" | "right") => {
    if (!containerRef.current) return;
    const currentScroll = window.scrollY;
    const scrollStep = window.innerHeight * 0.45;
    window.scrollTo({
      top: direction === "right" ? currentScroll + scrollStep : currentScroll - scrollStep,
      behavior: "smooth",
    });
  };

  return (
    <div className="deck-recipes-wrapper" ref={containerRef} id="recipes">
      <div className="deck-recipes-sticky">
        <div className="recipe-header-bar">
          <div className="section-heading light">
            <p className="eyebrow">KATALOG LAMOURAD ✦</p>
            <h2>
              Produk pilihan,<br />
              <em>favorit keluarga.</em>
            </h2>
            <p className="section-copy">
              Scroll ke bawah untuk menjelajahi katalog produk unggulan secara horizontal.
            </p>
          </div>

          <div className="recipe-category-pills">
            {categories.map((cat) => (
              <button
                key={cat}
                className={"recipe-cat-btn " + (activeCategory === cat ? "active" : "")}
                onClick={() => setActiveCategory(cat)}
              >
                {cat}
              </button>
            ))}
          </div>
        </div>

        <div className="horizontal-track-container">
          <div className="recipe-horizontal-track" ref={trackRef}>
            {filteredRecipes.map((recipe) => (
              <article className="recipe-card-modern" key={recipe.name}>
                <div className="recipe-card-photo">
                  <img src={recipe.image} alt={recipe.name} />
                  <span className="recipe-tag-pill">{recipe.tag}</span>
                  <span className="recipe-time-pill">✓ {recipe.time}</span>
                </div>
                <div className="recipe-card-body">
                  <div>
                    <h3>{recipe.name}</h3>
                    <p>{recipe.desc}</p>
                  </div>
                  <div className="recipe-card-foot">
                    <span className="recipe-difficulty">★ {recipe.level}</span>
                    <a className="recipe-view-btn" href={recipe.link || "/products"}>
                      LIHAT PRODUK <Arrow />
                    </a>
                  </div>
                </div>
              </article>
            ))}
          </div>
        </div>

        <div className="horizontal-controls-bar">
          <div className="horizontal-progress-bar">
            <span>01</span>
            <div className="bar-track">
              <div
                className="bar-fill"
                style={{ width: Math.max(10, scrollProgress * 100) + "%" }}
              ></div>
            </div>
            <span>0{filteredRecipes.length}</span>
            <span className="percent-label">{Math.round(scrollProgress * 100)}% SLIDE</span>
          </div>

          <div className="horizontal-nav-arrows">
            <button
              className="nav-arrow-btn"
              onClick={() => stepScroll("left")}
              aria-label="Slide sebelumnya"
            >
              ←
            </button>
            <button
              className="nav-arrow-btn"
              onClick={() => stepScroll("right")}
              aria-label="Slide berikutnya"
            >
              →
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}

function CookingClassSection({ cta }: { cta: SiteContent["cta"] }) {
  const [titleFirst, ...titleRest] = cta.title.split("\n");
  return (
    <section className="deck-section deck-class" id="class">
      <div className="class-section-inner">
        <div className="class-content">
          <p className="eyebrow">LAMOURAD WELLNESS CLUB ✦</p>
          <h2>
            {titleFirst}
            {titleRest.length > 0 && (
              <>
                <br />
                <em>{titleRest.join(" ")}</em>
              </>
            )}
          </h2>
          <p>{cta.desc}</p>
          <a className="dark-button" href={cta.btnLink}>
            {cta.btnText} <Arrow />
          </a>
        </div>

        <div className="class-photo-wrapper">
          <div className="class-photo">
            <img
              src="/images/lamourad-3/1.webp"
              alt="Perawatan Kulit Lamourad"
            />
          </div>
          <div className="class-floating-badge">
            BEAUTY<br />
            &amp;<br />
            HEALTH
          </div>
          <div className="class-stats-pill">
            <span>★</span> 4.9/5 Rating dari 50,000+ Pelanggan
          </div>
        </div>
      </div>

      <KineticMarquee
        theme="dark"
        reverse={true}
        items={[
          "LAMOURAD WELLNESS CLUB",
          "KECANTIKAN ALAMI",
          "KESEHATAN KELUARGA",
          "PRODUK RESMI & TERPERCAYA",
        ]}
      />
    </section>
  );
}

function Product3DSection({ products }: { products: Product[] }) {
  const [active, setActive] = useState(0);
  const [isPaused, setIsPaused] = useState(false);
  const touchStartX = useRef(0);

  const showcase = useMemo(
    () =>
      products.map((p) => ({
        name: p.name,
        tagline: p.tag,
        desc: p.desc,
        tags: ["✓ " + p.category, "✓ " + p.level, "✓ " + p.price].filter(Boolean),
        color: p.color,
        bg: "radial-gradient(circle at 60% 45%, " + p.color + "66 0%, #1f242d 100%)",
        image: p.image,
      })),
    [products]
  );

  useEffect(() => {
    if (isPaused || showcase.length === 0) return;
    const interval = setInterval(() => {
      setActive((current) => (current + 1) % showcase.length);
    }, 4500);
    return () => clearInterval(interval);
  }, [isPaused, showcase.length]);

  const activeProduct = showcase[active] || showcase[0];

  const handleTouchStart = (e: React.TouchEvent) => {
    touchStartX.current = e.touches[0].clientX;
  };

  const handleTouchEnd = (e: React.TouchEvent) => {
    const delta = e.changedTouches[0].clientX - touchStartX.current;
    if (delta > 40) {
      setActive((current) => (current - 1 + showcase.length) % showcase.length);
    } else if (delta < -40) {
      setActive((current) => (current + 1) % showcase.length);
    }
  };

  if (!activeProduct) return null;

  return (
    <section
      className="deck-section deck-products"
      id="products"
      style={{ background: activeProduct.bg }}
      onMouseEnter={() => setIsPaused(true)}
      onMouseLeave={() => setIsPaused(false)}
      onTouchStart={handleTouchStart}
      onTouchEnd={handleTouchEnd}
    >
      <div
        className="product-ambient-disc"
        style={{ background: activeProduct.color }}
      ></div>

      <div className="product-showcase-container">
        <div className="section-heading light">
          <p className="eyebrow">PRODUK UNGGULAN KAMI ✦</p>
          <h2>
            Pilihan tepat,<br />
            <em>selalu ada.</em>
          </h2>
        </div>

        <div className="product-3d-stage">
          <div className="product-info-panel">
            <span className="product-counter-pill">
              0{active + 1} / 0{showcase.length}
            </span>
            <h3>{activeProduct.name}</h3>
            <p className="product-desc">{activeProduct.desc}</p>

            <div className="product-feature-tags">
              {activeProduct.tags.map((tag) => (
                <span className="feature-tag" key={tag}>
                  {tag}
                </span>
              ))}
            </div>

            <div className="product-actions">
              <a className="red-button" href="/products">
                BELI SEKARANG <Arrow />
              </a>
              <a className="ghost-button" href="/recipes">
                PRODUK TERKAIT <Arrow />
              </a>
            </div>
          </div>

          <div className="product-cards-carousel">
            {showcase.map((prod, idx) => {
              const diff = idx - active;
              let cls = "coverflow-card ";
              if (diff === 0) cls += "is-active";
              else if (diff === -1 || (active === 0 && idx === showcase.length - 1)) cls += "is-prev";
              else if (diff === 1 || (active === showcase.length - 1 && idx === 0)) cls += "is-next";
              else cls += "is-hidden";

              return (
                <div
                  key={prod.name}
                  className={cls}
                  onClick={() => setActive(idx)}
                >
                  <img src={prod.image} alt={prod.name} />
                  <div className="coverflow-card-info">
                    <h4>{prod.name}</h4>
                    <span>{prod.tagline}</span>
                  </div>
                </div>
              );
            })}
          </div>
        </div>

        <div className="product-selector-tabs">
          {showcase.map((prod, idx) => (
            <button
              key={prod.name}
              className={"product-tab-btn " + (active === idx ? "active" : "")}
              onClick={() => setActive(idx)}
            >
              <span className="tab-dot" style={{ background: prod.color }}></span>
              {prod.name}
            </button>
          ))}
        </div>
      </div>
    </section>
  );
}

function StorySection() {
  return (
    <section className="deck-section deck-story" id="story">
      <div className="story-section-inner">
        <div className="story-image-wrap">
          <img
            src="/images/lamourad-3/5.webp"
            alt="Perawatan keluarga Lamourad"
          />
        </div>
        <div className="story-copy">
          <p className="eyebrow">CERITA LAMOURAD</p>
          <h2>
            Lebih dari<br />
            <em>sekadar berbelanja.</em>
          </h2>
          <div className="story-quote-card">
            <p>"Kesehatan dan rasa percaya diri berawal dari produk terbaik yang aman untuk seluruh anggota keluarga."</p>
          </div>
          <p>
            Bagi kami, merawat keluarga adalah wujud kasih sayang yang paling bermakna. Lewat setiap produk yang terjamin keasliannya dan terdaftar di BPOM, kami siap mendampingi hari-hari Anda dengan rasa tenang.
          </p>
          <a className="text-link" href="/company">
            PELAJARI PERJALANAN KAMI <Arrow />
          </a>
        </div>
      </div>
    </section>
  );
}

function Footer({ footer, brand }: { footer: SiteContent["footer"]; brand: { brandName: string; brandSub: string } }) {
  return (
    <footer className="deck-section deck-footer">
      <div className="footer-brand">
        <a href="#top" className="logo logo-white">
          <span className="brand-lief">{brand.brandName}</span>
          <span className="brand-market">{brand.brandSub}</span>
        </a>
        <p>{footer.about}</p>
        <div className="socials">
          {footer.socialLinks.map((s) => (
            <a href={s.href} key={s.label} aria-label={s.label}>{s.label}</a>
          ))}
        </div>
      </div>

      <div className="footer-links">
        {footer.columns.map((col) => (
          <div key={col.title}>
            <p className="eyebrow">{col.title}</p>
            {col.links.map((l) => (
              <a href={l.href} key={l.label}>{l.label}</a>
            ))}
          </div>
        ))}
        <div className="newsletter">
          <p className="eyebrow">INSPIRASI PERAWATAN</p>
          <p>
            Dapatkan promo menarik dan tips perawatan kulit langsung ke email kamu setiap minggu.
          </p>
          <div className="email-input">
            <span>Ketik alamat email kamu</span>
            <b>→</b>
          </div>
        </div>
      </div>

      <div className="footer-bottom">
        <span>{footer.copyright}</span>
        <span>AUTHENTIC CARE FOR INDONESIA</span>
      </div>
    </footer>
  );
}

function Loader({ onDone, brand }: { onDone: () => void; brand: { brandName: string; brandSub: string } }) {
  const [progress, setProgress] = useState(0);

  useEffect(() => {
    const start = performance.now();
    const tick = (now: number) => {
      const value = Math.min((now - start) / 1100, 1);
      setProgress(value);
      if (value < 1) {
        requestAnimationFrame(tick);
      } else {
        setTimeout(onDone, 200);
      }
    };
    requestAnimationFrame(tick);
  }, [onDone]);

  return (
    <div className="loader">
      <div className="loader-orbit"></div>
      <div className="loader-logo">
        <span className="brand-lief">{brand.brandName}</span>
        <span className="brand-market">{brand.brandSub}</span>
      </div>
      <div className="loader-bottom">
        <span>MENYIAPKAN KATALOG</span>
        <b>{Math.round(progress * 100)}%</b>
        <div>
          <i style={{ transform: "scaleX(" + progress + ")" }}></i>
        </div>
      </div>
    </div>
  );
}

export default function HomeClient({ content }: { content: SiteContent }) {
  const [menu, setMenu] = useState(false);
  const [showTop, setShowTop] = useState(false);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const onScroll = () => setShowTop(window.scrollY > 450);
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  return (
    <main id="top" className="deck-stack-container">
      {loading && <Loader onDone={() => setLoading(false)} brand={content.navbar} />}
      <Header onMenu={() => setMenu(true)} brand={content.navbar} />
      {menu && <Menu close={() => setMenu(false)} links={content.navbar.links} products={content.products} />}

      <HeroSection hero={content.hero} />
      <IntroSection intro={content.intro} />
      <HorizontalRecipeSection products={content.products} />
      <CookingClassSection cta={content.cta} />
      <Product3DSection products={content.products} />
      <StorySection />
      <Footer footer={content.footer} brand={content.navbar} />

      <div className="market-widget" onClick={() => window.open("/products", "_self")}>
        <span>✦</span>
        <b>BELI<br />SEKARANG</b>
      </div>

      <button className="chat-button" aria-label="Bantuan">•••</button>

      {showTop && (
        <button
          className="top-button"
          onClick={() => window.scrollTo({ top: 0, behavior: "smooth" })}
          aria-label="Kembali ke atas"
        >
          ↑
        </button>
      )}
    </main>
  );
}
