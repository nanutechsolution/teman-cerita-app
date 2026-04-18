<?php

namespace App\Filament\Resources\Activities\Schemas;

use Filament\Infolists\Components\KeyValueEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Spatie\Activitylog\Models\Activity;

class ActivityInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Kejadian')
                    ->schema([
                        TextEntry::make('causer.name')
                            ->label('Pelaku'),
                        TextEntry::make('description')
                            ->label('Aksi')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'created' => 'success',
                                'updated' => 'warning',
                                'deleted' => 'danger',
                                default => 'gray',
                            }),
                        TextEntry::make('subject_type')
                            ->label('Tipe Modul')
                            ->formatStateUsing(fn($state) => class_basename($state)),
                        TextEntry::make('subject_id')
                            ->label('ID Data'),
                        TextEntry::make('created_at')
                            ->label('Waktu Kejadian')
                            ->dateTime('d M Y, H:i:s'),
                    ])->columns(3),

                Section::make('Perubahan Data')
                    ->schema([
                        KeyValueEntry::make('properties.old')
                            ->label('Data Lama (Sebelum diubah)'),

                        KeyValueEntry::make('properties.attributes')
                            ->label('Data Baru (Setelah diubah)'),
                    ])->columns(2)
                    ->visible(fn(Activity $record) => $record->properties->has('old') || $record->properties->has('attributes')),
            ]);
    }
}
