<?php

namespace App\Http\Controllers;

use App\DataTables\PasienDataTable;
use App\Http\Requests\PasienRequest;
use App\Models\Pasien;
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
        return response($pasien);
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(PasienRequest $request)
    {
        //
    }

    public function show(Pasien $pasien)
    {
        //
    }

    public function edit(Pasien $pasien)
    {
        //
    }

    public function update(Request $request, Pasien $pasien)
    {
        //
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
}
