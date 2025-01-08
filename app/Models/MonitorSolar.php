<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitorSolar extends Model
{
    protected $table = 'monitor_solar';
    protected $primaryKey = 'id_monitoring';
    public $timestamps = false;

    protected $fillable = [
        'id_alat',
        'posisi_x',
        'posisi_y'
    ];

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'id_alat', 'id_alat');
    }
} 