<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pasien extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'pasien';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'no_hp',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'tanggal_masuk',
        'tanggal_keluar',
        'nama_wali',
        'hubungan_wali',
        // 'keluhan_utama',
        'diagnosa_medis',
        'kontak_wali',
        'no_rm',
    ];

    public function getNamaAndRmAttribute()
    {
        return $this->no_rm.' - '.$this->nama;
    }
}
