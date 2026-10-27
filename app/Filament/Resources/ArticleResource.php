<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Artikel';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('title')->required()->maxLength(255),
                        Forms\Components\TextInput::make('tag')->maxLength(255),
                        Forms\Components\TextInput::make('date')->maxLength(255)
                            ->helperText('Contoh: 12 Okt 2024'),
                        FileUpload::make('image')
                            ->label('Gambar Artikel')
                            ->disk('public')
                            ->directory('uploads/articles')
                            ->image()
                            ->imagePreviewHeight('120')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                        Forms\Components\Toggle::make('is_active')->default(true),
                        Forms\Components\Textarea::make('desc')->rows(3)->columnSpanFull(),
                        Forms\Components\RichEditor::make('content')
                            ->label('Isi Artikel')
                            ->columnSpanFull()
                            ->toolbarButtons(['bold', 'italic', 'underline', 'link', 'orderedList', 'bulletList', 'blockquote', 'h2', 'h3']),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
                    ->square()
                    ->state(function (Article $record): ?string {
                        $img = $record->image;
                        if (! $img) {
                            return asset('/images/liefmarket-32/50.webp');
                        }
                        if (str_starts_with($img, '/') || preg_match('~^https?://~i', $img)) {
                            return asset($img);
                        }
                        return asset('storage/' . $img);
                    })
                    ->checkFileExistence(false),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('tag')->badge()->sortable(),
                Tables\Columns\TextColumn::make('date')->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
