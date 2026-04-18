<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Kode Etik Jurnalistik',
                'slug' => 'kode-etik-jurnalistik',
                'content' => '<h2>Kode Etik Jurnalistik</h2><p>Kemerdekaan berpendapat, berekspresi, dan pers adalah hak asasi manusia yang dilindungi Pancasila, Undang-Undang Dasar 1945, dan Deklarasi Universal Hak Asasi Manusia PBB. Wartawan Indonesia menyadari sepenuhnya bahwa kemerdekaan pers perlu mematuhi Kode Etik Jurnalistik.</p>',
                'is_active' => true,
            ],
            [
                'title' => 'Pedoman Pemberitaan Media Siber',
                'slug' => 'pedoman-media-siber',
                'content' => '<h2>Pedoman Pemberitaan Media Siber</h2><p>Kemerdekaan berpendapat, kemerdekaan berekspresi, dan kemerdekaan pers adalah hak asasi manusia yang dilindungi Pancasila, Undang-Undang Dasar 1945, dan Deklarasi Universal Hak Asasi Manusia PBB. Media siber memiliki karakter khusus sehingga memerlukan pedoman agar pengelolaannya dapat dilaksanakan secara profesional, memenuhi fungsi, hak, dan kewajibannya.</p>',
                'is_active' => true,
            ],
            [
                'title' => 'Penafian (Disclaimer)',
                'slug' => 'penafian',
                'content' => '<h2>Penafian (Disclaimer)</h2><p>Semua materi berupa teks, foto, infografis, video, dan materi lain di <strong>Teman Cerita NTT</strong> disediakan secara bebas kepada publik. Segala bentuk kerugian yang mungkin timbul akibat penggunaan informasi di situs ini sepenuhnya adalah tanggung jawab pengguna. Kami berhak melakukan penyuntingan dan menghapus komentar yang mengandung unsur SARA atau provokasi.</p>',
                'is_active' => true,
            ],
            [
                'title' => 'Kebijakan Privasi',
                'slug' => 'kebijakan-privasi',
                'content' => '<h2>Kebijakan Privasi</h2><p>Privasi pengunjung sangat penting bagi kami. Dokumen kebijakan privasi ini menguraikan jenis informasi pribadi yang diterima dan dikumpulkan oleh sistem kami, seperti alamat IP dan cookies (jika ada), serta bagaimana informasi tersebut digunakan. Kami tidak akan pernah menjual informasi pribadi Anda kepada pihak ketiga.</p>',
                'is_active' => true,
            ],
        ];

        foreach ($pages as $page) {
            // Menggunakan updateOrCreate berdasarkan 'slug' agar aman jika dijalankan berulang kali
            Page::updateOrCreate(
                ['slug' => $page['slug']],
                $page
            );
        }
    }
}