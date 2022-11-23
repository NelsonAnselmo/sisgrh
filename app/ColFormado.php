<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ColFormado extends Model
{
    protected $table = 'tbcolformados'; 
    protected $primaryKey = 'idcolformado'; 

    public $timestamps = false; 

    protected $fillable = [
    	'idcolaborador',
    	'idformacao',
    	'datainicio',
    	'dataconclusao',
    	];

    protected $guarded = [

    ];
}
