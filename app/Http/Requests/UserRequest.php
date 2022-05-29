<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
        $rules = [
            'nama' => ['required', 'max:100', 'min:1'],
            'jabatan' => ['required', 'max:100', 'min:1'],
            'alamat' => ['required', 'max:255'],
            'tanggal_lahir' => ['required'],
            'tempat_lahir' => ['required'],
        ];

        if($this->method() == 'PATCH'){
            $rules += ['email' => ['required', 'min:6', 'max:100', 'unique:users,email,'.Auth::id()]];
            $rules += ['nik' => ['required', 'min:6', 'max:100', 'unique:users,nik,'.Auth::id()]];
            $rules += ['nip' => ['min:6', 'max:100', 'unique:users,nip,'.Auth::id()]];
            $rules += ['no_hp' => ['required', 'min:6', 'max:100', 'unique:users,no_hp,'.Auth::id()]];
        }else{
            $rules += ['email' => ['required', 'min:6', 'max:100', 'unique:users,email']];
            $rules += ['nik' => ['required', 'min:6', 'max:100', 'unique:users,nik']];
            $rules += ['nip' => ['min:6', 'max:100', 'unique:users,nip']];
            $rules += ['no_hp' => ['required', 'min:6', 'max:100', 'unique:users,no_hp']];
        };

        return $rules;
    }
}
