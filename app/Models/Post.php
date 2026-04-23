<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Post extends Model
{
    use HasFactory, LogsActivity; // Tambahkan LogsActivity di sini

    protected $table = 'posts'; // Nama tabel yang sesuai dengan migrasi awal

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
     * Konfigurasi Log Aktivitas (Audit Keredaksian)
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            // Tentukan kolom mana saja yang krusial untuk dicatat jika terjadi perubahan
            ->logOnly([
                'title',
                'slug',
                'content',
                'excerpt',
                'is_published',
                'is_headline',
                'is_breaking',
                'category_id',
                'author_id',
                'editor_id'
            ])
            // Hanya rekam log jika nilai benar-benar berubah (menghemat database)
            ->logOnlyDirty()
            // Jangan simpan log kosong
            ->dontSubmitEmptyLogs()
            // Format deskripsi agar mudah dibaca manusia
            ->setDescriptionForEvent(fn(string $eventName) => "Artikel telah di-{$eventName}");
    }

    /**
     * Relasi: Setiap Episode milik satu Kategori.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi: Episode (Artikel) ditulis oleh satu User (Author).
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // tags
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }
    /**
     * Relasi: Episode (Artikel) disetujui/diedit oleh satu User (Editor).
     */
    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'editor_id');
    }

    public function speakers(): BelongsToMany
    {
        return $this->belongsToMany(Speaker::class);
    }

    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeHeadline($q)
    {
        return $q->where('is_headline', true);
    }

    public function scopeBreaking($q)
    {
        return $q->where('is_breaking', true);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    /**
     * Jalankan event/logika otomatis saat model berinteraksi dengan database.
     */
    protected static function booted(): void
    {
        // Event 'saved' akan berjalan SETELAH data berhasil dibuat atau di-update
        static::saved(function ($episode) {

            // Cek apakah episode yang baru saja disimpan ini di-set sebagai headline
            if ($episode->is_headline) {

                // Cari semua episode headline, urutkan dari yang terbaru tayang, lalu lewati 5 teratas
                $oldHeadlineIds = static::where('is_headline', true)
                    ->orderBy('published_at', 'desc') // Atau gunakan 'created_at'
                    ->skip(5)
                    ->pluck('id');

                // Jika ternyata ada lebih dari 5 (artinya ada headline ke-6, ke-7, dst)
                if ($oldHeadlineIds->isNotEmpty()) {

                    // Matikan status headline secara massal untuk episode lama tersebut
                    // Kita menggunakan ->update() langsung agar tidak memicu infinite loop
                    static::whereIn('id', $oldHeadlineIds)->update([
                        'is_headline' => false
                    ]);
                }
            }
        });
    }
}
