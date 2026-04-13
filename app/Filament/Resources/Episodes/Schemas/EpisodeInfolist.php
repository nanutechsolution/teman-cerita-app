<?php

namespace App\Filament\Resources\Episodes\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;

class EpisodeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // KOLOM KIRI (Konten & Media Utama)
                Group::make()->schema([

                    Section::make('Informasi Utama')
                        ->schema([
                            TextEntry::make('title')
                                ->hiddenLabel()
                                ->size(TextSize::Large)
                                ->weight(FontWeight::Black)
                                ->columnSpanFull(),

                            Grid::make(2)->schema([
                                TextEntry::make('slug')
                                    ->label('Slug URL')
                                    ->color('gray')
                                    ->icon('heroicon-m-link'),

                                TextEntry::make('excerpt')
                                    ->label('Kutipan Pendek (Lead)')
                                    ->color('gray')
                                    ->columnSpanFull(),
                            ]),
                        ]),

                    Section::make('Media Visual')
                        ->schema([
                            ImageEntry::make('img')
                                ->hiddenLabel()
                                ->size(400)
                                ->disk('public')
                                ->extraImgAttributes(['class' => 'rounded-xl shadow-md w-full object-cover aspect-video'])
                                ->columnSpanFull(),

                            Grid::make(2)->schema([
                                TextEntry::make('image_caption')
                                    ->label('Caption Foto')
                                    ->placeholder('Tidak ada caption.')
                                    ->color('gray'),

                                TextEntry::make('image_source')
                                    ->label('Sumber Foto')
                                    ->badge()
                                    ->color('gray')
                                    ->placeholder('Tidak ada sumber.'),
                            ]),

                            TextEntry::make('link')
                                ->label('URL Eksternal / Video')
                                ->url(fn($record) => $record->link)
                                ->openUrlInNewTab()
                                ->color('danger')
                                ->icon('heroicon-m-play-circle')
                                ->placeholder('Tidak ada link eksternal.')
                                ->columnSpanFull(),
                        ]),

                    Section::make('Isi Berita')
                        ->schema([
                            TextEntry::make('content')
                                ->hiddenLabel()
                                ->html() // Render tag HTML dari RichEditor
                                ->prose() // Menggunakan tailwind typography agar rapi
                                ->columnSpanFull(),
                        ]),

                ])->columnSpan(['lg' => 2]),
                // KOLOM KANAN (Klasifikasi & Editorial)
                Group::make()->schema([

                    Section::make('Klasifikasi')
                        ->schema([
                            TextEntry::make('type')
                                ->label('Format')
                                ->badge()
                                ->color(fn(string $state): string => match ($state) {
                                    'article' => 'info',
                                    'video' => 'danger',
                                    'short' => 'warning',
                                    default => 'gray',
                                })
                                ->formatStateUsing(fn(string $state): string => match ($state) {
                                    'article' => 'Artikel',
                                    'video' => 'Video Panjang',
                                    'short' => 'Shorts',
                                    default => ucfirst($state),
                                }),

                            TextEntry::make('category.name')
                                ->label('Kategori')
                                ->badge()
                                ->color('primary'),

                            TextEntry::make('tags.name')
                                ->label('Tagar')
                                ->badge()
                                ->color('success')
                                ->placeholder('Belum ada tagar.'),

                            TextEntry::make('duration')
                                ->label('Durasi Video')
                                ->icon('heroicon-m-clock')
                                ->placeholder('-'),
                        ])->columns(2),

                    Section::make('Redaksional & Publikasi')
                        ->schema([
                            Grid::make(2)->schema([
                                TextEntry::make('author.name')
                                    ->label('Penulis / Jurnalis')
                                    ->icon('heroicon-m-user')
                                    ->placeholder('Sistem'),

                                TextEntry::make('views')
                                    ->label('Jumlah Tayangan')
                                    ->numeric()
                                    ->icon('heroicon-m-eye'),
                            ]),

                            Grid::make(3)->schema([
                                IconEntry::make('is_published')
                                    ->label('Publish')
                                    ->boolean(),

                                IconEntry::make('is_headline')
                                    ->label('Headline')
                                    ->boolean(),

                                IconEntry::make('is_breaking')
                                    ->label('Breaking')
                                    ->boolean(),
                            ]),

                            Grid::make(2)->schema([
                                TextEntry::make('date')
                                    ->label('Tgl Liputan')
                                    ->date('d M Y')
                                    ->icon('heroicon-m-calendar-days'),

                                TextEntry::make('published_at')
                                    ->label('Tgl Terbit')
                                    ->dateTime('d M Y, H:i')
                                    ->icon('heroicon-m-globe-americas')
                                    ->placeholder('Belum diatur'),
                            ]),
                        ]),

                    Section::make('Meta & SEO')
                        ->schema([
                            TextEntry::make('meta_title')
                                ->label('Meta Title')
                                ->placeholder('-')
                                ->columnSpanFull(),

                            TextEntry::make('meta_keywords')
                                ->label('Keywords')
                                ->placeholder('-')
                                ->columnSpanFull(),

                            TextEntry::make('meta_description')
                                ->label('Description')
                                ->placeholder('-')
                                ->columnSpanFull(),

                            Grid::make(2)->schema([
                                TextEntry::make('created_at')
                                    ->label('Dibuat Pada')
                                    ->dateTime('d M Y, H:i')
                                    ->color('gray'),

                                TextEntry::make('updated_at')
                                    ->label('Diperbarui Pada')
                                    ->dateTime('d M Y, H:i')
                                    ->color('gray'),
                            ]),
                        ])->collapsed(), // Dibuat tertutup (collapse) secara default

                ])->columnSpan(['lg' => 1]),
            ]);
    }
}
