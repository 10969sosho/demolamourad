<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
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
                        Forms\Components\TextInput::make('image')->maxLength(255)
                            ->helperText('Path gambar, contoh: /images/lamourad-3/1.webp'),
                        Forms\Components\ColorPicker::make('color'),
                        Forms\Components\TextInput::make('link')->maxLength(255),
                        Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                        Forms\Components\Textarea::make('desc')->rows(3)->columnSpanFull(),
                        Forms\Components\Toggle::make('is_active')->default(true),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Gambar')->square(),
                Tables\Columns\TextColumn::make('name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category')->badge()->sortable(),
                Tables\Columns\TextColumn::make('tag')->toggleable(),
                Tables\Columns\TextColumn::make('price')->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([
                Tables\Filters\SelectFilter::make('category')->multiple(),
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
