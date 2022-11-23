<?php

namespace App\Http\Controllers;

use App\Departamento;
use Illuminate\Http\Request;
use App\Http\Requests\DepartamentoFormRequest;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB as FacadesDB;

class DepartamentoController extends Controller
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
    		$departamentos = FacadesDB::table('tbdepartamento')
    		-> where('nome','LIKE','%'.$query.'%')
    		-> where ('condicao','=','1')
    		-> orderBy ('iddepartamento','desc')
    		-> paginate(5);

    		return view('configuracao.departamento.index', ['departamentos'=>$departamentos, 'searchText'=>$query]);
    	}  
    }

    public function create()
    {
    	return view('configuracao.departamento.create');	
    }

    public function store(DepartamentoFormRequest $request)
    {
    	$departamento = new Departamento();
    	$departamento -> nome = $request -> get('nome');
    	$departamento -> descricao = $request -> get('descricao');
    	$departamento -> condicao = '1';
    	$departamento -> save();

    	return Redirect('configuracao/departamento')->with('success', 'Departamento Salvo com Sucesso');
    }

    public function show($id)
    {
    	return view('configuracao.departamento.show', ['departamento' => Departamento::findOrFail($id)]);
    }

    public function edit($id)
    {
    	return view('configuracao.departamento.edit', ['departamento' => Departamento::findOrFail($id)]);
    }

    public function update(DepartamentoFormRequest $request, $id)
    {
    	$departamento = Departamento::findOrFail($id);
    	$departamento -> nome = $request -> get('nome');
		$departamento -> descricao = $request -> get('descricao');
		$departamento -> update();    

		return Redirect('configuracao/departamento')->with('success', 'Alteações do Departamento foram Salvas com Sucesso');
    }

    public function destroy($id)
    {
    	$categoria = Departamento::findOrFail($id);
    	$categoria -> delete();

    	return Redirect('configuracao/departamento')->with('success', 'Departamento foi Eliminada com Sucesso');
    }

	public function PDFDepartamento()
	{

			$entidade = FacadesDB::table('tbentidade')->first();
    		$departamento = FacadesDB::table('tbdepartamento')
    		-> where ('condicao','=','1')
    		-> get();

			$pdf= FacadePdf::loadView('configuracao.departamento.pdf.Departamento', ['departamento'=>$departamento, 'entidade'=>$entidade]);
			$pdf->setPaper('A4','portrait');
			return $pdf->stream('Departamento.pdf');
	}
}
