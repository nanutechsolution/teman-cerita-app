<?php

namespace App\Filament\Resources\Careers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Ramsey\Collection\Set;

class CareerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Lowongan')
                    ->schema([
                        TextInput::make('title')
                            ->label('Posisi')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn($state, Set $set) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),

                        Select::make('type')
                            ->label('Tipe Pekerjaan')
                            ->options([
                                'Full-Time' => 'Full-Time',
                                'Freelance' => 'Freelance',
                                'Remote' => 'Remote',
                                'Internship' => 'Internship',
                            ])
                            ->required(),

                        TextInput::make('location')
                            ->label('Lokasi')
                            ->placeholder('Contoh: Kupang / Remote'),

                        Textarea::make('description')
                            ->label('Deskripsi Singkat')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('apply_link')
                            ->label('Link Pendaftaran')
                            ->placeholder('URL atau mailto:email@anda.com'),
                    ])->columns(2),

                Section::make('Pengaturan Tampilan')
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Highlight (Desain Gelap)'),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0),
                    ])->columns(3),
            ]);
    }
}
