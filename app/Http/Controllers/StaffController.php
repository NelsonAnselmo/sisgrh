<?php

namespace App\Http\Controllers;

use App\Staff;
use App\ColaboradorContrato;
use Illuminate\Http\Request;
use App\Http\Requests\StaffFormRequest;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB as FacadesDB;

class StaffController extends Controller
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
    		-> join('tbdepartamento as d', 'c.iddepartamento', '=', 'd.iddepartamento')
    		-> select('c.idcolaborador' ,'c.nome', 'c.bi', 'c.telefone', 'c.inss', 'c.nuit', 'c.sexo', 'c.processo', 'd.nome as departamento')
            -> where('c.nome','LIKE','%'.$query.'%')
            ->where('c.tipo', '=', 'STAFF')
            -> where ('d.condicao','=','1')
    		-> orwhere('c.processo','LIKE','%'.$query.'%')
            ->where('c.tipo', '=', 'STAFF')
            -> where ('d.condicao','=','1')
    		-> orderBy ('c.idcolaborador','desc') 
    		-> paginate(5); 

    		return view('colaborador.staff.index',['colaboradores'=>$colaboradores, 'searchText'=>$query]);
    	}
    }

    public function create()
    {

        $departamentos=FacadesDB::table('tbdepartamento')
		->where('condicao', '=', '1')
		->get();

        $contratos=FacadesDB::table('tbcontrato')
		->where('condicao', '=', '1')
		->get();

    	return view('colaborador.staff.create', ['departamentos'=>$departamentos, 'contratos'=>$contratos]);	
    }

    public function store(StaffFormRequest $request)
    {

        try{
            
            FacadesDB::beginTransaction();

                $colaborador = new Staff();
                $colaborador -> idcontrato        = $request -> get('idcontrato');
                $colaborador -> iddepartamento    =$request -> get('iddepartamento');
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
                $colaborador -> tipo              = 'STAFF';
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

        return Redirect('colaborador/staff')->with('success', 'STAFF foi Cadastrao com Sucesso');
    }

    public function show($id)
    {

        $colaborador=FacadesDB::table('tbcolaborador as c')
        ->join('tbcontrato as p', 'c.idcontrato', '=', 'p.idcontrato')
        ->join('tbdepartamento as d', 'c.iddepartamento', '=', 'd.iddepartamento')
        ->select('c.processo', 'c.nome', 'c.dataNascimento', 'c.sexo', 'c.telefone', 'c.email', 'c.nomePai', 'c.nomeMae', 'c.bi', 'c.dataEmisaoBi', 'c.dataValidadeBi', 'c.nuit', 'c.inss', 'c.dataAberturaInss', 'c.formacaoAcademica', 'c.tipo', 'p.nome as contrato', 'd.nome as departamento')
        ->where('c.idcolaborador', '=', $id)
        ->first();

        $contratos=FacadesDB::table('tbcolaboradorcontrato')
		->where('estado', '=', 'Activo')
        ->where('processo', '=', $colaborador->processo)
		->first();


        return view('colaborador.staff.show', ['colaborador'=>$colaborador, 'contratos'=>$contratos]);
    }

    public function edit($id)
    {
        $departamento=FacadesDB::table('tbdepartamento')->where('condicao','=','1')->get();
        return view('colaborador.staff.edit', ['departamento'=>$departamento ,'colaborador' => Staff::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {

        $colaborador = Staff::findOrFail($id);
        $colaborador -> iddepartamento    = $request -> get('iddepartamento');
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

        return Redirect('colaborador/staff')->with('success', 'Alteações do STAFF foram Salvas com Sucesso');
    }

    public function destroy($id)
    {

        $colaborador = Staff::findOrFail($id);
    	$colaborador -> delete();

    	return Redirect('colaborador/staff')->with('success', 'STAFF foi Eliminado com Sucesso');
    }

    public function PDFStaff()
	{

        $entidade = FacadesDB::table('tbentidade')->first();
        $colaboradores = FacadesDB::table('tbcolaborador as c')
        -> join('tbdepartamento as d', 'c.iddepartamento', '=', 'd.iddepartamento')
        -> select('c.idcolaborador' ,'c.nome', 'c.bi', 'c.telefone', 'c.inss', 'c.nuit', 'c.sexo', 'c.processo', 'd.nome as departamento')
        ->where('c.tipo', '=', 'STAFF')
        ->get();

        $pdf= FacadePdf::loadView('colaborador.staff.pdf.Staff', ['colaboradores'=>$colaboradores, 'entidade'=>$entidade]);
        $pdf->setPaper('A4','portrait');
        return $pdf->stream('STAFF.pdf');

    }
}
