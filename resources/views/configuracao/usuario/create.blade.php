@extends('adminlte::page')
@section('content_header')
    <link rel="stylesheet" href="{{ asset('select2/css/bootstrap-select.min.css') }}">
@stop
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
    @if (Auth::user()->tipo == 'Supervisor')
    @include('errors.info')
    @else
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title m-0">Novo Usuário</h3>
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

                {!! Form::open(['url' => 'configuracao/usuario', 'method' => 'POST', 'autocomplete' => 'off']) !!}
                {{ Form::token() }}
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" name="name" required value="{{ old('name') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Sexo</label>
                            <select name='sexo' class="form-control selectpicker" data-live-search="true" required>
                                <option value="">---Selecione o
                                    Sexo---</option>
                                <option>Masculino</option>
                                <option>Femenino</option>
                                <option>Outros</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="text" name="telefone" value="{{ old('telefone') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="bi">BI</label>
                            <input type="text" name="bi" value="{{ old('bi') }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Tipo</label>
                            <select name='tipo' class="form-control selectpicker" data-live-search="true" required>
                                <option value="">---Selecione o
                                    Tipo
                                    de Usuário---</option>
                                <option>Supervisor</option>
                                <option>Administrador</option>
                                <option>Recursos Humano</option>
                                <option>Director Executivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control"
                                required>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Salvar</button>
                        <a href="{{ URL::action('UserController@index') }}" class="btn btn-danger"><i
                                class="fa fa-times"></i>
                            Cancelar</a>
                    </div>
                </div>
                {!! Form::close() !!}
                <hr class="my-2">
            </div>
        </div>

    @endif
@stop
@section('js')
<script src="{{ asset('select2/js/bootstrap-select.min.js') }}"></script>
@stop

