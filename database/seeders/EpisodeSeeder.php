<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EpisodeSeeder extends Seeder
{
    /**
     * Jalankan database seeds untuk 20 berita contoh portal berita NTT.
     */
    public function run(): void
    {
        // hapus semua data lama untuk menghindari duplikasi saat seeding ulang
        Post::truncate();

        // 1. Pastikan ada minimal satu User sebagai Penulis (Author)
        $author = User::first() ?? User::factory()->create([
            'name' => 'Admin Redaksi',
            'email' => 'redaksi@highlightntt.com',
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

        // 3. Data 20 Berita/Episode NTT
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
                'is_headline' => true,
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
                'is_headline' => true,
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
            [
                'title' => 'Harga Beras Melambung di Pasar Kasih Naikoten Kupang, Pemprov Siapkan Operasi Pasar',
                'type' => 'article',
                'category_slug' => 'ekonomi',
                'is_headline' => false,
                'is_breaking' => true,
                'views' => 1450,
            ],
            [
                'title' => 'Polemik Tapal Batas Wilayah di Timor Tengah Selatan, Tokoh Adat Turun Tangan',
                'type' => 'article',
                'category_slug' => 'kebijakan-publik',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 670,
            ],
            [
                'title' => 'Mitos vs Fakta Obat Tradisional NTT: Pandangan Medis Modern',
                'type' => 'video',
                'duration' => '28:15',
                'category_slug' => 'podcast',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 850,
            ],
            [
                'title' => 'Menjelajah Pesona Bukit Cinta, Surga Tersembunyi di Rote Ndao',
                'type' => 'video',
                'duration' => '08:45',
                'category_slug' => 'sosial-budaya',
                'is_headline' => true,
                'is_breaking' => false,
                'views' => 3400,
            ],
            [
                'title' => 'Dana Desa untuk Pemberdayaan UMKM Perempuan di Sumba, Sudah Tepat Sasaran?',
                'type' => 'article',
                'category_slug' => 'ekonomi',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 420,
            ],
            [
                'title' => 'KLB Rabies di Kabupaten TTS Menelan Korban Jiwa, Vaksinasi Massal Digelar',
                'type' => 'article',
                'category_slug' => 'kesehatan',
                'is_headline' => true,
                'is_breaking' => true,
                'views' => 5600,
            ],
            [
                'title' => 'Merawat Tradisi Pasola di Sumba: Peran Generasi Muda #pasola #ntt',
                'type' => 'short',
                'duration' => '00:55',
                'category_slug' => 'sosial-budaya',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 2800,
            ],
            [
                'title' => 'Diskusi Panel: Transisi Energi Terbarukan di Kepulauan Sunda Kecil',
                'type' => 'video',
                'duration' => '55:30',
                'category_slug' => 'kebijakan-publik',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 320,
            ],
            [
                'title' => 'Geliat Startup Kopi Manggarai: Dari Kebun Petani Lokal Menuju Kedai Global',
                'type' => 'article',
                'category_slug' => 'ekonomi',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 780,
            ],
            [
                'title' => 'Waspada Demam Berdarah! Kenali Gejala dan Langkah Pencegahan Awal',
                'type' => 'short',
                'duration' => '00:40',
                'category_slug' => 'kesehatan',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 1900,
            ],
        ];

        // 4. Proses Input ke Database
        foreach ($newsData as $data) {
            $category_id = $catIds[$data['category_slug']] ?? null;
            
            // Hapus slug dari array sebelum di-merge karena tidak ada di kolom tabel posts
            unset($data['category_slug']);

            $newPost = Post::create(array_merge($data, [
                'category_id' => $category_id, // Perbaikan: Menambahkan category_id yang sebelumnya hilang
                'slug' => Str::slug($data['title']) . '-' . Str::random(5), // Tambahan random string agar slug pasti unik
                'excerpt' => 'Liputan mendalam mengenai ' . $data['title'] . ' yang sedang menjadi perhatian masyarakat Nusa Tenggara Timur.',
                'content' => '<p>Ini adalah isi berita simulasi untuk <strong>' . $data['title'] . '</strong>.</p><p>Laporan tim redaksi <em>Highlight NTT</em> menunjukkan bahwa isu ini memerlukan perhatian serius dari berbagai stakeholder terkait untuk menemukan solusi jangka panjang yang menguntungkan masyarakat luas.</p><p>Berdasarkan data di lapangan, banyak warga yang masih menantikan langkah konkret dari pihak berwenang. Kami akan terus memperbarui perkembangan isu ini secara berkala.</p>',
                'image_caption' => 'Ilustrasi ' . $data['title'],
                'image_source' => 'Dok. Redaksi Highlight NTT',
                'link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Link dummy
                'is_published' => true,
                'published_at' => now()->subHours(rand(1, 48)), // Acak waktu tayang dari 1 hingga 48 jam yang lalu
                'date' => now()->subHours(rand(1, 48))->toDateString(),
                'author_id' => $author->id,
            ]));

            // Pasangkan dengan 1-2 tag acak (jika TagSeeder sudah dijalankan dan tabel tags tidak kosong)
            if (Tag::count() > 0) {
                $tags = Tag::inRandomOrder()->take(rand(1, 3))->pluck('id');
                $newPost->tags()->attach($tags);
            }
        }
    }
}