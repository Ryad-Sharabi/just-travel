<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class FlutterUser extends Authenticatable
{
use HasApiTokens, HasFactory;

protected $fillable = [
    'user_id',
    'first_name',
    'last_name',
    'email',
    'password',
    'profile_image',
    'email_verification_token',
    'email_verified_at',
];
public function feedbacks()
{
    return $this->hasMany(Feedback::class, 'user_id');
}

}
