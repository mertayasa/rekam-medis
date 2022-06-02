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
            'data' => ['required', 'array'],
            'data.diaphores' => ['required'],
            'data.frekuensi_nadi' => ['required'],
            'data.gelisah' => ['required'],
            'data.keluhan_nyeri' => ['required'],
            'data.kesulitan_tidur' => ['required'],
            'data.meringis' => ['required'],
            'data.mual' => ['required'],
            'data.muntah' => ['required'],
            'data.nafsu_makan' => ['required'],
            'data.nama_penyakit' => ['required'],
            'data.non_farmakologis' => ['required'],
            'data.nyeri_terkontrol' => ['required'],
            'data.onset_nyeri' => ['required'],
            'data.operation_end' => ['required'],
            'data.operation_start' => ['required'],
            'data.penyebab_nyeri' => ['required'],
            'data.pola_nafas' => ['required'],
            'data.sikap_protektif' => ['required'],
            'data.tekanan_darah' => ['required'],
            'data.durasi_nyeri' => ['required'],
            'data.intervensi_child' => ['required'],
            'etiologi' => ['required'],
            'tanda_mayor' => ['required'],
            'tanda_minor' => ['required'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => $validator->errors()
            ], 422)
        );
    }

    public function messages()
    {
        return [
            'data.diaphores.required' => trans('validation.required', ['attribute' => 'diaphores']),
            'data.frekuensi_nadi.required' => trans('validation.required', ['attribute' => 'frekuensi nadi']),
            'data.gelisah.required' => trans('validation.required', ['attribute' => 'gelisah']),
            'data.keluhan_nyeri.required' => trans('validation.required', ['attribute' => 'keluhan nyeri']),
            'data.kesulitan_tidur.required' => trans('validation.required', ['attribute' => 'kesulitan tidur']),
            'data.meringis.required' => trans('validation.required', ['attribute' => 'meringis']),
            'data.mual.required' => trans('validation.required', ['attribute' => 'mual']),
            'data.muntah.required' => trans('validation.required', ['attribute' => 'muntah']),
            'data.nafsu_makan.required' => trans('validation.required', ['attribute' => 'nafsu makan']),
            'data.nama_penyakit.required' => trans('validation.required', ['attribute' => 'nama penyakit']),
            'data.non_farmakologis.required' => trans('validation.required', ['attribute' => 'non farmakologis']),
            'data.nyeri_terkontrol.required' => trans('validation.required', ['attribute' => 'nyeri terkontrol']),
            'data.onset_nyeri.required' => trans('validation.required', ['attribute' => 'onset nyeri']),
            'data.operation_end.required' => trans('validation.required', ['attribute' => 'durasi rawat']),
            'data.operation_start.required' => trans('validation.required', ['attribute' => 'durasi rawat']),
            'data.penyebab_nyeri.required' => trans('validation.required', ['attribute' => 'penyebab nyeri']),
            'data.pola_nafas.required' => trans('validation.required', ['attribute' => 'pola nafas']),
            'data.sikap_protektif.required' => trans('validation.required', ['attribute' => 'sikap protektif']),
            'data.tekanan_darah.required' => trans('validation.required', ['attribute' => 'tekanan darah']),
            'data.durasi_nyeri.required' => trans('validation.required', ['attribute' => 'durasi nyeri']),
            'data.intervensi_child.required' => trans('validation.required', ['attribute' => 'intervensi']),
        ];
    }
}
