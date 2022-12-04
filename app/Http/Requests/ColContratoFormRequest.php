<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColContratoFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'dataContrato' => 'required',
            'dataValidade' => 'required',
        ];;
    }
}
