<?php

namespace App\Http\Controllers;

use App\Entidade;
use Illuminate\Http\Request;
use App\Http\Requests\EntidadeFormRequest;
use Illuminate\Support\Facades\DB as FacadesDB;
class EntidadeController extends Controller
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
    		$entidades = FacadesDB::table('tbentidade')
    		-> where('nome','LIKE','%'.$query.'%')
    		-> orwhere('nuit','LIKE','%'.$query.'%')
    		-> paginate(7); 

    		return view('configuracao.entidade.index',['entidades'=>$entidades,'searchText'=>$query]);
    	}
    }

    public function create()
    {
    	$entidades=FacadesDB::table('tbentidade')->count();

        if($entidades == 0){

    	    return view("configuracao.entidade.create");
        }
        else{
            return redirect()->back()->with('error', 'Entidade já esta cadastrada, só podes editar ou visualizar os detalhes!!');
        }
    }

    public function store(EntidadeFormRequest $request)
    {
    	$entidade = new Entidade();
        $entidade -> fax = $request -> get('fax');
    	$entidade -> nome =$request -> get('nome');
        $entidade -> nuit = $request -> get('nuit');
        $entidade -> avrua = $request -> get('avrua');
        $entidade -> email = $request -> get('email');
        $entidade -> cidade = $request -> get('cidade');
        $entidade -> registo = $request -> get('registo');
    	$entidade -> telefone = $request -> get('telefone');
        $entidade -> provincia = $request -> get('provincia');

    	if ($request->file('imagem')->isValid())
    	{
			$file = $request->file('imagem');
    		$file->move(public_path().'/storage/imagens/artigos/',$file->getClientOriginalName());
    		$entidade->imagem=$file->getClientOriginalName();
    	}
    	$entidade -> save();

    	return Redirect('configuracao/entidade')->with('success', 'Entidade Salva com Sucesso');
    }

    public function show($id)
    {
		$entidade= FacadesDB::table('tbentidade')-> first();

    	return view('configuracao.entidade.show',['entidade' => $entidade]);
    }

    public function edit($id)
    {
    	$entidade=Entidade::findOrFail($id);
		
    	return view('configuracao.entidade.edit',['entidade' => $entidade]);
    }

    public function update(EntidadeFormRequest $request, $id)
    {
    	$entidade = Entidade::findOrFail($id);
        $entidade -> fax = $request -> get('fax');
    	$entidade -> nome =$request -> get('nome');
        $entidade -> nuit = $request -> get('nuit');
        $entidade -> avrua = $request -> get('avrua');
        $entidade -> email = $request -> get('email');
        $entidade -> cidade = $request -> get('cidade');
        $entidade -> registo = $request -> get('registo');
    	$entidade -> telefone = $request -> get('telefone');
        $entidade -> provincia = $request -> get('provincia');

    	if ($request->file('imagem')->isValid())
    	{
			$file = $request->file('imagem');
    		$file->move(public_path().'/storage/imagens/artigos/',$file->getClientOriginalName());
    		$entidade->imagem=$file->getClientOriginalName();
    	}
		$entidade -> update();    

		return Redirect('configuracao/entidade')->with('success', 'Alteações da Entidade foram Salvas com Sucesso');
    }

    public function destroy($id)
    {
    	$articulo = Entidade::findOrFail($id);
    	$articulo -> delete();

    	return Redirect('configuracao/entidade')->with('success', 'Produto foi Eliminado com Sucesso');
    }
}
