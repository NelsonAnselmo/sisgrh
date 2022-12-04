<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desenpenho extends Model
{
    protected $table = 'tbavaliacao'; 
    protected $primaryKey = 'idavaliacao'; 

    public $timestamps = false; 

    protected $fillable = [
    	'idcolaborador',
    	'idsupervisora',
    	'nomeprojecto',
    	'dataini',
    	'assiduidade',
    	'assi_nota',
    	'responsablidade',
    	'res_nota',
    	'meta',
    	'meta_nota',
    	'registo',
    	'registo_nota',
    	'comentario'
    	];

    protected $guarded = [

    ]; 
}
