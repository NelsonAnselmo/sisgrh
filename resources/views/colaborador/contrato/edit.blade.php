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
                        <li class="breadcrumb-item active">Colaboraddor/STAFF</li>
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
                <h3 class="card-title m-0">Editar Contrado do Colaborador => {{ $colaborador->nome }}</h3>
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

                {!! Form::model($contrato, [
                    'method' => 'PATCH',
                    'route' => ['contrato.update', $contrato->id],
                    'files' => 'true',
                ]) !!}
                {{ Form::token() }}
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Tipo de Contrato</label>
                            <select name='iddepartamento' class="form-control selectpicker" data-live-search="true"
                                required>
                                @foreach ($tipocontrato as $cont)
                                    @if ($cont->idcontrato == $contrato->idcontrato)
                                        <option value="{{ $cont->idcontrato }}" selected>{{ $cont->nome }}</option>
                                    @else
                                        <option value="{{ $cont->idcontrato }}">{{ $cont->nome }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="dataContrato">Data incio</label>
                            <input type="date" value="{{ $contrato->dataContrato }}" name="dataContrato"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="dataValidade">Data Termino</label>
                            <input type="date" value="{{ $contrato->dataValidade }}" name="dataValidade"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Salvar</button>
                            <a href="{{ URL::action('ColCotratohoController@index') }}" class="btn btn-danger"><i
                                    class="fa fa-times"></i>
                                Cancelar</a>
                        </div>
                    </div>
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
