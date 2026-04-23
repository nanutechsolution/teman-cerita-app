<?php

namespace App\Filament\Resources\Comments\Tables;

use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CommentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('post.title')
                    ->label('Berita')
                    ->limit(30) // Agar tidak kepanjangan di tabel
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Nama')
                    ->description(fn($record) => $record->email) // Email muncul kecil di bawah nama
                    ->searchable(),

                TextColumn::make('body')
                    ->label('Komentar')
                    ->limit(50)
                    ->wrap() // Agar teks turun ke bawah jika panjang
                    ->searchable(),

                // Menggunakan ToggleColumn agar bisa langsung approve/reject tanpa buka form
                ToggleColumn::make('is_approved')
                    ->label('Approve')
                    ->disabled(! auth()->user()->can('approve:comment')),

                TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])->defaultSort('created_at', 'desc')
            ->filters([
                TernaryFilter::make('is_approved')
                    ->label('Status Moderasi')
                    ->placeholder('Semua Komentar')
                    ->trueLabel('Sudah Disetujui')
                    ->falseLabel('Belum Disetujui'),
            ])
            ->recordActions([
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('approve')
                        ->action(fn(\Illuminate\Database\Eloquent\Collection $records) => $records->each->update(['is_approved' => true]))
                        ->deselectRecordsAfterCompletion()
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
