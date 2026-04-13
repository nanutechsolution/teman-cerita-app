<?php

namespace App\Filament\Resources\RedactionMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class RedactionMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),
                TextInput::make('position')
                    ->label('Jabatan')
                    ->placeholder('Contoh: Pemimpin Redaksi')
                    ->required(),
                Select::make('group')
                    ->label('Grup Struktur')
                    ->options([
                        'pimpinan' => 'Dewan Pimpinan / Penanggung Jawab',
                        'editorial' => 'Tim Editorial & Produksi',
                        'it_sosmed' => 'Teknologi & Media Baru',
                    ])
                    ->required(),
                FileUpload::make('photo')
                    ->label('Foto Profil (Opsional)')
                    ->image()
                    ->directory('redaksi_photos')
                    ->disk('public'),
                TextInput::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }
}
