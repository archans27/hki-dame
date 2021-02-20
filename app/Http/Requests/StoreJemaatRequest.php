<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreJemaatRequest extends FormRequest
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
            // 'keluarga_id' => ['required'],
            // 'sektor_id' => ['required'],
            // 'nama' => ['required'],
            // 'no_anggota' => ['required'],
            // 'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            // 'tempat_lahir' => ['required'],
            // 'tanggal_lahir' => ['required'],
            // 'golongan_darah' => [ Rule::in(['-','A', 'B', 'AB', 'O']) ],
            // 'status_rumah' => ['required', Rule::in(['Tetap', 'Sementara'])],
            // 'pendidikan' => [Rule::in(['-', 'SD', 'SMP', 'SMA/SMK', 'DIPLOMA (D1, D2, D3)', 'SARJANA (D4, S1)', 'MAGISTER (S2)', 'DOKTORAL (S3)'])],
            // 'pekerjaan' => ['required'],
            // 'tanggal_anggota' => ['required','date'],
            // 'hidup' => ['required', 'boolean'],
            // 'alamat_rumah' => [],
            // 'nomor_telepon' => [],
            // 'foto' => [],
        ];
    }
}
