<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            
            'name'     => 'required|string|max:100',
            'sexo'     => 'required|string',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'bi'       => 'max:13',
            'telefone' => 'max:13',
            'tipo'     => 'required|max:30',
        ];
    }
}
