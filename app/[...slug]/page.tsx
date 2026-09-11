
export function generateStaticParams() {
  const topSlugs = Object.keys(pages).map((key) => ({ slug: [key] }));
  const productSlugs = ["msg", "tepung-bumbu", "santan", "saus", "sambal-tradisional", "kaldu"].map((sub) => ({
    slug: ["products", sub],
  }));
  return [...topSlugs, ...productSlugs];
}

const pages: Record<string, { title: string; eyebrow: string; text: string; color: string; image: string }> = {
  company: { eyebrow: 'TENTANG LIEFMARKET', title: 'Rasa yang tumbuh bersama Indonesia.', text: 'Sejak 1968, LIEFMARKET hadir menemani keluarga Indonesia membuat hidangan yang penuh cerita.', color: '#ed1c24', image: 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=1200&q=85' },
  'life-at-sasa': { eyebrow: 'KEHIDUPAN DI LIEFMARKET', title: 'Bekerja dengan hati, bertumbuh bersama.', text: 'Di balik setiap rasa, ada orang-orang yang percaya bahwa hal baik selalu dimulai dari kebersamaan.', color: '#f5b61b', image: 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1200&q=85' },
  products: { eyebrow: 'PRODUK LIEFMARKET', title: 'Teman baik untuk setiap masakan.', text: 'Temukan bahan pilihan yang membuat masakan sehari-hari terasa istimewa.', color: '#079acb', image: 'https://images.unsplash.com/photo-1601050690117-94f5f6fa8bd7?auto=format&fit=crop&w=1200&q=85' },
  recipes: { eyebrow: 'INSPIRASI RESEP', title: 'Masak lebih seru, makan lebih lahap.', text: 'Resep mudah dan lezat untuk momen makan yang selalu ingin diulang.', color: '#087b45', image: 'https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&w=1200&q=85' },
  'food-service': { eyebrow: 'FOOD SERVICE', title: 'Rasa konsisten untuk bisnis yang berarti.', text: 'Solusi bumbu profesional untuk dapur yang melayani lebih banyak cerita.', color: '#ed6a00', image: 'https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=1200&q=85' },
  articles: { eyebrow: 'ARTIKEL LIEFMARKET', title: 'Cerita hangat dari meja makan.', text: 'Baca tips, inspirasi, dan cerita yang membuat hidup terasa lebih berbumbu.', color: '#c91620', image: 'https://images.unsplash.com/photo-1507048331197-7d4ac70811cf?auto=format&fit=crop&w=1200&q=85' },
  community: { eyebrow: 'KOMUNITAS LIEFMARKET', title: 'Karena rasa paling nikmat saat dibagi.', text: 'Bergabung dengan keluarga besar LIEFMARKET dan rayakan serunya masak bersama.', color: '#ed1c24', image: 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?auto=format&fit=crop&w=1200&q=85' },
  contact: { eyebrow: 'KONTAK KAMI', title: 'Mari ngobrol soal rasa.', text: 'Punya pertanyaan, ide, atau ingin berkolaborasi? Kami siap mendengar.', color: '#009ed2', image: 'https://images.unsplash.com/photo-1521791055366-0d553872125f?auto=format&fit=crop&w=1200&q=85' },
  faq: { eyebrow: 'FAQ', title: 'Pertanyaan yang sering ditanyakan.', text: 'Temukan jawaban seputar produk, resep, dan cerita Sasa.', color: '#e9a40b', image: 'https://images.unsplash.com/photo-1498837167922-ddd27525d352?auto=format&fit=crop&w=1200&q=85' },
};

export default function InnerPage({ params }: { params: { slug: string[] } }) {
  const key = params.slug.join('/');
  const parent = params.slug[0];
  const detailName = params.slug[1]?.replaceAll('-', ' ').replace(/\b\w/g, (letter) => letter.toUpperCase());
  const page = pages[key] || (detailName ? { ...pages[parent] || pages.products, eyebrow: parent === 'recipes' ? 'RESEP SASA' : 'PRODUK SASA', title: detailName, text: 'Temukan inspirasi, cara penggunaan, dan cerita di balik pilihan favorit keluarga Indonesia.' } : pages[parent] || pages.products);
  return <main className="inner-page" style={{ '--page-color': page.color } as React.CSSProperties}><header className="inner-header"><a href="/" className="logo"><i>L</i><span>LIEFMARKET<small>RASA UNTUK INDONESIA</small></span></a><a href="/" className="back-home">← KEMBALI KE BERANDA</a></header><section className="inner-hero"><div><p className="eyebrow">{page.eyebrow}</p><h1>{page.title}</h1><p>{page.text}</p><a className="dark-button" href="/">JELAJAHI LIEFMARKET <span>→</span></a></div><div className="inner-image"><img src={page.image} alt={page.title} /></div></section><section className="inner-next"><p className="eyebrow">TEMUKAN LEBIH BANYAK</p><h2>Setiap rasa punya<br /><em>ceritanya sendiri.</em></h2><a className="text-link" href="/">KEMBALI KE BERANDA <span>→</span></a></section></main>;
}
