<?php

namespace App\Http\Controllers;

use App\Formacao;
use Illuminate\Http\Request;
use App\Http\Requests\FormacaoFormRequest;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB as FacadesDB;

class FormacaoController extends Controller
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
    		$formacoes = FacadesDB::table('tbformacao')
    		-> where('nome','LIKE','%'.$query.'%')
    		-> where ('condicao','=','1')
    		-> orderBy ('idformacao','desc')
    		-> paginate(5);

    		return view('configuracao.formacao.index', ['formacoes'=>$formacoes, 'searchText'=>$query]);
    	}  
    }

    public function create()
    {
    	return view('configuracao.formacao.create');	
    }

    public function store(FormacaoFormRequest $request)
    {
    	$formacao = new Formacao();
    	$formacao -> nome = $request -> get('nome');
    	$formacao -> descricao = $request -> get('descricao');
    	$formacao -> condicao = '1';
    	$formacao -> save();

    	return Redirect('configuracao/formacao')->with('success', 'Formação Salvo com Sucesso');
    }

    public function show($id)
    {
    	return view('configuracao.formacao.show', ['formacao' => Formacao::findOrFail($id)]);
    }

    public function edit($id)
    {
    	return view('configuracao.formacao.edit', ['formacao' => Formacao::findOrFail($id)]);
    }

    public function update(FormacaoFormRequest $request, $id)
    {
    	$formacao = Formacao::findOrFail($id);
    	$formacao -> nome = $request -> get('nome');
		$formacao -> descricao = $request -> get('descricao');
		$formacao -> update();    

		return Redirect('configuracao/formacao')->with('success', 'Alteações da Formação foram Salvas com Sucesso');
    }

    public function destroy($id)
    {
    	$formacao = Formacao::findOrFail($id);
    	$formacao -> delete();

    	return Redirect('configuracao/formacao')->with('success', 'Formação foi Eliminada com Sucesso');
    }

	public function PDFFormacao()
	{

			$entidade = FacadesDB::table('tbentidade')->first();
    		$formacao = FacadesDB::table('tbformacao')
    		-> where ('condicao','=','1')
    		-> get();

			$pdf= FacadePdf::loadView('configuracao.formacao.pdf.Formacao', ['formacao'=>$formacao, 'entidade'=>$entidade]);
			$pdf->setPaper('A4','portrait');
			return $pdf->stream('Formacao.pdf');
	}
}
