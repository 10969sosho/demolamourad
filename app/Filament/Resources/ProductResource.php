<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Produk';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('name')->required()->maxLength(255),
                        Forms\Components\TextInput::make('tag')->maxLength(255),
                        Forms\Components\TextInput::make('category')->required()->maxLength(255),
                        Forms\Components\TextInput::make('time')->label('Brand / Time')->maxLength(255),
                        Forms\Components\TextInput::make('level')->maxLength(255),
                        Forms\Components\TextInput::make('price')->maxLength(255),
                        FileUpload::make('image')
                            ->label('Gambar Produk')
                            ->disk('public')
                            ->directory('uploads/products')
                            ->image()
                            ->imagePreviewHeight('120')
                            ->columnSpanFull(),
                        Forms\Components\ColorPicker::make('color'),
                        Forms\Components\TextInput::make('link')->maxLength(255),
                        Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                        Forms\Components\Textarea::make('desc')->rows(3)->columnSpanFull(),
                    ]),
                    Forms\Components\Grid::make(3)->schema([
                        Forms\Components\Toggle::make('is_active')->label('Aktif di Katalog')->default(true),
                        Forms\Components\Toggle::make('is_featured')
                            ->label('Tampil di Carousel Beranda')
                            ->helperText('Muncul di section Produk Pilihan (horizontal slide)'),
                        Forms\Components\Toggle::make('is_showcase')
                            ->label('Tampil di Coverflow / Sticky Showcase')
                            ->helperText('Muncul di slider coverflow beranda'),
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
                    ->state(function (Product $record): ?string {
                        $img = $record->image;
                        if (! $img) {
                            return asset('/images/liefmarket-32/1.webp');
                        }
                        if (str_starts_with($img, '/') || preg_match('~^https?://~i', $img)) {
                            return asset($img);
                        }
                        return asset('storage/' . $img);
                    })
                    ->checkFileExistence(false),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category')->badge()->sortable(),
                Tables\Columns\TextColumn::make('tag')->toggleable(),
                Tables\Columns\TextColumn::make('price')->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')->label('Aktif'),
                Tables\Columns\ToggleColumn::make('is_featured')->label('Carousel Beranda'),
                Tables\Columns\ToggleColumn::make('is_showcase')->label('Showcase Beranda'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('category')->multiple(),
                Tables\Filters\SelectFilter::make('is_featured')
                    ->label('Carousel Beranda')
                    ->options([1 => 'Ya', 0 => 'Tidak']),
                Tables\Filters\SelectFilter::make('is_showcase')
                    ->label('Showcase Beranda')
                    ->options([1 => 'Ya', 0 => 'Tidak']),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
