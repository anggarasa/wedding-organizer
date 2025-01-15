<?php

namespace App\Models\Diskon;

use App\Models\Layanan\SewaBaju;
use Illuminate\Database\Eloquent\Model;

class DiskonSewaBaju extends Model
{
    protected $fillable = [
        'name',
        'discount',
        'status',
        'start_date',
        'end_date',
    ];

    // Hash many
    public function sewaBajus()
    {
        return $this->hasMany(SewaBaju::class);
    }
    // Hash many
}
