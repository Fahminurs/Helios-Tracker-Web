<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alat';
    protected $primaryKey = 'id_alat';
    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'kode_perangkat',
        'status_servo',
        'status_esp32',
        'cuaca',
        'suhu',
        'lokasi_perangkat'
    ];

    protected $casts = [
        'lokasi_perangkat' => 'json'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
} 