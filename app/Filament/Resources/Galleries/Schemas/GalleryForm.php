<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                FileUpload::make('cover_image')
                    ->image(),
                FileUpload::make('image_source')
                    ->image(),
                Toggle::make('is_published')
                    ->required(),
                DateTimePicker::make('published_at'),
                Select::make('author_id')
                    ->relationship('author', 'name'),
                Select::make('editor_id')
                    ->relationship('editor', 'name'),
            ]);
    }
}
