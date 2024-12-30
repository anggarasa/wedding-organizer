<?php

namespace App\Models\Layanan;

use App\Models\Images\ImageSewaBaju;
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

    // Hash many Start
    public function imageSewaBajus()
    {
        return $this->hasMany(ImageSewaBaju::class);
    }
    // Hash many End
}
