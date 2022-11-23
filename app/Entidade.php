<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entidade extends Model
{
    protected $table = 'tbentidade'; 
    protected $primaryKey = 'identidade'; 

    public $timestamps = false; 

    protected $fillable = [
    	'nome',
    	'provincia',
        'cidade',
        'telefone',
        'nuit',
        'fax',
        'avrua',
        'email',
        'registo',
        'imagem',
    	];

    protected $guarded = [

    ];
}
