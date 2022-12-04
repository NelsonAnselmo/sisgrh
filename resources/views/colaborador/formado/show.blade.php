@extends('adminlte::page')

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
                <h3 class="card-title m-0">Detalhes das Formações do Colaborador</h3>
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
                                        <th>Nome</th>
                                        <th>Data de Inicio</th>
                                        <th>Data de Conclusão</th>
                                    </tr>
                                </thead>
                                @forelse($colformados  as $key=> $for)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $for->formacao }}</td>
                                        <td>{{ $for->datainicio }}</td>
                                        <td>{{ $for->dataconclusao }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">Nenhum registo encontrado!</td>
                                    </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-4">
                    <a href="{{ URL::action('ColFormadoController@index') }}" class="btn btn-danger float-right"><i
                            class="fas fa-reply"></i> Voltar
                    </a>
                </div>
                <hr class="my-4">
            </div>
        </div>

        @endif
@endsection
