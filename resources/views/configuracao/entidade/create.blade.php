@extends('adminlte::page')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Configuração/Entidade</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title m-0">Nova Entidade</h3>
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

            {!! Form::open(['url' => 'configuracao/entidade', 'method' => 'POST','autocomplete' => 'off','files' => 'true']) !!}
            {{ Form::token() }}
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" required value="{{ old('nome') }}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="registo">Nr. Registro</label>
                        <input type="text" name="registo" value="{{ old('registo') }}" class="form-control">
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
                        <label for="fax">Fax</label>
                        <input type="text" name="fax" value="{{ old('fax') }}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="nuit">Nuit</label>
                        <input type="text" name="nuit" value="{{ old('nuit') }}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="provincia">Provincia</label>
                        <input type="text" name="provincia" required value="{{ old('provincia') }}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" name="cidade" required value="{{ old('cidade') }}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="avrua">Av. Rua</label>
                        <input type="text" name="avrua" value="{{ old('avrua') }}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="imagem">Imagem</label>
                        <input type="file" name="imagem" class="form-control">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Salvar</button>
                    <a href="{{ URL::action('EntidadeController@index') }}" class="btn btn-danger"><i class="fa fa-times"></i>
                        Cancelar</a>
                </div>
            </div>
            {!! Form::close() !!}
            <hr class="my-2">
        </div>
    </div>
@stop
