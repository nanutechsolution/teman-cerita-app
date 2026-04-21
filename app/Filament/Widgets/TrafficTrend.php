<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TrafficTrend extends StatsOverviewWidget
{
    use HasWidgetShield;
    protected ?string $heading = 'Tren Traffic 7 Hari Terakhir';
    protected static ?int $sort = 3;

    protected function getStats(): array
    {
        // 🔥 7 hari terakhir
        $current = Post::whereNotNull('published_at')
            ->whereBetween('published_at', [
                now()->subDays(6)->startOfDay(),
                now()->endOfDay()
            ])
            ->sum('views');

        // 🔥 7 hari sebelumnya
        $previous = Post::whereNotNull('published_at')
            ->whereBetween('published_at', [
                now()->subDays(13)->startOfDay(),
                now()->subDays(7)->endOfDay()
            ])
            ->sum('views');

        // 🔥 Hitung growth %
        $growth = $previous > 0
            ? (($current - $previous) / $previous) * 100
            : ($current > 0 ? 100 : 0);

        $growthFormatted = number_format($growth, 1) . '%';

        // 🔥 Chart 7 hari terakhir (rapi & gak bolong)
        $raw = Post::whereNotNull('published_at')
            ->where('published_at', '>=', now()->subDays(6))
            ->selectRaw('DATE(published_at) as date, SUM(views) as total')
            ->groupByRaw('DATE(published_at)')
            ->pluck('total', 'date')
            ->toArray();

        $chart = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chart[] = $raw[$date] ?? 0;
        }

        return [
            Stat::make('Traffic 7 Hari', number_format($current))
                ->description(
                    ($growth >= 0 ? 'Naik ' : 'Turun ') . $growthFormatted . ' dari minggu lalu'
                )
                ->descriptionIcon(
                    $growth >= 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-arrow-trending-down'
                )
                ->color($growth >= 0 ? 'success' : 'danger')
                ->chart($chart),
        ];
    }
}