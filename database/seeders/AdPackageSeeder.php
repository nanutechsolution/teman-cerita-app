<?php

namespace Database\Seeders;

use App\Models\AdPackage;
use Illuminate\Database\Seeder;

class AdPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Display Ads',
                'description' => 'Penempatan Banner di halaman depan, artikel, dan sidebar untuk brand awareness maksimal.',
                'price_text' => 'Mulai dari Rp 500rb/bln',
                'icon' => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16m-7 6h7"/></svg>',
                'is_featured' => false,
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Video Native',
                'description' => 'Integrasi brand ke dalam konten Podcast atau Video Shorts yang agresif di Media Sosial.',
                'price_text' => 'Paket Produksi Tersedia',
                'icon' => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>',
                'is_featured' => true, // Akan menggunakan styling gelap/dark mode
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Advertorial',
                'description' => 'Penulisan artikel berbayar yang dikemas secara jurnalistik untuk mempromosikan layanan Anda.',
                'price_text' => 'Free Social Share',
                'icon' => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>',
                'is_featured' => false,
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($packages as $package) {
            // Menggunakan updateOrCreate agar tidak terjadi duplikat jika seeder dijalankan berulang kali
            AdPackage::updateOrCreate(
                ['name' => $package['name']], 
                $package
            );
        }
    }
}