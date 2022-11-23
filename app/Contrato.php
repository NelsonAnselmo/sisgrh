<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = 'tbcontrato'; 
    protected $primaryKey = 'idcontrato'; 

    public $timestamps = false; 

    protected $fillable = [
    	'nome',
    	'descricao',
    	'condicao',
    	];

    protected $guarded = [

    ];
}
