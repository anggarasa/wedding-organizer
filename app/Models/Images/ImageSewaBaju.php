<?php

namespace App\Models\Images;

use App\Models\Layanan\SewaBaju;
use Illuminate\Database\Eloquent\Model;

class ImageSewaBaju extends Model
{
    protected $fillable = [
        'sewa_baju_id',
        'image',
        'size',
    ];

    // Belongs to Start
    public function sewaBaju()
    {
        return $this->belongsTo(SewaBaju::class);
    }
    // Belongs to End
}
