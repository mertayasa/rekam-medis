<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiologi extends Model
{
    use HasFactory;

    public $table = 'etiologi';

    protected $fillable = [
        'value',
    ];
}
