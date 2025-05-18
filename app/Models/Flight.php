<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'origin_code',
        'destination_code',
        'airline',
        'price',
        'duration',
        'departure_date'
    ];
}
