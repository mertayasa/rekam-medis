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
            ->addColumn('status', function ($pasien) {
                return $pasien->tanggal_keluar == null ? '<b>Belum Keluar</b>' : 'Sudah Keluar';
            })
            ->addColumn('action', function ($pasien) {
                $deleteUrl = "'" . route('pasien.destroy', $pasien->id) . "', 'datatable'";

                if($pasien->tanggal_keluar == null){
                  $penanda = '<li><a class="dropdown-item" x-on:click="$store.pasienModal.setKeluar($event)" data-id="'. $pasien->id .'" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tandai Pasien Sudah Keluar" href="#">Tandai Sudah Keluar</a></li>';
                }else{
                  $penanda = '';
                }

                return '<div class="dropdown">
                <a class="btn btn-sm btn-warning dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  Aksi
                </a>
              
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" x-on:click="$store.pasienModal.getPasien($event)" data-id="'. $pasien->id .'" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lihat" href="#">Lihat Biodata</a></li>
                  '. $penanda .'
                  <li><a href="' . route('pasien.edit', $pasien->id) . '" class="dropdown-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Edit Pasien</a>
                  <li><a href="' . route('rekam.edit_pengkajian', $pasien->id) . '" class="dropdown-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Edit Rekam Medis</a>
                  <li><a href="' . route('rekam.show_detail', $pasien->id) . '" class="dropdown-item" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Lihat Rekam Medis</a>
                  <li><a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="dropdown-item text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px"><b>Hapus</b></a></li>
                </ul>
              </div>';
                // return
                //     '<div class="btn-group">'.
                //         '<button class="btn btn-sm btn-info" x-on:click="$store.pasienModal.getPasien($event)" data-id="'. $pasien->id .'" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Lihat" style="margin-right: 5px" >Biodata</button>' .
                //         '<a href="' . route('pasien.edit', $pasien->id) . '" class="btn btn-sm btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" >Edit Rekam Medis</a>' .
                //         '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px">Hapus</a>' .
                //     '</div>';
            })->addIndexColumn()->rawColumns(['action', 'status'])->make(true);
    }
}
