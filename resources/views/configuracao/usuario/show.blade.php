@extends('adminlte::page')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Configuração/Usuário</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->tipo == 'Administrador' || Auth::user()->tipo == 'Gerente')
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title m-0">Detalhes do Usuário</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <div class="card-body">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Nome</label>
                        <p>{{ $usuario->name }}</p>
                    </div>
                    <hr class="my-2">
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        <label>Código</label>
                        <p>{{ $usuario->id }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        <label>Sexo</label>
                        <p>{{ $usuario->sexo }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        <label>BI</label>
                        <p>{{ $usuario->bi }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        <label>Tipo de Usuário</label>
                        <p>{{ $usuario->tipo }} </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        <label>Email</label>
                        <p>{{ $usuario->email }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        <label>Data Cadastro</label>
                        <p>{{ date("d-m-Y H:m", strtotime($usuario->created_at)) }}</p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="form-group">
                        <label>Data Última Edição</label>
                        <p>{{ date("d-m-Y H:m", strtotime($usuario->updated_at)) }}</p>
                    </div>
                </div>

            </div><br>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-4">
                <a href="{{ URL::action('UserController@index') }}" class="btn btn-danger float-right"><i
                        class="fas fa-reply"></i> Voltar
                </a>
            </div>
            <hr class="my-4">
        </div>
    </div>
    @else
    @include('errors.info')
    @endif
@endsection
