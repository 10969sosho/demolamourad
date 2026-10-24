# Lamourad Landing Page

Landing page brand **Lamourad** (tema biru), dibangun dengan Next.js 14 (static export).

## Menjalankan

```bash
npm install
npm run dev
```

## Build (static export)

```bash
npm run build
```

Output statis ada di folder `out/`.

## Deploy

Project menggunakan `output: 'export'` (lihat `next.config.mjs`), sehingga bisa di-deploy ke hosting statis (Netlify, Vercel static, GitHub Pages, dll).
