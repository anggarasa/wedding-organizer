<?php

namespace App\Models\Diskon;

use Illuminate\Database\Eloquent\Model;

class DiskonCode extends Model
{
    protected $fillable = [
        'code',
        'description',
        'discount',
        'penggunaan',
        'status',
        'start_date',
        'end_date',
    ];
}
