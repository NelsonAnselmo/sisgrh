<?php

namespace App\Http\Controllers;

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

        $totalstaff = FacadesDB::table('tbcolaborador as c')
        ->join('tbcolaboradorcontrato as cc', 'c.processo', '=', 'cc.processo')
        ->select(FacadesDB::raw('count(c.idcolaborador) as total'))
        ->where('cc.estado', '=', 'Activo')
        ->where('c.tipo', '=', 'STAFF')
        ->first();

        $totalpdsc = FacadesDB::table('tbcolaborador as c')
        ->join('tbcolaboradorcontrato as cc', 'c.processo', '=', 'cc.processo')
        ->select(FacadesDB::raw('count(c.idcolaborador) as total'))
        ->where('cc.estado', '=', 'Activo')
        ->where('c.tipo', '=', 'PDSC')
        ->first();

        $totaldepartamento = FacadesDB::table('tbdepartamento')
        ->select(FacadesDB::raw('count(iddepartamento) as total'))
        ->where('condicao', '=', '1')
        ->first();

        $colabsex = FacadesDB::table('tbcolaborador')
        ->select(FacadesDB::raw('count(idcolaborador) as total'), 'sexo')
        ->groupBy('Sexo')
        ->get();

        $colabdep = FacadesDB::table('tbcolaborador as c')
        ->join('tbdepartamento as d', 'c.iddepartamento', '=', 'd.iddepartamento')
        ->select(FacadesDB::raw('count(c.idcolaborador) as total'), 'c.iddepartamento', 'd.nome as departamento')
        ->groupBy('c.iddepartamento', 'd.nome')
        ->get();

        return view('home', ['totalcurso'=>$totalcurso, 'totalstaff'=>$totalstaff, 'totalpdsc'=>$totalpdsc, 'totaldepartamento'=>$totaldepartamento, 'colabsex'=>$colabsex, 'colabdep'=>$colabdep]);
    }
}
