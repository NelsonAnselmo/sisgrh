<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formacao extends Model
{
    protected $table = 'tbformacao'; 
    protected $primaryKey = 'idformacao'; 

    public $timestamps = false; 

    protected $fillable = [
    	'nome',
    	'descricao',
    	'condicao',
    	];

    protected $guarded = [

    ];
}
