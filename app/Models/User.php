<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'password',
        'role',
        'foto_profil',
        'token',
        'otp_expiry',
        'create_at'
    ];

    protected $hidden = [
        'password',
        'token',
    ];

    protected $casts = [
        'otp_expiry' => 'datetime',
        'create_at' => 'datetime',
    ];

    protected $attributes = [
        'role' => 'user',
        'foto_profil' => '/image/foto_profile/default_profile.png'
    ];
}
