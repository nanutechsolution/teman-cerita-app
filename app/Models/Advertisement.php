<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Advertisement extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'image_path',
        'link_url',
        'position',
        'clicks',
        'views',
        'is_active',
        'starts_at',
        'expired_at',
    ];

    /**
     * Konversi tipe data otomatis.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'starts_at' => 'datetime',
        'expired_at' => 'datetime',
        'clicks' => 'integer',
        'views' => 'integer',
    ];

    /**
     * Scope untuk memfilter iklan yang sedang aktif dan dalam periode tayang.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('expired_at')->orWhere('expired_at', '>', now());
            });
    }

    protected static function booted()
    {
        static::saved(function ($ad) {
            Cache::forget("ad_pos_{$ad->position}");
        });

        static::deleted(function ($ad) {
            Cache::forget("ad_pos_{$ad->position}");
        });
    }
}
