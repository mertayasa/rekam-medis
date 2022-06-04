<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiagnosaRequest;
use App\Http\Requests\EvaluasiRequest;
use App\Http\Requests\LuaranRequest;
use App\Http\Requests\RekamMedisRequest;
use App\Models\Etiologi;
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
        $etiologi = $common_data['etiologi'];

        if($pengkajian == []){
            $pengkajian['keluhan_utama'] = '';
        }

        $data = [
            'prev_btn' => [
                'url' => route('pasien.edit', $pasien->id),
                'label' => 'Edit pasien'
            ],
            'pasien' => $pasien,
            'pengkajian' => $pengkajian,
            'tanda_mayor' => $tanda_mayor,
            'etiologi' => $etiologi,
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
            'durasi_nyeri' => $data['data']['durasi_nyeri'],
            'etiologi' => [],
            'provoking' => $data['data']['provoking'] ?? '',
            'quality' => $data['data']['quality'] ?? '',
            'region' => $data['data']['region'] ?? '',
            'severity' => $data['data']['severity'] ?? '',
            'time' => $data['data']['time'] ?? '',
        ];

        foreach ($data['etiologi'] as $key => $klinis) {
            if($klinis['is_checked']){
                $to_update['etiologi'][] = $klinis['id'];
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
            'prev_btn' => [
                'url' => route('rekam.edit_pengkajian', $pasien->id),
                'label' => 'Kembali ke halaman pengkajian'
            ],
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
        $pengkajian = $common_data['pengkajian'];
        // if(isset($pengkajian['durasi_nyeri'])){
        //     $pengkajian['durasi_nyeri'] = $pengkajian['durasi_nyeri'] == 'kurang_3' ? 'Nyeri < 3bulan' : 'Nyeri > 3bulan';
        // }else{
        //     $pengkajian['durasi_nyeri'] = 'Tidak ada keluhan tambahan';
        // }

        $tanda_mayor = $common_data['tanda_mayor'];
        $tanda_minor = $common_data['tanda_minor'];
        $etiologi = $common_data['etiologi'];
        $etiologi = Etiologi::all();
        $intervensi = Intervensi::with('opsi_intervensi', 'opsi_intervensi.opsi_child')->get(['id', 'value', 'keterangan', 'url_youtube']);

        $etiologi = $etiologi->map(function ($etio) use($pengkajian) {
            if(isset($pengkajian['etiologi']) && in_array($etio->id, json_decode($pengkajian['etiologi']))){
                $etio->is_checked = true;
            }else{
                $etio->is_checked = false;
            }

            return $etio;
        });

        foreach($intervensi as $key => $inter){
            $opsi_intervensi = $inter->opsi_intervensi()->with('opsi_child')->where('id_parent', NULL)->get();
            $intervensi[$key]['opsi_intervensi'] = $opsi_intervensi;
        }

        $luaran['intervensi_child'] = $luaran['intervensi_child'] ?? "[]";

        $intervensi = $intervensi->map(function ($inter) use($luaran) {
            $inter->is_checked = false;
            foreach ($inter->opsi_intervensi as $key => $opsi) {
                foreach ($opsi->opsi_child as $key => $child) {
                    if(isset($luaran['intervensi_child']) && in_array($child->id, json_decode($luaran['intervensi_child']))){
                        $inter->is_checked = true;
                        $child->is_checked = true;
                    }else{
                        $child->is_checked = false;
                    }
                }
            }

            if($inter->url_youtube){
                $url_yt = explode('/', $inter->url_youtube);
                $inter->id_youtube = end($url_yt);
            }

            
            return $inter;
        });

        // dd($intervensi);

        $luaran['intervensi_child'] = json_decode($luaran['intervensi_child']);
        
        $data = [
            'prev_btn' => [
                'url' => route('rekam.edit_diagnosa', $pasien->id),
                'label' => 'Kembali ke halaman diagnosa'
            ],
            'pasien' => $pasien,
            'luaran' => array_merge($luaran, $pengkajian),
            'tanda_mayor' => $tanda_mayor,
            'tanda_minor' => $tanda_minor,
            'etiologi' => $etiologi,
            'diagnosa' => $diagnosa,
            'etiologi' => $etiologi,
            'intervensi' => $intervensi
        ];

        return view('rekam-medis.edit.luaran', $data);
    }

    public function updateLuaran(LuaranRequest $request, Pasien $pasien)
    {
        try{
            $data = $request->validated();
            $to_update = [
                'diaphores' => $data['data']['diaphores'] ?? '',
                'frekuensi_nadi' => $data['data']['frekuensi_nadi'] ?? '',
                'gelisah' => $data['data']['gelisah'] ?? '',
                'keluhan_nyeri' => $data['data']['keluhan_nyeri'] ?? '',
                'kesulitan_tidur' => $data['data']['kesulitan_tidur'] ?? '',
                'meringis' => $data['data']['meringis'] ?? '',
                'mual' => $data['data']['mual'] ?? '',
                'muntah' => $data['data']['muntah'] ?? '',
                'nafsu_makan' => $data['data']['nafsu_makan'] ?? '',
                'nama_penyakit' => $data['data']['nama_penyakit'] ?? '',
                'non_farmakologis' => $data['data']['non_farmakologis'] ?? '',
                'nyeri_terkontrol' => $data['data']['nyeri_terkontrol'] ?? '',
                'onset_nyeri' => $data['data']['onset_nyeri'] ?? '',
                'operation_end' => $data['data']['operation_end'] ?? '',
                'operation_start' => $data['data']['operation_start'] ?? '',
                'penyebab_nyeri' => $data['data']['penyebab_nyeri'] ?? '',
                'pola_nafas' => $data['data']['pola_nafas'] ?? '',
                'sikap_protektif' => $data['data']['sikap_protektif'] ?? '',
                'tekanan_darah' => $data['data']['tekanan_darah'] ?? '',
                'intervensi_child' => $data['data']['intervensi_child'] ?? [],
            ];

            $to_update_pengkajian = [
                'durasi_nyeri' => $data['data']['durasi_nyeri'] ?? '',
            ];

            foreach ($data['etiologi'] as $key => $klinis) {
                if($klinis['is_checked']){
                    $to_update_pengkajian['etiologi'][] = $klinis['id'];
                }
            }
    
            foreach ($data['tanda_mayor'] as $key => $mayor) {
                if($mayor['is_checked']){
                    $to_update_pengkajian['tanda_mayor'][] = $mayor['id'];
                }
            }
    
            foreach ($data['tanda_minor'] as $key => $minor) {
                if($minor['is_checked']){
                    $to_update_pengkajian['tanda_minor'][] = $minor['id'];
                }
            }

            DB::transaction(function () use($pasien, $to_update, $to_update_pengkajian) {
                foreach ($to_update_pengkajian as $key => $kajian) {
                    if($kajian != null){
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
                                'value' => is_array($kajian) ? json_encode($kajian) : $kajian,
                            ]
                        );
                    }
                }
                foreach ($to_update as $key => $value) {
                    if($value != null){
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
                                'value' => is_array($value) ? json_encode($value) : $value,
                            ]
                        );
                    }
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

        $tanda_mayor = TandaMayor::all();
        $tanda_minor = TandaMinor::all();
        $tanda_mayor = $tanda_mayor->map(function ($tanda) use($evaluasi) {
            if(isset($evaluasi['tanda_mayor']) && in_array($tanda->id, json_decode($evaluasi['tanda_mayor']))){
                $tanda->is_checked = true;
            }else{
                $tanda->is_checked = false;
            }

            return $tanda;
        });

        $tanda_minor = $tanda_minor->map(function ($tanda) use($evaluasi) {
            if(isset($evaluasi['tanda_minor']) && in_array($tanda->id, json_decode($evaluasi['tanda_minor']))){
                $tanda->is_checked = true;
            }else{
                $tanda->is_checked = false;
            }

            return $tanda;
        });

        $data = [
            'prev_btn' => [
                'url' => route('rekam.edit_luaran', $pasien->id),
                'label' => 'Kembali ke halaman luaran'
            ],
            'tanda_mayor' => $tanda_mayor,
            'tanda_minor' => $tanda_minor,
            'pasien' => $pasien,
            'evaluasi' => $evaluasi
        ];

        return view('rekam-medis.edit.evaluasi', $data);
    }

    public function updateEvaluasi(EvaluasiRequest $request, Pasien $pasien)
    {
        // return response($request->validated());

        try{
            $data = $request->validated();
            unset($data['data']['tanda_minor']);
            unset($data['data']['tanda_mayor']);
            $to_update = $data['data'];

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
            
            DB::transaction(function () use($pasien, $to_update) {
                foreach ($to_update as $key => $value) {
                    if($value != null){
                        RekamMedis::updateOrCreate(
                            [
                                'id_pasien' => $pasien->id,
                                'group' => 'evaluasi',
                                'key' => $key
                            ],
                            [
                                'id_pasien' => $pasien->id,
                                'group' => 'evaluasi',
                                'key' => $key,
                                'value' => is_array($value) ? json_encode($value) : $value,
                            ]
                        );
                    }
                }
            }, 5);
        }catch(Exception $e){
            Log::error($e);
            return response(['message' => 'Terjadi kesalahan pada server'], 500);
        }

        session()->flash('success', 'Data diagnosa berhasil di-update');
        return response([
            'message' => 'Berhasil menyimpan data', 
            'redirect_to' => route('pasien.index'),
            // 'redirect_to_rluaran' => route('rekam.edit_luaran', $pasien->id),
        ], 200);
    }

    public function getCommonData($pasien)
    {
        $pengkajian = RekamMedis::getData('pengkajian', $pasien->id);
        $tanda_mayor = TandaMayor::all();
        $tanda_minor = TandaMinor::all();
        $etiologi = Etiologi::all();
        
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

        $etiologi = $etiologi->map(function ($tanda) use($pengkajian) {
            if(isset($pengkajian['etiologi']) && in_array($tanda->id, json_decode($pengkajian['etiologi']))){
                $tanda->is_checked = true;
            }else{
                $tanda->is_checked = false;
            }

            return $tanda;
        });

        return [
            'pengkajian' => $pengkajian,
            'tanda_mayor' => $tanda_mayor,
            'tanda_minor' => $tanda_minor,
            'etiologi' => $etiologi
        ];
    }

    public function getCommonDataEvaluasi($pasien)
    {
        $evaluasi = RekamMedis::getData('evaluasi', $pasien->id);
        $tanda_mayor = TandaMayor::all();
        $tanda_minor = TandaMinor::all();
        
        $tanda_mayor = $tanda_mayor->map(function ($tanda) use($evaluasi) {
            if(isset($evaluasi['tanda_mayor']) && in_array($tanda->id, json_decode($evaluasi['tanda_mayor']))){
                $tanda->is_checked = true;
            }else{
                $tanda->is_checked = false;
            }

            return $tanda;
        });

        $tanda_minor = $tanda_minor->map(function ($tanda) use($evaluasi) {
            if(isset($evaluasi['tanda_minor']) && in_array($tanda->id, json_decode($evaluasi['tanda_minor']))){
                $tanda->is_checked = true;
            }else{
                $tanda->is_checked = false;
            }

            return $tanda;
        });

        return [
            'tanda_mayor' => $tanda_mayor,
            'tanda_minor' => $tanda_minor,
        ];
    }

    public function lihatDetail(Pasien $pasien)
    {
        $pengkajian = RekamMedis::getData('pengkajian', $pasien->id);
        
        if(!$pengkajian){
            return redirect()->route('rekam.edit_pengkajian', $pasien->id)->with('warning', 'Data rekam medis belum diisi');
        }

        $diagnosa = RekamMedis::getData('diagnosa', $pasien->id);
        $luaran = RekamMedis::getData('luaran', $pasien->id);
        $evaluasi = RekamMedis::getData('evaluasi', $pasien->id);

        $common_data = $this->getCommonData($pasien);
        $common_data_evaluasi = $this->getCommonDataEvaluasi($pasien);

        $pengkajian['tanda_mayor'] = $common_data['tanda_mayor'];
        $pengkajian['tanda_minor'] = $common_data['tanda_minor'];
        $pengkajian['etiologi'] = $common_data['etiologi'];
        
        $evaluasi['tanda_mayor'] = $common_data_evaluasi['tanda_mayor'];
        $evaluasi['tanda_minor'] = $common_data_evaluasi['tanda_minor'];

        if(isset($pengkajian['durasi_nyeri'])){
            $pengkajian['durasi_nyeri'] = $pengkajian['durasi_nyeri'] == 'kurang_3' ? 'Nyeri < 3bulan' : 'Nyeri > 3bulan';
        }else{
            $pengkajian['durasi_nyeri'] = 'Tidak ada keluhan tambahan';
        }

        if(isset($evaluasi['durasi_nyeri'])){
            $evaluasi['durasi_nyeri'] = $evaluasi['durasi_nyeri'] == 'kurang_3' ? 'Nyeri < 3bulan' : 'Nyeri > 3bulan';
        }else{
            $evaluasi['durasi_nyeri'] = 'Tidak ada keluhan tambahan';
        }

        $rekam_medis = array_merge(['pengkajian' => $pengkajian], ['diagnosa' => $diagnosa], ['luaran' => $luaran], ['evaluasi' => $evaluasi]);
        
        $intervensi = Intervensi::with('opsi_intervensi')->whereHas('opsi_intervensi', function($opsi) use($rekam_medis){
            return $opsi->whereIn('id', json_decode(($rekam_medis['luaran']['intervensi_child'] ?? "[]")));
        })->get();

        $intervensi->map(function($inter) use($rekam_medis){
            $inter->opsi_intervensi = $inter->opsi_intervensi->map(function($opsi) use($rekam_medis){
                $opsi->opsi_child->map(function($child) use($rekam_medis){
                    $child->is_checked = in_array($child->id, json_decode(($rekam_medis['luaran']['intervensi_child'] ?? "[]")));
                    return $child;
                });
                return $opsi;
            });
            return $inter;
        });

        $rekam_medis['intervensi'] = $intervensi;
        $pasien->diagnosa_medis = $diagnosa['diagnosa'] ?? '-';
        $pasien->keluhan_utama = $pengkajian['keluhan_utama'] ?? '-';

        $data = [
            'rekam_medis' => $rekam_medis,
            'pasien' => $pasien
        ];

        return view('rekam-medis.show.index', $data);
    }
}
