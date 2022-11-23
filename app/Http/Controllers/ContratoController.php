<?php

namespace App\Http\Controllers;

use App\Contrato;
use Illuminate\Http\Request;
use App\Http\Requests\ContratoFormRequest;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB as FacadesDB;

class ContratoController extends Controller
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
    		$contratos = FacadesDB::table('tbcontrato')
    		-> where('nome','LIKE','%'.$query.'%')
    		-> where ('condicao','=','1')
    		-> orderBy ('idcontrato','desc')
    		-> paginate(5);

    		return view('configuracao.contrato.index', ['contratos'=>$contratos, 'searchText'=>$query]);
    	}  
    }

    public function create()
    {
    	return view('configuracao.contrato.create');	
    }

    public function store(ContratoFormRequest $request)
    {
    	$contrato = new Contrato();
    	$contrato -> nome = $request -> get('nome');
    	$contrato -> descricao = $request -> get('descricao');
    	$contrato -> condicao = '1';
    	$contrato -> save();

    	return Redirect('configuracao/contrato')->with('success', 'Contrato Salvo com Sucesso');
    }

    public function show($id)
    {
    	return view('configuracao.contrato.show', ['contrato' => Contrato::findOrFail($id)]);
    }

    public function edit($id)
    {
    	return view('configuracao.contrato.edit', ['contrato' => Contrato::findOrFail($id)]);
    }

    public function update(ContratoFormRequest $request, $id)
    {
    	$contrato = Contrato::findOrFail($id);
    	$contrato -> nome = $request -> get('nome');
		$contrato -> descricao = $request -> get('descricao');
		$contrato -> update();    

		return Redirect('configuracao/contrato')->with('success', 'Alteações do Contrato foram Salvas com Sucesso');
    }

    public function destroy($id)
    {
    	$contrato = Contrato::findOrFail($id);
    	$contrato -> delete();

    	return Redirect('configuracao/contrato')->with('success', 'Contrato foi Eliminada com Sucesso');
    }

	public function PDFContrato()
	{

			$entidade = FacadesDB::table('tbentidade')->first();
    		$contrato = FacadesDB::table('tbcontrato')
    		-> where ('condicao','=','1')
    		-> get();

			$pdf= FacadePdf::loadView('configuracao.contrato.pdf.Contrato', ['contrato'=>$contrato, 'entidade'=>$entidade]);
			$pdf->setPaper('A4','portrait');
			return $pdf->stream('Contrato.pdf');
	}
}
