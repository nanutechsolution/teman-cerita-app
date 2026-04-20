<?php

namespace App\Services;

use App\Models\Advertisement;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AdService
{
    /**
     * Mengambil iklan aktif berdasarkan posisi dengan caching 30 menit.
     * Best Practice: Simpan sebagai Array di Cache, kembalikan sebagai Object.
     */
    public static function getAd(string $position)
    {
        // Kita simpan data mentah sebagai ARRAY di dalam cache.
        // Array murni tidak membutuhkan class definition sehingga 100% aman dari error "Incomplete Object".
        $adData = Cache::remember("ad_pos_{$position}", 1800, function () use ($position) {
            $ad = Advertisement::where('position', $position)
                ->where('is_active', true)
                ->where(function ($q) {
                    $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
                })
                ->where(function ($q) {
                    $q->whereNull('expired_at')->orWhere('expired_at', '>', now());
                })
                ->inRandomOrder()
                ->first();

            return $ad ? $ad->toArray() : null;
        });

        // Setelah data diambil (baik dari cache atau DB), baru kita ubah menjadi object.
        // Dengan begini, Blade tetap bisa menggunakan syntax $ad->id tanpa error.
        return $adData ? (object) $adData : null;
    }

    /**
     * Mencatat jumlah tayangan (view) iklan.
     */
    public static function incrementView($adId)
    {
        if (!$adId) return;
        
        // Gunakan DB builder langsung untuk performa maksimal dan menghindari overhead model
        DB::table('advertisements')->where('id', $adId)->increment('views');
    }
}