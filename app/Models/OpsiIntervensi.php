<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpsiIntervensi extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'opsi_intervensi';

    protected $fillable = [
        'value',
        'id_intervensi',
        'id_parent'
    ];

    public function intervensi()
    {
        return $this->belongsTo(Intervensi::class, 'id_intervensi');
    }
}
