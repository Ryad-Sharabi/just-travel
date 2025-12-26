<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'brand',
        'model',
        'city',
        'price',
        'image_url',
        'images',
        'category',
        'seats',
        'transmission',
        'fuel_type',
        'price_per_day',
        'currency',
        'booking_url',
        'last_synced_at',
        'rapidapi_car_id',
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2',
        'price_per_day' => 'decimal:2',
        'seats' => 'integer',
        'last_synced_at' => 'datetime',
    ];
}
