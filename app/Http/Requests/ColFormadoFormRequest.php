<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColFormadoFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'idcolaborador' => 'required',
            'idformacao' => 'required'
        ];
    }
}
