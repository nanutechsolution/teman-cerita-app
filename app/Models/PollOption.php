<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PollOption extends Model
{
    protected $fillable = [
        'poll_id',
        'name',
        'votes_count', // Kita izinkan fillable untuk keperluan manipulasi awal jika perlu
    ];

    public function poll(): BelongsTo
    {
        return $this->belongsTo(Poll::class);
    }
}