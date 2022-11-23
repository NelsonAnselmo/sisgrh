@extends('adminlte::page')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Configuração/Perfil</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title m-0">Meu Perfil</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-812 col-sm-12 col-xs-12">
                    @include('errors.alerts')
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <label>Nome</label>
                        <p>{{ $usuario->name }}</p>
                    </div>
                    <hr class="my-2">
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label>Código</label>
                        <p>{{ $usuario->id }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label>Número de BI</label>
                        <p>{{ $usuario->bi }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label>Telefone</label>
                        <p>{{ $usuario->telefone }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label>Email</label>
                        <p>{{ $usuario->email }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label>Sexo</label>
                        <p>{{ $usuario->sexo }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label>Usuário</label>
                        <p>{{ $usuario->tipo }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label>Data Cadastro</label>
                        <p>{{ date('d-m-Y H:m', strtotime($usuario->created_at)) }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label>Última Edição</label>
                        <p>{{ date('d-m-Y H:m', strtotime($usuario->updated_at)) }}</p>
                    </div>
                </div>


            </div>
            <hr class="my-2">
            <br>
            {!! Form::model($usuario, ['method' => 'PATCH', 'route' => ['perfil.update', $usuario->id]]) !!}
            {{ Form::token() }}

            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="password"><em>Você pode alterar a seu Senha.</em></label>
                        <input type="password" name="password" value="{{ old('password') }}" class="form-control" required>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <br>
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Salvar</button>
                        <a href="/home" class="btn btn-danger"><i
                                class="fas fa-reply"></i>
                            Voltar</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
            <br>
            <hr class="my-2">

        </div>

    </div>
@stop
