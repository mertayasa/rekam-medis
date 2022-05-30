<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';

    protected $fillable = [
        'id_pasien',
        'group',
        'key',
        'value'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }
}
