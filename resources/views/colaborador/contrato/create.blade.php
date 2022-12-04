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
                        <li class="breadcrumb-item active">Colaborador/Formação</li>
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
                <h3 class="card-title m-0">Novo Contrato</h3>
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

                {!! Form::open(['url' => 'colaborador/contrato', 'method' => 'POST', 'autocomplete' => 'off']) !!}
                {{ Form::token() }}
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Colaborador</label>
                            <select name='processo' class="form-control selectpicker" data-live-search="true">
                                <option value="" style="text-align: center">---Selecionar
                                    Colaborador---</option>
                                @foreach ($colaboradores as $col)
                                    <option value="{{ $col->processo }}">
                                        {{ $col->processo }}- {{ $col->nome }} - {{ $col->tipo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <hr class="my-2">
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Tipo de Contrato</label>
                            <select name='idcontrato' class="form-control selectpicker" data-live-search="true" required>
                                <option value="" style="text-align: center">---Selecionar
                                    Contrato---</option>
                                @foreach ($contratos as $cont)
                                    <option value="{{ $cont->idcontrato }}">{{ $cont->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="dataContrato">Data de Inicio</label>
                            <input type="date" value="{{ old('dataContrato') }}" name="dataContrato" class="form-control"
                                required>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="dataValidade">Data de Conclusão</label>
                            <input type="date" value="{{ old('dataValidade') }}" name="dataValidade" class="form-control"
                                required>
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

                    {!! Form::close() !!}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <hr class="my-2">
                    </div>
                </div>
            </div>

    @endif
@stop
@section('js')
    <script src="{{ asset('select2/js/bootstrap-select.min.js') }}"></script>
@stop
