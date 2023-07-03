<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MItem extends Model
{
    protected $table = 'item';
    protected $fillable = [
        'number',
        'name',
        'brand_id',
        'category_id',
        'created_at',
        'updated_at',
    ];
}
