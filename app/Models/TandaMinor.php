<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TandaMinor extends Model
{
    use HasFactory;

    public $table = 'tanda_minor';

    protected $fillable = [
        'value',
    ];
}
