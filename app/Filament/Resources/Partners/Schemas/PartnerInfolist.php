<?php

namespace App\Filament\Resources\Partners\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class PartnerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Partner')
                    ->schema([
                        ImageEntry::make('logo')
                            ->hiddenLabel()
                            ->height(100),

                        TextEntry::make('name')
                            ->label('Nama Instansi')
                            ->weight('bold')
                            ->size(TextSize::Large),

                        TextEntry::make('type')
                            ->label('Tipe Kerjasama')
                            ->badge(),

                        TextEntry::make('link')
                            ->label('Website/Sosmed')
                            ->url(fn($record) => $record->link)
                            ->openUrlInNewTab()
                            ->color('primary')
                            ->placeholder('Tidak ada link'),

                        IconEntry::make('is_active')
                            ->label('Status Aktif')
                            ->boolean(),
                    ])->columns(2),
            ]);
    }
}
