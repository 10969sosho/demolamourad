<?php

namespace App\Filament\Pages;

use App\Filament\Pages\Concerns\InteractsWithSiteSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;

class ManageAbout extends Page implements HasForms
{
    use InteractsWithSiteSettings;

    protected static ?string $navigationGroup = 'Pengaturan Situs';

    protected static ?string $navigationLabel = 'Tentang Kami';

    protected static ?string $title = 'Pengaturan Halaman Tentang Kami';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 3;

    protected static string $view = 'filament.pages.manage-settings-page';

    /** @return array<string, string> */
    protected function settingFields(): array
    {
        return [
            'aboutEyebrow' => 'about.eyebrow',
            'aboutTitle' => 'about.title',
            'aboutHeroImage' => 'about.heroImage',
            'aboutStoryEyebrow' => 'about.storyEyebrow',
            'aboutStoryTitle' => 'about.storyTitle',
            'aboutStoryImage' => 'about.storyImage',
            'aboutStoryQuote' => 'about.storyQuote',
            'aboutStoryText' => 'about.storyText',
            'aboutAuthenticityText' => 'about.authenticityText',
            'aboutQualityEyebrow' => 'about.qualityEyebrow',
            'aboutQualityTitle' => 'about.qualityTitle',
            'aboutQualityImage' => 'about.qualityImage',
            'aboutQualityText' => 'about.qualityText',
            'aboutVisionTitle' => 'about.visionTitle',
            'aboutVisionText' => 'about.visionText',
            'aboutMissionItems' => 'about.missionItems',
            'aboutPillarsTitle' => 'about.pillarsTitle',
            'aboutPillars' => 'about.pillars',
            'aboutProductsBtnText' => 'about.productsBtnText',
            'aboutContactBtnText' => 'about.contactBtnText',
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Hero Tentang Kami')->schema([
                Grid::make(2)->schema([
                    TextInput::make('aboutEyebrow')->label('Eyebrow Hero'),
                    FileUpload::make('aboutHeroImage')->label('Gambar Hero')->disk('public')->directory('uploads/about')->image()->imagePreviewHeight('120'),
                    Textarea::make('aboutTitle')->label('Judul Hero (pisahkan baris dengan baris baru)')->rows(2)->columnSpanFull(),
                ]),
            ]),
            Section::make('Cerita')->schema([
                Grid::make(2)->schema([
                    TextInput::make('aboutStoryEyebrow')->label('Eyebrow'),
                    FileUpload::make('aboutStoryImage')->label('Gambar')->disk('public')->directory('uploads/about')->image()->imagePreviewHeight('120'),
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
                        Select::make('icon')->options([
                            'shield' => 'Perisai (Shield)',
                            'leaf' => 'Daun (Leaf)',
                            'heart' => 'Hati (Heart)',
                            'star' => 'Bintang (Star)',
                        ])->default('shield'),
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
                    FileUpload::make('aboutQualityImage')->label('Gambar')->disk('public')->directory('uploads/about')->image()->imagePreviewHeight('120'),
                    Textarea::make('aboutQualityTitle')->label('Judul (pisahkan baris dengan baris baru)')->rows(2),
                    Textarea::make('aboutQualityText')->label('Teks')->rows(4),
                ]),
            ]),
            Section::make('Komitmen & Aksi')->schema([
                Textarea::make('aboutAuthenticityText')->label('Teks Komitmen Autentisitas BPOM')->rows(3),
                Grid::make(2)->schema([
                    TextInput::make('aboutProductsBtnText')->label('Label Tombol Katalog'),
                    TextInput::make('aboutContactBtnText')->label('Label Tombol Kontak'),
                ]),
            ]),
        ];
    }
}
