<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\InteractsWithFormActions;
use Filament\Pages\Page;

class ManageSite extends Page implements HasForms
{
    use InteractsWithFormActions;

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationLabel = 'Pengaturan Situs';

    protected static ?string $title = 'Pengaturan Situs';

    protected static string $view = 'filament.pages.manage-site';

    public ?array $data = [];

    /** Form field name => dot path inside SiteSetting::content(). */
    protected const FIELDS = [
        'primaryColor' => 'theme.primaryColor',
        'secondaryColor' => 'theme.secondaryColor',
        'accentColor' => 'theme.accentColor',
        'bgColor' => 'theme.bgColor',
        'textColor' => 'theme.textColor',
        'navbarBg' => 'theme.navbarBg',
        'brandName' => 'navbar.brandName',
        'brandSub' => 'navbar.brandSub',
        'heroTitle' => 'hero.title',
        'heroDescription' => 'hero.description',
        'heroBadge' => 'hero.badge',
        'primaryBtnText' => 'hero.primaryBtnText',
        'primaryBtnLink' => 'hero.primaryBtnLink',
        'secondaryBtnText' => 'hero.secondaryBtnText',
        'secondaryBtnLink' => 'hero.secondaryBtnLink',
        'heroBgImage' => 'hero.bgImage',
        'introTitle' => 'intro.title',
        'introSubtitle' => 'intro.subtitle',
        'introItems' => 'intro.items',
        'contactWhatsapp' => 'contact.whatsapp',
        'contactAddress' => 'contact.address',
        'contactEmail' => 'contact.email',
        'contactHours' => 'contact.hours',
        'footerAbout' => 'footer.about',
        'footerCopyright' => 'footer.copyright',
        'socialLinks' => 'footer.socialLinks',
        'aboutEyebrow' => 'about.eyebrow',
        'aboutTitle' => 'about.title',
        'aboutHeroImage' => 'about.heroImage',
        'aboutStoryEyebrow' => 'about.storyEyebrow',
        'aboutStoryTitle' => 'about.storyTitle',
        'aboutStoryText' => 'about.storyText',
        'aboutStoryQuote' => 'about.storyQuote',
        'aboutStoryImage' => 'about.storyImage',
        'aboutVisionTitle' => 'about.visionTitle',
        'aboutVisionText' => 'about.visionText',
        'aboutMissionItems' => 'about.missionItems',
        'aboutPillarsTitle' => 'about.pillarsTitle',
        'aboutPillars' => 'about.pillars',
        'aboutQualityEyebrow' => 'about.qualityEyebrow',
        'aboutQualityTitle' => 'about.qualityTitle',
        'aboutQualityText' => 'about.qualityText',
        'aboutQualityImage' => 'about.qualityImage',
        'contactPageEyebrow' => 'contact.eyebrow',
        'contactPageTitle' => 'contact.title',
        'contactPageText' => 'contact.text',
        'contactPageHeroImage' => 'contact.heroImage',
        'contactFormTitle' => 'contact.formTitle',
        'contactFormNote' => 'contact.formNote',
        'contactFaqTitle' => 'contact.faqTitle',
        'contactFaq' => 'contact.faq',
    ];

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('settings')->schema([
                    Tab::make('🎨 Warna & Tema')->schema([
                        Grid::make(3)->schema([
                            ColorPicker::make('primaryColor')->label('Primary')->hex(),
                            ColorPicker::make('secondaryColor')->label('Secondary')->hex(),
                            ColorPicker::make('accentColor')->label('Accent')->hex(),
                            ColorPicker::make('bgColor')->label('Background')->hex(),
                            ColorPicker::make('textColor')->label('Text')->hex(),
                            ColorPicker::make('navbarBg')->label('Navbar Background')->hex(),
                        ]),
                    ]),
                    Tab::make('🧭 Navigasi & Branding')->schema([
                        Grid::make(2)->schema([
                            TextInput::make('brandName')->label('Brand Name')->required(),
                            TextInput::make('brandSub')->label('Sub Name')->required(),
                        ]),
                    ]),
                    Tab::make('🚀 Hero & Intro')->schema([
                        Textarea::make('heroTitle')->label('Hero Title')->rows(2)->helperText('Pisahkan baris dengan baris baru'),
                        Textarea::make('heroDescription')->label('Hero Description')->rows(3),
                        Textarea::make('heroBadge')->label('Hero Badge')->rows(3),
                        Grid::make(2)->schema([
                            TextInput::make('primaryBtnText')->label('Primary Button Text'),
                            TextInput::make('primaryBtnLink')->label('Primary Button Link'),
                            TextInput::make('secondaryBtnText')->label('Secondary Button Text'),
                            TextInput::make('secondaryBtnLink')->label('Secondary Button Link'),
                            TextInput::make('heroBgImage')->label('BG Image'),
                        ]),
                        TextInput::make('introTitle')->label('Intro Title')->helperText('Pisahkan baris dengan baris baru'),
                        Textarea::make('introSubtitle')->label('Intro Subtitle')->rows(3),
                        Repeater::make('introItems')
                            ->label('3 Intro Stats')
                            ->schema([
                                TextInput::make('value')->label('Value')->required(),
                                TextInput::make('label')->label('Label')->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(3)
                            ->columnSpanFull(),
                    ]),
                    Tab::make('📞 Kontak & Footer')->schema([
                        Section::make('Informasi Kontak')->schema([
                            Grid::make(2)->schema([
                                TextInput::make('contactWhatsapp')
                                    ->label('Nomor WhatsApp (format: 628xxxxxxxxxx)')
                                    ->helperText('Dipakai tombol pesan produk & form kontak. Contoh: 6281234567890'),
                                TextInput::make('contactEmail')->label('Email'),
                                TextInput::make('contactAddress')->label('Alamat')->columnSpanFull(),
                                TextInput::make('contactHours')->label('Jam Operasional'),
                            ]),
                        ]),
                        Section::make('Footer')->schema([
                            Textarea::make('footerAbout')->label('About')->rows(3),
                            TextInput::make('footerCopyright')->label('Copyright'),
                            Repeater::make('socialLinks')
                                ->label('Sosmed Links')
                                ->schema([
                                    TextInput::make('label')->label('Label')->required(),
                                    TextInput::make('href')->label('Href')->required(),
                                ])
                                ->columns(2)
                                ->columnSpanFull(),
                        ]),
                    ]),
                    Tab::make('🏢 Tentang Kami')->schema([
                        Grid::make(2)->schema([
                            TextInput::make('aboutEyebrow')->label('Eyebrow Hero'),
                            TextInput::make('aboutHeroImage')->label('Gambar Hero'),
                            Textarea::make('aboutTitle')->label('Judul Hero (pisahkan baris dengan baris baru)')->rows(2)->columnSpanFull(),
                        ]),
                        Section::make('Cerita')->schema([
                            Grid::make(2)->schema([
                                TextInput::make('aboutStoryEyebrow')->label('Eyebrow'),
                                TextInput::make('aboutStoryImage')->label('Gambar'),
                                Textarea::make('aboutStoryTitle')->label('Judul (pisahkan baris dengan baris baru)')->rows(2),
                                Textarea::make('aboutStoryQuote')->label('Kutipan')->rows(2),
                                Textarea::make('aboutStoryText')->label('Teks Cerita')->rows(4)->columnSpanFull(),
                            ]),
                        ]),
                        Section::make('Visi & Misi')->schema([
                            TextInput::make('aboutVisionTitle')->label('Judul'),
                            Textarea::make('aboutVisionText')->label('Teks Visi')->rows(3),
                            Repeater::make('aboutMissionItems')
                                ->label('Item Misi')
                                ->schema([
                                    Textarea::make('value')->label('Teks')->rows(2)->required(),
                                ])
                                ->defaultItems(4)
                                ->columnSpanFull(),
                        ]),
                        Section::make('Pilar Keunggulan')->schema([
                            TextInput::make('aboutPillarsTitle')->label('Judul Section'),
                            Repeater::make('aboutPillars')
                                ->label('4 Pilar')
                                ->schema([
                                    Select::make('icon')
                                        ->options([
                                            'shield' => 'Perisai (Shield)',
                                            'leaf' => 'Daun (Leaf)',
                                            'heart' => 'Hati (Heart)',
                                            'star' => 'Bintang (Star)',
                                        ])
                                        ->default('shield'),
                                    TextInput::make('title')->label('Judul')->required(),
                                    Textarea::make('desc')->label('Deskripsi')->rows(2)->required(),
                                ])
                                ->columns(3)
                                ->defaultItems(4)
                                ->columnSpanFull(),
                        ]),
                        Section::make('Standar Kualitas')->schema([
                            Grid::make(2)->schema([
                                TextInput::make('aboutQualityEyebrow')->label('Eyebrow'),
                                TextInput::make('aboutQualityImage')->label('Gambar'),
                                Textarea::make('aboutQualityTitle')->label('Judul (pisahkan baris dengan baris baru)')->rows(2),
                                Textarea::make('aboutQualityText')->label('Teks')->rows(4),
                            ]),
                        ]),
                    ]),
                    Tab::make('💬 Halaman Kontak')->schema([
                        Grid::make(2)->schema([
                            TextInput::make('contactPageEyebrow')->label('Eyebrow Hero'),
                            TextInput::make('contactPageHeroImage')->label('Gambar Hero'),
                            Textarea::make('contactPageTitle')->label('Judul Hero (pisahkan baris dengan baris baru)')->rows(2),
                            Textarea::make('contactPageText')->label('Teks Hero')->rows(3),
                        ]),
                        Section::make('Form & FAQ')->schema([
                            TextInput::make('contactFormTitle')->label('Judul Form'),
                            Textarea::make('contactFormNote')->label('Catatan Form')->rows(2),
                            TextInput::make('contactFaqTitle')->label('Judul FAQ'),
                            Repeater::make('contactFaq')
                                ->label('Item FAQ')
                                ->schema([
                                    TextInput::make('q')->label('Pertanyaan')->required(),
                                    Textarea::make('a')->label('Jawaban')->rows(3)->required(),
                                ])
                                ->columns(2)
                                ->defaultItems(4)
                                ->columnSpanFull(),
                        ]),
                    ]),
                ]),
            ])
            ->statePath('data');
    }

    public function mount(): void
    {
        $content = SiteSetting::content();
        $state = [];

        foreach (self::FIELDS as $field => $path) {
            $state[$field] = data_get($content, $path);
        }

        $this->form->fill($state);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach (self::FIELDS as $field => $path) {
            SiteSetting::set($path, $data[$field] ?? null);
        }

        Notification::make()
            ->success()
            ->title('Pengaturan situs tersimpan')
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Pengaturan')
                ->icon('heroicon-o-check')
                ->submit('save'),
        ];
    }
}
