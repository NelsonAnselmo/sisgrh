<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserFormRequest;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\DB as FacadesDB;

class UserController extends Controller
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
    		$usuarios = FacadesDB::table('users')
    		-> where('name','LIKE','%'.$query.'%')
    		-> orwhere('tipo','LIKE','%'.$query.'%')
    		-> orderBy ('id','desc') 
    		-> paginate(7); 

    		return view('configuracao.usuario.index',['usuarios'=>$usuarios,'searchText'=>$query]);
    	}
    }

    public function create()
    {
    	return view("configuracao.usuario.create");	
    }

    public function store(UserFormRequest $request)
    {
    	$usuario = new User();
    	$usuario -> name = $request -> get('name');
    	$usuario -> email = $request -> get('email');
    	$usuario -> password = bcrypt($request -> get('password'));
    	$usuario -> tipo = $request -> get('tipo');
    	$usuario -> telefone = $request -> get('telefone');
    	$usuario -> bi = $request -> get('bi');
        $usuario -> sexo = $request -> get('sexo');
    	$usuario -> save();

    	return Redirect('configuracao/usuario')->with('success', 'Usuário Salvo com Sucesso');
    }

    public function show($id)
    {
    	return view('configuracao.usuario.show',['usuario' => User::findOrFail($id)]);
    }

    public function edit($id)
    { 
    	return view('configuracao.usuario.edit',['usuario' => User::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
    	$usuario = User::findOrFail($id);
    	$usuario -> name = $request -> get('name');
    	$usuario -> tipo = $request -> get('tipo');
    	$usuario -> telefone = $request -> get('telefone');
    	$usuario -> bi = $request -> get('bi');
        $usuario -> sexo = $request -> get('sexo');
		$usuario -> update();    

		return Redirect('configuracao/usuario')->with('success', 'Alteações do Usuário foram Salvos com Sucesso');
    }

    public function destroy($id)
    {
    	$usuario = User::findOrFail($id);
    	$usuario -> delete();

    	return Redirect('configuracao/usuario')->with('success', 'Usuário foi Eliminado com Sucesso');
    }

    public function PDFUser()
	{

			$entidade = FacadesDB::table('tbentidade')->first();
    		$usuarios = FacadesDB::table('users')-> get();

			$pdf= FacadePdf::loadView('configuracao.usuario.pdf.Usuario', ['usuarios'=>$usuarios, 'entidade'=>$entidade]);
			$pdf->setPaper('A4','portrait');
			return $pdf->stream('Usuario.pdf');
	}
}
