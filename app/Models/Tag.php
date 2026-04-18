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

    public function posts(): BelongsToMany
    {
        // Penjelasan parameter: (Model Tujuan, Nama Tabel Pivot, Foreign Key Model Ini, Foreign Key Model Tujuan)
        return $this->belongsToMany(Post::class);
    }
}
