<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MItemvariant extends Model
{
    protected $table = 'itemvariant';

    protected $fillable = [
        'code',
        'description',
        'item_id',
        'created_at',
        'updated_at',
    ];
}
