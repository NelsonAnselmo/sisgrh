<?php

namespace App\Http\Controllers;

use App\Staff;
use App\ColaboradorContrato;
use Illuminate\Http\Request;
use App\Http\Requests\StaffFormRequest;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB as FacadesDB;

class PdscController extends Controller
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
    		$colaboradores = FacadesDB::table('tbcolaborador as c')
    		->join('tbcontrato as d', 'c.idcontrato', '=', 'd.idcontrato')
    		->select('c.idcolaborador' ,'c.nome', 'c.bi', 'c.telefone', 'c.inss', 'c.nuit', 'c.sexo', 'c.processo', 'd.nome as contrato')
            ->where('c.nome','LIKE','%'.$query.'%')
            ->where('c.tipo', '=', 'PDSC')
            ->where ('d.condicao','=','1')
    		->orwhere('c.processo','LIKE','%'.$query.'%')
            ->where('c.tipo', '=', 'PDSC')
            ->where ('d.condicao','=','1')
    		->orderBy ('c.idcolaborador','desc') 
    		->paginate(5); 

    		return view('colaborador.pdsc.index',['colaboradores'=>$colaboradores, 'searchText'=>$query]);
    	}
    }

    public function create()
    {

        $contratos=FacadesDB::table('tbcontrato')
		->where('condicao', '=', '1')
		->get();

    	return view('colaborador.pdsc.create', ['contratos'=>$contratos]);	
    }

    public function store(StaffFormRequest $request)
    {

        try{
            
            FacadesDB::beginTransaction();

                $colaborador = new Staff();
                $colaborador -> idcontrato        = $request -> get('idcontrato');
                $colaborador -> processo          = $request -> get('processo');
                $colaborador -> nome              = $request -> get('nome');
                $colaborador -> dataNascimento    = $request -> get('datanasc'); 
                $colaborador -> sexo              = $request -> get('sexo');
                $colaborador -> telefone          = $request -> get('telefone');
                $colaborador -> email             = $request -> get('email');
                $colaborador -> nomePai           = $request -> get('nomepai');
                $colaborador -> nomeMae           = $request -> get('nomemae');
                $colaborador -> bi                = $request -> get('bi');
                $colaborador -> dataEmisaoBi      = $request -> get('dataemissao');
                $colaborador -> dataValidadeBi    = $request -> get('datavalidade');
                $colaborador -> nuit              = $request -> get('nuit');
                $colaborador -> dataAberturaInss  =  $request -> get('dataaberturainss');
                $colaborador -> formacaoAcademica = $request -> get('formacao');
                $colaborador -> inss              = $request -> get('inss');
                $colaborador -> tipo              = 'PDSC';
                $colaborador -> save();

                    $colaboradorcontrato = new ColaboradorContrato();
                    $colaboradorcontrato -> processo     = $request -> get('processo');
                    $colaboradorcontrato -> idcontrato        = $request -> get('idcontrato'); 
                    $colaboradorcontrato -> dataValidade = $request -> get('datafimcontrato');
                    $colaboradorcontrato -> dataContrato = $request -> get('datainiciocontrato');
                    $colaboradorcontrato -> estado       = 'Activo';
                    $colaboradorcontrato -> save();

                    FacadesDB::commit();
            } catch(\Exception $e)
                {
                    FacadesDB::rollback();
                }

        return Redirect('colaborador/pdsc')->with('success', 'PDSC foi Cadastrao com Sucesso');
    }

    public function show($id)
    {

        $colaborador=FacadesDB::table('tbcolaborador as c')
        ->join('tbcontrato as p', 'c.idcontrato', '=', 'p.idcontrato')
        ->select('c.processo', 'c.nome', 'c.dataNascimento', 'c.sexo', 'c.telefone', 'c.email', 'c.nomePai', 'c.nomeMae', 'c.bi', 'c.dataEmisaoBi', 'c.dataValidadeBi', 'c.nuit', 'c.inss', 'c.dataAberturaInss', 'c.formacaoAcademica', 'c.tipo', 'p.nome as contrato')
        ->where('c.idcolaborador', '=', $id)
        ->first();

        $contratos=FacadesDB::table('tbcolaboradorcontrato')
		->where('estado', '=', 'Activo')
        ->where('processo', '=', $colaborador->processo)
		->first();


        return view('colaborador.pdsc.show', ['colaborador'=>$colaborador, 'contratos'=>$contratos]);
    }

    public function edit($id)
    {
        
        return view('colaborador.pdsc.edit', ['colaborador' => Staff::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {

        $colaborador = Staff::findOrFail($id);
        $colaborador -> processo          = $request -> get('processo');
        $colaborador -> nome              = $request -> get('nome');
        $colaborador -> dataNascimento    = $request -> get('datanasc'); 
        $colaborador -> sexo              = $request -> get('sexo');
        $colaborador -> telefone          = $request -> get('telefone');
        $colaborador -> email             = $request -> get('email');
        $colaborador -> nomePai           = $request -> get('nomepai');
        $colaborador -> nomeMae           = $request -> get('nomemae');
        $colaborador -> bi                = $request -> get('bi');
        $colaborador -> dataEmisaoBi      = $request -> get('dataemissao');
        $colaborador -> dataValidadeBi    = $request -> get('datavalidade');
        $colaborador -> nuit              = $request -> get('nuit');
        $colaborador -> dataAberturaInss  = $request -> get('dataaberturainss');
        $colaborador -> formacaoAcademica = $request -> get('formacao');
        $colaborador -> inss              = $request -> get('inss');
        $colaborador -> update();

        return Redirect('colaborador/pdsc')->with('success', 'Alteações do PDSC foram Salvas com Sucesso');
    }

    public function destroy($id)
    {

        $colaborador = Staff::findOrFail($id);
    	$colaborador -> delete();

    	return Redirect('colaborador/pdsc')->with('success', 'PDSC foi Eliminado com Sucesso');
    }

    public function PDFPdsc()
	{

        $entidade = FacadesDB::table('tbentidade')->first();
        $colaboradores = FacadesDB::table('tbcolaborador')
        ->select('idcolaborador' ,'nome', 'bi', 'telefone', 'inss', 'nuit', 'sexo', 'processo')
        ->where('tipo', '=', 'PDSC')
        ->get();

        $pdf= FacadePdf::loadView('colaborador.pdsc.pdf.Pdsc', ['colaboradores'=>$colaboradores, 'entidade'=>$entidade]);
        $pdf->setPaper('A4','portrait');
        return $pdf->stream('PDSC.pdf');

    }
    
}
