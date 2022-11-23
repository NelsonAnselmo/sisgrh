@extends('adminlte::page')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Configurações/Formação</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->tipo == 'Administrador' || Auth::user()->tipo == 'Gerente')
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title m-0">Nova Formação</h3>
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

                {!! Form::open(['url' => 'configuracao/formacao', 'method' => 'POST', 'autocomplete' => 'off']) !!}
                {{ Form::token() }}
                <div class="form-group">
                    <label for="nome">Formação</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <input type="text" name="descricao" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Salvar</button>
                    <a href="{{ URL::action('FormacaoController@index') }}" class="btn btn-danger"><i
                            class="fa fa-times"></i> Cancelar</a>
                </div>
                {!! Form::close() !!}

                <hr class="my-2">
            </div>
        </div>
    @else
        @include('errors.info')
    @endif
@stop
