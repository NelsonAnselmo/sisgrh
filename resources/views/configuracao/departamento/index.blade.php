@extends('adminlte::page')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Configurações/Departamento</li> 
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
                <h3 class="card-title m-0"> Lista de Departamento</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <a href="departamento/create">
                            <button class="btn btn-outline-primary"> Novo
                                <i class="right fa fa-plus"></i>
                            </button>
                        </a>
                            <a href="{{ URL::action('DepartamentoController@PDFDepartamento') }}" class="btn btn-outline-primary"
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
                        @include('configuracao.departamento.search')
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-812 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color:#A9D0F5">
                                    <tr>
                                        <th>#</th>
                                        <th>Departamento</th>
                                        <th>Descrição</th>
                                        <th style="text-align-last: center;">Opções</th>
                                    </tr>
                                </thead>
                                @forelse($departamentos  as $key=> $dep)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $dep->nome }}</td>
                                        <td>{{ $dep->descricao }}</td>
                                        <td style="text-align-last: center;">
                                            <a href="{{ URL::action('DepartamentoController@show', $dep->iddepartamento) }}"
                                                class="btn btn-primary btn-sm" title="Detalhes">
                                                <i class="right fa fa-eye"></i>
                                            </a>
                                            <a href="{{ URL::action('DepartamentoController@edit', $dep->iddepartamento) }}"
                                                class="btn btn-primary btn-sm" title="Editar">
                                                <i class="right fa fa-edit"></i>
                                            </a>
                                            @if (Auth::user()->tipo == 'Administrador' || Auth::user()->tipo == 'Recursos Humano' )
                                                <a href="{{ 'DepartamentoController@destroy', $dep->iddepartamento }}"
                                                    class="btn btn-danger btn-sm"
                                                    data-target="#modal-delete-{{ $dep->iddepartamento }}" data-toggle="modal"
                                                    title="Elimiar">
                                                    <i class="right fa fa-trash-alt"></i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @include('configuracao.departamento.modal')
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
                        {{ $departamentos->appends(['searchText' => $searchText])->links() }}
                    </div>
                </div>
                <hr class="my-2">

            </div>
        </div>

    @endif
@stop
