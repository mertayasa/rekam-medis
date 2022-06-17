<?php

namespace App\Http\Controllers;

use App\Http\Requests\DiagnosaRequest;
use App\Http\Requests\EvaluasiRequest;
use App\Http\Requests\ImplementasiRequest;
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
        $tanda_mayor = $common_data['tanda_mayor'];
        $tanda_minor = $common_data['tanda_minor'];
        $etiologi = $common_data['etiologi'];
        $etiologi = Etiologi::all();
        $intervensi = Intervensi::with('opsi_intervensi', 'opsi_intervensi.opsi_child')->get(['id', 'value', 'keterangan', 'is_main', 'id_parent']);

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

            return $inter;
        });

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

            // $selected_intervensi = [];
            // foreach ($data['intervensi'] as $key => $intervensi) {
            //     if($intervensi['is_checked']){
            //         $selected_intervensi[] = $intervensi['id'];
            //     }
            // }

            // return response($selected_intervensi);
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
                'perawat_pelaksana' => $data['data']['perawat_pelaksana'] ?? [],
                'date' => $data['data']['date'] ?? [],
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
            'redirect_to_rimplementasi' => route('rekam.edit_implementasi', $pasien->id),
        ], 200);
    }

    public function editImplementasi(Pasien $pasien)
    {
        $pasien_all = Pasien::get()->pluck('nama_and_rm', 'id');
        $pasien_all->prepend('Cari pasien', '');
        
        $data = [
            'prev_btn' => [
                'url' => (!$pasien->id) ? route('pasien.index') : route('rekam.edit_diagnosa', $pasien->id),
                'label' => (!$pasien->id) ? 'Kembali ke halaman pasien' : 'Kembali ke halaman luaran'
            ],
            'pasien' => $pasien,
            'pasien_all' => $pasien_all,
        ];

        return view('rekam-medis.edit.implementasi', $data);
    }

    public function getImplementasi(Pasien $pasien)
    {
        $implementasi = RekamMedis::where('id_pasien', $pasien->id)->where('group', 'implementasi')->get();

        $value_implementasi = [];
        $luaran = RekamMedis::getData('luaran', $pasien->id);
        $diagnosa = RekamMedis::getData('diagnosa', $pasien->id);
        $pasien->diagnosa_keperawatan = $diagnosa['diagnosa'] ?? null;

        if($luaran == []){
            $luaran['luaran'] = '';
        }

        if($implementasi == []){
            $implementasi['implementasi'] = '';
        }

        $intervensi = Intervensi::with('opsi_intervensi', 'url_yt_intervensi')->whereHas('opsi_intervensi', function($opsi) use($luaran){
            return $opsi->whereIn('id', json_decode(($luaran['intervensi_child'] ?? "[]")));
        })->get();

        // Get history intervensi implementasi
        $value_implementasi = $this->getHistoryImplementasi($implementasi, $luaran);
        
        $intervensi->map(function($inter) use($implementasi, $pasien, $luaran){
            $inter->opsi_intervensi = $inter->opsi_intervensi->map(function($opsi) use($implementasi, $luaran){
                $opsi->opsi_child->map(function($child) use($implementasi, $luaran){
                    $child->is_checked = in_array($child->id, json_decode(($luaran['intervensi_child'] ?? "[]")));
                    $child->implementasi_is_checked = in_array($child->id, json_decode(($implementasi['checked_intervensi_child'] ?? "[]")));
                    return $child;
                });
                return $opsi;
            });
            return $inter;
        });

        $intervensi = $this->getFormattedIntervensi($intervensi);

        $checkbox_intervensi = view('includes.implementasi.intervensi', ['intervensi' => $intervensi, 'set_checked' => true])->render();

        return response([
            'intervensi' => $intervensi,
            'pasien' => $pasien,
            'value_implementasi' => $value_implementasi,
            'checkbox_intervensi' => $checkbox_intervensi,
            'date',
            'time',
            'perawat_pelaksana',
            'implementasi' => [
                'intervensi_child' => [],
                'checked_intervensi_child' => [],
            ],
            'table_implementasi' => view('includes.history.implementasi', ['value_implementasi' => $value_implementasi])->render(),
        ]);
    }

    private function getHistoryImplementasi($implementasi, $luaran)
    {
        $value_implementasi = [];

        $intervensi = Intervensi::with('opsi_intervensi', 'url_yt_intervensi')->whereHas('opsi_intervensi', function($opsi) use($luaran){
            return $opsi->whereIn('id', json_decode(($luaran['intervensi_child'] ?? "[]")));
        })->get();

        foreach($implementasi as $key => $implemen){
            $imple = $implemen->getHistory();
            $value_implementasi[$key] = $imple;

            $value_implementasi[$key]['intervensi_child'] = $luaran['intervensi_child'] ?? "[]";
            $value_implementasi[$key]['checked_intervensi_child'] = $imple['checked_intervensi_child'] ?? "[]";

            $raw_intervensi = $intervensi->map(function($inter) use($value_implementasi, $key){
                $inter->opsi_intervensi = $inter->opsi_intervensi->map(function($opsi) use($value_implementasi, $key){
                    $opsi->opsi_child->map(function($child) use($value_implementasi, $key){
                        $child->is_checked = in_array($child->id, json_decode(($value_implementasi[$key]['intervensi_child'] ?? "[]")));
                        $child->implementasi_is_checked = in_array($child->id, json_decode(($value_implementasi[$key]['checked_intervensi_child'] ?? "[]")));
                        return $child;
                    });
                    return $opsi;
                });
                return $inter;
            });

            $value_implementasi[$key]['raw_intervensi'] = $this->getFormattedIntervensi($raw_intervensi);
        }

        return $value_implementasi;
    }

    public function updateImplementasi(ImplementasiRequest $request, Pasien $pasien)
    {
        try{
            $to_update = $request->validated();
            // return $to_update;
            unset($to_update['data']['implementasi']);
            unset($to_update['data']['intervensi_child']);

            DB::transaction(function () use($pasien, $to_update) {
                $rekam_medis = RekamMedis::create([
                    'id_pasien' => $pasien->id,
                    'group' => 'implementasi',
                    'key' => 'dummy'
                ]);
    
                foreach ($to_update['data'] as $key => $value) {
                    $rekam_medis->rekam_medis_history()->create(
                        [
                            'id_pasien' => $pasien->id,
                            'group' => 'implementasi',
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

        session()->flash('success', 'Data implementasi keperawatan berhasil di-update');
        return response([
            'message' => 'Berhasil menyimpan data', 
            'redirect_to' => route('pasien.index'),
            'redirect_to_revaluasi' => route('rekam.edit_evaluasi', $pasien->id),
        ], 200);
    }

    public function editEvaluasi(Pasien $pasien)
    {
        $pasien_all = Pasien::get()->pluck('nama_and_rm', 'id');
        $pasien_all->prepend('Cari pasien', '');

        $tanda_mayor = TandaMayor::all();
        $tanda_minor = TandaMinor::all();

        $tanda_mayor->map(function($tanda){
            $tanda->is_checked = false;
            return $tanda;
        });

        $tanda_minor = $tanda_minor->map(function($minor){
            $minor->is_checked = false;
            return $minor;
        });

        $data = [
            'prev_btn' => [
                'url' => route('rekam.edit_implementasi', $pasien->id),
                'label' => 'Kembali ke halaman implementasi'
            ],
            'pasien_all' => $pasien_all,
            'pasien' => $pasien,
            'tanda_mayor' => $tanda_mayor,
            'tanda_minor' => $tanda_minor,
        ];

        return view('rekam-medis.edit.evaluasi', $data);
    }

    public function getEvaluasi(Pasien $pasien)
    {   
        $evaluasi = RekamMedis::where('id_pasien', $pasien->id)->where('group', 'evaluasi')->get();
        $value_evaluasi = $this->getHistoryEvaluasi($evaluasi);

        return response([
            'pasien' => $pasien,
            'evaluasi' => [
                'analisa' => '',
                'planning' => '',
                'provoking' => '',
                'quality' => '',
                'rasa_nyeri' => '',
                'region' => '',
                'severity' => '',
                'time' => '',
                'time_periksa' => '',
            ],
            'table_evaluasi' => view('includes.history.evaluasi', ['value_evaluasi' => $value_evaluasi])->render(),
        ]);

    }

    private function getHistoryEvaluasi($evaluasi)
    {
        $value_evaluasi = [];

        foreach ($evaluasi as $key => $evalua) {
            $eval = $evalua->getHistory();
            $tanda_mayor = TandaMayor::all();
            $tanda_minor = TandaMinor::all();

            $value_evaluasi[$key] = $eval;

            $tanda_mayor_list = [];
            $tanda_minor_list = [];

            foreach ($tanda_mayor as $tanda) {
                if(isset($eval['tanda_mayor']) && in_array($tanda->id, json_decode($eval['tanda_mayor']))){
                    $tanda_mayor_list[] = $tanda->value;
                }
            }

            foreach ($tanda_minor as $tanda) {
                if(isset($eval['tanda_minor']) && in_array($tanda->id, json_decode($eval['tanda_minor']))){
                    $tanda_minor_list[] = $tanda->value;
                }
            }

            $value_evaluasi[$key]['tanda_mayor'] = $tanda_mayor_list;
            $value_evaluasi[$key]['tanda_minor'] = $tanda_minor_list;

            $value_evaluasi[$key]['analisa'] = getAnalisa($value_evaluasi[$key]['analisa'] ?? '');
            $value_evaluasi[$key]['rasa_nyeri'] = getRasaNyeri($value_evaluasi[$key]['rasa_nyeri'] ?? '');
            $value_evaluasi[$key]['durasi_nyeri'] = getDurasiNyeri($value_evaluasi[$key]['durasi_nyeri'] ?? '');
        }

        return $value_evaluasi;
    }

    public function updateEvaluasi(EvaluasiRequest $request, Pasien $pasien)
    {
        
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
                $rekam_medis = RekamMedis::create([
                    'id_pasien' => $pasien->id,
                    'group' => 'evaluasi',
                    'key' => 'dummy'
                ]);

                foreach ($to_update as $key => $value) {
                    if($value != null){
                        $rekam_medis->rekam_medis_history()->create(
                            [
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

        $data = $this->getDetailData($pasien);
        // dd($data);
        return view('rekam-medis.show.index', $data);
    }
    
    public function print(Pasien $pasien)
    {
        $pengkajian = RekamMedis::getData('pengkajian', $pasien->id);
        if(!$pengkajian){
            return redirect()->route('rekam.edit_pengkajian', $pasien->id)->with('warning', 'Data rekam medis belum diisi');
        }

        $data = $this->getDetailData($pasien);
        return view('rekam-medis.show.print', $data);
    }

    private function getDetailData($pasien)
    {
        $pengkajian = RekamMedis::getData('pengkajian', $pasien->id);
        $diagnosa = RekamMedis::getData('diagnosa', $pasien->id);
        $luaran = RekamMedis::getData('luaran', $pasien->id);
        // $evaluasi = RekamMedis::getData('evaluasi', $pasien->id);
        $evaluasi = RekamMedis::where('id_pasien', $pasien->id)->where('group', 'evaluasi')->get();
        // $implementasi = RekamMedis::getData('implementasi', $pasien->id);
        $implementasi = RekamMedis::where('id_pasien', $pasien->id)->where('group', 'implementasi')->get();

        $common_data = $this->getCommonData($pasien);
        $common_data_evaluasi = $this->getCommonDataEvaluasi($pasien);

        $pengkajian['tanda_mayor'] = $common_data['tanda_mayor'];
        $pengkajian['tanda_minor'] = $common_data['tanda_minor'];
        $pengkajian['etiologi'] = $common_data['etiologi'];
        
        // $evaluasi['tanda_mayor'] = $common_data_evaluasi['tanda_mayor'];
        // $evaluasi['tanda_minor'] = $common_data_evaluasi['tanda_minor'];

        if(isset($pengkajian['durasi_nyeri'])){
            $pengkajian['durasi_nyeri'] = $pengkajian['durasi_nyeri'] == 'kurang_3' ? 'Nyeri < 3bulan' : 'Nyeri > 3bulan';
        }else{
            $pengkajian['durasi_nyeri'] = 'Tidak ada keluhan tambahan';
        }

        // if(isset($evaluasi['durasi_nyeri'])){
        //     $evaluasi['durasi_nyeri'] = $evaluasi['durasi_nyeri'] == 'kurang_3' ? 'Nyeri < 3bulan' : 'Nyeri > 3bulan';
        // }else{
        //     $evaluasi['durasi_nyeri'] = 'Tidak ada keluhan tambahan';
        // }

        $rekam_medis = array_merge(['pengkajian' => $pengkajian] ?? [], ['diagnosa' => $diagnosa] ?? [], ['luaran' => $luaran] ?? [], ['implementasi' => $implementasi] ?? [], ['evaluasi' => $evaluasi] ?? []);
        
        $intervensi = Intervensi::with('opsi_intervensi', 'url_yt_intervensi')->whereHas('opsi_intervensi', function($opsi) use($rekam_medis){
            return $opsi->whereIn('id', json_decode(($rekam_medis['luaran']['intervensi_child'] ?? "[]")));
        })->get();

        $intervensi->map(function($inter) use($rekam_medis, $pasien){
            $inter->opsi_intervensi = $inter->opsi_intervensi->map(function($opsi) use($rekam_medis){
                $opsi->opsi_child->map(function($child) use($rekam_medis){
                    $child->is_checked = in_array($child->id, json_decode(($rekam_medis['luaran']['intervensi_child'] ?? "[]")));
                    return $child;
                });
                return $opsi;
            });
            return $inter;
        });

        $rekam_medis['intervensi'] = $this->getFormattedIntervensi($intervensi) ?? [];
        $pasien->diagnosa_keperawatan = $diagnosa['diagnosa'] ?? '-';
        $pasien->keluhan_utama = $pengkajian['keluhan_utama'] ?? '-';

        foreach ($rekam_medis['intervensi'] as $key => $intervensi) {
            if(isset($intervensi['url_yt_intervensi']) && $intervensi['url_yt_intervensi']){
                $rekam_medis['luaran']['share_link'] = route('rekam_intervensi.share', $pasien->id);
            }
        }

        $history_implementasi = $this->getHistoryImplementasi($implementasi, $luaran);
        $history_evaluasi = $this->getHistoryEvaluasi($evaluasi);
        // dd($history_evaluasi);

        $data = [
            'rekam_medis' => $rekam_medis,
            'pasien' => $pasien,
            'history_implementasi' => $history_implementasi,
            'history_evaluasi' => $history_evaluasi,
        ];

        return $data;
    }

    public function getFormattedIntervensi($intervensi)
    {
        $intervensi = $intervensi->toArray();

        foreach ($intervensi as $key => $inter) {
            if($inter['id_parent'] != null){
                $parent_inter = array_search($inter['id_parent'], array_column($intervensi, 'id'));
                $intervensi[$parent_inter]['another_child'][] = $inter;
            }
        }

        return $intervensi;
    }

    public function publicLink(Pasien $pasien)
    {
        $luaran = RekamMedis::getData('luaran', $pasien->id);
        
        if(!$luaran){
            abort(404, 'Data Rekam Medis Tidak Ditemukan');
        }

        $intervensi = Intervensi::all();

        $intervensi = Intervensi::with('opsi_intervensi', 'url_yt_intervensi')->whereHas('opsi_intervensi', function($opsi) use($luaran){
            return $opsi->whereIn('id', json_decode(($luaran['intervensi_child'] ?? "[]")));
        })->get();

        // dd($intervensi);

        $data = [
            'pasien' => $pasien,
            'intervensi' => $intervensi,
        ];

        return view('rekam-medis.public.intervensi', $data);
    }
}
