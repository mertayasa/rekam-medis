<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function editPengkajian(Pasien $pasien)
    {
        $data = [
            'pasien' => $pasien,
        ];
        
        return view('rekam-medis.edit.pengkajian', $data);
    }
}
