<?php

namespace App\Http\Controllers;

use App\Staff;
use App\ColFormado;
use Illuminate\Http\Request;
use App\Http\Requests\ColFormadoFormRequest;
use Illuminate\Support\Facades\DB as FacadesDB;


class ColFormadoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	if($request)
    	{
    		$query = trim($request->get('searchText'));
            $codigoformacao = FacadesDB::table('tbformacao as f')
            -> join('tbcolformados as c', 'f.idformacao', '=', 'c.idformacao')
            -> select('c.idformacao', 'f.nome' )
            -> where('f.nome','LIKE','%'.$query.'%')
            -> distinct()
            -> paginate(5);

    		$colformasos = FacadesDB::table('tbcolformados as f')
            -> join('tbcolaborador as c', 'f.idcolaborador', '=', 'c.idcolaborador')
            -> join('tbformacao as fr', 'f.idformacao', '=', 'fr.idformacao')
            -> select('f.idcolformado', 'fr.idformacao', 'f.idcolaborador', 'f.datainicio', 'f.dataconclusao', 'c.processo', 'c.nome','c.tipo', 'c.telefone', 'fr.nome as formacao')
            -> orderBy ('f.idcolformado','desc')
    		-> get(); 

    		return view('colaborador.formado.index', ['colformasos'=>$colformasos, 'codigoformacao'=>$codigoformacao, 'searchText'=>$query]);
    	}  
    }

    public function create()
    {
        $formacoes = FacadesDB::table('tbformacao')->get();
        $colaborador = FacadesDB::table('tbcolaborador')->get();
    	return view('colaborador.formado.create', ['formacoes'=>$formacoes, 'colaborador'=>$colaborador]);	
    }

    public function store(ColFormadoFormRequest $request)
    {
        
       
    	$idcolaborador = $request -> get('idcolaborador');
        
        $idformacao = $request -> get('idformacao');
        $datain =     $request->get('datainicio');
        $datafi =     $request->get('dataconclusao');

        $cont = 0;

        while($cont < count($idcolaborador))
        {

            $detalhe = new ColFormado();
            $detalhe -> idformacao =  $idformacao; 
            $detalhe -> datainicio =  $datain; 
            $detalhe -> dataconclusao =  $datafi; 
            $detalhe -> idcolaborador = $idcolaborador[$cont];
            $detalhe -> save();

            $cont=$cont+1;

        }

    	return Redirect('colaborador/formado')->with('success', 'Formação foi associada aos colaboradores com Sucesso');
    }

    public function show($id)
    {
        $colaborador = Staff::findOrFail($id);
        $colformados = FacadesDB::table('tbcolformados as f')
        -> join('tbcolaborador as c', 'f.idcolaborador', '=', 'c.idcolaborador')
        -> join('tbformacao as fr', 'f.idformacao', '=', 'fr.idformacao')
        -> select('f.idcolformado', 'fr.idformacao', 'f.idcolaborador', 'f.datainicio', 'f.dataconclusao', 'c.processo', 'c.nome','c.tipo', 'c.telefone', 'fr.nome as formacao')
        ->where('f.idcolaborador', '=', $id)
        -> paginate(5); 

    	return view('colaborador.formado.show', ['colaborador' =>$colaborador, 'colformados'=>$colformados]);
    }

    public function edit($id)
    {
    	return view('configuracao.contrato.edit', ['contrato' => ColFormado::findOrFail($id)]);
    }

    public function update(ColFormadoFormRequest $request, $id)
    {
    	$contrato = ColFormado::findOrFail($id);
    	$contrato -> nome = $request -> get('nome');
		$contrato -> descricao = $request -> get('descricao');
		$contrato -> update();    

		return Redirect('configuracao/formado')->with('success', 'Alteações do Contrato foram Salvas com Sucesso');
    }

    public function destroy($id)
    {
    	$contrato = ColFormado::findOrFail($id);
    	$contrato -> delete();

    	return Redirect('colaborador/formado')->with('success', 'Formação foi Eliminada com Sucesso');
    }
    
}
