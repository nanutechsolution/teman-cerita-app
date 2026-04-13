<?php

namespace App\Filament\Widgets;

use App\Models\Episode;
use App\Models\User;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    use HasWidgetShield;
    /**
     * Interval update widget (opsional)
     */
    protected  ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        // Menghitung metrik utama
        $totalNews = Episode::count();
        $totalViews = Episode::sum('views');
        $publishedNews = Episode::where('is_published', true)->count();
        $totalAuthors = User::count();

        return [
            Stat::make('Total Konten', $totalNews)
                ->description('Semua artikel & video')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('info')
                ->chart([7, 12, 10, 3, 15, 4, 17]), // Data dummy untuk visual chart

            Stat::make('Total Tayangan', number_format($totalViews))
                ->description('Kumulatif pembaca')
                ->descriptionIcon('heroicon-m-eye')
                ->color('success')
                ->chart([10, 20, 15, 30, 45, 50, 60]),

            Stat::make('Status Terbit', $publishedNews)
                ->description($totalNews - $publishedNews . ' Berita masih draft')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color($publishedNews > 0 ? 'success' : 'warning'),

            Stat::make('Tim Redaksi', $totalAuthors)
                ->description('Kontributor & Admin')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),
        ];
    }
}
