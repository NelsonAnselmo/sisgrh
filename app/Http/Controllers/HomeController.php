<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalcurso = FacadesDB::table('tbformacao')
        ->select(FacadesDB::raw('count(idformacao) as total'))
        ->where('condicao', '=', '1')
        ->first();

        $totalstaff = FacadesDB::table('tbcolaborador')
        ->select(FacadesDB::raw('count(idcolaborador) as total'))
        ->where('tipo', '=', 'STAFF')
        ->first();

        $totalpdsc = FacadesDB::table('tbcolaborador')
        ->select(FacadesDB::raw('count(idcolaborador) as total'))
        ->where('tipo', '=', 'PDSC')
        ->first();

        $totaldepartamento = FacadesDB::table('tbdepartamento')
        ->select(FacadesDB::raw('count(iddepartamento) as total'))
        ->where('condicao', '=', '1')
        ->first();
        
        return view('home', ['totalcurso'=>$totalcurso, 'totalstaff'=>$totalstaff, 'totalpdsc'=>$totalpdsc, 'totaldepartamento'=>$totaldepartamento]);
    }
}
