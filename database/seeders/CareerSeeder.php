<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    public function run(): void
    {
        $careers = [
            [
                'title' => 'Kontributor Tulisan',
                'slug' => 'kontributor-tulisan',
                'type' => 'Freelance',
                'location' => 'Flores, Sumba, Timor, Alor',
                'description' => 'Kirimkan opini atau laporan warga dari wilayah Anda (Flores, Sumba, Timor, Alor).',
                'apply_link' => '#',
                'is_featured' => false,
                'sort_order' => 1,
            ],
            [
                'title' => 'Reporter Investigasi',
                'slug' => 'reporter-investigasi',
                'type' => 'Full-Time',
                'location' => 'Kupang',
                'description' => 'Berbasis di Kupang. Memiliki kemampuan analisis data dan keberanian dalam mengangkat isu publik.',
                'apply_link' => '#',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Video Editor',
                'slug' => 'video-editor',
                'type' => 'Remote',
                'location' => 'Indonesia',
                'description' => 'Mengolah konten podcast dan shorts Teman Cerita NTT menjadi visual yang agresif dan modern.',
                'apply_link' => '#',
                'is_featured' => false,
                'sort_order' => 3,
            ],
        ];

        foreach ($careers as $career) {
            Career::updateOrCreate(['slug' => $career['slug']], $career);
        }
    }
}