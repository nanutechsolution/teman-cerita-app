<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    // Relasi: Satu Kategori punya banyak Episode
    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }
}
