<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'tbdepartamento'; 
    protected $primaryKey = 'iddepartamento'; 

    public $timestamps = false; 

    protected $fillable = [
    	'nome',
    	'descricao',
    	'condicao'
    	];

    protected $guarded = [

    ]; 
}
