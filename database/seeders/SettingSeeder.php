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
                'value' => 'Teman Cerita NTT',
                'type' => 'text',
                'group' => 'General'
            ],
            [
                'key' => 'site_description',
                'label' => 'Deskripsi Situs',
                'value' => 'Kanal berbagi informasi, ide-ide, dan cerita-cerita menarik dari berbagai sudut pandang seputar Nusa Tenggara Timur.',
                'type' => 'textarea',
                'group' => 'General'
            ],
            [
                'key' => 'site_logo',
                'label' => 'Logo Website',
                'value' => 'settings/default-logo.png',
                'type' => 'file',
                'group' => 'General'
            ],
            [
                'key' => 'site_favicon',
                'label' => 'Favicon',
                'value' => 'settings/default-favicon.png',
                'type' => 'file',
                'group' => 'General'
            ],

            // --- GROUP: SOCIAL MEDIA ---
            [
                'key' => 'instagram_url',
                'label' => 'Link Instagram',
                'value' => 'https://instagram.com/temancerita.ntt',
                'type' => 'text',
                'group' => 'Social'
            ],
            [
                'key' => 'youtube_url',
                'label' => 'Link YouTube',
                'value' => 'https://youtube.com/@teman-cerita-ntt',
                'type' => 'text',
                'group' => 'Social'
            ],
            [
                'key' => 'facebook_url',
                'label' => 'Link Facebook',
                'value' => 'https://facebook.com/temancerita.ntt',
                'type' => 'text',
                'group' => 'Social'
            ],
            [
                'key' => 'tiktok_url',
                'label' => 'Link TikTok',
                'value' => 'https://tiktok.com/@temancerita.ntt',
                'type' => 'text',
                'group' => 'Social'
            ],

            // --- GROUP: CONTACT ---
            [
                'key' => 'contact_email',
                'label' => 'Email Kontak',
                'value' => 'halo@temancerita.com',
                'type' => 'text',
                'group' => 'Contact'
            ],
            [
                'key' => 'contact_phone',
                'label' => 'Nomor WhatsApp',
                'value' => '+628123456789',
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

            // --- GROUP: SEO GLOBAL ---
            [
                'key' => 'meta_keywords_default',
                'label' => 'Default Keywords SEO',
                'value' => 'podcast ntt, berita ntt, cerita rakyat ntt, diskusi publik ntt, maumere, kupang, flores',
                'type' => 'text',
                'group' => 'SEO'
            ],
            [
                'key' => 'footer_text',
                'label' => 'Teks Footer',
                'value' => 'Dibuat dengan cinta untuk masyarakat Nusa Tenggara Timur.',
                'type' => 'text',
                'group' => 'General'
            ],
            [
                'key' => 'whatsapp_number',
                'label' => 'Nomor WhatsApp',
                'value' => '+628123456789',
                'type' => 'text',
                'group' => 'Contact'
            ]
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
