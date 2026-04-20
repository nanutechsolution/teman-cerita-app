<?php

namespace App\Filament\Resources\Advertisements\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AdvertisementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        Section::make('Visual Iklan')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Nama UMKM / Judul Iklan')
                                    ->required()
                                    ->maxLength(255),

                                FileUpload::make('image_path')
                                    ->label('Banner Iklan')
                                    ->image()
                                    ->directory('ads')
                                    ->imageEditor()
                                    ->required()
                                    ->helperText('Rekomendasi ukuran: 728x90 (Horizontal) atau 300x250 (Sidebar)'),

                                TextInput::make('link_url')
                                    ->label('Link Tujuan (WhatsApp/Web)')
                                    ->url()
                                    ->placeholder('https://wa.me/62812...'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Pengaturan & Jadwal')
                            ->schema([
                                Select::make('position')
                                    ->label('Posisi Penempatan')
                                    ->options([
                                        'home_top' => 'Beranda Atas',
                                        'home_middle' => 'Beranda Tengah',
                                        'sidebar' => 'Sidebar Berita',
                                        'footer_top' => 'Atas Footer',
                                    ])
                                    ->required(),

                                Toggle::make('is_active')
                                    ->label('Status Aktif')
                                    ->default(true),

                                DateTimePicker::make('starts_at')
                                    ->label('Mulai Tayang')
                                    ->default(now()),

                                DateTimePicker::make('expired_at')
                                    ->label('Berakhir Pada')
                                    ->helperText('Kosongkan jika ingin tayang selamanya'),
                            ]),

                        Section::make('Statistik')
                            ->schema([
                                Placeholder::make('views')
                                    ->label('Total Tayangan')
                                    ->content(fn($record): string => $record ? number_format($record->views) . ' kali' : '0'),

                                Placeholder::make('clicks')
                                    ->label('Total Klik')
                                    ->content(fn($record): string => $record ? number_format($record->clicks) . ' kali' : '0'),
                            ])
                            ->hidden(fn($operation) => $operation === 'create'),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}
