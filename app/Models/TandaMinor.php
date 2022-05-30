<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TandaMinor extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'tanda_minor';

    protected $fillable = [
        'value',
    ];
}
