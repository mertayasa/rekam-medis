<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervensi extends Model
{
    use HasFactory;

    public $table = 'intervensi';

    protected $fillable = [
        'value',
        'keterangan'
    ];
    
    public function opsi_intervensi()
    {
        return $this->hasMany(OpsiIntervensi::class, 'intervensi_id');
    }
}
