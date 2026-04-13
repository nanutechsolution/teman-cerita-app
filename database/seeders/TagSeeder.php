<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar tag standar untuk portal berita NTT
        $tags = [
            'Berita Terkini',
            'Nusa Tenggara Timur',
            'Kota Kupang',
            'Kebijakan Publik',
            'Sosial Budaya',
            'Kesehatan',
            'Pendidikan',
            'Ekonomi',
            'Politik',
            'Pariwisata',
            'Hukum & Kriminal',
            'Podcast',
            'Eksklusif',
            'Isu Publik',
            'Opini',
            'Viral'
        ];

        // Looping untuk memasukkan data ke database
        foreach ($tags as $tagName) {
            Tag::firstOrCreate(
                // Kondisi pencarian (agar tidak duplikat jika seeder dijalankan ulang)
                ['slug' => Str::slug($tagName)],
                // Data yang diisi jika belum ada
                ['name' => $tagName]
            );
        }
    }
}