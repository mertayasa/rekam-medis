<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiagnosaRequest;
use App\Http\Requests\LuaranRequest;
use App\Http\Requests\RekamMedisRequest;
use App\Models\Intervensi;
use App\Models\KondisiKlinis;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\TandaMayor;
use App\Models\TandaMinor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use function GuzzleHttp\Promise\all;

class RekamMedisController extends Controller
{
    public function editPengkajian(Pasien $pasien)
    {
        $pengkajian = RekamMedis::getData('pengkajian', $pasien->id);
        $common_data = $this->getCommonData($pasien);
        $tanda_mayor = $common_data['tanda_mayor'];
        $tanda_minor = $common_data['tanda_minor'];
        $kondisi_klinis = $common_data['kondisi_klinis'];

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
        if($diagnosa == []){
            $diagnosa['diagnosa'] = 'Nyeri Akut';
        }

        $data = [
            'pasien' => $pasien,
            'diagnosa' => $diagnosa
        ];

        return view('rekam-medis.edit.diagnosa', $data);
    }

    public function updateDiagnosa(DiagnosaRequest $request, Pasien $pasien)
    {
        try{
            $data = $request->validated();

            RekamMedis::updateOrCreate(
                [
                    'id_pasien' => $pasien->id,
                    'group' => 'diagnosa',
                    'key' => 'diagnosa'
                ],
                [
                    'id_pasien' => $pasien->id,
                    'group' => 'diagnosa',
                    'key' => 'diagnosa',
                    'value' => $data['diagnosa'],
                ]
            );
        }catch(Exception $e){
            Log::error($e);
            return response(['message' => 'Terjadi kesalahan pada server'], 500);
        }

        session()->flash('success', 'Data diagnosa berhasil di-update');
        return response([
            'message' => 'Berhasil menyimpan data', 
            'redirect_to' => route('pasien.index'),
            'redirect_to_rluaran' => route('rekam.edit_luaran', $pasien->id),
        ], 200);
    }

    public function editLuaran(Pasien $pasien)
    {
        $luaran = RekamMedis::getData('luaran', $pasien->id);
        $diagnosa = RekamMedis::getData('diagnosa', $pasien->id);
        
        if($luaran == []){
            $luaran['luaran'] = '';
        }
        
        if($diagnosa == []){
            $diagnosa['diagnosa'] = 'Data diagnosa belum ditentukan';
        }

        $common_data = $this->getCommonData($pasien);
        $tanda_mayor = $common_data['tanda_mayor'];
        $tanda_minor = $common_data['tanda_minor'];
        $kondisi_klinis = $common_data['kondisi_klinis'];
        $intervensi = Intervensi::with('opsi_intervensi', 'opsi_intervensi.opsi_child')->get(['id', 'value', 'keterangan']);
        foreach($intervensi as $key => $inter){
            $opsi_intervensi = $inter->opsi_intervensi()->with('opsi_child')->where('id_parent', NULL)->get();
            $intervensi[$key]['opsi_intervensi'] = $opsi_intervensi;
        }

        $luaran['opsi_intervensi'] = "[5,6,7]";

        $intervensi = $intervensi->map(function ($inter) use($luaran) {
            $inter->is_checked = false;
            foreach ($inter->opsi_intervensi as $key => $opsi) {
                foreach ($opsi->opsi_child as $key => $child) {
                    if(isset($luaran['opsi_intervensi']) && in_array($child->id, json_decode($luaran['opsi_intervensi']))){
                        $inter->is_checked = true;
                        $child->is_checked = true;
                    }else{
                        $child->is_checked = false;
                    }
                }
            }

            return $inter;
        });
        
        $data = [
            'pasien' => $pasien,
            'luaran' => $luaran,
            'tanda_mayor' => $tanda_mayor,
            'tanda_minor' => $tanda_minor,
            'kondisi_klinis' => $kondisi_klinis,
            'diagnosa' => $diagnosa,
            'intervensi' => $intervensi
        ];

        return view('rekam-medis.edit.luaran', $data);
    }

    public function updateLuaran(LuaranRequest $request, Pasien $pasien)
    {
        // return response($request->validated());

        try{
            $data = $request->validated();
            $to_update = [
                'diaphores' => $data['luaran']['diaphores'] ?? '',
                'frekuensi_nadi' => $data['luaran']['frekuensi_nadi'] ?? '',
                'gelisah' => $data['luaran']['gelisah'] ?? '',
                'keluhan_nyeri' => $data['luaran']['keluhan_nyeri'] ?? '',
                'kesulitan_tidur' => $data['luaran']['kesulitan_tidur'] ?? '',
                'meringis' => $data['luaran']['meringis'] ?? '',
                'mual' => $data['luaran']['mual'] ?? '',
                'muntah' => $data['luaran']['muntah'] ?? '',
                'nafsu_makan' => $data['luaran']['nafsu_makan'] ?? '',
                'nama_penyakit' => $data['luaran']['nama_penyakit'] ?? '',
                'non_farmakologis' => $data['luaran']['non_farmakologis'] ?? '',
                'nyeri_terkontrol' => $data['luaran']['nyeri_terkontrol'] ?? '',
                'onset_nyeri' => $data['luaran']['onset_nyeri'] ?? '',
                'operation_end' => $data['luaran']['operation_end'] ?? '',
                'operation_start' => $data['luaran']['operation_start'] ?? '',
                'penyebab_nyeri' => $data['luaran']['penyebab_nyeri'] ?? '',
                'pola_nafas' => $data['luaran']['pola_nafas'] ?? '',
                'sikap_protektif' => $data['luaran']['sikap_protektif'] ?? '',
                'tekanan_darah' => $data['luaran']['tekanan_darah'] ?? '',
            ];

            DB::transaction(function () use($pasien, $to_update) {
                foreach ($to_update as $key => $value) {
                    RekamMedis::updateOrCreate(
                        [
                            'id_pasien' => $pasien->id,
                            'group' => 'luaran',
                            'key' => $key
                        ],
                        [
                            'id_pasien' => $pasien->id,
                            'group' => 'luaran',
                            'key' => $key,
                            'value' => $value,
                        ]
                    );
                }
            }, 5);
        }catch(Exception $e){
            Log::error($e);
            return response(['message' => 'Terjadi kesalahan pada server'], 500);
        }

        session()->flash('success', 'Data luaran berhasil di-update');
        return response([
            'message' => 'Berhasil menyimpan data', 
            'redirect_to' => route('pasien.index'),
            'redirect_to_revaluasi' => route('rekam.edit_evaluasi', $pasien->id),
        ], 200);
    }

    public function editEvaluasi(Pasien $pasien)
    {
        $evaluasi = RekamMedis::getData('evaluasi', $pasien->id);
        if($evaluasi == []){
            $evaluasi['evaluasi'] = '';
        }

        $data = [
            'pasien' => $pasien,
            'evaluasi' => $evaluasi
        ];

        dd($data);

        return view('rekam-medis.edit.evaluasi', $data);
    }

    public function updateEvaluasi(Request $request, Pasien $pasien)
    {
        
    }

    public function getCommonData($pasien)
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

        return [
            'tanda_mayor' => $tanda_mayor,
            'tanda_minor' => $tanda_minor,
            'kondisi_klinis' => $kondisi_klinis
        ];
    }
}
