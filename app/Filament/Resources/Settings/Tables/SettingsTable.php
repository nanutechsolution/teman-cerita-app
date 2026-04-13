<?php

namespace App\Filament\Resources\Settings\Tables;

use App\Models\Setting;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->label('Nama Pengaturan')
                    ->searchable()
                    ->sortable()
                    ->description(fn(Setting $record): string => $record->key),

                TextColumn::make('value')
                    ->label('Nilai Saat Ini')
                    ->limit(50)
                    ->formatStateUsing(function ($state, Setting $record) {
                        if ($record->type === 'file') {
                            return '[File/Gambar]';
                        }
                        return $state;
                    }),

                TextColumn::make('group')
                    ->label('Grup')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('group')
                    ->options([
                        'General' => 'Umum',
                        'Social' => 'Media Sosial',
                        'Contact' => 'Kontak',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
