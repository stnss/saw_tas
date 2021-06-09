<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlternatifRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-Z ]+$/'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nama Alternatif'
        ];
    }

    public function messages() {
        return [
            'name.required' => 'Nama Alternatif tidak boleh kosong!',
            'name.regex' => 'Nama Alternatif tidak dapat mengandung selain alphabet dan (spasi)'
        ];
    }
}
