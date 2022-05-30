<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TandaMayor extends Model
{
    use HasFactory;

    public $table = 'tanda_mayor';

    protected $fillable = [
        'value'
    ];
}
