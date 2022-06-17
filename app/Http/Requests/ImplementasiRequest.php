<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            'data.date' => ['required', 'date'],
            'data.time' => ['nullable'],
            'data.perawat_pelaksana' => ['required', 'max:255']
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
            'data.date.required' => trans('validation.required', ['attribute' => 'tanggal']),
            'data.perawat_pelaksana.required' => trans('validation.required', ['attribute' => 'perawat pelaksana']),
        ];
    }
}
