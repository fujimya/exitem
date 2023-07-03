<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MBrand extends Model
{
    protected $table = 'brand';

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
    ];
}
