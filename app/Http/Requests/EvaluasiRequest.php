<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EvaluasiRequest extends FormRequest
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
            'data.analisa' => ['required'],
            'data.planning' => ['required'],
            'data.provoking' => ['required'],
            'data.quality' => ['required'],
            'data.rasa_nyeri' => ['required'],
            'data.region' => ['required'],
            'data.severity' => ['required'],
            'data.tanda_objektif' => ['required'],
            'data.time' => ['required'],
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
            'data.analisa.required' => trans('validation.required', ['attribute' => 'analisa']),
            'data.planning.required' => trans('validation.required', ['attribute' => 'planning']),
            'data.provoking.required' => trans('validation.required', ['attribute' => 'provoking']),
            'data.quality.required' => trans('validation.required', ['attribute' => 'quality']),
            'data.rasa_nyeri.required' => trans('validation.required', ['attribute' => 'data subjektif rasa nyeri']),
            'data.region.required' => trans('validation.required', ['attribute' => 'region']),
            'data.severity.required' => trans('validation.required', ['attribute' => 'severity']),
            'data.tanda_objektif.required' => trans('validation.required', ['attribute' => 'tanda_objektif']),
            'data.time.required' => trans('validation.required', ['attribute' => 'time']),
        ];
    }
}
