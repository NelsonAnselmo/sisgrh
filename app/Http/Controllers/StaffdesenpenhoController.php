<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Desenpenho;
use Illuminate\Http\Request;
use App\Http\Requests\DesenpenhoFormRequest;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB as FacadesDB;

class StaffdesenpenhoController extends Controller
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
        ->select('a.idavaliacao' ,'c.nome', 'c.nuit', 'c.sexo', 'c.telefone', 'c.tipo')
        ->where('c.nome','LIKE','%'.$query.'%')
        ->where('tipo', '=', 'STAFF')
        ->orwhere('c.sexo','LIKE','%'.$query.'%')
        ->where('tipo', '=', 'STAFF')
        ->paginate(7);  

    		return view('desenpenho.staff.index',['desenpenhos'=>$desenpenhos, 'searchText'=>$query]);
            
    }

    public function create()
    {

		$datahj = date("Y-m-d", strtotime(Carbon::now('Africa/Maputo')));

         $colaboradores = FacadesDB::table('tbcolaborador')
         ->where('tipo', '=', 'STAFF')
         ->get();

         $supervisor = FacadesDB::table('tbcolaborador')
         ->where('tipo', '=', 'STAFF')
         ->get();

    	return view('desenpenho.staff.create',['datahj'=>$datahj, 'colaboradores'=>$colaboradores, 'supervisor'=>$supervisor]);
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
    	$desenpenho -> etica = $request -> get('etica');
    	$desenpenho -> etica_nota = $request -> get('etica_nota');
    	$desenpenho -> comentario = $request -> get('comentario');
    	$desenpenho -> save();


        return Redirect('desenpenho/staff')->with('success', 'Desenpenho foi atribuido com Sucesso');
    	
    }

    public function show($id)
    {
        $desenpenho = FacadesDB::table('tbavaliacao as a')
        ->join('tbcolaborador as c', 'a.idcolaborador', '=', 'c.idcolaborador')
        ->select('a.idavaliacao' ,'c.nome', 'a.idsupervisora', 'a.nomeprojecto', 'a.dataini', 'a.assiduidade', 'a.assi_nota', 'a.responsablidade', 'a.res_nota', 'a.meta', 'a.meta_nota', 'a.registo', 'a.registo_nota', 'a.etica', 'a.etica_nota', 'a.comentario')
        ->where('a.idavaliacao', '=', $id)
        ->first();

		return view('desenpenho.staff.show', ['desenpenho' =>$desenpenho]);
    }

    public function edit($id)
    {
        $entidade = FacadesDB::table('tbentidade')->first();
        $desenpenho = FacadesDB::table('tbavaliacao as a')
        ->join('tbcolaborador as c', 'a.idcolaborador', '=', 'c.idcolaborador')
        ->join('tbdepartamento as d', 'c.iddepartamento', '=', 'd.iddepartamento')
        ->select('a.idavaliacao' ,'c.nome', 'a.idsupervisora', 'a.nomeprojecto', 'a.dataini', 'a.assiduidade', 'a.assi_nota', 'a.responsablidade', 'a.res_nota', 'a.meta', 'a.meta_nota', 'a.registo', 'a.registo_nota', 'a.etica', 'a.etica_nota', 'a.comentario', 'd.nome as departamento')
        ->where('a.idavaliacao', '=', $id)
        ->first();
		
        $pdf= FacadePdf::loadView('desenpenho.staff.pdf.pdf', ['desenpenho'=>$desenpenho, 'entidade'=>$entidade]);
        $pdf->setPaper('A4','portrait');
        return $pdf->stream('DESENPENHOSTAFF.pdf');
    }

    public function update()
    {
    	
    }

    public function destroy($id)
    {
    	
    }
}
