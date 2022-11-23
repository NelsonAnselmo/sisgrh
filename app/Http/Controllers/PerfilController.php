<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\PerfilFormRequest;

class PerfilController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function index(Request $request)
	{
		$usuario=User::findOrFail(Auth()->User()->id);
		return view('configuracao.perfil.index',['usuario'=>$usuario]);

	}

	public function update(PerfilFormRequest $request,$id)
	{

		$usuario=User::findOrFail(Auth()->User()->id);
		$usuario->password=bcrypt($request->get('password'));
		$usuario->update();

		$usuario=User::findOrFail(Auth()->User()->id);

		return redirect()->back()->with('success', 'Sucesso ao alterar a senha !');
	}
}
