<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntidadeFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nome' => 'required|max:50',
            'cidade' => 'required|max:50',
            'provincia' => 'required|max:50',
            'nuit' => 'max:15',
            'avrua' => 'max:100',
            'telefone' => 'max:13',
            'email' => 'max:100',
        ];
    }
}
