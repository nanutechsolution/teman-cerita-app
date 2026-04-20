<?php

namespace App\Filament\Resources\Galleries\Schemas;

use App\Models\Gallery;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()
                    ->schema([
                        // BAGIAN 1: INFORMASI ALBUM GALERI
                        Section::make('Informasi Galeri')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Judul Galeri')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                                TextInput::make('slug')
                                    ->disabled()
                                    ->dehydrated()
                                    ->required()
                                    ->unique(Gallery::class, 'slug', ignoreRecord: true),

                                Textarea::make('description')
                                    ->label('Deskripsi Album')
                                    ->rows(3)
                                    ->columnSpanFull(),

                                FileUpload::make('cover_image')
                                    ->label('Cover Galeri')
                                    ->image()
                                    ->directory('galleries/covers')
                                    ->visibility('public')
                                    ->disk('public')
                                    ->imageEditor()
                                    ->columnSpanFull(),

                                TextInput::make('image_source')
                                    ->label('Sumber Cover (Kredit)')
                                    ->maxLength(255),
                            ])->columns(2),

                        // BAGIAN 2: UPLOAD BANYAK FOTO (MENGGUNAKAN REPEATER)
                        Section::make('Daftar Foto')
                            ->description('Tambahkan foto-foto ke dalam album galeri ini.')
                            ->schema([
                                Repeater::make('images') // 'images' adalah nama fungsi relasi di model Gallery
                                    ->relationship()
                                    ->schema([
                                        FileUpload::make('image_path')
                                            ->label('Unggah Foto')
                                            ->image()
                                            ->directory('galleries/images')
                                            ->required()
                                            ->visibility('public')
                                            ->disk('public')
                                            ->columnSpan([
                                                'md' => 5,
                                            ]),
                                        TextInput::make('caption')
                                            ->label('Caption Foto (Opsional)')
                                            ->maxLength(500)
                                            ->columnSpan([
                                                'md' => 7,
                                            ]),
                                    ])
                                    ->columns([
                                        'md' => 12,
                                    ])
                                    ->orderColumn('sort_order') // Fitur Drag & Drop untuk mengurutkan foto
                                    ->defaultItems(1)
                                    ->addActionLabel('Tambah Foto Lain')
                                    ->collapsible()
                                    ->itemLabel(fn(array $state): ?string => $state['caption'] ?? 'Foto Tanpa Caption'),
                            ]),
                    ])
                    ->columnSpan(['lg' => 2]),

                // SIDEBAR KANAN: STATUS PUBLIKASI
                Group::make()
                    ->schema([
                        Section::make('Status & Publikasi')
                            ->schema([
                                Toggle::make('is_published')
                                    ->label('Publikasikan')
                                    ->default(true),

                                DateTimePicker::make('published_at')
                                    ->label('Tanggal Tayang')
                                    ->default(now())
                                    ->required(),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}
