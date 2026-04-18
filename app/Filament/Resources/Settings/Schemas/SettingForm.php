<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Ubah Nilai')
                    ->description('Silakan sesuaikan nilai pengaturan di bawah ini.')
                    ->schema([
                        TextInput::make('label')
                            ->label('Nama Pengaturan')
                            ->disabled()
                            ->columnSpanFull(),

                        // Input Dinamis Berdasarkan Type
                        TextInput::make('value')
                            ->label('Isi Pengaturan')
                            ->required()
                            ->visible(fn($record) => $record?->type === 'text')
                            ->columnSpanFull(),

                        Textarea::make('value')
                            ->label('Isi Pengaturan')
                            ->required()
                            ->rows(4)
                            ->visible(fn($record) => $record?->type === 'textarea')
                            ->columnSpanFull(),

                        FileUpload::make('value')
                            ->label('Upload File/Logo')
                            ->image()
                            ->directory('settings')
                            ->required()
                            ->visibility('public')
                            ->disk('public')
                            ->imageEditor()
                            ->visible(fn($record) => $record?->type === 'file')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
