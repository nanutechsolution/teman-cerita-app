<?php

namespace App\Enums;

enum NavigationGroup: string
{
    case CONTENT = 'Manajemen Konten';
    case USER_MANAGEMENT = 'Manajemen Pengguna';
    case SETTINGS = 'Pengaturan Sistem';
    case REPORTS = 'Laporan';
    case MASTER_DATA = 'Data Master';
    case INBOX = 'Kotak Masuk';
    case PARTNERS = 'Sponsor & Partner';
    case SYSTEM_SECURITY = 'Sistem & Keamanan';
    case BUSINESS_MANAGEMENT = 'Manajemen Bisnis';
    case INTERACTION = 'Interaksi Pembaca';
}
