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
                <h3 class="card-title m-0"> Detalhes do Contrato</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">

                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Contrato</label>
                            <p>{{ $contrato->nome }}</p>
                        </div>
                        <hr class="my-2">
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label>Código</label>
                            <p>{{ $contrato->idcontrato }}</p>
                        </div>
                    </div>

                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        <div class="form-group">
                            <label>Descrição</label>
                            <p>{{ $contrato->descricao }}</p>
                        </div>
                    </div>
                </div><br>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-4">
                    <a href="{{ URL::action('ContratoController@index') }}" class="btn btn-danger float-right"><i
                            class="fas fa-reply"></i> Voltar
                    </a>
                </div>
                <hr class="my-4">
            </div>
        </div>
    @else
        @include('errors.info')
    @endif
@endsection
