<?php

namespace App\Filament\Resources\RedactionMembers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class RedactionMembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                 ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular() // Membuat foto berbentuk lingkaran di tabel
                    ->defaultImageUrl(url('/images/placeholder.png')), // Opsional jika foto kosong
                    
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                    
                TextColumn::make('position')
                    ->label('Jabatan')
                    ->searchable(),
                    
                TextColumn::make('group')
                    ->label('Grup')
                    ->badge() // Membuat tampilan UI berupa badge berwarna
                    ->color(fn (string $state): string => match ($state) {
                        'pimpinan' => 'danger',
                        'editorial' => 'success',
                        'it_sosmed' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pimpinan' => 'Pimpinan',
                        'editorial' => 'Editorial',
                        'it_sosmed' => 'IT & Sosial Media',
                        default => $state,
                    })
                    ->searchable(),
                    
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),
                    
                ToggleColumn::make('is_active')
                    ->label('Status Aktif')
                    ->sortable(), // Menggunakan ToggleColumn agar admin bisa klik langsung dari tabel
                    
                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
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
