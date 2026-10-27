<?php

namespace App\Filament\Pages;

use App\Filament\Pages\Concerns\InteractsWithSiteSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;

class ManageHome extends Page implements HasForms
{
    use InteractsWithSiteSettings;

    protected static ?string $navigationGroup = 'Pengaturan Situs';

    protected static ?string $navigationLabel = 'Beranda';

    protected static ?string $title = 'Pengaturan Beranda';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.pages.manage-settings-page';

    /** @return array<string, string> */
    protected function settingFields(): array
    {
        return [
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
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Hero Beranda')->schema([
                Textarea::make('heroTitle')->label('Hero Title')->rows(2)->helperText('Pisahkan baris dengan baris baru'),
                Textarea::make('heroDescription')->label('Hero Description')->rows(3),
                Textarea::make('heroBadge')->label('Hero Badge')->rows(3),
                Grid::make(2)->schema([
                    TextInput::make('primaryBtnText')->label('Primary Button Text'),
                    TextInput::make('primaryBtnLink')->label('Primary Button Link'),
                    TextInput::make('secondaryBtnText')->label('Secondary Button Text'),
                    TextInput::make('secondaryBtnLink')->label('Secondary Button Link'),
                    FileUpload::make('heroBgImage')
                        ->label('Gambar Hero (kanan)')
                        ->disk('public')
                        ->directory('uploads/hero')
                        ->image()
                        ->imagePreviewHeight('160')
                        ->columnSpanFull(),
                ]),
            ]),
            Section::make('Intro Beranda')->schema([
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
            Section::make('Pengaturan Produk Beranda')
                ->schema([
                    Placeholder::make('product_carousel_info')
                        ->label('')
                        ->content("Produk di carousel beranda diatur di menu 'Produk' dengan mencentang toggle 'Carousel Beranda'."),
                ]),
        ];
    }
}
