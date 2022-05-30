<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TandaMayor extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'tanda_mayor';

    protected $fillable = [
        'value'
    ];
}
