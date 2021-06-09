<?php

namespace App\Http\Requests;

use App\Models\Kriteria;
use Illuminate\Foundation\Http\FormRequest;

class StoreKriteriaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $sumBobot = Kriteria::all()->sum('bobot');
        return [
            'name' => 'required|regex:/^[a-zA-Z0-9 -&]+$/',
            'bobot' => 'required|numeric|between:0.001,'.(1 - $sumBobot),
            'type' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama Kriteria',
            'bobot' => 'Bobot Kriteria',
            'type' => 'Type Kriteria'
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Nama Kriteria tidak boleh kosong!',
            'name.regex' => 'Nama Kriteria tidak dapat mengandung selain alphanumeric, (spasi), - dan &',
            'bobot.required' => 'Bobot Kriteria tidak boleh kosong!',
            'bobot.numeric' => 'Bobot Kriteria tidak dapat mengandung selain angka!',
            'type.required' => 'Type Kriteria tidak boleh kosong!'
        ];
    }
}
