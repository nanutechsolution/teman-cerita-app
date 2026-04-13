<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedactionMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'group',
        'photo',
        'sort_order',
        'is_active',
    ];
}