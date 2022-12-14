<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColaboradorContrato extends Model
{
   
    protected $table = 'tbcolaboradorcontrato'; 
    protected $primaryKey = 'id'; 

    public $timestamps = false; 

    protected $fillable = [
    	'idcontrato',
        'idcolaborador',
    	'dataContrato',
    	'dataValidade',
    	'estado',
    	];

    protected $guarded = [

    ];
}
