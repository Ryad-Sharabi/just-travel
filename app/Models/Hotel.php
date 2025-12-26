<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'hotel_id',
        'city',
        'country_code',
        'chain_code',
        'latitude',
        'longitude',
        'address',
        'distance',
        'last_update',
        'image_url',
        'images',
        'rating',
        'review_count',
        'description',
        'amenities',
        'price_per_night',
        'price',
        'currency',
        'booking_url',
        'last_synced_at',
        'rapidapi_hotel_id',
    ];

    protected $casts = [
        'images' => 'array',
        'amenities' => 'array',
        'rating' => 'decimal:2',
        'price_per_night' => 'decimal:2',
        'latitude' => 'decimal:6',
        'longitude' => 'decimal:6',
        'distance' => 'float',
        'last_update' => 'datetime',
        'last_synced_at' => 'datetime',
    ];
}
