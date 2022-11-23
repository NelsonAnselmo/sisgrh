<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormacaoFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|max:225',
            'descricao' => 'max:255'
        ];
    }
}
