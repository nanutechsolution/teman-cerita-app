<?php

namespace Database\Seeders;

use App\Models\Episode;
use App\Models\Category;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EpisodeSeeder extends Seeder
{
    /**
     * Jalankan database seeds untuk 10 berita contoh.
     */
    public function run(): void
    {
        // 1. Pastikan ada minimal satu User sebagai Penulis (Author)
        $author = User::first() ?? User::factory()->create([
            'name' => 'Admin Redaksi',
            'email' => 'redaksi@temancerita.com',
        ]);
        
        // 2. Siapkan Kategori Berita Utama
        $categories = [
            ['name' => 'Kebijakan Publik', 'slug' => 'kebijakan-publik'],
            ['name' => 'Kesehatan', 'slug' => 'kesehatan'],
            ['name' => 'Sosial Budaya', 'slug' => 'sosial-budaya'],
            ['name' => 'Podcast', 'slug' => 'podcast'],
            ['name' => 'Ekonomi', 'slug' => 'ekonomi'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate(['slug' => $cat['slug']], ['name' => $cat['name']]);
        }

        // Ambil ID kategori untuk pemetaan
        $catIds = Category::pluck('id', 'slug')->toArray();

        // 3. Data 10 Berita/Episode (Sebagian berdasarkan screenshot Anda)
        $newsData = [
            [
                'title' => 'ISU HANGAT JADI KEBIJAKAN PUBLIK! - Rektor Universitas Nusa Nipa Buka Suara',
                'type' => 'video',
                'duration' => '14:20',
                'category_slug' => 'kebijakan-publik',
                'is_headline' => true,
                'is_breaking' => true,
                'views' => 1250,
            ],
            [
                'title' => 'PUSKESMAS BOGANATAR KAB. SIKKA MANGKRAK, Warga Menjerit Minta Kepastian',
                'type' => 'article',
                'category_slug' => 'kesehatan',
                'is_headline' => false,
                'is_breaking' => true,
                'views' => 497,
            ],
            [
                'title' => 'Cerita Bersama Rektor Universitas Nusa Nipa Maumere: Masa Depan Pendidikan NTT',
                'type' => 'video',
                'duration' => '45:10',
                'category_slug' => 'podcast',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 2100,
            ],
            [
                'title' => 'Budaya Ngada NTT #bajawa #ngada #budaya - Tradisi yang Tetap Terjaga',
                'type' => 'short',
                'duration' => '00:59',
                'category_slug' => 'sosial-budaya',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 1600,
            ],
            [
                'title' => 'Fenomena Bunuh Diri di NTT. Sehatkah Mental Kita? Tinjauan Psikologi Sosial',
                'type' => 'article',
                'category_slug' => 'sosial-budaya',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 3200,
            ],
            [
                'title' => 'Dampak Kekeringan di Flores Timur: Petani Jagung Terancam Gagal Panen Total',
                'type' => 'article',
                'category_slug' => 'ekonomi',
                'is_headline' => false,
                'is_breaking' => true,
                'views' => 540,
            ],
            [
                'title' => 'Pariwisata Labuan Bajo: Antara Konservasi Komodo dan Target Wisatawan Masif',
                'type' => 'video',
                'duration' => '12:05',
                'category_slug' => 'kebijakan-publik',
                'is_headline' => true,
                'is_breaking' => false,
                'views' => 2400,
            ],
            [
                'title' => 'Potret Pendidikan di Perbatasan: Perjuangan Siswa di Atambua Demi Menuntut Ilmu',
                'type' => 'article',
                'category_slug' => 'sosial-budaya',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 890,
            ],
            [
                'title' => 'Inovasi Tenun Ikat Sikka: Bagaimana Menembus Pasar Fashion Internasional?',
                'type' => 'short',
                'duration' => '00:45',
                'category_slug' => 'sosial-budaya',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 1200,
            ],
            [
                'title' => 'Anggaran Stunting NTT: Evaluasi Efektivitas Penyaluran Dana di Tingkat Desa',
                'type' => 'article',
                'category_slug' => 'ekonomi',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 310,
            ],
        ];

        // 4. Proses Input ke Database
        foreach ($newsData as $data) {
            $category_id = $catIds[$data['category_slug']] ?? null;
            unset($data['category_slug']);

            $newEpisode = Episode::create(array_merge($data, [
                'slug' => Str::slug($data['title']),
                'excerpt' => 'Liputan mendalam mengenai ' . $data['title'] . ' yang sedang menjadi perhatian masyarakat NTT.',
                'content' => '<p>Ini adalah isi berita simulasi untuk <strong>' . $data['title'] . '</strong>.</p><p>Laporan tim redaksi <em>Teman Cerita</em> menunjukkan bahwa isu ini memerlukan perhatian serius dari berbagai stakeholder terkait untuk menemukan solusi jangka panjang.</p>',
                'image_caption' => 'Visualisasi dari ' . $data['title'],
                'image_source' => 'Tim Produksi Teman Cerita',
                'link' => 'https://www.youtube.com/watch?v=example',
                'is_published' => true,
                'published_at' => now(),
                'date' => now(),
                'author_id' => $author->id,
            ]));

            // Pasangkan dengan 1-2 tag acak (jika TagSeeder sudah dijalankan)
            if (Tag::count() > 0) {
                $tags = Tag::inRandomOrder()->take(rand(1, 2))->pluck('id');
                $newEpisode->tags()->attach($tags);
            }
        }
    }
}