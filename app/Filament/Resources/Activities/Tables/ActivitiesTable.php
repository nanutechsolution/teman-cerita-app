<?php

namespace App\Filament\Resources\Activities\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ActivitiesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('causer.name')
                    ->label('Pelaku')
                    ->placeholder('Sistem / Guest')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Aksi')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => ucfirst($state))
                    ->searchable(),

                TextColumn::make('subject_type')
                    ->label('Tabel / Modul')
                    ->formatStateUsing(function ($state) {
                        // Mengambil nama class model terakhir (contoh: App\Models\Post -> Post)
                        return class_basename($state);
                    })
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Waktu Kejadian')
                    ->dateTime('d M Y, H:i:s')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                // Filter berdasarkan tabel/model
                SelectFilter::make('subject_type')
                    ->label('Modul')
                    ->options([
                        'App\Models\Post' => 'Artikel/Berita',
                        'App\Models\User' => 'Pengguna',
                        'App\Models\Category' => 'Kategori',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
