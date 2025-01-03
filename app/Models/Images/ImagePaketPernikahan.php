<?php

namespace App\Models\Images;

use App\Models\Layanan\PaketPernikahan;
use Illuminate\Database\Eloquent\Model;

class ImagePaketPernikahan extends Model
{
    protected $fillable = [
        'paket_pernikahan_id',
        'path',
    ];

    // Belongs to 
    public function paketPernikahan()
    {
        return $this->belongsTo(PaketPernikahan::class);
    }
    // Belongs to 
}
