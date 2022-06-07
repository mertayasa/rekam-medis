<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImplementasiRequest extends FormRequest
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
            'data.checked_intervensi_child' => ['nullable', 'array'],
            'data.date' => ['nullable', 'date'],
            'data.time' => ['nullable'],
            'data.perawat_pelaksana' => ['required', 'max:255']
        ];
    }
}
