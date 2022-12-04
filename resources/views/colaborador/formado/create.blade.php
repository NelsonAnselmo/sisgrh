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
                <h3 class="card-title m-0">Novo Colaborador Formado</h3>
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

                {!! Form::open(['url' => 'colaborador/formado', 'method' => 'POST', 'autocomplete' => 'off']) !!}
                {{ Form::token() }}
                <div class="row">

                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <label>Formação</label>
                            <select name='idformacao' id="idformacao" class="form-control selectpicker"
                                data-live-search="true" required>
                                <option value="" style="text-align: center">---Selecionar
                                    Formação---</option>
                                @foreach ($formacoes as $for)
                                    <option value="{{ $for->idformacao }}">{{ $for->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label for="datainicio">Data de Inicio</label>
                            <input type="date" value="{{ old('datainicio') }}" name="datainicio" id="datainicio"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label for="dataconclusao">Data de Conclusão</label>
                            <input type="date" value="{{ old('dataconclusao') }}" name="dataconclusao" id="dataconclusao"
                                class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Colaborador</label>
                            <select name='pidcolaborador' id="pidcolaborador" class="form-control selectpicker"
                                data-live-search="true">
                                <option value="" style="text-align: center">---Selecionar
                                    Colaborador---</option>
                                @foreach ($colaborador as $col)
                                    <option value="{{ $col->idcolaborador }}_{{ $col->processo }}_{{ $col->bi }}">
                                        {{ $col->nome }} - {{ $col->tipo }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label for="pprocesso">Nr. Processo</label>
                            <input type="text" name="pprocesso" id="pprocesso" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label for="pbi">Nr. BI</label>
                            <input type="text" name="pbi" id="pbi" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                        <label></label>
                        <div class="form-group">
                            <button type="button" id="bt_add" class="btn btn-primary"><i class="fas fa-check"></i>
                                Adicionar</button>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <hr>
                    </div>

                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <table id="detalhes" class="table table-striped  table-bordered table-condensed table-hover">
                            <thead style="background-color:#A9D0F5">
                                <th>Opções</th>
                                <th>Colaborador</th>
                                <th>Nr. Processo</th>
                                <th>BI</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="guardar">
                        <div class="form-group">
                            <input name="_token" value="{{ csrf_token() }}" type="hidden">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Salvar</button>
                            <button class="btn btn-danger" type="reset"><i class="fa fa-times"></i> Cancelar</button>
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

    <script>
        $(document).ready(function() {
            $('#bt_add').click(function() {
                agregar();
            });
        });

        var cont = 0;
        $("#guardar").hide();
        $("#pidcolaborador").change(mostrarValores);

        function mostrarValores() {

            dadosColaborador = document.getElementById('pidcolaborador').value.split('_');
            $("#pprocesso").val(dadosColaborador[1]);
            $("#pbi").val(dadosColaborador[2]);
        }

        function agregar() {

            dadosColaborador = document.getElementById('pidcolaborador').value.split('_');
            idcolaborador = dadosColaborador[0];
            nome = $("#pidcolaborador option:selected").text();
            processo = $("#pprocesso").val();
            bi = $("#pbi").val();

            var fila = '<tr class="selected" id="fila' + cont +
                '"><td><button type="button" class="btn btn-warning" onclick="eliminar(' + cont +
                ');">X</button></td><td><input type="hidden" name="idcolaborador[]" value="' + idcolaborador + '">' + nome +
                '</td><td><input type="hidden" name="processo[]" value="' + processo + '">' + processo +
                '</td><td><input type="hidden" name="bi[]" value="' + bi + '">' + bi + '</td></tr>';
            cont++;

            limpiar();
            evaluar();
            $('#detalhes').append(fila);

        }

        function limpiar() {
            $("#pprocesso").val("");
            $("#pbi").val("");
        }

        function evaluar() {
            if (cont > 0) {
                $("#guardar").show();
            } else {
                $("#guardar").hide();
            }
        }

        function eliminar(index) {
            $("#fila" + index).remove();
            evaluar();
        }
    </script>

@stop
