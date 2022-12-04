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
    @if (Auth::user()->tipo == 'Supervisor')
    @include('errors.info')
    @else
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title m-0">Editar Entidade => {{ $entidade->nome }}</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('errors.alerts')
                </div>
            </div>

            {!! Form::model($entidade, ['method' => 'PATCH','route' => ['entidade.update', $entidade->identidade], 'files' => 'true']) !!}
            {{ Form::token() }}
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" required value="{{ $entidade->nome }}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="registo">Nr. Registro</label>
                        <input type="text" name="registo" value="{{  $entidade->registo }}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" name="telefone" value="{{  $entidade->telefone }}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="fax">Fax</label>
                        <input type="text" name="fax" value="{{ $entidade->fax }}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="nuit">Nuit</label>
                        <input type="text" name="nuit" value="{{  $entidade->nuit }}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{  $entidade->email }}"class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="provincia">Provincia</label>
                        <input type="text" name="provincia" required value="{{  $entidade->provincia }}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="cidade">Cidade</label>
                        <input type="text" name="cidade" required value="{{  $entidade->cidade }}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="avrua">Av. Rua</label>
                        <input type="text" name="avrua" value="{{  $entidade->avrua }}" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="imagem">Imagem</label>
                        <input type="file" name="imagem" class="form-control" required>
                    </div>
                </div>
            </div>
            @if (($entidade->imagem)!="")
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 float-right">
                <div class="form-group">
                    <img src="{{ asset('storage/imagens/artigos/' . $entidade->imagem) }}" alt="Sem Imagem" height="200px"
                        width="200px" class="img-circle img-bordered-sm float-right">
                </div>
            </div>
            @endif
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Salvar</button>
                    <a href="{{ URL::action('EntidadeController@index') }}" class="btn btn-danger"><i
                            class="fa fa-times"></i>
                        Cancelar</a>
                </div>
            </div>
            {!! Form::close() !!}
            <br> <br>
            <br> <br>
            <br> <br>
            <hr class="my-2">
        </div>
    </div>

    @endif
@stop
