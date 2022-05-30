<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    public $table = 'pasien';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'tanggal_masuk',
        'tanggal_keluar',
        'nama_wali',
        'hubungan_wali',
        // 'keluhan_utama',
        // 'diagnosa_medis',
        'kontak_wali',
        'no_rm',
    ];
}
