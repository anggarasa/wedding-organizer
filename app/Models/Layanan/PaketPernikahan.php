<?php

namespace App\Models\Layanan;

use Illuminate\Database\Eloquent\Model;
use App\Models\Images\ImagePaketPernikahan;

class PaketPernikahan extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'description',
        'include',
        'layanan_tambahan',
        'syarat',
        'price',
        'diskon_paket_pernikahan_id',
        'discount',
        'final_price',
    ];

    // Mengatur harga setelah diskon
    public function setDiscountPercentageAttribute($value)
    {
        $this->attributes['discount'] = $value;
        $this->attributes['final_price'] = $this->attributes['price'] - ($this->attributes['price'] * $value / 100);
    }
    // Mengatur harga setelah diskon

    // Hash many
    public function imagePaketPernikahans()
    {
        return $this->hasMany(ImagePaketPernikahan::class);
    }
    // Hash many

    // Many to many
    public function sewaBajus()
    {
        return $this->belongsToMany(SewaBaju::class, 'paket_pernikahans_and_sewa_bajus');
    }
    // Many to many
}
