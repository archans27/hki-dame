<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreJemaatBaruRequest extends FormRequest
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
            'nama' => ['required'],
            'no_anggota' => ['required'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required'],
            'golongan_darah' => [ Rule::in(['-','A', 'B', 'AB', 'O']) ],
            'pendidikan' => [Rule::in(['-', 'SD', 'SMP', 'SMA/SMK', 'DIPLOMA (D1, D2, D3)', 'SARJANA (D4, S1)', 'MAGISTER (S2)', 'DOKTORAL (S3)'])],
            'pekerjaan' => ['required'],
            'tanggal_anggota' => ['required','date'],
            'hidup' => ['required', 'boolean'],
            'nomor_telepon' => [],
            'alamat_jemaat_baru' => ['required'],
            'gereja_terakhir' => [],
            'gereja_lama_lain' => [],
            'persembahan_tahunan' => ['required','numeric','min:0'],
            "tk_gereja" => 'nullable|numeric|min:0',
            "tk_pendeta" => 'nullable|numeric|min:0',
            "tk_majelis" => 'nullable|numeric|min:0',
            "tk_guru_huria" => 'nullable|numeric|min:0',
            "tk_pengembangan" => 'nullable|numeric|min:0',
        ];
    }
}
