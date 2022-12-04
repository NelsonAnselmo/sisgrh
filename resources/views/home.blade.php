@extends('adminlte::page')
@section('title', 'sisGRH - KUGARISSICA')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        @if (Auth::user()->tipo == 'Supervisor')
            <div class="lockscreen-wrapper">
                <div class="lockscreen-logo">
                    <i class="fa fa-info"></i>
                    Seja bem vindo ao sisGRH
                    <marquee behavior="true">
                        Supervisor/(a) : {{ Auth::user()->name }}
                    </marquee>
                </div>
            </div><br><br><br><br><br><br><br><br><br>
        @else
            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h4>
                            {{ number_format($totalcurso->total, 1, ',', '.') }}
                        </h4>

                        <p>Total de Formação</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <a href="{{ URL::action('FormacaoController@formacoes') }}" class="small-box-footer">Mais Informação <i
                            class="fas fa-arrow-circle-right"></i></a>
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
                    <a href="{{ URL::action('StaffController@staff') }}" class="small-box-footer">Mais
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
                    <a href="{{ URL::action('PdscController@pdsc') }}" class="small-box-footer">Mais
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
                    <a href="{{ URL::action('DepartamentoController@departamento') }}" class="small-box-footer">Mais
                        Informação
                        <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-12">
                <hr class="my-2">
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="position-relative mb-2">
                            COLABORADOR – SEXO
                            <canvas id="hart" height="400" style="display: block; width: 310px; height: 200px;"
                                width="620" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <div class="position-relative mb-2">
                            DEPARTAMENTO - COLABORADOR
                            <canvas id="yChart" height="400" style="display: block; width: 310px; height: 200px;"
                                width="620" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@stop
@section('js')
    <script src="{{ asset('select2/js/chart.min.js') }}"></script>
    <script>
        $(function() {

            <?php
            foreach ($colabsex as $key => $value) {
                $totals[] = $value->total;
                $sexos[] = $value->sexo;
            }
            
            foreach ($colabdep as $key => $value) {
                $totais[] = $value->total;
                $deperts[] = $value->departamento;
            }
            
            try {
                $total = join(', ', $totals);
                $sexo = join("', '", $sexos);
                $sexo = "'" . $sexo . "'";
            
                $totai = join(', ', $totais);
                $depert = join("', '", $deperts);
                $depert = "'" . $depert . "'";
            } catch (Exception $e) {
                $total = 0;
                $sexo = 0;
            
                $totai = 0;
                $depert = 0;
            }
            
            ?>
            const txnv = document.getElementById('hart').getContext('2d');
            const hart = new Chart(txnv, {
                data: {
                    datasets: [{
                        type: 'pie',
                        label: 'TOTAL ',
                        data: [<?php echo $total; ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1,
                        spacing: 4
                    }],
                    labels: [<?php echo $sexo; ?>]
                },
                options: {
                    scales: {}

                }
            });

            const ctxnv = document.getElementById('yChart').getContext('2d');
            const yChart = new Chart(ctxnv, {
                data: {
                    datasets: [{
                        type: 'bar',
                        label: 'TOTAL ',
                        data: [<?php echo $totai; ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }, ],
                    labels: [<?php echo $depert; ?>]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        });
    </script>
@stop
