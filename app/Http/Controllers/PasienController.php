<?php

namespace App\Http\Controllers;

use App\DataTables\PasienDataTable;
use App\Http\Requests\PasienRequest;
use App\Models\Pasien;
use App\Models\RekamMedis;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PasienController extends Controller
{
    public function index()
    {
        return view('pasien.index');
    }

    public function datatable()
    {
        $pasien = Pasien::all();
        return PasienDataTable::set($pasien);
    }

    public function find(Pasien $pasien)
    {
        $diagnosa = RekamMedis::getData('diagnosa', $pasien->id);
        $pengkajian = RekamMedis::getData('pengkajian', $pasien->id);

        $pasien->diagnosa_medis = $diagnosa['diagnosa'] ?? '-';
        $pasien->keluhan_utama = $pengkajian['keluhan_utama'] ?? '-';

        return response($pasien);
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(PasienRequest $request)
    {
        try{
            $pasien = Pasien::create($request->validated());
        }catch(Exception $e){
            Log::error($e);
            return response(['message' => 'Terjadi kesalahan pada server'], 500);
        }
        
        session()->flash('success', 'Pasien berhasil ditambahkan');
        return response([
            'message' => 'Berhasil menyimpan data', 
            'redirect_to' => route('pasien.index'),
            'redirect_to_rmedis' => route('rekam.edit_pengkajian', $pasien->id),
        ], 200);
    }

    public function show(Pasien $pasien)
    {
        //
    }

    public function edit(Pasien $pasien)
    {
        $data = [
            'prev_btn' => [
                'url' => route('pasien.index'),
                'label' => 'Kembali'
            ],
            'pasien' => $pasien
        ];

        return view('pasien.edit', $data);
    }

    public function update(PasienRequest $request, Pasien $pasien)
    {
        try{
            $pasien->update($request->validated());
        }catch(Exception $e){
            Log::error($e);
            return response(['message' => 'Terjadi kesalahan pada server'], 500);
        }
        
        session()->flash('success', 'Pasien berhasil diubah');
        return response([
            'message' => 'Berhasil menyimpan data', 
            'redirect_to' => route('pasien.index'),
            'redirect_to_rmedis' => route('rekam.edit_pengkajian', $pasien->id),
        ], 200);
    }

    public function destroy(Pasien $pasien)
    {
        try {
            $pasien->delete();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus pasien']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus pasien']);
    }

    public function setKeluar(Pasien $pasien)
    {
        try {
            $pasien->update(['tanggal_keluar' => Carbon::now()]);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['message' => 'Gagal menyimpan tanggal keluar pasien'], 500);
        }

        return response(['message' => 'Berhasil menyimpan tanggal keluar pasien'], 200);
    }
}
