<?php

namespace App\Filament\Resources\Episodes\Tables;

use App\Models\Episode;
use App\Models\Post;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EpisodesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('img')
                    ->label('Media')
                    ->square()
                    ->size(80)
                    ->extraImgAttributes(['class' => 'rounded-lg shadow-sm object-cover']),

                TextColumn::make('title')
                    ->label('Judul Konten')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->description(fn(Post $record): string => str($record->slug)->limit(40)),

                TextColumn::make('type')
                    ->label('Format')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'article' => 'info',
                        'video' => 'danger',
                        'short' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'article' => 'Artikel',
                        'video' => 'Video Panjang',
                        'short' => 'Shorts',
                        default => ucfirst($state),
                    })
                    ->sortable(),

                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('primary')
                    ->sortable(),

                TextColumn::make('views')
                    ->label('Views')
                    ->numeric()
                    ->sortable()
                    ->icon('heroicon-m-eye')
                    ->color('gray')
                    ->alignEnd(),

                // Fitur Redaksional Interaktif (Inline Edit)
                ToggleColumn::make('is_headline')
                    ->disabled(fn() => !auth()->user()->can('Feature:headline'))
                    ->label('Headline')
                    ->onColor('danger'),

                ToggleColumn::make('is_breaking')
                    ->disabled(fn() => !auth()->user()->can('Feature:breaking'))
                    ->label('Breaking')
                    ->onColor('warning'),

                ToggleColumn::make('is_published')
                    ->disabled(fn() => !auth()->user()->can('Publish:post'))
                    ->label('Publikasi')
                    ->onColor('success'),
                TextColumn::make('author.name')
                    ->label('Penulis')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('date')
                    ->label('Tanggal Rilis')
                    ->date('d M Y')
                    ->sortable()
                    ->icon('heroicon-m-calendar-days')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('link')
                    ->label('Link Eksternal')
                    ->icon('heroicon-m-link')
                    ->color('info')
                    ->url(fn(Post $record): ?string => $record->link)
                    ->openUrlInNewTab()
                    ->formatStateUsing(fn() => 'Buka')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Diinput Pada')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

                SelectFilter::make('is_headline')
                    ->label('Filter Headline')
                    ->placeholder('Semua Konten')
                    ->options([
                        true => 'Headline',
                        false => 'Bukan Headline',
                    ]),
                SelectFilter::make('is_breaking')
                    ->label('Filter Breaking')
                    ->placeholder('Semua Konten')
                    ->options([
                        true => 'Breaking',
                        false => 'Bukan Breaking',
                    ]),
                SelectFilter::make('is_published')
                    ->label('Filter Publikasi')
                    ->placeholder('Semua Konten')
                    ->options([
                        true => 'Sudah Terbit',
                        false => 'Draft / Disembunyikan',
                    ]),
                SelectFilter::make('type')
                    ->label('Format Konten')
                    ->options([
                        'article' => 'Artikel Berita',
                        'video' => 'Video Panjang',
                        'short' => 'YouTube Shorts',
                    ]),

                SelectFilter::make('category_id')
                    ->relationship('category', 'name')
                    ->label('Filter Kategori')
                    ->preload(),

                TernaryFilter::make('is_published')
                    ->label('Status Publikasi')
                    ->placeholder('Semua Konten')
                    ->trueLabel('Sudah Terbit')
                    ->falseLabel('Draft / Disembunyikan'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])->defaultSort('date', 'desc');
    }
}
