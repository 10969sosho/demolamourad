<?php

namespace App\Filament\Pages;

use App\Filament\Pages\Concerns\InteractsWithSiteSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;

class ManageContact extends Page implements HasForms
{
    use InteractsWithSiteSettings;

    protected static ?string $navigationGroup = 'Pengaturan Situs';

    protected static ?string $navigationLabel = 'Kontak & Footer';

    protected static ?string $title = 'Pengaturan Kontak & Footer';

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected static ?int $navigationSort = 4;

    protected static string $view = 'filament.pages.manage-settings-page';

    /** @return array<string, string> */
    protected function settingFields(): array
    {
        return [
            'contactWhatsapp' => 'contact.whatsapp',
            'contactEmail' => 'contact.email',
            'contactAddress' => 'contact.address',
            'contactHours' => 'contact.hours',
            'footerTagline' => 'footer.tagline',
            'footerAbout' => 'footer.about',
            'footerCopyright' => 'footer.copyright',
            'socialLinks' => 'footer.socialLinks',
            'footerColumns' => 'footer.columns',
            'contactPageEyebrow' => 'contact.eyebrow',
            'contactPageTitle' => 'contact.title',
            'contactPageText' => 'contact.text',
            'contactPageHeroImage' => 'contact.heroImage',
            'contactFormTitle' => 'contact.formTitle',
            'contactFormNote' => 'contact.formNote',
            'contactFaqTitle' => 'contact.faqTitle',
            'contactFaq' => 'contact.faq',
        ];
    }

    protected function getFormSchema(): array
    {
        return [
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
                TextInput::make('footerTagline')->label('Tagline Footer'),
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
                Repeater::make('footerColumns')
                    ->label('Kolom Navigasi Footer')
                    ->schema([
                        TextInput::make('title')->label('Judul Kolom')->required(),
                        Repeater::make('links')
                            ->label('Tautan')
                            ->schema([
                                TextInput::make('label')->label('Label')->required(),
                                TextInput::make('href')->label('Href')->required(),
                            ])
                            ->columns(2)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]),
            Section::make('Halaman Kontak')->schema([
                Grid::make(2)->schema([
                    TextInput::make('contactPageEyebrow')->label('Eyebrow Hero'),
                    FileUpload::make('contactPageHeroImage')->label('Gambar Hero')->disk('public')->directory('uploads/contact')->image()->imagePreviewHeight('120'),
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
        ];
    }
}
