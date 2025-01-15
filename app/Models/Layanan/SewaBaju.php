<?php

namespace App\Models\Layanan;

use App\Models\Images\ImageSewaBaju;
use App\Models\Diskon\DiskonSewaBaju;
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
        'discount',
        'category',
        'final_price',
        'description',
        'diskon_sewa_baju_id',
    ];

    // Hash many Start
    public function imageSewaBajus()
    {
        return $this->hasMany(ImageSewaBaju::class);
    }
    // Hash many End

    // Belongs to
    public function diskonSewaBaju()
    {
        return $this->belongsTo(DiskonSewaBaju::class);
    }
    // Belongs to

    // Many to many
    public function paketPernikahans()
    {
        return $this->belongsToMany(PaketPernikahan::class, 'paket_pernikahans_and_sewa_bajus');
    }
    // Many to many
}
