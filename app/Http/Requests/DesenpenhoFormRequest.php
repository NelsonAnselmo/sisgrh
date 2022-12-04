<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DesenpenhoFormRequest extends FormRequest
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
            'idcolaborador'   =>'required',
            'idsupervisora'   =>'required',
            'nomeprojecto'    =>'required|max:100',
            'dataini'         =>'required',
            'assiduidade'     =>'required|max:225',
            'assi_nota'       =>'required|max:20',
            'responsablidade' =>'required|max:225',
            'res_nota'        =>'required|max:20',
            'meta'            =>'required|max:225',
            'meta_nota'       =>'required|max:20',
            'registo'         =>'required|max:225',
            'registo_nota'    =>'required|max:20',
            'comentario'      =>'required|max:225'
        ];
    }
}
