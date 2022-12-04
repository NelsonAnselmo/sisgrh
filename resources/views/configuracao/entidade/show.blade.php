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
                <h3 class="card-title m-0">Detalhes da Entidade</h3>
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
                            <p>{{ $entidade->nome }}</p>
                        </div>
                        <hr class="my-2">
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Código</label>
                            <p>{{ $entidade->identidade }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Nr. Registro</label>
                            <p>{{ $entidade->registo }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Telefone</label>
                            <p>{{ $entidade->telefone }}</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Fax</label>
                            <p>{{ $entidade->fax }}</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Nuit</label>
                            <p>{{ $entidade->nuit }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Email</label>
                            <p>{{ $entidade->email }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Provincia</label>
                            <p>{{ $entidade->provincia }}</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label>Cidade</label>
                            <p>{{ $entidade->cidade }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>Av. Rua</label>
                            <p>{{ $entidade->avrua }}</p>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 float-right">
                        <img src="{{ asset('storage/imagens/artigos/' . $entidade->imagem) }}" alt="Sem Imagem"
                            height="120px" width="150px" class="img-circle img-bordered-sm float-right">
                    </div>

                </div><br>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-4">
                    <a href="{{ URL::action('EntidadeController@index') }}" class="btn btn-danger float-right"><i
                            class="fas fa-reply"></i> Voltar
                    </a>
                </div>
                <hr class="my-4">
            </div>
        </div>

    @endif
@endsection
