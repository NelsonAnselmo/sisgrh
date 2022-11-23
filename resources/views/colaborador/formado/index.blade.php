@extends('adminlte::page')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Colaborador/Formado</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->tipo == 'Administrador' || Auth::user()->tipo == 'Gerente')
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title m-0">Lista de Colaboradores Formados</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <a href="formado/create">
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
                        @include('colaborador.formado.search')
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-striped table-condensed table-hover">
                            <tbody>
                                @foreach ($codigoformacao as $values)
                                    <tr data-widget="expandable-table" aria-expanded="false">
                                        <td style="background-color:#A9D0F5">
                                            <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                           {{ $values->idformacao }} - FORMAÇÃO : {{ $values->nome }}
                                        </td>
                                    </tr>
                                    <tr class="expandable-body d-none">
                                        <td>
                                            <div class="p-0" style="display: none;">
                                                <table class="table table-hover">

                                                    <thead>
                                                        <tr>
                                                            <th>Processo</th>
                                                            <th>Nome</th>
                                                            <th>Tipo</th>
                                                            <th>Telefone</th>
                                                            <th>Data Inicio</th>
                                                            <th>Data Conclusão</th>
                                                            <th style="text-align-last: center;">Opções</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($colformasos as $det)
                                                            @if ($values->idformacao == $det->idformacao)
                                                                <tr>
                                                                    <td>{{ $det->processo }}</td>
                                                                    <td>{{ $det->nome }}</td>
                                                                    <td>{{ $det->tipo }}</td>
                                                                    <td>{{ $det->telefone }}</td>
                                                                    <td>{{ date('d-m-Y', strtotime($det->datainicio)) }}</td>
                                                                    <td>{{ date('d-m-Y', strtotime($det->dataconclusao)) }}</td>                                                           </td>
                                                                    <td style="text-align-last: center;">
                                                                        <a href="{{ URL::action('ColFormadoController@show', $det->idcolaborador) }}"
                                                                            class="btn btn-primary btn-sm" title="Detalhes">
                                                                            <i class="right fa fa-eye"></i>
                                                                        </a>
                                                                        @if (Auth::user()->tipo == 'Administrador')
                                                                        <a href="{{ 'ColFormadoController@destroy', $det->idcolformado }}"
                                                                            class="btn btn-danger btn-sm"
                                                                            data-target="#modal-delete-{{ $det->idcolformado }}" data-toggle="modal"
                                                                            title="Elimiar">
                                                                            <i class="right fa fa-trash-alt"></i>
                                                                        </a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                @include('colaborador.formado.modal')
                                                            @else
                                                            @endif
                                                        @empty
                                                            <tr>
                                                                <td colspan="6"> Nenhum registo
                                                                    encontrado!
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $codigoformacao->appends(['searchText' => $searchText])->links() }}
                    </div>
                </div>
                <hr class="my-2">

            </div>
        </div>
    @else
        @include('errors.info')
    @endif
@stop
