<?php

namespace App\Filament\Pages;

use App\Filament\Pages\Concerns\InteractsWithSiteSettings;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;

class ManageTheme extends Page implements HasForms
{
    use InteractsWithSiteSettings;

    protected static ?string $navigationGroup = 'Pengaturan Situs';

    protected static ?string $navigationLabel = 'Tema & Branding';

    protected static ?string $title = 'Pengaturan Tema & Branding';

    protected static ?string $navigationIcon = 'heroicon-o-paint-brush';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.manage-settings-page';

    /** @return array<string, string> */
    protected function settingFields(): array
    {
        return [
            'siteTitle' => 'site.title',
            'siteDescription' => 'site.description',
            'siteFavicon' => 'site.favicon',
            'fontFamily' => 'theme.fontFamily',
            'primaryColor' => 'theme.primaryColor',
            'secondaryColor' => 'theme.secondaryColor',
            'accentColor' => 'theme.accentColor',
            'bgColor' => 'theme.bgColor',
            'textColor' => 'theme.textColor',
            'navbarBg' => 'theme.navbarBg',
            'navbarText' => 'theme.navbarText',
            'brandName' => 'navbar.brandName',
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Identitas Situs')->schema([
                TextInput::make('siteTitle')
                    ->label('Judul Website (Title Tag)')
                    ->placeholder('LiefMarket — Solusi Perawatan & Produk Asli Terpercaya'),
                Textarea::make('siteDescription')->label('Deskripsi Meta Website')->rows(2),
                FileUpload::make('siteFavicon')
                    ->label('Favicon')
                    ->disk('public')
                    ->directory('uploads/site')
                    ->image()
                    ->imagePreviewHeight('64')
                    ->helperText('Upload favicon, ukuran ideal 32x32 atau 64x64 px.')
                    ->columnSpanFull(),
            ]),
            Section::make('Tipografi & Warna')->schema([
                Select::make('fontFamily')
                    ->label('Font Utama Website')
                    ->options([
                        'Nunito' => 'Nunito (Modern Clean Sans — Rekomendasi)',
                        'Plus Jakarta Sans' => 'Plus Jakarta Sans (Elegan & Geometris)',
                        'Inter' => 'Inter (Modern & Tegas)',
                        'Poppins' => 'Poppins (Ramah & Bulat)',
                        'Comfortaa' => 'Comfortaa (Rounded Unik)',
                    ])
                    ->default('Nunito'),
                Grid::make(4)->schema([
                    ColorPicker::make('primaryColor')->label('Primary Brand')->hex()->default('#173324'),
                    ColorPicker::make('secondaryColor')->label('Secondary')->hex()->default('#244634'),
                    ColorPicker::make('accentColor')->label('Accent / Gold')->hex()->default('#c5a880'),
                    ColorPicker::make('bgColor')->label('Background')->hex()->default('#f4f7f4'),
                    ColorPicker::make('textColor')->label('Teks Utama')->hex(),
                    ColorPicker::make('navbarBg')->label('Background Navbar')->hex()->default('#ffffff'),
                    ColorPicker::make('navbarText')->label('Teks Navbar')->hex()->default('#27352a'),
                ]),
            ]),
            Section::make('Branding')->schema([
                TextInput::make('brandName')
                    ->label('Nama Brand (Logo)')
                    ->default('LiefMarket')
                    ->required()
                    ->helperText('Nama brand utama website untuk logo navbar, loader, dan footer'),
            ]),
        ];
    }
}
