<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PasienRequest extends FormRequest
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
            'nama' => ['required', 'max:100'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-Laki', 'Perempuan'])],
            'tempat_lahir' => ['required', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'alamat' => ['required', 'max:255'],
            'no_hp' => ['required', 'max:15'],
            'tanggal_masuk' => ['required', 'date'],
            'tanggal_keluar' => ['required', 'date'],
            'nama_wali' => ['required', 'max:100'],
            'hubungan_wali' => ['required', Rule::in(['Ayah', 'Ibu', 'Kakak', 'Adik', 'Lainnya'])],
            'kontak_wali' => ['required', 'max:255'],
            'no_rm' => ['required', 'max:255'],
        ];
    }
}
