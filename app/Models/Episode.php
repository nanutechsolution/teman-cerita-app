<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Episode extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal.
     * Sudah ditambahkan kolom baru berdasarkan migrasi portal berita.
     */
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'date',
        'link',
        'img',
        'content',
        'is_published',
        'published_at',
        // SEO Meta Fields
        'meta_title',
        'meta_description',
        'meta_keywords',
        // Metrik & Tipe
        'views',
        'type',
        'duration',
        // Jurnalisme & Hak Cipta Gambar
        'excerpt',
        'image_caption',
        'image_source',
        // Flag Tampilan Frontend
        'is_headline',
        'is_breaking',
        // Author & Editor
        'author_id',
        'editor_id',
    ];

    /**
     * Casting atribut ke tipe data tertentu.
     */
    protected $casts = [
        'date' => 'date',
        'is_published' => 'boolean',
        'is_headline' => 'boolean',
        'is_breaking' => 'boolean',
        'published_at' => 'datetime', // Memungkinkan perbandingan waktu (now()) di Controller
    ];

    /**
     * Relasi: Setiap Episode milik satu Kategori.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi: Satu Episode dapat memiliki banyak Narasumber (Speakers).
     */
    public function speakers(): BelongsToMany
    {
        return $this->belongsToMany(Speaker::class);
    }

    /**
     * Relasi: Banyak Episode bisa memiliki banyak Tag.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Relasi: Episode (Artikel) ditulis oleh satu User (Author).
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Relasi: Episode (Artikel) disetujui/diedit oleh satu User (Editor).
     */
    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

  
}
