<?php

namespace App\Models\Diskon;

use App\Models\Layanan\PaketPernikahan;
use Illuminate\Database\Eloquent\Model;

class DiskonPaketPernikahan extends Model
{
    protected $fillable = [
        'name',
        'discount',
        'status',
        'start_date',
        'end_date',
    ];

    // Hash Many
    public function paketPernikahans()
    {
        return $this->hasMany(PaketPernikahan::class);
    }
    // Hash Many
}
