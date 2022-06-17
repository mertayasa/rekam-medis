<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RekamMedis extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'rekam_medis';

    protected $fillable = [
        'id_pasien',
        'group',
        'key',
        'value'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    public function rekam_medis_history()
    {
        return $this->hasMany(RekamMedisHistory::class, 'id_rekam_medis');
    }

    static function getData($group, $id_pasien, $value = null)
    {
        $result = [];

        if ($value == null) {
            $data = self::where('id_pasien', $id_pasien)->where('group', $group)->get();
        } else {
            $data = self::where('id_pasien', $id_pasien)->where('group', $group)->where('key', $value)->first();
        }

        if ($data instanceof \Illuminate\Support\Collection) {
            foreach ($data as $item) {
                $result[$item->key] = $item->value == 'true' || $item->value == 'false' ? (bool) $item->value : $item->value;
            }
        } else {
            if ($data) {
                return $data->value == 'true' || $data->value == 'false' ? (bool) $data->value : $data->value;
            }

            return null;
        }

        return $result;
    }

    public function getHistory()
    {
        $data = $this->rekam_medis_history()->where('id_rekam_medis', $this->id)->get();

        $result = [];

        foreach ($data as $item) {
            $result[$item->key] = $item->value == 'true' || $item->value == 'false' ? (bool) $item->value : $item->value;
        }

        return $result;
    }
}
