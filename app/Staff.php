<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'tbcolaborador'; 
    protected $primaryKey = 'idcolaborador'; 

    public $timestamps = false; 

    protected $fillable = [
    	'idcontrato',
    	'iddepartamento',
    	'processo',
        'nome',
        'dataNascimento',
        'sexo',
        'nomePai',
        'nomeMae',
        'bi',
        'dataEmisaoBi',
        'dataValidadeBi',
        'nuit',
        'inss',
        'dataAberturaInss',
        'formacaoAcademica',
        'telefone',
        'email',
        'tipo',
    	];

    protected $guarded = [

    ];
}
