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

    // Mengatur harga setelah diskon
    public function setDiscountAttribute($value)
    {
        $this->attributes['discount'] = $value;
        $this->attributes['final_price'] = $this->price - ($this->price * $value / 100);
    }
    // Mengatur harga setelah diskon

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
