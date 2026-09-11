import './globals.css';

export const metadata = {
  title: 'LIEFMARKET — Bikin Makan Makin Berarti',
  description: 'Rasa Indonesia untuk cerita di meja makan.',
};

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return <html lang="id"><body>{children}</body></html>;
}
