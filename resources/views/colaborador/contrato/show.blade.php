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
                <h3 class="card-title m-0">Detalhes do Contrato do Colaborador</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Nome</label>
                            <p>{{ $colaborador->nome }}</p>
                        </div>
                        <hr class="my-2">
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Nr. Processo</label>
                            <p>{{ $colaborador->processo }}</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Sexo</label>
                            <p>{{ $colaborador->sexo }}</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Data Nascimento</label>
                            <p>{{ date('d-m-Y', strtotime($colaborador->dataNascimento)) }}</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Telefone</label>
                            <p>{{ $colaborador->telefone }}</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Email</label>
                            <p>{{ $colaborador->email }}</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Nuit</label>
                            <p>{{ $colaborador->nuit }}</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>BI</label>
                            <p>{{ $colaborador->bi }}</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Colaborador</label>
                            <p>{{ $colaborador->tipo }} </p>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <hr class="my-2">
                    </div>

                    <div class="col-lg-12 col-md-812 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-condensed table-hover">
                                <thead style="background-color:#A9D0F5">
                                    <tr>
                                        <th>#</th>
                                        <th>Tipo de Contrato</th>
                                        <th>Data de Inicio</th>
                                        <th>Data de Conclusão</th>
                                        <th>Estado</th>
                                        @if (Auth::user()->tipo == 'Administrador' || Auth::user()->tipo == 'Recursos Humano')
                                        <th style="text-align-last: center;">Opções</th>
                                        @endif
                                    </tr>
                                </thead>
                                @forelse($colcontratos  as $key=> $cont)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $cont->contrato }}</td>
                                        <td>{{ $cont->dataContrato }}</td>
                                        <td>{{ $cont->dataValidade }}</td>
                                        @if ($cont->estado == 'Activo')
                                            <td>
                                                <small class="badge badge-primary"><i class="far fa-clock"></i>
                                                    {{ $cont->estado }}
                                                </small>
                                            </td>
                                        @else
                                            <td>
                                                <small class="badge badge-danger"><i class="far fa-clock"></i>
                                                    {{ $cont->estado }}
                                                </small>
                                            </td>
                                        @endif
                                        @if (Auth::user()->tipo == 'Administrador' || Auth::user()->tipo == 'Recursos Humano')
                                        <td style="text-align-last: center;">
                                            <a href="{{ URL::action('ColCotratohoController@edit', $cont->id) }}"
                                                class="btn btn-primary btn-sm" title="Editar">
                                                <i class="right fa fa-edit"></i>
                                            </a>
                                            <a href="{{ 'ColCotratohoController@destroy', $cont->id }}"
                                                class="btn btn-danger btn-sm"
                                                data-target="#modal-delete-{{ $cont->id }}" data-toggle="modal"
                                                title="Terminar">
                                                <i class="right fa fa-clock"></i>
                                            </a>
                                        </td>
                                        @endif
                                    </tr>
                                    @include('colaborador.contrato.modal')
                                @empty
                                    <tr>
                                        <td colspan="6">Nenhum registo encontrado!</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-4">
                    <a href="{{ URL::action('ColCotratohoController@index') }}" class="btn btn-danger float-right"><i
                            class="fas fa-reply"></i> Voltar
                    </a>
                </div>
                <hr class="my-4">
                HISTÓRICO DE CONTRATOS
                <hr class="my-4">

                <table class="table table-striped table-bordered table-condensed table-hover">
                    <tr>
                        <th>#</th>
                        <th>Tipo de Contrato</th>
                        <th>Data de Inicio</th>
                        <th>Data de Conclusão</th>
                        <th>Estado</th>
                    </tr>
                    @forelse($historico  as $key=> $hist)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $hist->nome }}</td>
                            <td>{{ $hist->dataContrato }}</td>
                            <td>{{ $hist->dataValidade }}</td>
                            @if ($hist->estado == 'Activo')
                                <td>
                                    <small class="badge badge-primary"><i class="far fa-clock"></i>
                                        {{ $hist->estado }}
                                    </small>
                                </td>
                            @else
                                <td>
                                    <small class="badge badge-danger"><i class="far fa-clock"></i>
                                        {{ $hist->estado }}
                                    </small>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Nenhum registo encontrado!</td>
                        </tr>
                    @endforelse
                </table>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <hr class="my-2">
                </div>
            </div>
        </div>
        
    @endif
@endsection
