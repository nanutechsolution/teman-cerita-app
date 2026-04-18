<?php

namespace App\Filament\Resources\RedactionMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RedactionMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Anggota Redaksi')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                            
                        TextInput::make('position')
                            ->label('Jabatan')
                            ->placeholder('Contoh: Pemimpin Redaksi, Reporter, dll.')
                            ->required()
                            ->maxLength(255),

                        Select::make('group')
                            ->label('Grup (Kelompok UI)')
                            ->options([
                                'pimpinan' => 'Pimpinan',
                                'editorial' => 'Editorial',
                                'it_sosmed' => 'IT & Sosial Media',
                            ])
                            ->required()
                            ->default('editorial'),

                        FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp']) // Validasi tipe file spesifik
                            ->helperText('Maksimal ukuran file 2MB. Format yang diperbolehkan: JPEG, PNG, WEBP.')
                            ->maxSize(2048) // Maksimal ukuran file 2MB (dalam Kilobyte)
                            ->imageEditor() // Memungkinkan user untuk crop/edit gambar di UI
                            ->directory('redaction-members') // Disimpan ke folder storage/app/public/redaction-members
                            ->columnSpanFull(), // Membuat input foto memanjang penuh

                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->required()
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                    ])
            ]);
    }
}
