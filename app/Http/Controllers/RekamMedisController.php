<?php

namespace App\Http\Controllers;

use App\Http\Requests\RekamMedisRequest;
use App\Models\KondisiKlinis;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\TandaMayor;
use App\Models\TandaMinor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RekamMedisController extends Controller
{
    public function editPengkajian(Pasien $pasien)
    {
        $pengkajian = RekamMedis::getData('pengkajian', $pasien->id);
        $tanda_mayor = TandaMayor::all();
        $tanda_minor = TandaMinor::all();
        $kondisi_klinis = KondisiKlinis::all();
        
        $tanda_mayor = $tanda_mayor->map(function ($tanda) use($pengkajian) {
            if(isset($pengkajian['tanda_mayor']) && in_array($tanda->id, json_decode($pengkajian['tanda_mayor']))){
                $tanda->is_checked = true;
            }else{
                $tanda->is_checked = false;
            }

            return $tanda;
        });

        $tanda_minor = $tanda_minor->map(function ($tanda) use($pengkajian) {
            if(isset($pengkajian['tanda_minor']) && in_array($tanda->id, json_decode($pengkajian['tanda_minor']))){
                $tanda->is_checked = true;
            }else{
                $tanda->is_checked = false;
            }

            return $tanda;
        });

        $kondisi_klinis = $kondisi_klinis->map(function ($tanda) use($pengkajian) {
            if(isset($pengkajian['kondisi_klinis']) && in_array($tanda->id, json_decode($pengkajian['kondisi_klinis']))){
                $tanda->is_checked = true;
            }else{
                $tanda->is_checked = false;
            }

            return $tanda;
        });

        if($pengkajian == []){
            $pengkajian['keluhan_utama'] = '';
        }

        $data = [
            'pasien' => $pasien,
            'pengkajian' => $pengkajian,
            'tanda_mayor' => $tanda_mayor,
            'kondisi_klinis' => $kondisi_klinis,
            'tanda_minor' => $tanda_minor,
        ];
        
        return view('rekam-medis.edit.pengkajian', $data);
    }

    public function updatePengkajian(RekamMedisRequest $request, Pasien $pasien)
    {
        $data = $request->validated();
        $to_update = [
            'keluhan_utama' => $data['data']['keluhan_utama'],
            'is_mengeluh_nyeri' => (string) $data['data']['is_mengeluh_nyeri'] == true ? 'true' : 'false',
            'tanda_mayor' => [],
            'tanda_minor' => [],
            'kondisi_klinis' => [],
            'provoking' => $data['data']['provoking'] ?? '',
            'quality' => $data['data']['quality'] ?? '',
            'region' => $data['data']['region'] ?? '',
            'severity' => $data['data']['severity'] ?? '',
            'time' => $data['data']['time'] ?? '',
        ];

        foreach ($data['kondisi_klinis'] as $key => $klinis) {
            if($klinis['is_checked']){
                $to_update['kondisi_klinis'][] = $klinis['id'];
            }
        }

        foreach ($data['tanda_mayor'] as $key => $mayor) {
            if($mayor['is_checked']){
                $to_update['tanda_mayor'][] = $mayor['id'];
            }
        }

        foreach ($data['tanda_minor'] as $key => $minor) {
            if($minor['is_checked']){
                $to_update['tanda_minor'][] = $minor['id'];
            }
        }

        try{
            DB::transaction(function () use($pasien, $to_update) {
                foreach ($to_update as $key => $value) {
                    RekamMedis::updateOrCreate(
                        [
                            'id_pasien' => $pasien->id,
                            'group' => 'pengkajian',
                            'key' => $key
                        ],
                        [
                            'id_pasien' => $pasien->id,
                            'group' => 'pengkajian',
                            'key' => $key,
                            'value' => is_array($value) ? json_encode($value) : $value,
                        ]
                    );
                }
            }, 5);
        }catch(Exception $e){
            Log::error($e);
            return response(['message' => 'Terjadi kesalahan pada server'], 500);
        }

        session()->flash('success', 'Data kajian berhasil di-update');
        return response([
            'message' => 'Berhasil menyimpan data', 
            'redirect_to' => route('pasien.index'),
            'redirect_to_rdiagnosa' => route('rekam.edit_diagnosa', $pasien->id),
        ], 200);
    }

    public function editDiagnosa(Pasien $pasien)
    {
        $diagnosa = RekamMedis::getData('diagnosa', $pasien->id);
        $data = [
            'pasien' => $pasien,
            'diagnosa' => $diagnosa
        ];

        dd($data);

        return view('rekam-medis.edit.diagnosa', $data);
    }
}
