<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LuaranRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'luaran' => ['required', 'array'],
            'luaran.diaphores' => ['required'],
            'luaran.frekuensi_nadi' => ['required'],
            'luaran.gelisah' => ['required'],
            'luaran.keluhan_nyeri' => ['required'],
            'luaran.kesulitan_tidur' => ['required'],
            'luaran.meringis' => ['required'],
            'luaran.mual' => ['required'],
            'luaran.muntah' => ['required'],
            'luaran.nafsu_makan' => ['required'],
            'luaran.nama_penyakit' => ['required'],
            'luaran.non_farmakologis' => ['required'],
            'luaran.nyeri_terkontrol' => ['required'],
            'luaran.onset_nyeri' => ['required'],
            'luaran.operation_end' => ['required'],
            'luaran.operation_start' => ['required'],
            'luaran.penyebab_nyeri' => ['required'],
            'luaran.pola_nafas' => ['required'],
            'luaran.sikap_protektif' => ['required'],
            'luaran.tekanan_darah' => ['required'],
        ];
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(
            response()->json([
                'message' => $validator->errors()
            ], 422)
        );
    }
}
