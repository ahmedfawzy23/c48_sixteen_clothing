<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'title')
                    ->searchable()
                    ->required()
                    ->preload(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->unique()
                    ->required(),
                Textarea::make('description')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->default(0.0)
                    ->minValue(0)
                    ->prefix('$'),
                TextInput::make('stock')
                    ->required()
                    ->minValue(0)
                    ->numeric()
                    ->default(0),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('products'),
                Toggle::make('is_active')
                    ->default(true)
                    ->required(),
                Toggle::make('is_featured')
                    ->default(false)
                    ->required(),
            ]);
    }
}
