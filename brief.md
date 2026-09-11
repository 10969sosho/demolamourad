Website Design Brief — Sasa.co.id Style
1. Project Overview
Project Type

Brand / Corporate Website FMCG

Design Reference

sasa.co.id

Primary Objective

Membangun website brand yang:

kuat secara visual
mudah dinavigasi
terasa fun dan modern
menonjolkan produk dan makanan
membangun brand awareness
mengarahkan user ke resep, produk, komunitas, dan marketplace
Design Personality
Bold
Playful
Energetic
Warm
Family-oriented
Food-focused
Modern
Indonesian

Website jangan terasa seperti e-commerce marketplace.

Fokus utama:

BRAND
  ↓
INSPIRATION
  ↓
RECIPE
  ↓
PRODUCT
  ↓
COMMUNITY
  ↓
CONVERSION
2. Visual Direction
2.1 Overall Style

Gunakan desain:

full-width section
oversized typography
fotografi makanan besar
warna solid
rounded corners
organic curves
carousel
asymmetrical composition
floating elements

Hindari:

layout terlalu kotak
terlalu banyak border
UI SaaS
gradient berlebihan
shadow berat
typography kecil
card dengan terlalu banyak informasi
3. Color System
3.1 Primary Colors
Token	Hex	Usage
--color-red	#FF0000	Primary brand
--color-dark-red	#C91620	Secondary red
--color-white	#FFFFFF	Main background
--color-black	#222222	Main text
3.2 Accent Colors
Token	Hex	Usage
--color-blue	#009ED2	Product section
--color-yellow	#E9A40B	Cooking class
--color-green	#087B45	Food/product
--color-orange	#ED6A00	Supporting accent
--color-cream	#FDE9E5	Menu / secondary background
3.3 Color Ratio
White       60–70%
Red         15–25%
Accent      10–15%

Warna accent hanya digunakan untuk membedakan section/kategori.

4. Typography
Primary Font
Poppins

Fallback:

Arial
sans-serif
Font Scale
Hero
Desktop:
72–96px
Weight: 800
Line-height: 0.95–1.05
H1
56–72px
Weight: 700–800
H2
40–52px
Weight: 700–800
H3
24–32px
Weight: 700
Body
18–22px
Weight: 400–500
Line-height: 1.5
Small
14–16px
Heading Rules

Heading harus:

bold
pendek
impact tinggi
maksimal 2–3 baris
tight line-height

Contoh:

MASAK PAKAI SASA
HABIS TANPA SISA
5. Layout System
Container
max-width: 1280px
margin: 0 auto
padding: 0 40px

Desktop:

1440px viewport
content ± 1280px

Tablet:

padding: 24px

Mobile:

padding: 16px
6. Spacing System

Gunakan sistem 8px.

8
16
24
32
48
64
80
96
120
160

Section spacing desktop:

80–140px

Jangan membuat semua section rapat.

Whitespace merupakan bagian dari visual identity.

7. Header
Desktop

Header fixed.

┌─────────────────────────────────────────────────────┐
│ LOGO                              ☰   DAFTAR   ⌕     │
└─────────────────────────────────────────────────────┘
Position
position: fixed
top: 0
width: 100%
z-index: 999
height: 80–90px
Default
background: transparent
On Scroll

Background dapat berubah:

rgba(255,255,255,.95)

atau mengikuti background section.

Navigation

Tidak menggunakan horizontal navbar besar.

Gunakan:

Hamburger
Register
Search
8. Hero Section
Purpose

Membuat user langsung mengetahui:

siapa brand ini dan apa yang mereka tawarkan.

Structure
┌────────────────────────────────────────────────────┐
│                                                    │
│  MASSIVE HEADLINE         FOOD / FAMILY IMAGE     │
│                                                    │
│                                                    │
│                         ● ● ● ●                    │
└────────────────────────────────────────────────────┘
Dimension
Desktop:
min-height: 600px
max-height: 720px

Mobile:

min-height: 550px
Background

Gunakan:

foto makanan
keluarga
produk
campaign

Tambahkan overlay bila headline membutuhkan contrast.

Hero Navigation

Position:

bottom: 24–32px
center

Dots:

active = red
inactive = light gray
9. Introduction Section

Setelah hero, tampilkan headline besar.

Masak Pakai Sasa,
Habis Tanpa Sisa

Subtext:

Inspirasi resep lezat untuk setiap
hidangan favorit keluarga.

Alignment:

center
Dimension
padding:
90px 20px

Headline:

color: #FF0000
font-size: 60–72px
font-weight: 800
10. Recipe Category Navigation
Background
#FF0000
Layout
Kreasi Resep Pilihan

│ Sarapan │ Makan Siang │ Camilan │ Makan Malam │
Icon

Style:

outline
white
simple
rounded
Interaction

Hover:

opacity
scale

Active:

white underline / indicator
11. Recipe Showcase
Layout

Gunakan horizontal carousel.

←

[ CARD ]
[ CARD ]
[ CARD ]
[ CARD ]
[ CARD ]

                  →

          [Lihat Semua Menu]
Card
width: 210–240px
border-radius: 20–24px
overflow: hidden
Image

Aspect ratio:

4:5

Image:

object-fit: cover
Bottom Label

Gunakan warna berbeda per card.

Contoh:

Red
Blue
Green
Pink
Orange

Text:

white
semi-bold
center
12. Carousel Behavior

Desktop:

5 cards visible

Tablet:

3 cards

Mobile:

1.3–1.5 cards

Partial card harus tetap terlihat.

Tujuannya memberi indikasi bahwa section bisa di-scroll.

Controls

Desktop:

○ ←
            →

Arrow menggunakan:

red circle
white icon
13. Organic Section System

Ini sangat penting.

Jangan membuat setiap section:

rectangle
rectangle
rectangle
rectangle

Gunakan:

wave
curve
arc
diagonal curve
blob
large radius

Contoh:

WHITE
────────────────╮
                ╰────────────

          YELLOW SECTION

──────────────╮
              ╰────────────────

Implementasi:

border-radius
clip-path
pseudo-element
SVG

Prioritaskan SVG/CSS daripada image untuk bentuk background.

14. Cooking Class Section
Background
#E9A40B
Layout
┌─────────────────────────────────────────────────┐
│                                                 │
│  COOKING CLASS       ┌────────────────────────┐ │
│                      │                        │ │
│  Description         │      COOKING IMAGE    │ │
│                      │                        │ │
│  [Daftar Sekarang]   └────────────────────────┘ │
│                                                 │
└─────────────────────────────────────────────────┘
Left
40%
Right
60%

Image:

border-radius: 20px

Button:

pill
red background
white text
15. Product Section
Background

Dominan:

#009ED2

Gunakan giant curved blue background.

Main Composition
                PRODUCT

          ┌──────────────┐
          │              │
          │ PRODUCT IMAGE│
          │              │
          └──────────────┘

             ←       →

        [ PRODUK NAME ]
Product Image
width:
250–350px

Tambahkan:

circular background
thin outline
soft shadow
16. Product Category Navigation

Bentuk seperti segmented navigation.

┌────────┬──────────┬────────┬────────┬────────────┬────────┐
│ MSG    │ Tepung   │ Santan │ Saus   │ Sambal     │ Kaldu  │
│        │ Bumbu    │        │        │ Tradisional│        │
└────────┴──────────┴────────┴────────┴────────────┴────────┘
Colors
MSG      → Gray
Tepung   → Yellow
Santan   → Green
Saus     → Red
Sambal   → Red
Kaldu    → Orange
Shape
border-radius: 50px
overflow: hidden
17. Product Interaction

Saat user klik kategori:

1. Active category berubah
2. Product image berubah
3. Product title berubah
4. Background tetap
5. Animation 300–500ms

Transition:

fade + slide
18. Footer
Background
#FF0000
Layout
┌─────────────────────────────────────────────────────┐
│                                                     │
│ LOGO                     TAUTAN LANGSUNG            │
│                                                     │
│ Description              Perusahaan                │
│                          Kehidupan di Sasa          │
│ [Email] [Subscribe]      Produk                    │
│                          Resep                     │
│                          Artikel                   │
│                          Komunitas                 │
│                          Kontak Kami               │
│                                                     │
└─────────────────────────────────────────────────────┘
Footer Typography
Heading:
40–48px
800

Body:

16–18px
19. Mega Menu

Saat hamburger diklik:

FULL SCREEN OVERLAY

Layout:

┌─────────────────────┬────────────────────────────────┐
│                     │                                │
│ BERANDA             │ SASA MSG                       │
│ PERUSAHAAN          │ TEPUNG BUMBU                   │
│ KEHIDUPAN DI SASA   │ SANTAN                         │
│ PRODUK              │ SAUS                           │
│ RESEP               │ SAMBAL TRADISIONAL             │
│ FOOD SERVICE        │ KALDU                          │
│ ARTIKEL             │                                │
│ KOMUNITAS           │                                │
│ KONTAK KAMI         │                                │
│ FAQ                 │                                │
│                     │                                │
└─────────────────────┴────────────────────────────────┘
Left Panel
background: #FF0000
color: white
width: 50%
Right Panel
background: #FDE9E5
color: #C91620
width: 50%

Close:

X
top: 30px
right: 30px

Animation:

slide-in
300–500ms
ease-out
20. Marketplace Floating Widget

Floating widget kanan.

Default:

🛒

Saat active:

┌─────────────────────┐
│                     │
│    TOKOPEDIA        │
│                     │
│      SHOPEE         │
│                     │
│      WHATSAPP       │
│                     │
└─────────────────────┘
Position
position: fixed
right: 0
top: 50%

Panel muncul dengan animation:

translateX
fade
21. Floating Chat

Bottom right:

○
Style
width: 50–56px
height: 50–56px
border-radius: 50%
background: white
border: 1px solid #ddd
box-shadow: subtle
22. Back To Top

Bottom left:

↑

Style:

white background
red icon
red border
circle

Muncul setelah scroll:

> 400px
23. Animation Direction

Animation jangan berlebihan.

Gunakan:

fade
slide
scale
opacity

Duration:

250–500ms

Untuk hero:

600–800ms

Carousel:

500ms

Organic section tidak perlu bergerak terus-menerus.

24. Image Direction

Foto harus:

high quality
bright
saturated
appetizing
warm lighting
close-up food
manusia terlihat natural
tidak terlalu stock-photo-looking
Product Photography

Gunakan:

centered product
clean background
high contrast
25. Responsive Design
Desktop
> 1200px

Prioritas:

large typography
large image
wide spacing
multi-column
Tablet
768–1199px

Kurangi:

font size
spacing
number of cards
Mobile
< 768px
Layout
Hero
↓
Intro
↓
Recipe Categories
↓
Recipe Carousel
↓
Cooking Class
↓
Product Carousel
↓
Footer
Mobile Header
LOGO               ☰

DAFTAR dapat dipindahkan ke menu.

26. Component Architecture

Developer sebaiknya membuat component:

Header
HeroSlider
SectionTitle
RecipeCategory
RecipeCard
RecipeCarousel
CampaignSection
CookingClass
ProductCarousel
ProductCategoryTabs
MarketplaceWidget
ChatButton
BackToTop
MegaMenu
Footer
27. Suggested Page Structure
/
├── Home
├── Company
├── Life at Sasa
├── Products
│   ├── MSG
│   ├── Tepung Bumbu
│   ├── Santan
│   ├── Saus
│   ├── Sambal Tradisional
│   └── Kaldu
├── Recipes
│   ├── Breakfast
│   ├── Lunch
│   ├── Snack
│   └── Dinner
├── Food Service
├── Articles
├── Community
├── Contact
└── FAQ
28. UX Principles

Prioritas user:

1. Understand brand
2. Discover recipe
3. Discover product
4. Explore content
5. Join community
6. Purchase product

Setiap section harus punya satu primary action.

Contoh:

Recipe
→ Lihat Semua Menu

Cooking Class
→ Daftar Sekarang

Product
→ Lihat Semua Produk

Article
→ Baca Selengkapnya
29. Design Tokens
:root {
  --red: #FF0000;
  --dark-red: #C91620;

  --blue: #009ED2;
  --yellow: #E9A40B;
  --green: #087B45;
  --orange: #ED6A00;

  --cream: #FDE9E5;

  --white: #FFFFFF;
  --black: #222222;
  --gray: #555555;

  --font-primary: "Poppins", sans-serif;

  --radius-sm: 12px;
  --radius-md: 20px;
  --radius-lg: 30px;
  --radius-pill: 999px;

  --container: 1280px;

  --section-space: 100px;
}
30. Final Art Direction

Website harus terasa seperti:

"Brand FMCG Indonesia yang hidup, berani, fun, dan dekat dengan keluarga."

Bukan:

"Corporate website biasa."

Formula visual
BIG TYPOGRAPHY
        +
FOOD PHOTOGRAPHY
        +
RED BRAND COLOR
        +
ORGANIC SHAPES
        +
CAROUSEL
        +
LARGE WHITESPACE
        +
PLAYFUL UI

Rule paling penting: jangan hanya membuat website dengan warna merah dan Poppins. Karakter Sasa justru berasal dari kombinasi typography oversized + fotografi besar + curved section + warna blok + layout asimetris + carousel.
