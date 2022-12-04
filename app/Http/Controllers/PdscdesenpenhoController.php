<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Desenpenho;
use Illuminate\Http\Request;
use App\Http\Requests\DesenpenhoFormRequest;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB as FacadesDB;

class PdscdesenpenhoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	$query = trim($request->get('searchText'));


        $desenpenhos = FacadesDB::table('tbavaliacao as a')
        ->join('tbcolaborador as c', 'a.idcolaborador', '=', 'c.idcolaborador')
        ->select('a.idavaliacao' ,'c.nome', 'c.nuit', 'c.sexo', 'c.telefone')
        ->where('c.nome','LIKE','%'.$query.'%')
        ->where('tipo', '=', 'PDSC')
        ->orwhere('c.sexo','LIKE','%'.$query.'%')
        ->where('tipo', '=', 'PDSC')
        ->paginate(7);  

    		return view('desenpenho.pdsc.index',['desenpenhos'=>$desenpenhos, 'searchText'=>$query]);
            
    }

    public function create()
    {

		$datahj = date("Y-m-d", strtotime(Carbon::now('Africa/Maputo')));

         $colaboradores = FacadesDB::table('tbcolaborador')
         ->where('tipo', '=', 'PDSC')
         ->get();

         $supervisor = FacadesDB::table('tbcolaborador')
         ->where('tipo', '=', 'STAFF')
         ->get();

    	return view('desenpenho.pdsc.create',['datahj'=>$datahj, 'colaboradores'=>$colaboradores, 'supervisor'=>$supervisor]);
    }

    public function store(DesenpenhoFormRequest $request)
    {

        $desenpenho = new Desenpenho();
    	$desenpenho -> idcolaborador = $request -> get('idcolaborador');
    	$desenpenho -> idsupervisora = $request -> get('idsupervisora');
    	$desenpenho -> nomeprojecto = $request -> get('nomeprojecto');
    	$desenpenho -> dataini = $request -> get('dataini');
    	$desenpenho -> assiduidade = $request -> get('assiduidade');
    	$desenpenho -> assi_nota = $request -> get('assi_nota');
    	$desenpenho -> responsablidade = $request -> get('responsablidade');
    	$desenpenho -> res_nota = $request -> get('res_nota');
    	$desenpenho -> meta = $request -> get('meta');
    	$desenpenho -> meta_nota = $request -> get('meta_nota');
    	$desenpenho -> registo = $request -> get('registo');
    	$desenpenho -> registo_nota = $request -> get('registo_nota');
    	$desenpenho -> comentario = $request -> get('comentario');
    	$desenpenho -> save();


        return Redirect('desenpenho/pdsc')->with('success', 'Desenpenho foi atribuido com Sucesso');
    	
    }

    public function show($id)
    {
        $desenpenho = FacadesDB::table('tbavaliacao as a')
        ->join('tbcolaborador as c', 'a.idcolaborador', '=', 'c.idcolaborador')
        ->select('a.idavaliacao' ,'c.nome', 'a.idsupervisora', 'a.nomeprojecto', 'a.dataini', 'a.assiduidade', 'a.assi_nota', 'a.responsablidade', 'a.res_nota', 'a.meta', 'a.meta_nota', 'a.registo', 'a.registo_nota', 'a.comentario')
        ->where('a.idavaliacao', '=', $id)
        ->first();

		return view('desenpenho.pdsc.show', ['desenpenho' =>$desenpenho]);
    }

    public function edit($id)
    {
        $entidade = FacadesDB::table('tbentidade')->first();
        $desenpenho = FacadesDB::table('tbavaliacao as a')
        ->join('tbcolaborador as c', 'a.idcolaborador', '=', 'c.idcolaborador')
        ->select('a.idavaliacao' ,'c.nome', 'a.idsupervisora', 'a.nomeprojecto', 'a.dataini', 'a.assiduidade', 'a.assi_nota', 'a.responsablidade', 'a.res_nota', 'a.meta', 'a.meta_nota', 'a.registo', 'a.registo_nota', 'a.comentario')
        ->where('a.idavaliacao', '=', $id)
        ->first();
		
        $pdf= FacadePdf::loadView('desenpenho.pdsc.pdf.pdf', ['desenpenho'=>$desenpenho, 'entidade'=>$entidade]);
        $pdf->setPaper('A4','portrait');
        return $pdf->stream('DESENPENHOPDSC.pdf');
    }

    public function update()
    {
    	
    }

    public function destroy($id)
    {
    	
    }
}
