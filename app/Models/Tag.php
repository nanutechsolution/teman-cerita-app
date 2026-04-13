<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Relasi kebalikan (Inverse Relationship): 
     * Satu Tag dapat dimiliki oleh banyak Episode (Artikel/Video).
     */
    public function episodes(): BelongsToMany
    {
        return $this->belongsToMany(Episode::class);
    }
}
