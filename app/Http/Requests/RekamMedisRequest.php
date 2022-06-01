<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RekamMedisRequest extends FormRequest
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
        // return $this->all();
        return [
            'data' => 'required|array',
            // 'data.is_mengeluh_nyeri' => 'required|boolean',
            // 'data.is_mengeluh_nyeri' => 'required|string',
            'tanda_mayor' => 'required|array',
            'tanda_minor' => 'required|array',
            'kondisi_klinis' => 'required|array',
        ];
    }
}
