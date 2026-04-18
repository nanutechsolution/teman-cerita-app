<?php

namespace App\Filament\Widgets;

use App\Models\Episode;
use App\Models\Post;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LatestEpisodesWidget extends StatsOverviewWidget
{
    use HasWidgetShield;
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected  ?string $heading = 'Berita Masuk Terakhir';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Post::query()->latest()->limit(5)
            )
            ->columns([
                ImageColumn::make('img')
                    ->label('Media')
                    ->circular(),

                TextColumn::make('title')
                    ->label('Judul')
                    ->limit(50)
                    ->searchable(),

                TextColumn::make('author.name')
                    ->label('Penulis')
                    ->badge()
                    ->color('gray'),

                TextColumn::make('category.name')
                    ->label('Kategori'),

                TextColumn::make('created_at')
                    ->label('Waktu Input')
                    ->dateTime('d M H:i')
                    ->since()
                    ->color('primary'),
            ])
            ->actions([
                Action::make('view')
                    ->label('Lihat')
                    ->url(fn(Post $record): string => route('post.show', $record->slug))
                    ->openUrlInNewTab()
                    ->icon('heroicon-m-arrow-top-right-on-square'),
            ]);
    }
}
