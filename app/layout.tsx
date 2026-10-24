import './globals.css';
import { readContent } from '../lib/store';
import { themeVars } from '../lib/content';

export const dynamic = 'force-dynamic';

export async function generateMetadata() {
  const content = await readContent();
  return {
    title: content.navbar.brandName + content.navbar.brandSub.toUpperCase() + ' — Solusi Perawatan & Produk Asli Terpercaya',
    description: content.hero.description,
  };
}

export default async function RootLayout({ children }: { children: React.ReactNode }) {
  const content = await readContent();
  return (
    <html lang="id">
      <body style={themeVars(content.theme)}>{children}</body>
    </html>
  );
}
