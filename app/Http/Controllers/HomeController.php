<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\NavMenu;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Sub pages ported from the Next.js app/[...slug]/page.tsx.
     *
     * @var array<string, array{eyebrow: string, title: string, text: string, color: string, image: string}>
     */
    private const PAGES = [
        'company' => ['eyebrow' => 'TENTANG LIEFMARKET', 'title' => 'Solusi terpercaya produk resmi & original.', 'text' => 'LIEFMARKET hadir melayani keluarga Indonesia dengan jaminan produk perawatan, kosmetik, dan herbal berizin resmi BPOM.', 'color' => '#4a5770', 'image' => '/images/liefmarket-32/70.webp'],
        'life-at-liefmarket' => ['eyebrow' => 'KEHIDUPAN DI LIEFMARKET', 'title' => 'Melayani dengan hati, bertumbuh bersama.', 'text' => 'Di balik setiap produk yang tiba di rumah Anda, ada tim berdedikasi yang menjaga standar keaslian dan mutu terbaik.', 'color' => '#7f8ca6', 'image' => '/images/liefmarket-3/1.webp'],
        'products' => ['eyebrow' => 'PRODUK LIEFMARKET', 'title' => 'Sahabat terbaik untuk perawatan keluarga.', 'text' => 'Temukan berbagai produk perawatan kulit, kecantikan, dan herbal berkualitas dengan jaminan 100% original.', 'color' => '#333735', 'image' => '/images/liefmarket-32/10.webp'],
        'recipes' => ['eyebrow' => 'REKOMENDASI LIEFMARKET', 'title' => 'Rawat diri lebih optimal, hidup lebih sehat.', 'text' => 'Rekomendasi paket perawatan dan tips pemakaian untuk hasil maksimal dan aman bagi keluarga.', 'color' => '#56627a', 'image' => '/images/liefmarket-32/20.webp'],
        'food-service' => ['eyebrow' => 'MITRA BISNIS & GROSIR', 'title' => 'Pasokan resmi untuk usaha dan apotek.', 'text' => 'Solusi pengadaan produk perawatan, obat gosok, dan kosmetik dalam jumlah besar dengan harga kompetitif.', 'color' => '#7f8ca6', 'image' => '/images/liefmarket-3/2.webp'],
        'articles' => ['eyebrow' => 'ARTIKEL & TIPS', 'title' => 'Inspirasi cantik dan sehat setiap hari.', 'text' => 'Baca ulasan produk, tips perawatan wajah, dan khasiat herbal alami untuk kesehatan harian keluarga.', 'color' => '#3a455b', 'image' => '/images/liefmarket-32/50.webp'],
        'community' => ['eyebrow' => 'KOMUNITAS LIEFMARKET', 'title' => 'Tampil percaya diri bersama komunitas.', 'text' => 'Bergabung dengan keluarga besar LIEFMARKET dan dapatkan promo eksklusif serta tips perawatan.', 'color' => '#4a5770', 'image' => '/images/liefmarket-3/5.webp'],
        'contact' => ['eyebrow' => 'KONTAK KAMI', 'title' => 'Kami siap membantu kebutuhan Anda.', 'text' => 'Punya pertanyaan mengenai produk, pesanan grosir, atau kemitraan? Tim kami siap melayani Anda.', 'color' => '#333735', 'image' => '/images/liefmarket-32/2.webp'],
        'faq' => ['eyebrow' => 'FAQ', 'title' => 'Pertanyaan yang sering ditanyakan.', 'text' => 'Temukan jawaban seputar keaslian produk BPOM, proses pengiriman, dan cara pemesanan di LiefMarket.', 'color' => '#7f8ca6', 'image' => '/images/liefmarket-32/30.webp'],
    ];

    public function index(): View
    {
        $content = SiteSetting::content();
        $products = Product::where('is_active', true)->orderBy('sort_order')->get();

        $navLinks = $this->navLinks($content);

        $showcase = $products->map(fn (Product $p) => [
            'name' => $p->name,
            'tagline' => $p->tag,
            'desc' => $p->desc,
            'tags' => array_values(array_filter(['✓ '.$p->category, '✓ '.$p->level, '✓ '.$p->price])),
            'color' => $p->color,
            'bg' => 'radial-gradient(circle at 60% 45%, '.$p->color.'66 0%, #1f242d 100%)',
            'image' => $p->image,
        ])->values()->all();

        return view('home', [
            'content' => $content,
            'products' => $products,
            'articles' => Article::where('is_active', true)->orderBy('sort_order')->get(),
            'menuLinks' => $navLinks,
            'showcase' => $showcase,
            'categories' => array_values(array_unique(array_merge(['SEMUA'], $products->pluck('category')->all()))),
        ]);
    }

    public function products(): View
    {
        $content = SiteSetting::content();
        $products = Product::where('is_active', true)->orderBy('sort_order')->get();

        return view('products', [
            'content' => $content,
            'menuLinks' => $this->navLinks($content),
            'whatsapp' => (string) data_get($content, 'contact.whatsapp', ''),
            'products' => $products->map(fn (Product $p) => [
                'id' => $p->id,
                'name' => $p->name,
                'tag' => $p->tag,
                'category' => $p->category,
                'brand' => $p->time,
                'level' => $p->level,
                'desc' => $p->desc,
                'image' => $p->image,
                'color' => $p->color,
                'price' => $p->price,
                'priceValue' => (int) preg_replace('/\D/', '', (string) $p->price),
            ])->values(),
            'categories' => array_values(array_unique(array_filter($products->pluck('category')->all()))),
        ]);
    }

    public function about(): View
    {
        $content = SiteSetting::content();

        return view('about', [
            'content' => $content,
            'about' => data_get($content, 'about', []),
            'menuLinks' => $this->navLinks($content),
        ]);
    }

    public function contact(): View
    {
        $content = SiteSetting::content();

        return view('contact', [
            'content' => $content,
            'contact' => data_get($content, 'contact', []),
            'menuLinks' => $this->navLinks($content),
            'whatsapp' => (string) data_get($content, 'contact.whatsapp', ''),
        ]);
    }

    /**
     * @return array<int, array{label: string, href: string}>
     */
    private function navLinks(array $content): array
    {
        $navLinks = NavMenu::where('is_active', true)->orderBy('sort_order')->get(['label', 'href'])
            ->map->toArray()
            ->all();

        if ($navLinks === []) {
            $navLinks = data_get($content, 'navbar.links', []);
        }

        return $navLinks;
    }

    public function subpage(string $slug, ?string $child = null): View
    {
        $content = SiteSetting::content();
        $key = $child !== null ? $slug.'/'.$child : $slug;
        $detailName = $child !== null ? ucwords(str_replace('-', ' ', $child)) : null;
        $parent = self::PAGES[$slug] ?? null;

        if (isset(self::PAGES[$key])) {
            $page = self::PAGES[$key];
        } elseif ($detailName !== null) {
            $page = [
                'eyebrow' => $slug === 'recipes' ? 'REKOMENDASI LIEFMARKET' : 'PRODUK LIEFMARKET',
                'title' => $detailName,
                'text' => 'Temukan keaslian produk, komposisi, dan sertifikasi resmi BPOM untuk pilihan favorit keluarga Indonesia.',
            ] + ($parent ?? self::PAGES['products']);
        } else {
            $page = $parent ?? self::PAGES['products'];
        }

        return view('subpage', [
            'content' => $content,
            'page' => $page,
        ]);
    }
}
