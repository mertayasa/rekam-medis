<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedisHistory extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis_history';

    protected $fillable = [
        'id_rekam_medis',
        'group',
        'key',
        'value'
    ];

    public function rekam_medis()
    {
        return $this->belongsTo(RekamMedis::class, 'id_rekam_medis');
    }
}
