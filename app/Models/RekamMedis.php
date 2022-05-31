<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RekamMedis extends Model
{
    use SoftDeletes;
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

    public function getValue($group, $value = null)
    {
        if($value == null) {
            return $this->where('group', $group)->get();
        } else {
            return $this->where('group', $group)->where('key', $value)->first();
        }
    }
}
