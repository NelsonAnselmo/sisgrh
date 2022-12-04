@extends('adminlte::page')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Informações / Formação</li>
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
            <h3 class="card-title m-0">Lista de Formações</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <a href="/home" class="btn btn-primary"><i
                        class="fas fa-reply"></i> Voltar
                </a>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color:#A9D0F5">
                                <tr>
                                    <th>#</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                </tr>
                            </thead>
                            @forelse($curso as  $cur)
                                <tr>
                                    <td>{{ $cur->idformacao }}</td>
                                    <td>{{ $cur->nome }}</td>
                                    <td>{{ $cur->descricao }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Nenhum registo encontrado!</td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                    {{ $curso->links() }}
                </div>

            </div>
            <hr class="my-2">
        </div>
    </div>
    @endif
@stop
