<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitoringEnergi extends Model
{
    protected $table = 'monitoring_energi';
    protected $primaryKey = 'id_energi';
    public $timestamps = false;

    protected $fillable = [
        'id_alat',
        'ampere',
        'volt',
        'battery'
    ];

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'id_alat', 'id_alat');
    }
} 