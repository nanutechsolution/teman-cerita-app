<?php

namespace App\Filament\Resources\Episodes\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Filament\Infolists\Components\Split;

class EpisodeInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Menggunakan Split untuk desain Dashboard/Layout modern (Kiri lebar, Kanan sidebar)

                    // ==========================================
                    // KOLOM KIRI (Konten & Media Utama)
                    // ==========================================
                    Group::make([
                        Section::make('Informasi Utama')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                TextEntry::make('title')
                                    ->hiddenLabel()
                                    ->size(TextSize::Large)
                                    ->weight(FontWeight::Black)
                                    ->color('primary')
                                    ->columnSpanFull(),

                                TextEntry::make('excerpt')
                                    ->hiddenLabel()
                                    ->color('gray')
                                    ->columnSpanFull(),

                                Grid::make(2)->schema([
                                    TextEntry::make('slug')
                                        ->label('Slug URL')
                                        ->color('gray')
                                        ->icon('heroicon-m-link')
                                        ->copyable() // UI Modern: Bisa di-copy dengan 1 klik
                                        ->copyMessage('Slug berhasil disalin!')
                                        ->copyMessageDuration(1500),

                                    TextEntry::make('link')
                                        ->label('URL Eksternal / Video')
                                        ->url(fn($record) => $record->link)
                                        ->openUrlInNewTab()
                                        ->color('danger')
                                        ->icon('heroicon-m-play-circle')
                                        ->placeholder('Tidak ada link eksternal.')
                                        ->copyable(),
                                ]),
                            ]),

                        Section::make('Media Visual')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                ImageEntry::make('img')
                                    ->hiddenLabel()
                                    ->width('100%') // Membuat gambar responsif penuh
                                    ->height('auto')
                                    ->disk('public')
                                    ->extraImgAttributes([
                                        'class' => 'rounded-xl shadow-lg w-full object-cover aspect-video border border-gray-200 dark:border-white/10'
                                    ])
                                    ->columnSpanFull(),

                                Grid::make(2)->schema([
                                    TextEntry::make('image_caption')
                                        ->label('Caption Foto')
                                        ->placeholder('Tidak ada caption.')
                                        ->color('gray')
                                        ->inlineLabel(), // UI Modern: Label di samping nilai

                                    TextEntry::make('image_source')
                                        ->label('Sumber Foto')
                                        ->badge()
                                        ->color('gray')
                                        ->placeholder('Tidak ada sumber.')
                                        ->inlineLabel(),
                                ]),
                            ]),

                        Section::make('Isi Berita')
                            ->icon('heroicon-o-newspaper')
                            ->collapsible() // Bisa di-collapse agar tidak makan tempat jika konten panjang
                            ->schema([
                                TextEntry::make('content')
                                    ->hiddenLabel()
                                    ->html()
                                    ->prose()
                                    ->columnSpanFull(),
                            ]),

                            Section::make('Data Polling Berita')
                            ->icon('heroicon-o-chart-bar')
                            ->collapsible()
                            // Sembunyikan section ini jika berita tidak memiliki polling
                            ->hidden(fn ($record) => ! $record->poll)
                            ->schema([
                                Grid::make(2)->schema([
                                    TextEntry::make('poll.question')
                                        ->label('Pertanyaan')
                                        ->size(TextSize::Large)
                                        ->weight(FontWeight::Bold)
                                        ->columnSpanFull(),

                                    IconEntry::make('poll.is_active')
                                        ->label('Status Polling')
                                        ->boolean()
                                        ->trueIcon('heroicon-o-check-circle')
                                        ->falseIcon('heroicon-o-x-circle'),

                                    TextEntry::make('poll.closed_at')
                                        ->label('Batas Waktu')
                                        ->dateTime('d M Y, H:i')
                                        ->placeholder('Tanpa batas waktu')
                                        ->color('warning'),
                                ]),

                                // Menampilkan Opsi Jawaban beserta perolehan suaranya
                                RepeatableEntry::make('poll.options')
                                    ->label('Hasil Suara')
                                    ->schema([
                                        Grid::make(2)->schema([
                                            TextEntry::make('name')
                                                ->hiddenLabel()
                                                ->weight(FontWeight::Medium),
                                            TextEntry::make('votes_count')
                                                ->hiddenLabel()
                                                ->badge()
                                                ->color('success')
                                                ->formatStateUsing(fn (string $state): string => $state . ' Suara')
                                                ->alignEnd(),
                                        ])
                                    ])
                                    ->columns(1)
                                    ->columnSpanFull(),
                            ]),
                        // ==========================================
                    ])->grow(), // ->grow() memastikan kolom kiri mengambil sisa ruang maksimal

                    // ==========================================
                    // KOLOM KANAN (Klasifikasi, Sidebar & SEO)
                    // ==========================================
                    Group::make([
                        Section::make('Klasifikasi')
                            ->icon('heroicon-o-tag')
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
                            ]),

                        Section::make('Status & Editorial')
                            ->icon('heroicon-o-check-badge')
                            ->schema([
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
                                ])->columnSpanFull(),

                                TextEntry::make('author.name')
                                    ->label('Jurnalis')
                                    ->icon('heroicon-m-user')
                                    ->placeholder('Sistem'),

                                TextEntry::make('views')
                                    ->label('Tayangan')
                                    ->numeric()
                                    ->badge()
                                    ->color('gray')
                                    ->icon('heroicon-m-eye'),

                                TextEntry::make('date')
                                    ->label('Tgl Liputan')
                                    ->date('d M Y')
                                    ->icon('heroicon-m-calendar-days'),

                                TextEntry::make('published_at')
                                    ->label('Tgl Terbit')
                                    ->dateTime('d M Y, H:i')
                                    ->badge()
                                    ->color('success')
                                    ->icon('heroicon-m-globe-americas')
                                    ->placeholder('Belum diatur'),
                            ])->columns(2), // Membuat data editorial tampil dalam 2 kolom rapat

                        Section::make('Meta & SEO')
                            ->icon('heroicon-o-magnifying-glass')
                            ->collapsed()
                            ->compact() // UI Modern: Mode compact mengurangi padding
                            ->schema([
                                TextEntry::make('meta_title')
                                    ->label('Title')
                                    ->placeholder('-')
                                    ->weight(FontWeight::SemiBold),

                                TextEntry::make('meta_keywords')
                                    ->label('Keywords')
                                    ->placeholder('-')
                                    ->color('primary'),

                                TextEntry::make('meta_description')
                                    ->label('Description')
                                    ->placeholder('-')
                                    ->color('gray'),

                                TextEntry::make('created_at')
                                    ->label('Dibuat Pada')
                                    ->dateTime('d M Y, H:i')
                                    ->size(TextSize::Small)
                                    ->color('gray'),

                                TextEntry::make('updated_at')
                                    ->label('Diperbarui Pada')
                                    ->dateTime('d M Y, H:i')
                                    ->size(TextSize::Small)
                                    ->color('gray'),
                            ]),
                    ]),
            ]);
    }
}
