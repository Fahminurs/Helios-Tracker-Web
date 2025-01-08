<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'devices';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'kode_perangkat',
        'status'
    ];
} 