<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColContrato extends Model
{
    protected $table = 'tbcolaboradorcontrato'; 
    protected $primaryKey = 'id'; 

    public $timestamps = false;

    protected $fillable = [
    	'idcontrato',
    	'processo',
    	'dataContrato',
    	'dataValidade',
        'estado',
    	];

    protected $guarded = [

    ];
}
