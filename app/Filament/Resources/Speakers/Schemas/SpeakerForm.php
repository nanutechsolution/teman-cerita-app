<?php

namespace App\Filament\Resources\Speakers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SpeakerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               Section::make('Profil Narasumber')->schema([
                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->label('Slug URL')
                            ->required()
                            ->unique('speakers', 'slug', ignoreRecord: true),
                    ]),

                    TextInput::make('profession')
                        ->label('Profesi / Jabatan')
                        ->placeholder('Contoh: Aktivis Lingkungan / Akademisi UNDANA')
                        ->required(),

                    Textarea::make('bio')
                        ->label('Biografi Singkat')
                        ->rows(3),

                    FileUpload::make('photo')
                        ->label('Foto Profil')
                        ->image()
                        ->avatar() // Menampilkan bentuk lingkaran
                        ->imageEditor()
                        ->directory('speakers_photos')
                        ->maxSize(1024),
                ]),

                Section::make('Media Sosial')->schema([
                    Grid::make(2)->schema([
                        TextInput::make('instagram')
                            ->label('Username Instagram')
                            ->prefix('@'),
                        TextInput::make('youtube')
                            ->label('Link Channel YouTube')
                            ->url(),
                    ]),
                ])->collapsed(),
            ]);
    }
}
