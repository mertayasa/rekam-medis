<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Intervensi extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'intervensi';

    protected $fillable = [
        'value',
        'keterangan',
        'is_main',
        'id_parent'
        // 'url_youtube',
    ];

    protected $casts = [
        'is_main' => 'boolean',
    ];
    
    public function opsi_intervensi()
    {
        return $this->hasMany(OpsiIntervensi::class, 'id_intervensi');
    }

    public function url_yt_intervensi()
    {
        return $this->hasMany(UrlYtIntervensi::class, 'id_intervensi');
    }
}
