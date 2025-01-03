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
    ];

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
