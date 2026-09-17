'use client';

import { useEffect, useState, useRef, useMemo } from "react";

const recipesData = [
  {
    name: "Viva Velvet Cushion SPF 50",
    tag: "4 SHADES LENGKAP",
    category: "KOSMETIK",
    time: "Viva Cosmetics",
    level: "Matte Finish",
    desc: "Cushion lembut dengan UV filter SPF 50 PA++++ dan formula pelembap tahan seharian.",
    image: "/images/liefmarket-3/1.webp",
    color: "#7fa697",
  },
  {
    name: "Ovale 2in1 Facial Lotion",
    tag: "ANTI ACNE CARE",
    category: "SKINCARE",
    time: "Ovale Official",
    level: "Deep Control",
    desc: "Pembersih dan penyegar wajah seketika dengan ekstrak lidah buaya dan jeruk nipis.",
    image: "/images/liefmarket-32/10.webp",
    color: "#8fb8a7",
  },
  {
    name: "Dragon Menthol Gosok Po'peng",
    tag: "HERBAL NUSANTARA",
    category: "KESEHATAN",
    time: "Cap Dragon",
    level: "100% Menthol",
    desc: "Membantu meredakan sakit kepala, hidung tersumbat, dan masuk angin sejak 1948.",
    image: "/images/liefmarket-3/3.webp",
    color: "#555555",
  },
  {
    name: "Viva Paket Clean Mask Pink",
    tag: "5IN1 GLOWING SET",
    category: "SKINCARE",
    time: "Viva Cosmetics",
    level: "Kulit Cerah",
    desc: "Paket lengkap Milk Cleanser, Face Tonic, Clean Mask, Collagen Night Cream & Serum.",
    image: "/images/liefmarket-32/70.webp",
    color: "#4a7061",
  },
  {
    name: "Garnier Sakura Glow Mask",
    tag: "HYALURON NIGHT",
    category: "SKINCARE",
    time: "Garnier Night",
    level: "Kulit Glowing",
    desc: "Menutrisi kulit intensif di malam hari dengan ekstrak sakura Jepang alami.",
    image: "/images/liefmarket-32/20.webp",
    color: "#6e9484",
  },
  {
    name: "Harmony Sabun Buah Mix",
    tag: "AROMA SEGAR",
    category: "BODY CARE",
    time: "Harmony Soap",
    level: "Mood Enhancer",
    desc: "Sensasi mandi segar dengan perpaduan ekstrak aneka buah tropis yang menyegarkan.",
    image: "/images/liefmarket-32/50.webp",
    color: "#5b8574",
  },
  {
    name: "Mini Kidi Diaper Baby Wipes",
    tag: "ALOE VERA LEMBUT",
    category: "IBU & BAYI",
    time: "Baby Wipes",
    level: "Non-Alcohol",
    desc: "Tisu basah 98% naturally derived ingredients, aman dan higienis untuk kulit bayi.",
    image: "/images/liefmarket-32/30.webp",
    color: "#3a5b4e",
  },
];

const productsData = [
  {
    name: "VIVA VELVET CUSHION",
    tagline: "Flawless & SPF 50 PA++++",
    desc: "Cushion bertekstur velvet lembut dengan coverage merata dan perlindungan maksimal dari sinar UV. Menjaga wajah segar bebas kilap sepanjang hari.",
    tags: ["✓ SPF 50 PA++++", "✓ 4 Pilihan Shade", "✓ Halal & BPOM"],
    color: "#7fa697",
    bg: "radial-gradient(circle at 60% 45%, #32473e 0%, #1f2d27 100%)",
    image: "/images/liefmarket-3/1.webp",
  },
  {
    name: "OVALE 2IN1 FACIAL LOTION",
    tagline: "Pembersih & Penyegar Wajah",
    desc: "Formula aksi ganda membersihkan sisa riasan dan kotoran sekaligus mengontrol minyak berlebih dengan ekstrak lidah buaya dan jeruk nipis.",
    tags: ["✓ Deep Cleansing", "✓ Anti Acne Care", "✓ 3 Pilihan Ukuran"],
    color: "#8fb8a7",
    bg: "radial-gradient(circle at 60% 45%, #2c4238 0%, #1c2a24 100%)",
    image: "/images/liefmarket-32/10.webp",
  },
  {
    name: "DRAGON MENTHOL GOSOK",
    tagline: "Warisan Hangat Sejak 1948",
    desc: "Menthol kristal murni 100% cap Dragon untuk meredakan masuk angin, pegal linu, dan hidung tersumbat secara cepat dan melegakan.",
    tags: ["✓ 100% Menthol Alami", "✓ Hangat Tahan Lama", "✓ Praktis Higienis"],
    color: "#c0d2cb",
    bg: "radial-gradient(circle at 60% 45%, #3a4b44 0%, #24312b 100%)",
    image: "/images/liefmarket-3/2.webp",
  },
  {
    name: "VIVA PAKET GLOWING SET",
    tagline: "Rangkaian Perawatan Kulit Cerah",
    desc: "Paket 5 produk unggulan perawatan wajah dengan ekstrak bengkoang, collagen, dan serum pencerah untuk kulit sehat dan bersinar alami.",
    tags: ["✓ 5 Produk Unggulan", "✓ Collagen & Niacinamide", "✓ Teruji Klinis"],
    color: "#a2c2b5",
    bg: "radial-gradient(circle at 60% 45%, #344a40 0%, #202e28 100%)",
    image: "/images/liefmarket-32/70.webp",
  },
  {
    name: "FRESHCARE SMASH SAKURA",
    tagline: "Double Inhaler + Roll On 2in1",
    desc: "Inovasi minyak aromaterapi roll-on hangat plus double inhaler segar dengan wangi bunga sakura yang menenangkan dan botol glow in the dark.",
    tags: ["✓ 2in1 Inhaler + Roll On", "✓ Aroma Sakura Segar", "✓ Glow In The Dark"],
    color: "#6e9484",
    bg: "radial-gradient(circle at 60% 45%, #2c4137 0%, #1b2923 100%)",
    image: "/images/liefmarket-32/2.webp",
  },
];

function Arrow({ direction = "right" }: { direction?: "left" | "right" }) {
  return <span aria-hidden>{direction === "left" ? "←" : "→"}</span>;
}

function Header({ onMenu }: { onMenu: () => void }) {
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
        <i>L</i>
        <span>
          LIEFMARKET<small>PRODUK RESMI & TERPERCAYA</small>
        </span>
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

function Menu({ close }: { close: () => void }) {
  const links = [
    ["Beranda", "/"],
    ["Tentang Kami", "/company"],
    ["Kehidupan di LiefMarket", "/life-at-liefmarket"],
    ["Katalog Produk", "/products"],
    ["Rekomendasi Produk", "/recipes"],
    ["Mitra Bisnis", "/food-service"],
    ["Artikel & Tips", "/articles"],
    ["Komunitas", "/community"],
    ["Kontak Kami", "/contact"],
    ["FAQ", "/faq"],
  ];
  const productLinks = [
    ["Viva Cosmetics", "/products/viva"],
    ["Ovale Skincare", "/products/ovale"],
    ["Dragon Herbal", "/products/dragon"],
    ["Garnier Care", "/products/garnier"],
    ["FreshCare Aromatherapy", "/products/freshcare"],
    ["Harmony Body Wash", "/products/harmony"],
  ];

  return (
    <div className="menu-overlay">
      <button className="close-menu" onClick={close}>×</button>
      <div className="menu-main">
        <p className="eyebrow">JELAJAHI LIEFMARKET</p>
        {links.map(([item, href], i) => (
          <a href={href} onClick={close} key={item}>
            {item}<sup>0{i + 1}</sup>
          </a>
        ))}
      </div>
      <div className="menu-products">
        <p className="eyebrow">PRODUK PILIHAN</p>
        {productLinks.map(([item, href]) => (
          <a href={href} onClick={close} key={item}>
            {item} <Arrow />
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

function HeroSection() {
  const [mouseOffset, setMouseOffset] = useState({ x: 0, y: 0 });

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
          LIEFMARKET SURABAYA <span>✦</span>
        </p>
        <h1>
          Perawatan Terbaik<br />
          <em>Keluarga Anda.</em>
        </h1>
        <p className="hero-desc">
          Menghadirkan produk perawatan diri, kosmetik berkualitas, dan herbal alami nusantara 100% original dan bersertifikasi resmi BPOM.
        </p>
        <div className="hero-actions">
          <a className="red-button" href="#recipes">
            JELAJAHI PRODUK <Arrow />
          </a>
          <a className="ghost-button" href="#class">
            WELLNESS CLUB <Arrow />
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
          <img src="/images/liefmarket-32/70.webp" alt="Paket Perawatan LiefMarket" />
        </div>
        <div
          className="hero-badge"
          style={{
            transform: "rotate(-10deg) translate(" + -mouseOffset.x * 1.2 + "px, " + -mouseOffset.y * 1.2 + "px)",
          }}
        >
          100%<br />
          <span>ORIGINAL<br />BPOM</span>
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

function IntroSection() {
  return (
    <section className="deck-section deck-intro" id="about">
      <KineticMarquee
        theme="light"
        items={[
          "LIEFMARKET SURABAYA",
          "100% PRODUK ORIGINAL & BPOM",
          "PERAWATAN & KESEHATAN KELUARGA",
          "BELANJA AMAN & TERPERCAYA",
        ]}
      />

      <div className="intro">
        <div className="intro-mark">✳</div>
        <p className="eyebrow">SEJAK AWAL BERSAMA ANDA</p>
        <h2>
          Pilihan terlengkap,<br />
          <em>aman & terpercaya.</em>
        </h2>
        <p>
          LiefMarket menghadirkan produk perawatan diri, kosmetik pilihan, dan herbal kesehatan keluarga berkualitas tinggi dengan jaminan keaslian 100%.
        </p>
        <a className="text-link" href="#story">
          BACA CERITA KAMI <Arrow />
        </a>

        <div className="intro-stats">
          <div className="intro-stat-item">
            <strong>1000+</strong>
            <span>PRODUK ORIGINAL</span>
          </div>
          <div className="intro-stat-item">
            <strong>100%</strong>
            <span>TERSERTIFIKASI BPOM</span>
          </div>
          <div className="intro-stat-item">
            <strong>50rb+</strong>
            <span>PELANGGAN SETIA</span>
          </div>
        </div>
      </div>
    </section>
  );
}

function HorizontalRecipeSection() {
  const containerRef = useRef<HTMLDivElement>(null);
  const trackRef = useRef<HTMLDivElement>(null);
  const [scrollProgress, setScrollProgress] = useState(0);
  const [activeCategory, setActiveCategory] = useState("SEMUA");

  const categories = ["SEMUA", "SKINCARE", "KOSMETIK", "KESEHATAN", "BODY CARE", "IBU & BAYI"];

  const filteredRecipes = useMemo(() => {
    if (activeCategory === "SEMUA") return recipesData;
    return recipesData.filter((r) => r.category === activeCategory);
  }, [activeCategory]);

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
            <p className="eyebrow">KATALOG LIEFMARKET ✦</p>
            <h2>
              PRODUK PILIHAN<br />
              <em>FAVORIT KELUARGA.</em>
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
                    <a className="recipe-view-btn" href="/products">
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

function CookingClassSection() {
  return (
    <section className="deck-section deck-class" id="class">
      <div className="class-section-inner">
        <div className="class-content">
          <p className="eyebrow">LIEFMARKET WELLNESS CLUB ✦</p>
          <h2>
            RAWAT DIRI,<br />
            <em>PERCAYA DIRI.</em>
          </h2>
          <p>
            Dapatkan inspirasi gaya hidup sehat, tips merawat kulit harian, serta panduan memilih produk kecantikan dan herbal yang tepat untuk keluarga Anda.
          </p>
          <a className="dark-button" href="/community">
            GABUNG KOMUNITAS SEKARANG <Arrow />
          </a>
        </div>

        <div className="class-photo-wrapper">
          <div className="class-photo">
            <img
              src="/images/liefmarket-3/1.webp"
              alt="Perawatan Kulit LiefMarket"
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
          "LIEFMARKET WELLNESS CLUB",
          "KECANTIKAN ALAMI",
          "KESEHATAN KELUARGA",
          "PRODUK RESMI & TERPERCAYA",
        ]}
      />
    </section>
  );
}

function Product3DSection() {
  const [active, setActive] = useState(0);
  const [isPaused, setIsPaused] = useState(false);
  const touchStartX = useRef(0);

  useEffect(() => {
    if (isPaused) return;
    const interval = setInterval(() => {
      setActive((current) => (current + 1) % productsData.length);
    }, 4500);
    return () => clearInterval(interval);
  }, [isPaused]);

  const activeProduct = productsData[active];

  const handleTouchStart = (e: React.TouchEvent) => {
    touchStartX.current = e.touches[0].clientX;
  };

  const handleTouchEnd = (e: React.TouchEvent) => {
    const delta = e.changedTouches[0].clientX - touchStartX.current;
    if (delta > 40) {
      setActive((current) => (current - 1 + productsData.length) % productsData.length);
    } else if (delta < -40) {
      setActive((current) => (current + 1) % productsData.length);
    }
  };

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
            PILIHAN YANG<br />
            <em>SELALU ADA.</em>
          </h2>
        </div>

        <div className="product-3d-stage">
          <div className="product-info-panel">
            <span className="product-counter-pill">
              0{active + 1} / 0{productsData.length}
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
            {productsData.map((prod, idx) => {
              const diff = idx - active;
              let cls = "coverflow-card ";
              if (diff === 0) cls += "is-active";
              else if (diff === -1 || (active === 0 && idx === productsData.length - 1)) cls += "is-prev";
              else if (diff === 1 || (active === productsData.length - 1 && idx === 0)) cls += "is-next";
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
          {productsData.map((prod, idx) => (
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
            src="/images/liefmarket-3/5.webp"
            alt="Perawatan keluarga LiefMarket"
          />
        </div>
        <div className="story-copy">
          <p className="eyebrow">CERITA LIEFMARKET</p>
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

function Footer() {
  return (
    <footer className="deck-section deck-footer">
      <div className="footer-brand">
        <a href="#top" className="logo logo-white">
          <i>L</i>
          <span>
            LIEFMARKET<small>PRODUK RESMI & TERPERCAYA</small>
          </span>
        </a>
        <p>
          Solusi terpercaya produk perawatan kecantikan,<br />
          kesehatan herbal, dan kebutuhan keluarga Indonesia.
        </p>
        <div className="socials">
          <a href="#instagram" aria-label="Instagram">ig</a>
          <a href="#facebook" aria-label="Facebook">f</a>
          <a href="#youtube" aria-label="YouTube">▶</a>
        </div>
      </div>

      <div className="footer-links">
        <div>
          <p className="eyebrow">JELAJAHI</p>
          <a href="/company">Tentang LiefMarket</a>
          <a href="/products">Katalog Produk</a>
          <a href="/recipes">Rekomendasi Favorit</a>
          <a href="/articles">Artikel & Tips Perawatan</a>
        </div>
        <div>
          <p className="eyebrow">BANTUAN</p>
          <a href="/contact">Kontak Kami</a>
          <a href="/faq">FAQ</a>
          <a href="/community">Komunitas</a>
        </div>
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
        <span>© 2024 LIEFMARKET INDONESIA. ALL RIGHTS RESERVED.</span>
        <span>AUTHENTIC CARE FOR INDONESIA</span>
      </div>
    </footer>
  );
}

function Loader({ onDone }: { onDone: () => void }) {
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
        <i>L</i>
        <span>
          LIEFMARKET<small>PRODUK RESMI & TERPERCAYA</small>
        </span>
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

export default function Home() {
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
      {loading && <Loader onDone={() => setLoading(false)} />}
      <Header onMenu={() => setMenu(true)} />
      {menu && <Menu close={() => setMenu(false)} />}

      <HeroSection />
      <IntroSection />
      <HorizontalRecipeSection />
      <CookingClassSection />
      <Product3DSection />
      <StorySection />
      <Footer />

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
