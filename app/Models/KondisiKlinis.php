<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KondisiKlinis extends Model
{
    use HasFactory;

    public $table = 'kondisi_klinis';

    protected $fillable = [
        'value',
    ];
}
