<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;

class EpisodesChart extends ChartWidget
{
    use HasWidgetShield;

    protected ?string $heading = 'Pertumbuhan Konten (30 Hari Terakhir)';
    protected static ?int $sort = 2;
    protected string $color = 'danger';

    protected function getData(): array
    {
        // 🔥 Ambil data mentah
        $rawData = Post::whereNotNull('created_at')
            ->where('created_at', '>=', now()->subDays(29))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupByRaw('DATE(created_at)')
            ->orderBy('date')
            ->pluck('total', 'date')
            ->toArray();

        $labels = [];
        $data   = [];

        // 🔥 Generate 30 hari (biar gak bolong)
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');

            $labels[] = now()->subDays($i)->format('d M');
            $data[]   = $rawData[$date] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Konten Dibuat',
                    'data' => $data,
                    'fill' => 'start',
                    'tension' => 0.4, // biar smooth
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}