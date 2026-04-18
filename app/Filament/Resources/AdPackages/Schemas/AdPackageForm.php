<?php

namespace App\Filament\Resources\AdPackages\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AdPackageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Paket Iklan')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Paket')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('price_text')
                            ->label('Teks Harga')
                            ->placeholder('Contoh: Mulai dari Rp 500rb/bln')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->columnSpanFull(),

                        Textarea::make('icon')
                            ->label('Kode SVG Icon')
                            ->placeholder('<svg>...</svg>')
                            ->helperText('Paste kode SVG dari heroicons.com di sini')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Pengaturan Tampilan')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        Toggle::make('is_featured')
                            ->label('Jadikan Unggulan (Desain Gelap)'),

                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                    ])->columns(3),
            ]);
    }
}
