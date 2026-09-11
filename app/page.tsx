'use client';

import { useEffect, useState, useRef, useMemo } from "react";

const recipesData = [
  {
    name: "Ayam Goreng Kremes",
    tag: "GURIH & RENYAH",
    category: "MAKAN SIANG",
    time: "35 Mnt",
    level: "Mudah",
    desc: "Renyah di luar, bumbu meresap sampai ke tulang dengan taburan kremes gurih keemasan.",
    image: "https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?auto=format&fit=crop&w=750&q=85",
    color: "#e6332a",
  },
  {
    name: "Nasi Goreng Spesial",
    tag: "FAVORIT KELUARGA",
    category: "SARAPAN",
    time: "20 Mnt",
    level: "Praktis",
    desc: "Aroma wajan smoky dengan racikan bumbu istimewa andalan keluarga Indonesia.",
    image: "https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&w=750&q=85",
    color: "#087b45",
  },
  {
    name: "Soto Ayam Kuning",
    tag: "HANGAT & LEZAT",
    category: "MAKAN MALAM",
    time: "45 Mnt",
    level: "Sedang",
    desc: "Kuah kuning kaya rempah yang gurih, hangat menenangkan di setiap sendok santap.",
    image: "https://images.unsplash.com/photo-1547592180-85f173990554?auto=format&fit=crop&w=750&q=85",
    color: "#ed6a00",
  },
  {
    name: "Mie Goreng Jawa",
    tag: "PRAKTIS SEHARI-HARI",
    category: "SARAPAN",
    time: "15 Mnt",
    level: "Praktis",
    desc: "Perpaduan manis gurih bumbu rempah dengan sayuran segar dan taburan bawang goreng.",
    image: "https://images.unsplash.com/photo-1569718212165-3a8278d5f624?auto=format&fit=crop&w=750&q=85",
    color: "#009ed2",
  },
  {
    name: "Sambal Matah Bali",
    tag: "PEDASNYA JUARA",
    category: "CAMILAN",
    time: "10 Mnt",
    level: "Mudah",
    desc: "Irisan bawang merah dan cabai rawit disiram minyak kelapa panas, aroma harum menggoda.",
    image: "https://images.unsplash.com/photo-1601050690597-df0568f70950?auto=format&fit=crop&w=750&q=85",
    color: "#c91620",
  },
  {
    name: "Sayur Asem Segar",
    tag: "ASAM GURIH SEGAR",
    category: "MAKAN SIANG",
    time: "25 Mnt",
    level: "Mudah",
    desc: "Kombinasi asam jawa asli dan sayuran segar renyah penghilang dahaga makan siang.",
    image: "https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&w=750&q=85",
    color: "#087b45",
  },
  {
    name: "Opor Ayam Gurih",
    tag: "ISTIMEWA NUSANTARA",
    category: "MAKAN MALAM",
    time: "50 Mnt",
    level: "Sedang",
    desc: "Kuah santan kental dengan aroma ketumbar dan lengkuas yang meresap sempurna.",
    image: "https://images.unsplash.com/photo-1555939594-58d7cb561ad1?auto=format&fit=crop&w=750&q=85",
    color: "#e6332a",
  },
];

const productsData = [
  {
    name: "SASA MSG GURIH",
    tagline: "Penyedap Rasa Murni Sejak 1968",
    desc: "Monosodium Glutamat murni dari tetes tebu alami, rahasia kelezatan masakan rumahan hingga restoran bintang lima.",
    tags: ["✓ 100% Tetes Tebu Alami", "✓ Gurih Seimbang", "✓ Halal MUI"],
    color: "#f1b82d",
    bg: "radial-gradient(circle at 60% 45%, #2a2205 0%, #0d0c07 100%)",
    image: "https://images.unsplash.com/photo-1601050690117-94f5f6fa8bd7?auto=format&fit=crop&w=700&q=85",
  },
  {
    name: "TEPUNG BUMBU",
    tagline: "Kriuk Renyah Tahan 8 Jam",
    desc: "Kombinasi rempah pilihan dengan racikan Platinum Crunch, bikin gorengan tetap renyah tanpa keras.",
    tags: ["✓ Kriuk Tahan 8 Jam", "✓ Bumbu Meresap", "✓ Tanpa Pengawet"],
    color: "#ff9900",
    bg: "radial-gradient(circle at 60% 45%, #301703 0%, #120901 100%)",
    image: "https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?auto=format&fit=crop&w=700&q=85",
  },
  {
    name: "SANTAN KELAPA",
    tagline: "Gurih Alami Buatan Rumah",
    desc: "Diperas dari kelapa tua segar pilihan tanpa pewarna buatan. Aroma wangi pandan kelapa alami yang nikmat.",
    tags: ["✓ Ekstrak Kelapa Segar", "✓ Bebas Kolesterol", "✓ Kental Alami"],
    color: "#087b45",
    bg: "radial-gradient(circle at 60% 45%, #052615 0%, #02120a 100%)",
    image: "https://images.unsplash.com/photo-1604909052743-94e838986d24?auto=format&fit=crop&w=700&q=85",
  },
  {
    name: "SAUS SAMBAL ASLI",
    tagline: "Sensasi Pedas Cabai Pilihan",
    desc: "Diproduksi dari cabai rawit merah segar pilihan yang dipetik langsung dari petani lokal nusantara.",
    tags: ["✓ Cabai Rawit Segar", "✓ Pedas Nendang", "✓ Rasa Mantap"],
    color: "#e6332a",
    bg: "radial-gradient(circle at 60% 45%, #33080b 0%, #140203 100%)",
    image: "https://images.unsplash.com/photo-1601050690597-df0568f70950?auto=format&fit=crop&w=700&q=85",
  },
  {
    name: "KALDU PELEZAT",
    tagline: "Ekstrak Daging Rebusan Lama",
    desc: "Aroma kaldu gurih dari daging segar pilihan yang direbus perlahan, memperkaya rasa masakan kuah.",
    tags: ["✓ Ekstrak Daging Asli", "✓ Rempah Kaya Rasa", "✓ Praktis"],
    color: "#d97706",
    bg: "radial-gradient(circle at 60% 45%, #2e1803 0%, #110901 100%)",
    image: "https://images.unsplash.com/photo-1547592180-85f173990554?auto=format&fit=crop&w=700&q=85",
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
          LIEFMARKET<small>RASA UNTUK INDONESIA</small>
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
    ["Perusahaan", "/company"],
    ["Kehidupan di Sasa", "/life-at-sasa"],
    ["Produk", "/products"],
    ["Resep", "/recipes"],
    ["Food Service", "/food-service"],
    ["Artikel", "/articles"],
    ["Komunitas", "/community"],
    ["Kontak Kami", "/contact"],
    ["FAQ", "/faq"],
  ];
  const productLinks = [
    ["Sasa MSG", "/products/msg"],
    ["Tepung Bumbu", "/products/tepung-bumbu"],
    ["Santan", "/products/santan"],
    ["Saus", "/products/saus"],
    ["Sambal Tradisional", "/products/sambal-tradisional"],
    ["Kaldu", "/products/kaldu"],
  ];

  return (
    <div className="menu-overlay">
      <button className="close-menu" onClick={close}>×</button>
      <div className="menu-main">
        <p className="eyebrow">JELAJAHI SASA</p>
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
          ENAK<br />
          <span>∞</span><br />
          SELAMANYA
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
          RASA UNTUK INDONESIA <span>✦</span>
        </p>
        <h1>
          Bikin Makan<br />
          <em>Makin Berarti.</em>
        </h1>
        <p className="hero-desc">
          Karena rasa bukan sekadar rasa. Ia adalah cerita, tawa, dan kehangatan yang selalu ingin diulang di setiap meja makan keluarga Indonesia.
        </p>
        <div className="hero-actions">
          <a className="red-button" href="#recipes">
            JELAJAHI RESEP <Arrow />
          </a>
          <a className="ghost-button" href="#class">
            COOKING CLASS <Arrow />
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
          <img src="/hero.jpg" alt="Hidangan hangat keluarga" />
        </div>
        <div
          className="hero-badge"
          style={{
            transform: "rotate(-10deg) translate(" + -mouseOffset.x * 1.2 + "px, " + -mouseOffset.y * 1.2 + "px)",
          }}
        >
          100%<br />
          <span>RASA<br />INDONESIA</span>
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
          "BIKIN MAKAN MAKIN BERARTI",
          "100% RASA INDONESIA",
          "GURIH MURNI SEJAK 1968",
          "MASAK PAKAI SASA HABIS TANPA SISA",
        ]}
      />

      <div className="intro">
        <div className="intro-mark">✳</div>
        <p className="eyebrow">SEJAK 1968</p>
        <h2>
          Masak pakai Sasa,<br />
          <em>habis tanpa sisa.</em>
        </h2>
        <p>
          Teman setia keluarga Indonesia selama lebih dari setengah abad untuk menghadirkan rasa gurih murni dan momen kebersamaan yang penuh kehangatan.
        </p>
        <a className="text-link" href="#story">
          BACA CERITA KAMI <Arrow />
        </a>

        <div className="intro-stats">
          <div className="intro-stat-item">
            <strong>56+</strong>
            <span>TAHUN MENEMANI</span>
          </div>
          <div className="intro-stat-item">
            <strong>100%</strong>
            <span>RASA ASLI INDONESIA</span>
          </div>
          <div className="intro-stat-item">
            <strong>34</strong>
            <span>PROVINSI DIJANGKAU</span>
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

  const categories = ["SEMUA", "SARAPAN", "MAKAN SIANG", "MAKAN MALAM", "CAMILAN"];

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
            <p className="eyebrow">DARI DAPUR SASA ✦</p>
            <h2>
              KREASI YANG<br />
              <em>BIKIN RINDU.</em>
            </h2>
            <p className="section-copy">
              Scroll ke bawah untuk menjelajahi kartu resep secara horizontal.
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
                  <span className="recipe-time-pill">⏱ {recipe.time}</span>
                </div>
                <div className="recipe-card-body">
                  <div>
                    <h3>{recipe.name}</h3>
                    <p>{recipe.desc}</p>
                  </div>
                  <div className="recipe-card-foot">
                    <span className="recipe-difficulty">⚡ {recipe.level}</span>
                    <a className="recipe-view-btn" href="/recipes">
                      LIHAT RESEP <Arrow />
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
          <p className="eyebrow">SASA COOKING CLUB ✦</p>
          <h2>
            MASAK ITU<br />
            <em>GEMBIRA.</em>
          </h2>
          <p>
            Belajar langsung teknik memasak dari chef profesional, eksplorasi bumbu rahasia nusantara, dan temukan serunya memasak bersama keluarga tercinta.
          </p>
          <a className="dark-button" href="/community">
            DAFTAR KELAS SEKARANG <Arrow />
          </a>
        </div>

        <div className="class-photo-wrapper">
          <div className="class-photo">
            <img
              src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=1100&q=90"
              alt="Memasak bersama chef Sasa"
            />
          </div>
          <div className="class-floating-badge">
            COOK<br />
            WITH<br />
            LOVE
          </div>
          <div className="class-stats-pill">
            <span>★</span> 4.9/5 Rating dari 50,000+ Alumni
          </div>
        </div>
      </div>

      <KineticMarquee
        theme="dark"
        reverse={true}
        items={[
          "SASA COOKING CLUB",
          "KREASI TANPA BATAS",
          "SEMUA BISA JADI KOKI",
          "RASA YANG SELALU DIRINDUKAN",
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
            RASA YANG<br />
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
                RESEP TERKAIT <Arrow />
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
            src="https://images.unsplash.com/photo-1507048331197-7d4ac70811cf?auto=format&fit=crop&w=1100&q=85"
            alt="Keluarga di meja makan"
          />
        </div>
        <div className="story-copy">
          <p className="eyebrow">CERITA DI BALIK RASA</p>
          <h2>
            Lebih dari<br />
            <em>sekadar bumbu.</em>
          </h2>
          <div className="story-quote-card">
            <p>"Di setiap rumah, selalu ada rasa yang menyatukan. Di setiap rasa, ada cerita yang tak pernah usai."</p>
          </div>
          <p>
            Bagi kami, memasak adalah ungkapan cinta paling tulus. Lewat setiap butir bumbu berkualitas, kami hadir merawat kehangatan keluarga di seluruh penjuru Indonesia.
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
          <i>S</i>
          <span>
            SASA<small>RASA UNTUK INDONESIA</small>
          </span>
        </a>
        <p>
          Untuk setiap masakan yang dibuat<br />
          dengan hati dan kehangatan.
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
          <a href="/company">Tentang Sasa</a>
          <a href="/products">Katalog Produk</a>
          <a href="/recipes">Koleksi Resep</a>
          <a href="/articles">Artikel & Tips</a>
        </div>
        <div>
          <p className="eyebrow">BANTUAN</p>
          <a href="/contact">Kontak Kami</a>
          <a href="/faq">FAQ</a>
          <a href="/community">Komunitas</a>
        </div>
        <div className="newsletter">
          <p className="eyebrow">INSPIRASI RESEP</p>
          <p>
            Dapatkan ide menu masakan baru langsung ke email kamu setiap minggu.
          </p>
          <div className="email-input">
            <span>Ketik alamat email kamu</span>
            <b>→</b>
          </div>
        </div>
      </div>

      <div className="footer-bottom">
        <span>© 2024 SASA INDONESIA. ALL RIGHTS RESERVED.</span>
        <span>MADE WITH RASA IN INDONESIA</span>
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
          LIEFMARKET<small>RASA UNTUK INDONESIA</small>
        </span>
      </div>
      <div className="loader-bottom">
        <span>MENYIAPKAN RASA</span>
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
        <b>BELI<br />SASA</b>
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
