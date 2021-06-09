<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SAWRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'saw' => 'required',
            'saw.*.*' => 'integer'
        ];
    }

    public function attributes()
    {
        return [
            'saw' => 'Nilai Perbandingan'
        ];
    }

    public function messages() {
        return [
            'saw.required' => 'Nilai Perbandingan tidak boleh kosong!',
            'saw.*.*.integer' => 'Nilai Perbandingan harus mengandung angka'
        ];
    }
}
