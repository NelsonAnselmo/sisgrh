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
    @if (Auth::user()->tipo == 'Supervisor')
    @include('errors.info')
    @else
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title m-0"> Lista de Formação</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <a href="formacao/create">
                            <button class="btn btn-outline-primary"> Nova
                                <i class="right fa fa-plus"></i>
                            </button>
                        </a>
                            <a href="{{ URL::action('FormacaoController@PDFFormacao') }}" class="btn btn-outline-primary"
                                title="Imprimir"target="_blank">
                                <i class="right fa fa-print"></i>
                            </a>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-lg-12 col-md-812 col-sm-12 col-xs-12">
                        @include('errors.alerts')
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        @include('configuracao.formacao.search')
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color:#A9D0F5">
                                    <tr>
                                        <th>#</th>
                                        <th>Formação</th>
                                        <th>Descrição</th>
                                        <th style="text-align-last: center;">Opções</th>
                                    </tr>
                                </thead>
                                @forelse($formacoes  as $key=> $for)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $for->nome }}</td>
                                        <td>{{ $for->descricao }}</td>
                                        <td style="text-align-last: center;">
                                            <a href="{{ URL::action('FormacaoController@show', $for->idformacao) }}"
                                                class="btn btn-primary btn-sm" title="Detalhes">
                                                <i class="right fa fa-eye"></i>
                                            </a>
                                            <a href="{{ URL::action('FormacaoController@edit', $for->idformacao) }}"
                                                class="btn btn-primary btn-sm" title="Editar">
                                                <i class="right fa fa-edit"></i>
                                            </a>
                                            @if (Auth::user()->tipo == 'Administrador' || Auth::user()->tipo == 'Recursos Humano')
                                                <a href="{{ 'FormacaoController@destroy', $for->idformacao }}"
                                                    class="btn btn-danger btn-sm"
                                                    data-target="#modal-delete-{{ $for->idformacao }}" data-toggle="modal"
                                                    title="Elimiar">
                                                    <i class="right fa fa-trash-alt"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @include('configuracao.formacao.modal')
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
                        {{ $formacoes->appends(['searchText' => $searchText])->links() }}
                    </div>
                </div>
                <hr class="my-2">

            </div>
        </div>

    @endif
@stop
