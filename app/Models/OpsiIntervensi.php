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
        'id_parent',
        'url_youtube',
        'sub_intervensi_id'
    ];

    public function intervensi()
    {
        return $this->belongsTo(Intervensi::class, 'id_intervensi');
    }

    public function opsi_child()
    {
        return $this->hasMany(OpsiIntervensi::class, 'id_parent');
    }
}
