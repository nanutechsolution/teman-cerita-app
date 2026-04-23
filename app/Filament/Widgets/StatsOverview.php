<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\User;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends StatsOverviewWidget
{
    use HasWidgetShield;
    protected ?string $pollingInterval = '30s';

    protected function getStats(): array
    {
        // 🔥 MASTER STATS (1 query)
        $stats = Post::selectRaw("
    COUNT(*) as total_news,
    COALESCE(SUM(views), 0) as total_views,

    SUM(CASE 
        WHEN published_at IS NOT NULL 
        AND published_at <= NOW() 
        THEN 1 ELSE 0 
    END) as published_news,

    SUM(CASE 
        WHEN published_at IS NULL 
        THEN 1 ELSE 0 
    END) as draft_news,

    SUM(CASE 
        WHEN published_at > NOW() 
        THEN 1 ELSE 0 
    END) as scheduled_news
")->first();

        $totalNews     = (int) $stats->total_news;
        $totalViews    = (int) $stats->total_views;
        $publishedNews = (int) $stats->published_news;
        $draftNews     = (int) $stats->draft_news;
        $scheduledNews = (int) $stats->scheduled_news;

        // 👥 USER
        $totalAuthors = User::count();

        // 📊 VIEWS HARI INI
        $todayViews = Post::whereNotNull('published_at')
            ->whereDate('published_at', today())
            ->sum('views') ?? 0;

        // 📈 PERTUMBUHAN 7 HARI (views)
        $viewsLast7Days = Post::selectRaw("
        DATE(published_at) as date,
        COALESCE(SUM(views),0) as total
    ")
            ->where('published_at', '>=', now()->subDays(6))
            ->groupByRaw('DATE(published_at)')
            ->orderByRaw('DATE(published_at)')
            ->pluck('total')
            ->toArray();

        // fallback biar chart gak kosong
        $viewsChart = $this->normalizeChart($viewsLast7Days);

        // 📊 KONTEN HARI INI
        $todayPosts = Post::whereNotNull('published_at')
            ->whereDate('published_at', today())
            ->count();

        return [

            // 📰 TOTAL KONTEN
            Stat::make('Total Konten', number_format($totalNews))
                ->description("{$publishedNews} terbit • {$draftNews} draft")
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary')
                ->chart($viewsChart),

            // 👁️ TOTAL VIEWS
            Stat::make('Total Tayangan', number_format($totalViews))
                ->description('+' . number_format($todayViews) . ' hari ini')
                ->descriptionIcon('heroicon-m-eye')
                ->color('success')
                ->chart($viewsChart),

            // 🚀 PRODUKTIVITAS
            Stat::make('Posting Hari Ini', number_format($todayPosts))
                ->description('Konten dipublikasikan hari ini')
                ->descriptionIcon('heroicon-m-bolt')
                ->color($todayPosts > 0 ? 'success' : 'warning'),

            // 👥 TIM
            Stat::make('Tim Redaksi', number_format($totalAuthors))
                ->description('Penulis & Admin aktif')
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),
        ];
    }

    /**
     * Normalisasi chart agar selalu 7 data
     */
    private function normalizeChart(array $data): array
    {
        $days = 7;

        if (count($data) < $days) {
            return array_merge(array_fill(0, $days - count($data), 0), $data);
        }

        return array_slice($data, -$days);
    }
}
