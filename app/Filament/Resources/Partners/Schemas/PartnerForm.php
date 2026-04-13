<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PartnerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Partner')->schema([
                    TextInput::make('name')
                        ->label('Nama Instansi/Perusahaan')
                        ->required(),
                    
                    Select::make('type')
                        ->label('Tipe Kerjasama')
                        ->options([
                            'Sponsor Utama' => 'Sponsor Utama',
                            'Sponsor' => 'Sponsor',
                            'Media Partner' => 'Media Partner',
                            'Partner' => 'Partner',
                        ])
                        ->required(),

                    TextInput::make('link')
                        ->label('URL Website/Sosmed')
                        ->url()
                        ->placeholder('https://...'),

                    FileUpload::make('logo')
                        ->label('Logo Partner')
                        ->image()
                        ->directory('partners')
                        ->required()
                        ->helperText('Gunakan background transparan (PNG) untuk hasil terbaik.'),
                    
                    Toggle::make('is_active')
                        ->label('Tampilkan di Website')
                        ->default(true),
                ])
            ]);
    }
}
