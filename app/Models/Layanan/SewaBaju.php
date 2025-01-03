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

    // Many to many
    public function paketPernikahans()
    {
        return $this->belongsToMany(PaketPernikahan::class, 'paket_pernikahans_and_sewa_bajus');
    }
    // Many to many
}
