<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Speaker;
use App\Models\Episode;
use App\Models\Partner;
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
        User::updateOrCreate(
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

        // 6. EPISODE CONTOH
        $categoryIds = Category::pluck('id')->toArray();
        $speakerIds = Speaker::pluck('id')->toArray();

        $episodes = [
            [
                'title' => 'Bedah Makan Bergizi Gratis & Tantangannya di Kab. Sikka',
                'slug' => 'bedah-makan-bergizi-gratis-sikka',
                'category_id' => $categoryIds[0],
                'date' => now()->subDays(5),
                'link' => 'https://www.youtube.com/watch?v=example1',
                'img' => 'episodes/default-thumbnail.png',
                'content' => '<h2>Ringkasan Diskusi</h2><p>Episode kali ini membahas mengenai implementasi program makan bergizi gratis di Kabupaten Sikka. Kami mengupas tuntas mengenai kesiapan logistik, anggaran daerah, hingga dampak gizi bagi anak-anak sekolah.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'meta_title' => 'Analisis Makan Bergizi Gratis di Sikka - Teman Cerita NTT',
                'meta_description' => 'Bagaimana kesiapan Kab. Sikka menyambut program makan bergizi? Simak diskusi mendalamnya di sini.',
            ],
            [
                'title' => 'Cerita Para Pendamping: Ketika Janji Kerja Berujung Perbudakan',
                'slug' => 'cerita-pendamping-trafficking-ntt',
                'category_id' => $categoryIds[1],
                'date' => now()->subDays(10),
                'link' => 'https://www.youtube.com/watch?v=example2',
                'img' => 'episodes/default-thumbnail.png',
                'content' => '<h2>Tragedi Human Trafficking</h2><p>NTT masih darurat perdagangan orang. Maria Londa berbagi cerita pilu sekaligus strategi pencegahan dari akar rumput untuk melindungi para calon pekerja migran.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(10),
                'meta_title' => 'Melawan Perbudakan Modern di NTT',
                'meta_description' => 'Edukasi dan cerita nyata perjuangan melawan human trafficking di Nusa Tenggara Timur.',
            ],
            [
                'title' => 'Edukasi Politik: Jari Pintar di Tahun Politik NTT',
                'slug' => 'edukasi-politik-jari-pintar-ntt',
                'category_id' => $categoryIds[2],
                'date' => now()->addDays(2), // DIJADWALKAN TAYANG MASA DEPAN
                'link' => 'https://www.youtube.com/watch?v=example3',
                'img' => 'episodes/default-thumbnail.png',
                'content' => '<p>Menjelang Pilkada, bagaimana warga NTT menyaring informasi hoax di media sosial? Diskusi bersama pakar komunikasi mengenai literasi digital politik.</p>',
                'is_published' => true,
                'published_at' => now()->addDays(2),
                'meta_title' => 'Literasi Politik Digital NTT',
                'meta_description' => 'Tips menghindari hoax politik di media sosial bagi warga NTT.',
            ],
        ];

        foreach ($episodes as $index => $epData) {
            $episode = Episode::updateOrCreate(['slug' => $epData['slug']], $epData);

            // Hubungkan dengan 1-2 narasumber secara acak
            $episode->speakers()->sync([
                $speakerIds[$index % count($speakerIds)],
            ]);
        }
    }
}
