<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // --- GROUP: GENERAL ---
            [
                'key' => 'site_name',
                'label' => 'Nama Website',
                'value' => 'HighlightNTT',
                'type' => 'text',
                'group' => 'General'
            ],
            // logo
            [
                'key' => 'site_logo',
                'label' => 'Logo Website',
                'value' => 'https://highlightntt.com/logo.png',
                'type' => 'file',
                'group' => 'General'
            ],
            [
                'key' => 'site_tagline',
                'label' => 'Tagline Website',
                'value' => 'Menyoroti Fakta, Menjaga Etika',
                'type' => 'text',
                'group' => 'General'
            ],
            [
                'key' => 'site_description',
                'label' => 'Deskripsi Situs',
                'value' => 'Highlight NTT menyajikan berita dan informasi terkini seputar Nusa Tenggara Timur dengan menjunjung tinggi integritas fakta dan etika jurnalistik.',
                'type' => 'textarea',
                'group' => 'General'
            ],

            [
                'key' => 'site_motto',
                'label' => 'Motto Operasional',
                'value' => 'Suara Independen dari Timur untuk Indonesia.',
                'type' => 'text',
                'group' => 'General'
            ],
            // --- GROUP: SOCIAL & SYNDICATION ---
            [
                'key' => 'rss_feed_url',
                'label' => 'URL RSS Feed',
                'value' => 'https://highlightntt.com/feed',
                'type' => 'text',
                'group' => 'Social'
            ],
            [
                'key' => 'instagram_url',
                'label' => 'Link Instagram',
                'value' => 'https://instagram.com/highlightntt.com',
                'type' => 'text',
                'group' => 'Social'
            ],

            // --- GROUP: CONTACT & WHATSAPP ---
            [
                'key' => 'contact_whatsapp',
                'label' => 'Nomor WhatsApp (Aktif)',
                'value' => '628123456789', // Gunakan format angka tanpa '+' untuk link API
                'type' => 'text',
                'group' => 'Contact'
            ],
            [
                'key' => 'whatsapp_message_default',
                'label' => 'Pesan Otomatis WA',
                'value' => 'Halo Redaksi Highlight NTT, saya ingin memberikan informasi/saran...',
                'type' => 'text',
                'group' => 'Contact'
            ],
            [
                'key' => 'contact_email',
                'label' => 'Email Kontak',
                'value' => 'redaksi@highlightntt.com',
                'type' => 'text',
                'group' => 'Contact'
            ],
            [
                'key' => 'address',
                'label' => 'Alamat Kantor',
                'value' => 'Jl. El Tari, Kota Kupang, Nusa Tenggara Timur',
                'type' => 'textarea',
                'group' => 'Contact'
            ],

            // --- GROUP: SEO ---
            [
                'key' => 'meta_keywords_default',
                'label' => 'Default Keywords SEO',
                'value' => 'berita ntt, highlight ntt, fakta ntt, informasi kupang, rss news ntt',
                'type' => 'text',
                'group' => 'SEO'
            ],
            [
                'key' => 'footer_text',
                'label' => 'Teks Footer',
                'value' => '© Highlight NTT. Menyoroti Fakta, Menjaga Etika.',
                'type' => 'text',
                'group' => 'General'
            ],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
