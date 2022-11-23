@extends('adminlte::page')

@section('title', 'sisRH - KUGARISSICA')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">

        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h4>
                        {{ number_format($totalcurso->total, 1, ',', '.') }}
                    </h4>

                    <p>Total de Habitações</p>
                </div>
                <div class="icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <a href="{{ URL::action('FormacaoController@index') }}" class="small-box-footer">Mais Informação <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h4>
                        {{ number_format($totalstaff->total, 1, ',', '.') }}
                    </h4>
                    <p>
                        Total de STAFF's
                    </p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-secret"></i>
                </div>
                <a href="{{ URL::action('StaffController@index') }}" class="small-box-footer">Mais
                    Informação
                    <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h4>
                        {{ number_format($totalpdsc->total, 1, ',', '.') }}
                    </h4>

                    <p>Total de PDSC’s</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user"></i>
                </div>
                <a href="{{ URL::action('PdscController@index') }}" class="small-box-footer">Mais
                    Informação <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h4>
                        {{ number_format($totaldepartamento->total, 1, ',', '.') }}
                    </h4>

                    <p>Total de Departame</p>
                </div>
                <div class="icon">
                    <i class="fas fa-home"></i>
                </div>
                <a href="{{ URL::action('DepartamentoController@index') }}" class="small-box-footer">Mais Informação
                    <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-12">
        <hr class="my-2">
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative mb-4">
                        COLABORADOR – SEXO
                        <canvas id="mChart" height="400" style="display: block; width: 310px; height: 200px;"
                            width="620" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="position-relative mb-4">
                        DEPARTAMENTO - COLABORADOR
                        <canvas id="myChart" height="400" style="display: block; width: 310px; height: 200px;"
                            width="620" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{ asset('select2/js/chart.min.js') }}"></script>
@stop
