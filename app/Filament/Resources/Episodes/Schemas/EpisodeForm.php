<?php

namespace App\Filament\Resources\Episodes\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class EpisodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Informasi Utama')
                        ->description('Judul, ringkasan, dan isi lengkap dari berita atau konten.')
                        ->schema([
                            TextInput::make('title')
                                ->label('Judul Berita / Episode')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                            TextInput::make('slug')
                                ->label('Slug URL')
                                ->required()
                                ->unique(ignoreRecord: true)
                                ->maxLength(255),

                            Textarea::make('excerpt')
                                ->label('Kutipan Pendek (Lead/Excerpt)')
                                ->helperText('Ringkasan 1-2 kalimat yang akan muncul di halaman depan (Home).')
                                ->rows(3)
                                ->maxLength(500),
                            RichEditor::make('content')
                                ->label('Isi Berita / Deskripsi Lengkap')
                                ->fileAttachmentsDirectory('episodes_content')
                                ->required(),
                        ]),

                    Section::make('Media Visual')
                        ->schema([
                            FileUpload::make('img')
                                ->label('Thumbnail Utama')
                                ->helperText('Format: JPG, PNG, atau WebP. Maksimal ukuran file: 2MB.')
                                ->image()
                                ->imageEditor()
                                ->visibility('public')
                                ->disk('public')
                                ->directory('episode')
                                ->imageEditorAspectRatioOptions(['16:9', '9:16', '1:1'])
                                ->maxSize(2048)
                                ->maxFiles(1)
                                ->helperText('Maximal 1 file. Format yang diperbolehkan: JPG, PNG, WEBP. Ukuran maksimal 2MB.')
                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                ->required()
                                ->columnSpanFull(),

                            Grid::make(2)->schema([
                                TextInput::make('image_caption')
                                    ->label('Caption / Keterangan Foto')
                                    ->maxLength(255),

                                TextInput::make('image_source')
                                    ->label('Sumber Foto (Hak Cipta)')
                                    ->helperText('Contoh: Dok. Pribadi, Antara Foto, dll.')
                                    ->maxLength(255),
                            ]),

                            TextInput::make('link')
                                ->label('URL Eksternal (Video YouTube / TikTok)')
                                ->helperText('Kosongkan jika ini hanya artikel teks biasa.')
                                ->url()
                                ->columnSpanFull(),
                        ]),

                    Section::make('Search Engine Optimization (SEO)')
                        ->description('Pengaturan tag meta untuk Google dan Media Sosial.')
                        ->schema([
                            TextInput::make('meta_title')
                                ->label('Meta Title')
                                ->helperText('Bisa dikosongkan. Otomatis memakai Judul utama jika kosong.')
                                ->maxLength(255),

                            TextInput::make('meta_keywords')
                                ->label('Meta Keywords')
                                ->helperText('Pisahkan dengan koma. Contoh: berita ntt, kupang, gubernur')
                                ->maxLength(255),

                            Textarea::make('meta_description')
                                ->label('Meta Description')
                                ->rows(3)
                                ->maxLength(255)
                                ->columnSpanFull(),
                        ])->columns(2)->collapsed(),

                ])->columnSpan(['lg' => 2]),
                // KOLOM KANAN (Sidebar Pengaturan)
                Group::make()->schema([

                    Section::make('Klasifikasi & Format')
                        ->schema([
                            Select::make('type')
                                ->label('Format Konten')
                                ->options([
                                    'article' => 'Artikel Berita',
                                    'video' => 'Video Panjang (16:9)',
                                    'short' => 'Video Shorts (9:16)',
                                ])
                                ->default('article')
                                ->required(),

                            Select::make('category_id')
                                ->relationship(name: 'category', titleAttribute: 'name')
                                ->label('Kategori Isu')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->createOptionForm([
                                    TextInput::make('name')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                    TextInput::make('slug')
                                        ->required()
                                        ->unique('categories', 'slug'),
                                ]),

                            Select::make('tags')
                                ->relationship('tags', 'name')
                                ->label('Tagar (Tags)')
                                ->multiple()
                                ->preload()
                                ->searchable()
                                ->createOptionForm([
                                    TextInput::make('name')
                                        ->required()
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                                    TextInput::make('slug')
                                        ->required()
                                        ->unique('tags', 'slug'),
                                ]),

                            TextInput::make('duration')
                                ->label('Durasi Video')
                                ->helperText('Contoh: 14:20 atau 00:59. Khusus konten video.')
                                ->maxLength(10),

                            Select::make('speakers')
                                ->relationship('speakers', 'name')
                                ->label('Narasumber Terkait')
                                ->multiple()
                                ->preload()
                                ->searchable(),
                        ]),

                    Section::make('Penempatan Redaksional')
                        ->schema([
                            Toggle::make('is_headline')
                                ->label('Jadikan Headline')
                                ->helperText('Tampilkan di gambar paling besar di Beranda.')
                                ->disabled(fn() => !auth()->user()->can('Feature:headline')),

                            Toggle::make('is_breaking')
                                ->label('Kilas Berita (Breaking News)')
                                ->helperText('Munculkan di teks berjalan (ticker).')
                                ->disabled(fn() => !auth()->user()->can('Feature:breaking')),
                        ]),

                    Section::make('Pengaturan Publikasi')
                        ->schema([
                            Select::make('author_id')
                                ->relationship('author', 'name')
                                ->label('Penulis / Jurnalis')
                                ->default(fn() => auth()->id())
                                ->searchable()
                                ->preload(),

                            DatePicker::make('date')
                                ->label('Tanggal Liputan')
                                ->default(now())
                                ->required(),

                            Toggle::make('is_published')
                                ->label('Status: Publish')
                                ->default(false)
                                ->disabled(fn() => !auth()->user()->can('Publish:post'))
                                ->live() // 1. Buat toggle menjadi reaktif (trigger update ke server tanpa reload)
                                ->afterStateUpdated(function (Set $set, $state) {
                                    // 2. Jika toggle diaktifkan (true), set published_at ke waktu sekarang
                                    if ($state) {
                                        $set('published_at', now());
                                    } else {
                                        // Opsional: Jika toggle dimatikan, kosongkan kembali jadwal tayang
                                        $set('published_at', null);
                                    }
                                }),

                            DateTimePicker::make('published_at')
                                ->label('Jadwal Tayang (Otomatis)')
                                ->helperText('Biarkan kosong jika ingin tayang sekarang juga.')
                                ->seconds(false),
                        ]),

                ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }
}
