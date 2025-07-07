<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';
    protected $fillable = [
        'user_id', 'name', 'email', 'message', 'item_type', 'item_name', 'rating',
    ];

    public function user()
    {
        return $this->belongsTo(FlutterUser::class, 'user_id');
    }
}