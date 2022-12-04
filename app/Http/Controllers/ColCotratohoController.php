<?php

namespace App\Http\Controllers;

use App\ColContrato;
use Illuminate\Http\Request;
use App\Http\Requests\ColContratoFormRequest;
use Illuminate\Support\Facades\DB as FacadesDB;

class ColCotratohoController extends Controller
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
            $codigocontrato = FacadesDB::table('tbcontrato as c')
            -> join('tbcolaboradorcontrato as ctr', 'c.idcontrato', '=', 'ctr.idcontrato')
            -> select('c.idcontrato', 'c.nome')
            -> where('c.nome','LIKE','%'.$query.'%')
            -> distinct()
            -> paginate(5);

    		$colcontratos = FacadesDB::table('tbcolaboradorcontrato as ctr')
            -> join('tbcolaborador as c', 'ctr.processo', '=', 'c.processo')
            -> join('tbcontrato as ct', 'ctr.idcontrato', '=', 'ct.idcontrato')
            -> select('ctr.id', 'ct.idcontrato', 'ctr.processo', 'ctr.dataContrato', 'ctr.dataValidade', 'ctr.estado', 'c.nome','c.tipo', 'c.telefone', 'ct.nome as contrato')
            -> where('ctr.estado', '=', 'Activo')
            -> orderBy ('ctr.id','desc')
    		-> get(); 

    		return view('colaborador.contrato.index', ['colcontratos'=>$colcontratos, 'codigocontrato'=>$codigocontrato, 'searchText'=>$query]);
    	}  
    }

    
    public function create()
    {
        $contratos = FacadesDB::table('tbcontrato')->get();
        $colaboradores = FacadesDB::table('tbcolaborador')->get();

    	return view('colaborador.contrato.create', ['contratos'=>$contratos, 'colaboradores'=>$colaboradores]);	
    }

    public function store(ColContratoFormRequest $request)
    {

        $contratos=FacadesDB::table('tbcolaboradorcontrato')
        ->where('estado', '=','Activo')
        ->where('processo' ,'=' ,$request -> get('processo'))
        ->count();
        
        if($contratos <= 0){

            $contrato = new ColContrato();
            $contrato -> idcontrato = $request -> get('idcontrato');
            $contrato -> processo = $request -> get('processo');
            $contrato -> dataContrato = $request -> get('dataContrato');
            $contrato -> dataValidade = $request -> get('dataValidade');
            $contrato -> estado = 'Activo';
            $contrato -> save();
    
            return Redirect('colaborador/contrato')->with('success', 'Contrato Salvo com Sucesso');

        }else{

            return Redirect('colaborador/contrato')->with('error', 'O colaborador tem contrato/(s) em aberto, por favor terminar dodos os contrados do Colaborador');

        }
        
        
    }
    
    public function show($id)
    {
        $codprocesso = FacadesDB::table('tbcolaboradorcontrato')
        ->select('processo')
        ->where('id', '=', $id)
        ->first();

        $historico = FacadesDB::table('tbcolaboradorcontrato as c')
        -> join('tbcontrato as ct', 'c.idcontrato', '=', 'ct.idcontrato')
        ->where('processo', '=', $codprocesso->processo)
        -> orderBy ('c.id','desc')
        ->get();

        $colaborador = FacadesDB::table('tbcolaborador')
        ->where('processo', '=',  $codprocesso->processo)
        ->first(); 

        $colcontratos = FacadesDB::table('tbcolaboradorcontrato as ctr')
        -> join('tbcolaborador as c', 'ctr.processo', '=', 'c.processo')
        -> join('tbcontrato as ct', 'ctr.idcontrato', '=', 'ct.idcontrato')
        -> select('ctr.id', 'ct.idcontrato', 'ctr.processo', 'ctr.dataContrato', 'ctr.dataValidade', 'ctr.estado', 'c.nome','c.tipo', 'c.telefone', 'ct.nome as contrato')
        -> where('ctr.id', '=', $id)
        -> paginate(5); 

    	return view('colaborador.contrato.show', ['colcontratos'=>$colcontratos, 'colaborador'=>$colaborador, 'historico'=>$historico]);
    }

    public function edit($id)
    {
        $tipocontrato = FacadesDB::table('tbcontrato')->get();

        $codprocesso = FacadesDB::table('tbcolaboradorcontrato')
        ->select('processo')
        ->where('id', '=', $id)
        ->first();

        $colaborador = FacadesDB::table('tbcolaborador')
        ->where('processo', '=',  $codprocesso->processo)
        ->first();

    	return view('colaborador.contrato.edit', ['contrato' => ColContrato::findOrFail($id), 'tipocontrato'=>$tipocontrato, 'colaborador'=>$colaborador, 'codprocesso'=>$codprocesso]);
    }


    public function update(ColContratoFormRequest $request, $id)
    {
    	$contrato = ColContrato::findOrFail($id);
    	$contrato -> dataContrato = $request -> get('dataContrato');
		$contrato -> dataValidade = $request -> get('dataValidade');
		$contrato -> update();    

		return Redirect('colaborador/contrato')->with('success', 'Alteações do Contrato foram Salvas com Sucesso');
    }


    public function destroy($id)
    {
    	$contrato = ColContrato::findOrFail($id);
        $contrato -> estado = 'Terminado';
    	$contrato -> update();

    	return Redirect('colaborador/contrato')->with('success', 'Contrato foi Terminado com Sucesso');
    }
}
