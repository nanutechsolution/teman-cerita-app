<?php

namespace App\Filament\Resources\Advertisements\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class AdvertisementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Banner')
                    ->width(120)
                    ->height(60),

                TextColumn::make('title')
                    ->label('Nama UMKM')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('position')
                    ->label('Posisi')
                    ->badge()
                    ->color('gray')
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'home_top' => 'Beranda Atas',
                        'home_middle' => 'Beranda Tengah',
                        'sidebar' => 'Sidebar',
                        'footer_top' => 'Footer',
                        default => $state,
                    }),

                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('views')
                    ->label('Tayangan')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('clicks')
                    ->label('Klik')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color('success'),

                TextColumn::make('expired_at')
                    ->label('Kadaluarsa')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->color(fn($state) => $state && $state < now() ? 'danger' : 'gray'),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Hanya Aktif'),
                SelectFilter::make('position')
                    ->label('Filter Posisi')
                    ->options([
                        'home_top' => 'Beranda Atas',
                        'home_middle' => 'Beranda Tengah',
                        'sidebar' => 'Sidebar Berita',
                        'footer_top' => 'Atas Footer',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
