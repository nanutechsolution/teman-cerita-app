<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SettingInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Konfigurasi')
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('label')
                                ->label('Nama'),
                            TextEntry::make('key')
                                ->label('Key Identifikasi')
                                ->fontFamily('mono'),
                        ]),

                        TextEntry::make('value')
                            ->label('Nilai Teks')
                            ->visible(fn($record) => $record->type !== 'file')
                            ->placeholder('-')
                            ->columnSpanFull(),

                        ImageEntry::make('value')
                            ->label('Pratinjau File')
                            ->visible(fn($record) => $record->type === 'file')
                            ->imageHeight(150)
                            ->columnSpanFull(),

                        TextEntry::make('group')
                            ->label('Grup')
                            ->badge(),

                        TextEntry::make('updated_at')
                            ->label('Perubahan Terakhir')
                            ->dateTime(),
                    ]),
            ]);
    }
}
