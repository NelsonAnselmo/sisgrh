@extends('adminlte::page')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Configurações/Contrato</li> 
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->tipo == 'Administrador' || Auth::user()->tipo == 'Gerente')
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title m-0"> Lista de Contrato</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <a href="contrato/create">
                            <button class="btn btn-outline-primary"> Novo
                                <i class="right fa fa-plus"></i>
                            </button>
                        </a>
                        @if (Auth::user()->tipo == 'Administrador' || Auth::user()->tipo == 'Gerente')
                            <a href="{{ URL::action('ContratoController@PDFContrato') }}" class="btn btn-outline-primary"
                                title="Imprimir"target="_blank">
                                <i class="right fa fa-print"></i>
                            </a>
                        @endif
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-lg-12 col-md-812 col-sm-12 col-xs-12">
                        @include('errors.alerts')
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        @include('configuracao.contrato.search')
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-812 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color:#A9D0F5">
                                    <tr>
                                        <th>#</th>
                                        <th>Contrato</th>
                                        <th>Descrição</th>
                                        <th style="text-align-last: center;">Opções</th>
                                    </tr>
                                </thead>
                                @forelse($contratos  as $key=> $cont)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $cont->nome }}</td>
                                        <td>{{ $cont->descricao }}</td>
                                        <td style="text-align-last: center;">
                                            <a href="{{ URL::action('ContratoController@show', $cont->idcontrato) }}"
                                                class="btn btn-primary btn-sm" title="Detalhes">
                                                <i class="right fa fa-eye"></i>
                                            </a>
                                            <a href="{{ URL::action('ContratoController@edit', $cont->idcontrato) }}"
                                                class="btn btn-primary btn-sm" title="Editar">
                                                <i class="right fa fa-edit"></i>
                                            </a>
                                            @if (Auth::user()->tipo == 'Administrador')
                                                <a href="{{ 'ContratoController@destroy', $cont->idcontrato }}"
                                                    class="btn btn-danger btn-sm"
                                                    data-target="#modal-delete-{{ $cont->idcontrato }}" data-toggle="modal"
                                                    title="Elimiar">
                                                    <i class="right fa fa-trash-alt"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @include('configuracao.contrato.modal')
                                @empty
                                    <tr>
                                        <td colspan="4">Nenhum registo encontrado!</td>
                                    </tr>
                                @endforelse
                                @if (isset($key))
                                    <tr>
                                        <th colspan="3" style="text-align: right;">TOTAL</th>
                                        <th style="background-color:#A9D0F5"> {{ number_format($key + 1, 1, '.', ',') }}
                                        </th>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        {{ $contratos->appends(['searchText' => $searchText])->links() }}
                    </div>
                </div>
                <hr class="my-2">

            </div>
        </div>
    @else
        @include('errors.info')
    @endif
@stop
