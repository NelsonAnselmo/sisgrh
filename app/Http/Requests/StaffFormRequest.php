<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            
            'nome'           => 'required|string|max:50',
            'processo'       => 'required|string|max:20',
            'sexo'           => 'required|string',
            'bi'             => 'max:13',
            'telefone'       => 'max:13',
            'idcontrato'     => 'required|max:30',
        ];
    }
}
