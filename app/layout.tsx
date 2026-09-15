import './globals.css';

export const metadata = {
  title: 'LIEFMARKET — Solusi Perawatan & Produk Asli Terpercaya',
  description: 'Katalog produk perawatan kecantikan, kesehatan herbal, dan kebutuhan keluarga resmi terdaftar BPOM.',
};

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return <html lang="id"><body>{children}</body></html>;
}
