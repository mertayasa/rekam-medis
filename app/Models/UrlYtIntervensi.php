<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlYtIntervensi extends Model
{
    use HasFactory;

    public $table = 'url_yt_intervensi';

    protected $fillable = [
        'url',
    ];

    public function intervensi()
    {
        return $this->belongsTo(Intervensi::class, 'id_intervensi');
    }

    public function getVideoId()
    {
        $url_yt = explode('/', $this->url);
        return end($url_yt);
    }
}
