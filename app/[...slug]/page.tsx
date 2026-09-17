export function generateStaticParams() {
  const topSlugs = Object.keys(pages).map((key) => ({ slug: [key] }));
  const productSlugs = ["msg", "tepung-bumbu", "santan", "saus", "sambal-tradisional", "kaldu", "viva", "ovale", "dragon", "garnier", "freshcare", "harmony"].map((sub) => ({
    slug: ["products", sub],
  }));
  return [...topSlugs, ...productSlugs];
}

const pages: Record<string, { title: string; eyebrow: string; text: string; color: string; image: string }> = {
  company: { eyebrow: 'TENTANG LIEFMARKET', title: 'Solusi terpercaya produk resmi & original.', text: 'LIEFMARKET hadir melayani keluarga Indonesia dengan jaminan produk perawatan, kosmetik, dan herbal berizin resmi BPOM.', color: '#4a7061', image: '/images/liefmarket-32/70.webp' },
  'life-at-liefmarket': { eyebrow: 'KEHIDUPAN DI LIEFMARKET', title: 'Melayani dengan hati, bertumbuh bersama.', text: 'Di balik setiap produk yang tiba di rumah Anda, ada tim berdedikasi yang menjaga standar keaslian dan mutu terbaik.', color: '#7fa697', image: '/images/liefmarket-3/1.webp' },
  'life-at-sasa': { eyebrow: 'KEHIDUPAN DI LIEFMARKET', title: 'Melayani dengan hati, bertumbuh bersama.', text: 'Di balik setiap produk yang tiba di rumah Anda, ada tim berdedikasi yang menjaga standar keaslian dan mutu terbaik.', color: '#7fa697', image: '/images/liefmarket-3/1.webp' },
  products: { eyebrow: 'PRODUK LIEFMARKET', title: 'Sahabat terbaik untuk perawatan keluarga.', text: 'Temukan berbagai produk perawatan kulit, kecantikan, dan herbal berkualitas dengan jaminan 100% original.', color: '#333735', image: '/images/liefmarket-32/10.webp' },
  recipes: { eyebrow: 'REKOMENDASI LIEFMARKET', title: 'Rawat diri lebih optimal, hidup lebih sehat.', text: 'Rekomendasi paket perawatan dan tips pemakaian untuk hasil maksimal dan aman bagi keluarga.', color: '#567a6d', image: '/images/liefmarket-32/20.webp' },
  'food-service': { eyebrow: 'MITRA BISNIS & GROSIR', title: 'Pasokan resmi untuk usaha dan apotek.', text: 'Solusi pengadaan produk perawatan, obat gosok, dan kosmetik dalam jumlah besar dengan harga kompetitif.', color: '#7fa697', image: '/images/liefmarket-3/2.webp' },
  articles: { eyebrow: 'ARTIKEL & TIPS', title: 'Inspirasi cantik dan sehat setiap hari.', text: 'Baca ulasan produk, tips perawatan wajah, dan khasiat herbal alami untuk kesehatan harian keluarga.', color: '#3a5b4e', image: '/images/liefmarket-32/50.webp' },
  community: { eyebrow: 'KOMUNITAS LIEFMARKET', title: 'Tampil percaya diri bersama komunitas.', text: 'Bergabung dengan keluarga besar LIEFMARKET dan dapatkan promo eksklusif serta tips perawatan.', color: '#4a7061', image: '/images/liefmarket-3/5.webp' },
  contact: { eyebrow: 'KONTAK KAMI', title: 'Kami siap membantu kebutuhan Anda.', text: 'Punya pertanyaan mengenai produk, pesanan grosir, atau kemitraan? Tim kami siap melayani Anda.', color: '#333735', image: '/images/liefmarket-32/2.webp' },
  faq: { eyebrow: 'FAQ', title: 'Pertanyaan yang sering ditanyakan.', text: 'Temukan jawaban seputar keaslian produk BPOM, proses pengiriman, dan cara pemesanan di LiefMarket.', color: '#7fa697', image: '/images/liefmarket-32/30.webp' },
};

export default function InnerPage({ params }: { params: { slug: string[] } }) {
  const key = params.slug.join('/');
  const parent = params.slug[0];
  const detailName = params.slug[1]?.replaceAll('-', ' ').replace(/\b\w/g, (letter) => letter.toUpperCase());
  const page = pages[key] || (detailName ? { ...pages[parent] || pages.products, eyebrow: parent === 'recipes' ? 'REKOMENDASI LIEFMARKET' : 'PRODUK LIEFMARKET', title: detailName, text: 'Temukan keaslian produk, komposisi, dan sertifikasi resmi BPOM untuk pilihan favorit keluarga Indonesia.' } : pages[parent] || pages.products);
  return <main className="inner-page" style={{ '--page-color': page.color } as React.CSSProperties}><header className="inner-header"><a href="/" className="logo"><span className="brand-lief">lief</span><span className="brand-market">market</span></a><a href="/" className="back-home">← KEMBALI KE BERANDA</a></header><section className="inner-hero"><div><p className="eyebrow">{page.eyebrow}</p><h1>{page.title}</h1><p>{page.text}</p><a className="dark-button" href="/">JELAJAHI LIEFMARKET <span>→</span></a></div><div className="inner-image"><img src={page.image} alt={page.title} /></div></section><section className="inner-next"><p className="eyebrow">TEMUKAN LEBIH BANYAK</p><h2>Setiap produk punya<br /><em>kualitas terpercaya.</em></h2><a className="text-link" href="/">KEMBALI KE BERANDA <span>→</span></a></section></main>;
}
