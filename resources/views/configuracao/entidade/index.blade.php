@extends('adminlte::page')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Configuração/Entidade</li>
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
            <h3 class="card-title m-0">Lista da Entidade</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <a href="entidade/create">
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
                    @include('configuracao.entidade.search')
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-812 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color:#A9D0F5">
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Nuit</th>
                                    <th>Telefone</th>
                                    <th>Provincia</th>
                                    <th>Logo</th>
                                    <th style="text-align-last: center;">Opções</th>
                                </tr>
                            </thead>
                            @forelse($entidades  as $key=> $ent)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $ent->nome }}</td>
                                    <td>{{ $ent->nuit }}</td>
                                    <td>{{ $ent->telefone }}</td>
                                    <td>{{ $ent->provincia }}</td>
                                    <td style="text-align-last: center;">
                                        <img src="{{ asset('storage/imagens/artigos/' . $ent->imagem) }}" alt="Sem Imagem"
                                            height="50px" width="50px" class="img-circle img-bordered-sm">
                                    </td>

                                    <td style="text-align-last: center;">
                                        <a href="{{ URL::action('EntidadeController@show', $ent->identidade) }}"
                                            class="btn btn-primary btn-sm" title="Detalhes">
                                            <i class="right fa fa-eye"></i>
                                        </a>
                                        <a href="{{ URL::action('EntidadeController@edit', $ent->identidade) }}"
                                            class="btn btn-primary btn-sm" title="Editar">
                                            <i class="right fa fa-edit"></i>
                                        </a>
                                        @if (Auth::user()->tipo == 'Administrador')
                                        <a href="{{ 'EntidadeController@destroy', $ent->identidade }}"
                                            class="btn btn-danger btn-sm" data-target="#modal-delete-{{ $ent->identidade }}"
                                            data-toggle="modal" title="Elimiar">
                                            <i class="right far fa-trash-alt"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @include('configuracao.entidade.modal')
                            @empty
                                <tr>
                                    <td colspan="7">Nenhum registo encontrado! (Por favor, encirra as informações da sua empresa)</td>
                                </tr>
                            @endforelse
                            @if (isset($key))
                                <tr>
                                    <th colspan="6" style="text-align: right;">TOTAL</th>
                                    <th style="background-color:#A9D0F5"> {{ number_format($key + 1, 1, '.', ',') }}</th>
                                </tr>
                            @endif
                        </table>
                    </div>
                    {{ $entidades->appends(['searchText' => $searchText])->links() }}
                </div>
            </div>
            <hr class="my-2">

        </div>
    </div>

    @endif
@stop
