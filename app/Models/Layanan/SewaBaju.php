<?php

namespace App\Models\Layanan;

use Illuminate\Database\Eloquent\Model;

class SewaBaju extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'image',
        'price',
        'status',
        'ukuran',
        'category',
        'description',
    ];
}
