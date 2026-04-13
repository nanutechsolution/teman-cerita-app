<?php

namespace Database\Seeders;

use App\Models\RedactionMember;
use Illuminate\Database\Seeder;

class RedactionMemberSeeder extends Seeder
{
    /**
     * Jalankan database seeds untuk anggota redaksi.
     */
    public function run(): void
    {
        $members = [
            // --- GRUP PIMPINAN ---
            [
                'name' => 'John Doe, S.Sos.',
                'position' => 'Pemimpin Umum',
                'group' => 'pimpinan',
                'sort_order' => 1,
            ],
            [
                'name' => 'Maria G. Putri, M.I.Kom.',
                'position' => 'Pemimpin Redaksi / Penanggung Jawab',
                'group' => 'pimpinan',
                'sort_order' => 2,
            ],
            [
                'name' => 'Stefanus Jemadu',
                'position' => 'Pemimpin Perusahaan',
                'group' => 'pimpinan',
                'sort_order' => 3,
            ],

            // --- GRUP EDITORIAL ---
            [
                'name' => 'Andreas Kurniawan',
                'position' => 'Redaktur Pelaksana',
                'group' => 'editorial',
                'sort_order' => 4,
            ],
            [
                'name' => 'Yoseph B. L.',
                'position' => 'Editor Isu Publik',
                'group' => 'editorial',
                'sort_order' => 5,
            ],
            [
                'name' => 'Theresia L. Kedang',
                'position' => 'Reporter Kota Kupang',
                'group' => 'editorial',
                'sort_order' => 6,
            ],
            [
                'name' => 'Fransiskus Xaverius',
                'position' => 'Reporter Maumere & Sikka',
                'group' => 'editorial',
                'sort_order' => 7,
            ],
            [
                'name' => 'Ignatius Loyola',
                'position' => 'Visual & Videografer',
                'group' => 'editorial',
                'sort_order' => 8,
            ],

            // --- GRUP IT & SOSMED ---
            [
                'name' => 'Bambang Pamungkas',
                'position' => 'Web Developer',
                'group' => 'it_sosmed',
                'sort_order' => 9,
            ],
            [
                'name' => 'Siska Amelia',
                'position' => 'Social Media Specialist',
                'group' => 'it_sosmed',
                'sort_order' => 10,
            ],
        ];

        foreach ($members as $member) {
            RedactionMember::updateOrCreate(
                ['name' => $member['name'], 'position' => $member['position']], // Unik berdasarkan nama & jabatan
                [
                    'group' => $member['group'],
                    'sort_order' => $member['sort_order'],
                    'is_active' => true,
                    'photo' => null, // Biarkan admin upload via Filament nanti
                ]
            );
        }
    }
}