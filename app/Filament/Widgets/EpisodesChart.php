<?php

namespace App\Filament\Widgets;

use App\Models\Episode;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;

class EpisodesChart extends ChartWidget
{
    use HasWidgetShield;
    protected  ?string $heading = 'Pertumbuhan Konten (30 Hari Terakhir)';
    protected static ?int $sort = 2;
    protected  string $color = 'danger';

    protected function getData(): array
    {
        // Mengambil tren data konten baru dalam 30 hari terakhir
        // Catatan: Ini membutuhkan paket 'flowframe/laravel-trend'
        // Jika tidak ada, kita bisa gunakan agregasi manual sederhana
        $data = Episode::selectRaw('DATE(created_at) as date_label, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupByRaw('DATE(created_at)')
            ->orderBy('date_label', 'asc')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Berita Dibuat',
                    'data' => $data->pluck('count')->toArray(),
                    'fill' => 'start',
                ],
            ],
            'labels' => $data->pluck('date')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
