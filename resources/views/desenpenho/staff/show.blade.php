@extends('adminlte::page')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Desenpenho/PDSC</li>
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
                <h3 class="card-title m-0">Detalhes da analise</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="card-body">
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Nome Colaborador</label>
                            <p>{{ $desenpenho->nome }}</p>
                        </div>
                        <hr class="my-2">
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>Nomne Supervisor (a)</label>
                            <p>{{ $desenpenho->idsupervisora }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>Nome Projecto</label>
                            <p>{{ $desenpenho->nomeprojecto }}</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>Data avaliação</label>
                            <p>{{ date("d-m-Y", strtotime($desenpenho->dataini)) }}</p>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <hr class="my-2">
                    </div>

                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        <div class="form-group">
                            <label>1. ASSIDUIDADE</label>
                            <p>{{ $desenpenho->assiduidade }}</p>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label>Nota</label>
                            <p>{{ $desenpenho->assi_nota }}</p>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        <div class="form-group">
                            <label>2. RESPONSABILIDADE</label>
                            <p>{{ $desenpenho->responsablidade }}</p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label>Nota</label>
                            <p>{{ $desenpenho->res_nota }}</p>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        <div class="form-group">
                            <label>3. COMPRIMENTO DAS METAS</label>
                            <p>{{ $desenpenho->meta }}</p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label>Nota</label>
                            <p>{{ $desenpenho->meta_nota }}</p>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        <div class="form-group">
                            <label>4. REGISTO E REPORTE DE DADOS</label>
                            <p>{{ $desenpenho->registo }}</p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label>Nota</label>
                            <p>{{ $desenpenho->registo_nota }}</p>
                        </div>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        <div class="form-group">
                            <label>5. ÉTICA E DEONTOLOGIA PROFISSIONAL</label>
                            <p>{{ $desenpenho->etica }}</p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label>Nota</label>
                            <p>{{ $desenpenho->etica_nota }}</p>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <hr class="my-2">
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>COMENTÁRIOS</label>
                            <p>{{ $desenpenho->comentario }}</p>
                        </div>
                    </div>


                </div><br>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-4">
                    <a href="{{ URL::action('PdscdesenpenhoController@index') }}" class="btn btn-danger float-right"><i
                            class="fas fa-reply"></i> Voltar
                    </a>
                </div>
                <hr class="my-4">
            </div>
        </div>

    @endif
@endsection
