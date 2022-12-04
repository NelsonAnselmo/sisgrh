@extends('adminlte::page')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Desenpenho/PDSC</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title m-0">Avaliação de desempenho</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <a href="pdsc/create">
                            <button class="btn btn-outline-primary"> Novo
                                <i class="right fa fa-plus"></i>
                            </button>
                        </a>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-lg-12 col-md-812 col-sm-12 col-xs-12">
                        @include('errors.alerts')
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        @include('desenpenho.pdsc.search')
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color:#A9D0F5">
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>Sexo</th>
                                        <th>Telefone</th>
                                        <th style="text-align-last: center;">Opções</th>
                                    </tr>
                                </thead>
                                @forelse($desenpenhos  as $key=> $des)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $des->nome }}</td>
                                        <td>{{ $des->sexo }}</td>
                                        <td>{{ $des->telefone }}</td>
                                        <td style="text-align-last: center;">
                                            <a href="{{ URL::action('PdscdesenpenhoController@show', $des->idavaliacao) }}"
                                                class="btn btn-primary btn-sm" title="Detalhes">
                                                <i class="right fa fa-eye"></i>
                                            </a>
                                            <a href="{{ URL::action('PdscdesenpenhoController@edit', $des->idavaliacao) }}"
                                                class="btn btn-success btn-sm" title="Imprimir" target="_blank">
                                                <i class="right fa fa-print"></i>
                                            </a>
                                            @if (Auth::user()->tipo == 'Administrador')
                                                <a href="{{ 'PdscdesenpenhoController@destroy', $des->idavaliacao }}"
                                                    class="btn btn-danger btn-sm"
                                                    data-target="#modal-delete-{{ $des->idavaliacao }}" data-toggle="modal"
                                                    title="Elimiar">
                                                    <i class="right fa fa-trash-alt"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @include('desenpenho.pdsc.modal')
                                @empty
                                    <tr>
                                        <td colspan="5">Nenhum registo encontrado!</td>
                                    </tr>
                                @endforelse
                                @if (isset($key))
                                    <tr>
                                        <th colspan="4" style="text-align: right;">TOTAL</th>
                                        <th style="background-color:#A9D0F5"> {{ number_format($key + 1, 1, '.', ',') }}
                                        </th>
                                    </tr>
                                @endif
                            </table>
                        </div>
                        {{ $desenpenhos->appends(['searchText' => $searchText])->links() }}
                    </div>
                </div>
                <hr class="my-2">

            </div>
        </div>
@stop
