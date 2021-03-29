<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePernikahanRequest extends FormRequest
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
            'mempelai' => 'required|exists:jemaat,id',
            'pasangan_mempelai' => 'required|exists:jemaat,id',
            'pasangan_mempelai_sugestion' => 'required',
            'tanggal_pemberkatan' => 'required|date_format:d-m-Y'
        ];
    }
}
