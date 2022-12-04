@extends('adminlte::page')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Colaborador/Contrato</li>
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
                <h3 class="card-title m-0">Lista de Colaboradores com Contratos Activos</h3>
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
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-lg-12 col-md-812 col-sm-12 col-xs-12">
                        @include('errors.alerts')
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        @include('colaborador.contrato.search')
                    </div>
                </div>

                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-striped table-condensed table-hover">
                            <tbody>
                                @foreach ($codigocontrato as $values)
                                    <tr data-widget="expandable-table" aria-expanded="false">
                                        <td style="background-color:#A9D0F5">
                                            <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                            {{ $values->idcontrato }} - CONTTRATO : {{ $values->nome }}
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
                                                            <th>Estado</th>
                                                            <th style="text-align-last: center;">Opções</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($colcontratos as $det)
                                                            @if ($values->idcontrato == $det->idcontrato)
                                                                <tr>
                                                                    <td>{{ $det->processo }}</td>
                                                                    <td>{{ $det->nome }}</td>
                                                                    <td>{{ $det->tipo }}</td>
                                                                    <td>{{ $det->telefone }}</td>
                                                                    @if ($det->estado == 'Activo')
                                                                        <td>
                                                                            <small class="badge badge-primary"><i
                                                                                    class="far fa-clock"></i>
                                                                                {{ $det->estado }}
                                                                            </small>
                                                                        </td>
                                                                    @else
                                                                        <td>
                                                                            <small class="badge badge-danger"><i
                                                                                    class="far fa-clock"></i>
                                                                                {{ $det->estado }}
                                                                            </small>
                                                                        </td>
                                                                    @endif
                                                                    <td style="text-align-last: center;">
                                                                        <a href="{{ URL::action('ColCotratohoController@show', $det->id) }}"
                                                                            class="btn btn-primary btn-sm" title="Detalhes">
                                                                            <i class="right fa fa-eye"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @else
                                                            @endif
                                                        @empty
                                                            <tr>
                                                                <td colspan="4"> Nenhum registo encontrado!
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
                        {{ $codigocontrato->appends(['searchText' => $searchText])->links() }}
                    </div>
                </div>
                <hr class="my-2">

            </div>
        </div>

    @endif
@stop
