<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreJemaatLahirRequest extends FormRequest
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
            'keluarga_api' => 'required|exists:keluarga,id',
            'nama' => ['required'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required', 'date_format:"d-m-Y"'],
            'golongan_darah' => [ Rule::in(['-','A', 'B', 'AB', 'O']) ],
            'status_anak' => ['required', Rule::in(['Kandung', 'Angkat'])],
            "tk_gereja" => 'nullable|numeric|min:0',
            "tk_pendeta" => 'nullable|numeric|min:0',
            "tk_pendeta_diperbantukan" => 'nullable|numeric|min:0',
            "tk_majelis" => 'nullable|numeric|min:0',
            "tk_guru_jemaat" => 'nullable|numeric|min:0',
            "tk_lain_lain" => 'nullable|numeric|min:0',
            'temporary' => ['nullable', 'boolean'],
        ];
    }
}
