<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Speaker;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Jalankan seed database.
     */
    public function run(): void
    {
        // 1. BUAT AKUN ADMIN UTAMA
        $admin = User::updateOrCreate(
            ['email' => 'admin@temancerita.com'],
            [
                'name' => 'Admin Teman Cerita',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // 2. PENGATURAN GLOBAL (SETTINGS)
        $settings = [
            ['key' => 'site_name', 'label' => 'Nama Website', 'value' => 'Teman Cerita NTT', 'type' => 'text', 'group' => 'General'],
            ['key' => 'site_description', 'label' => 'Deskripsi Situs', 'value' => 'Kanal berbagi informasi, ide, dan cerita dari berbagai sudut pandang seputar Nusa Tenggara Timur.', 'type' => 'textarea', 'group' => 'General'],
            ['key' => 'site_logo', 'label' => 'Logo Website', 'value' => 'settings/default-logo.png', 'type' => 'file', 'group' => 'General'],
            ['key' => 'instagram_url', 'label' => 'Link Instagram', 'value' => 'https://instagram.com/temancerita.ntt', 'type' => 'text', 'group' => 'Social'],
            ['key' => 'youtube_url', 'label' => 'Link YouTube', 'value' => 'https://youtube.com/@teman-cerita-ntt', 'type' => 'text', 'group' => 'Social'],
            ['key' => 'contact_email', 'label' => 'Email Kontak', 'value' => 'halo@temancerita.com', 'type' => 'text', 'group' => 'Contact'],
            ['key' => 'home_focus_category', 'label' => 'Kategori Fokus Beranda (Slug)', 'value' => 'politik', 'type' => 'text', 'group' => 'General'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // 3. KATEGORI ISU
        $categories = [
            ['name' => 'Peristiwa', 'slug' => 'peristiwa'],
            ['name' => 'Opini', 'slug' => 'opini'],
            ['name' => 'Edukasi', 'slug' => 'edukasi'],
            ['name' => 'Politik', 'slug' => 'politik'],
            ['name' => 'Ekonomi', 'slug' => 'ekonomi'],
            ['name' => 'Sosbud', 'slug' => 'sosbud'],
            ['name' => 'Olahraga', 'slug' => 'olahraga'],
            ['name' => 'Nasional', 'slug' => 'nasional'],
            ['name' => 'Internasional', 'slug' => 'internasional'],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // 4. NARASUMBER (SPEAKERS)
        $speakers = [
            [
                'name' => 'Dr. Ahmad Sikka',
                'slug' => 'dr-ahmad-sikka',
                'profession' => 'Akademisi & Pengamat Kebijakan',
                'bio' => 'Dosen senior yang aktif meneliti dampak kebijakan pemerintah terhadap masyarakat lokal di Flores.',
                'instagram' => 'ahmad_sikka',
                'photo' => 'speakers/default-avatar.png',
            ],
            [
                'name' => 'Maria Londa',
                'slug' => 'maria-londa',
                'profession' => 'Aktivis Perlindungan Anak & Perempuan',
                'bio' => 'Pejuang hak-hak perempuan di NTT dengan pengalaman lebih dari 15 tahun di lapangan.',
                'instagram' => 'marialonda_ntt',
                'photo' => 'speakers/default-avatar.png',
            ],
            [
                'name' => 'Yoseph Kupang',
                'slug' => 'yoseph-kupang',
                'profession' => 'Praktisi Ekonomi Kreatif',
                'bio' => 'Founder komunitas kreatif anak muda di Kupang yang berfokus pada digitalisasi UMKM.',
                'youtube' => 'https://youtube.com/yosephcreative',
                'photo' => 'speakers/default-avatar.png',
            ],
        ];

        foreach ($speakers as $speaker) {
            Speaker::updateOrCreate(['slug' => $speaker['slug']], $speaker);
        }

        // 5. SPONSOR & PARTNER
        $partners = [
            ['name' => 'Bank NTT', 'type' => 'Sponsor Utama', 'sort_order' => 1, 'is_active' => true, 'logo' => 'partners/default-partner.png'],
            ['name' => 'Pemerintah Provinsi NTT', 'type' => 'Partner', 'sort_order' => 2, 'is_active' => true, 'logo' => 'partners/default-partner.png'],
            ['name' => 'Radio Suara Kupang', 'type' => 'Media Partner', 'sort_order' => 3, 'is_active' => true, 'logo' => 'partners/default-partner.png'],
        ];

        foreach ($partners as $partner) {
            Partner::updateOrCreate(['name' => $partner['name']], $partner);
        }

        // 6. POST/BERITA CONTOH (Refactored dari Episode)
        // Ambil mapping slug ke ID untuk kategori
        $catMap = Category::pluck('id', 'slug')->toArray();
        $speakerIds = Speaker::pluck('id')->toArray();

        // Data 20 Berita/Post
        $newsData = [
            [
                'title' => 'ISU HANGAT JADI KEBIJAKAN PUBLIK! - Rektor Universitas Nusa Nipa Buka Suara',
                'type' => 'video',
                'duration' => '14:20',
                'category_slug' => 'politik',
                'is_headline' => true,
                'is_breaking' => true,
                'views' => 1250,
            ],
            [
                'title' => 'PUSKESMAS BOGANATAR KAB. SIKKA MANGKRAK, Warga Menjerit Minta Kepastian',
                'type' => 'article',
                'category_slug' => 'peristiwa',
                'is_headline' => true,
                'is_breaking' => true,
                'views' => 497,
            ],
            [
                'title' => 'Cerita Bersama Rektor Universitas Nusa Nipa Maumere: Masa Depan Pendidikan NTT',
                'type' => 'video',
                'duration' => '45:10',
                'category_slug' => 'edukasi',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 2100,
            ],
            [
                'title' => 'Budaya Ngada NTT #bajawa #ngada #budaya - Tradisi yang Tetap Terjaga',
                'type' => 'short',
                'duration' => '00:59',
                'category_slug' => 'sosbud',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 1600,
            ],
            [
                'title' => 'Fenomena Bunuh Diri di NTT. Sehatkah Mental Kita? Tinjauan Psikologi Sosial',
                'type' => 'article',
                'category_slug' => 'opini',
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
                'category_slug' => 'ekonomi',
                'is_headline' => true,
                'is_breaking' => false,
                'views' => 2400,
            ],
            [
                'title' => 'Potret Pendidikan di Perbatasan: Perjuangan Siswa di Atambua Demi Menuntut Ilmu',
                'type' => 'article',
                'category_slug' => 'edukasi',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 890,
            ],
            [
                'title' => 'Inovasi Tenun Ikat Sikka: Bagaimana Menembus Pasar Fashion Internasional?',
                'type' => 'short',
                'duration' => '00:45',
                'category_slug' => 'sosbud',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 1200,
            ],
            [
                'title' => 'Anggaran Stunting NTT: Evaluasi Efektivitas Penyaluran Dana di Tingkat Desa',
                'type' => 'article',
                'category_slug' => 'politik',
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
                'category_slug' => 'peristiwa',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 670,
            ],
            [
                'title' => 'Mitos vs Fakta Obat Tradisional NTT: Pandangan Medis Modern',
                'type' => 'video',
                'duration' => '28:15',
                'category_slug' => 'edukasi',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 850,
            ],
            [
                'title' => 'Menjelajah Pesona Bukit Cinta, Surga Tersembunyi di Rote Ndao',
                'type' => 'video',
                'duration' => '08:45',
                'category_slug' => 'sosbud',
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
                'category_slug' => 'peristiwa',
                'is_headline' => true,
                'is_breaking' => true,
                'views' => 5600,
            ],
            [
                'title' => 'Merawat Tradisi Pasola di Sumba: Peran Generasi Muda #pasola #ntt',
                'type' => 'short',
                'duration' => '00:55',
                'category_slug' => 'sosbud',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 2800,
            ],
            [
                'title' => 'Diskusi Panel: Transisi Energi Terbarukan di Kepulauan Sunda Kecil',
                'type' => 'video',
                'duration' => '55:30',
                'category_slug' => 'politik',
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
                'category_slug' => 'edukasi',
                'is_headline' => false,
                'is_breaking' => false,
                'views' => 1900,
            ],
        ];

        // Looping untuk memasukkan data ke tabel posts
        foreach ($newsData as $data) {
            $catSlug = $data['category_slug'];
            unset($data['category_slug']); // Hapus slug karena tidak ada di tabel posts

            Post::create(array_merge($data, [
                'category_id' => $catMap[$catSlug] ?? array_values($catMap)[0], // Fallback ke kategori pertama jika tidak cocok
                'slug' => Str::slug($data['title']) . '-' . Str::random(5),
                'excerpt' => 'Liputan mendalam mengenai ' . $data['title'] . ' yang sedang menjadi perhatian masyarakat.',
                'content' => '<p>Ini adalah isi berita simulasi untuk <strong>' . $data['title'] . '</strong>.</p><p>Laporan tim redaksi <em>Teman Cerita NTT</em> menunjukkan bahwa isu ini memerlukan perhatian serius dari berbagai stakeholder terkait untuk menemukan solusi jangka panjang yang menguntungkan masyarakat luas.</p>',
                'image_caption' => 'Ilustrasi ' . $data['title'],
                'image_source' => 'Dok. Redaksi Teman Cerita',
                'link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', // Link dummy
                'is_published' => true,
                'published_at' => now()->subHours(rand(1, 48)), // Acak waktu tayang 1 - 48 jam lalu
                'date' => now()->subHours(rand(1, 48))->toDateString(),
                'author_id' => $admin->id,
            ]));
        }
    }
}
