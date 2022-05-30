<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class PasienDataTable
{
    static public function set($pasien)
    {
        return Datatables::of($pasien)
            ->addColumn('umur', function ($pasien) {
                return getAge($pasien->tanggal_lahir).' Tahun';
            })
            ->addColumn('action', function ($pasien) {
                $deleteUrl = "'" . route('pasien.destroy', $pasien->id) . "', 'datatable'";
                return
                    '<div class="btn-group">'.
                        '<button class="btn btn-sm btn-info" x-on:click="$store.pasienModal.getPasien($event)" data-id="'. $pasien->id .'" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lihat" style="margin-right: 5px" >Biodata</button>' .
                        '<a href="' . route('pasien.edit', $pasien->id) . '" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Edit & Rekam Medis</a>' .
                        '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px">Hapus</a>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}
