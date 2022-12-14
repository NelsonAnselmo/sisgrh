@extends('adminlte::page')
@section('content_header')
    <link rel="stylesheet" href="{{ asset('select2/css/bootstrap-select.min.css') }}">
@stop
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Desenpenho/STAFF</li>
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
                <h3 class="card-title m-0">Novo Desenpenho</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-12 col-md-812 col-sm-12 col-xs-12">
                        @include('errors.alerts')
                    </div>
                </div>

                {!! Form::open([
                    'url' => 'desenpenho/staff',
                    'method' => 'POST',
                    'autocomplete' => 'off',
                    'files' => 'true',
                ]) !!}
                {{ Form::token() }}
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Nome Colaborarador</label>
                            <select name='idcolaborador' class="form-control selectpicker" data-live-search="true" required>
                                <option value="" selected>----Selecione o Colaborador----</option>
                                @foreach ($colaboradores as $col)
                                    <option value="{{ $col->idcolaborador }}">{{ $col->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Nome Supervisor (a)</label>
                            <select name='idsupervisora' class="form-control selectpicker" data-live-search="true" required>
                                <option value="" selected>----Selecioner Supervisor (a)----</option>
                                @foreach ($supervisor as $sup)
                                    <option>{{ $sup->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="nomeprojecto">Nome Projecto</label>
                            <input type="text" name="nomeprojecto" required value="Mwanasana" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="dataini">Data Avalia????o</label>
                            <input type="date" value="{{ $datahj }}" name="dataini" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <hr class="my-2">
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead style="background-color:#A9D0F5">
                                <tr>
                                    <th>Indicadores </th>
                                    <th>Avalia????o</th>
                                    <th>Media da Avalia????o</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>
                                    <b>1.ASSIDUIDADE</b><br>
                                </td>
                                <td>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="assi_a"
                                                    name="assiduidade" required
                                                    value="Cumpre o hor??rio e est?? sempre presente, mostrando-se disposto a atender ??s necessidades de trabalho.">
                                                <label for="assi_a" class="custom-control-label">
                                                    Cumpre o hor??rio e est?? sempre presente, mostrando-se disposto a atender
                                                    ??s
                                                    necessidades de trabalho.
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="assi_b"
                                                    name="assiduidade" required
                                                    value="Cumpre o hor??rio estabelecido e ?? pontual nos seus compromissos de trabalho.">
                                                <label for="assi_b" class="custom-control-label">
                                                    Cumpre o hor??rio
                                                    estabelecido e ?? pontual nos seus compromissos de trabalho.
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="assi_c"
                                                    name="assiduidade" required
                                                    value="Normalmente n??o cumpre o hor??rio estabelecido, mas, quando presente, atende ??s necessidades de trabalho.">
                                                <label for="assi_c" class="custom-control-label">
                                                    Normalmente n??o cumpre o hor??rio estabelecido, mas, quando presente,
                                                    atende ??s
                                                    necessidades de trabalho.
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="assi_d"
                                                    name="assiduidade" required
                                                    value="Nunca cumpre hor??rio e est?? sempre ausente.">
                                                <label for="assi_d" class="custom-control-label">
                                                    Nunca cumpre hor??rio e est?? sempre ausente.
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select class="custom-select form-control-border border-width-2" name="assi_nota"
                                            required>
                                            <option value="">------------------</option>
                                            <option value="5 EXCELENTE">5</option>
                                            <option value="4 EXCELENTE">4</option>
                                            <option value="3 BOM">3</option>
                                            <option value="2 BOM">2</option>
                                            <option value="1 REGULAR">1</option>
                                            <option value="1 INSATISFAT??RIO">0</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>2.RESPONSABILIDADE</b>
                                </td>
                                <td>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="res_a"
                                                    name="responsablidade" required
                                                    value="Conhece suas atribui????es executando suas atividades acima das expectativas, antecipando-se ??s solicita????es.">
                                                <label for="res_a" class="custom-control-label">
                                                    Conhece suas atribui????es executando suas atividades acima das
                                                    expectativas,
                                                    antecipando-se ??s solicita????es.
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="res_b"
                                                    name="responsablidade" required
                                                    value="Executa adequadamente as suas atividades de acordo com a responsabilidade estabelecidas para o seu departamento.">
                                                <label for="res_b" class="custom-control-label">Executa adequadamente
                                                    as
                                                    suas atividades de acordo com a responsabilidade estabelecidas para o
                                                    seu
                                                    departamento.
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="res_c"
                                                    name="responsablidade" required
                                                    value="Em algumas situa????es demonstra pouca aten????o em rela????o a execu????o das atribui????es do seu cargo.">
                                                <label for="res_c" class="custom-control-label">
                                                    Em algumas situa????es demonstra pouca aten????o em rela????o a execu????o das
                                                    atribui????es do seu
                                                    cargo.
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="res_d"
                                                    name="responsablidade" required
                                                    value="N??o cumpre adequadamente suas atribui????es.">
                                                <label for="res_d" class="custom-control-label">
                                                    N??o cumpre adequadamente suas atribui????es.
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select class="custom-select form-control-border border-width-2" name="res_nota"
                                            required>
                                            <option value="">------------------</option>
                                            <option value="5 EXCELENTE">5</option>
                                            <option value="4 EXCELENTE">4</option>
                                            <option value="3 BOM">3</option>
                                            <option value="2 BOM">2</option>
                                            <option value="1 REGULAR">1</option>
                                            <option value="1 INSATISFAT??RIO">0</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>3.COMPRIMENTO DAS METAS</b>
                                </td>
                                <td>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="meta_a"
                                                    name="meta" required
                                                    value="Conhece a descri????o fluxo, implementa????o e as suas metas e cumpriu com todas as expectativas ao alcance do pacote prim??rio.">
                                                <label for="meta_a" class="custom-control-label">
                                                    Conhece a descri????o fluxo, implementa????o e as suas metas e cumpriu com
                                                    todas as expectativas ao alcance do pacote prim??rio.
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="meta_b"
                                                    name="meta" required
                                                    value="Executa adequadamente e tende a alcan??ar as metas que foram estabelecidas.">
                                                <label for="meta_b" class="custom-control-label">
                                                    Executa adequadamente e tende a alcan??ar as metas que foram
                                                    estabelecidas.
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="meta_c"
                                                    name="meta" required
                                                    value="Em processo de alcance das metas e esta a trabalhar em meio dos desafios.">
                                                <label for="meta_c" class="custom-control-label">
                                                    Em processo de alcance das metas e esta a trabalhar em meio dos
                                                    desafios.
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="meta_d"
                                                    name="meta" required
                                                    value="N??o tem sess??es regulares, tem tend??ncias de n??o cumprimento do esperado.">
                                                <label for="meta_d" class="custom-control-label">
                                                    N??o tem sess??es regulares, tem tend??ncias de n??o cumprimento do
                                                    esperado.
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select class="custom-select form-control-border border-width-2" name="meta_nota"
                                            required>
                                            <option value="">------------------</option>
                                            <option value="5 EXCELENTE">5</option>
                                            <option value="4 EXCELENTE">4</option>
                                            <option value="3 BOM">3</option>
                                            <option value="2 BOM">2</option>
                                            <option value="1 REGULAR">1</option>
                                            <option value="1 INSATISFAT??RIO">0</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>4.REGISTO E REPORTE DE DADOS</b>
                                </td>
                                <td>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="registo_a"
                                                    name="registo" required
                                                    value="Promove e executa as actividades e na mesma semana, regista as actividades nos ficheiros f??sicos e eletr??nicos semanalmente.">
                                                <label for="registo_a" class="custom-control-label">
                                                    Promove e executa as actividades e na mesma semana, regista as
                                                    actividades nos
                                                    ficheiros f??sicos e eletr??nicos semanalmente.
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="registo_b"
                                                    name="registo" required
                                                    value="Cumpre com os reportes mensais e faz pelo menos duas visitas por m??s para a actualiza????o dos dados.">
                                                <label for="registo_b" class="custom-control-label">
                                                    Cumpre com os reportes mensais e faz pelo menos duas visitas por
                                                    m??s para a actualiza????o dos dados.
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="registo_c"
                                                    name="registo" required
                                                    value="Conhece as responsabilidades de actualiza????o de dados semanais e o bi-semanais mais actualiza dados s?? no final do m??s para o reporte.">
                                                <label for="registo_c" class="custom-control-label">
                                                    Conhece as responsabilidades de actualiza????o de dados semanais e o
                                                    bi-semanais mais
                                                    actualiza dados s?? no final do m??s para o reporte.
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="registo_d"
                                                    name="registo" required
                                                    value="N??o actualiza dados a tempo e tem pelo menos tr??s atrasos no reporte de dados e na plataforma.">
                                                <label for="registo_d" class="custom-control-label">
                                                    N??o actualiza dados a tempo e tem pelo menos tr??s atrasos no reporte de
                                                    dados e na
                                                    plataforma.
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select class="custom-select form-control-border border-width-2"
                                            name="registo_nota" required>
                                            <option value="">------------------</option>
                                            <option value="5 EXCELENTE">5</option>
                                            <option value="4 EXCELENTE">4</option>
                                            <option value="3 BOM">3</option>
                                            <option value="2 BOM">2</option>
                                            <option value="1 REGULAR">1</option>
                                            <option value="1 INSATISFAT??RIO">0</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>5.??TICA E DEONTOLOGIA PROFISSIONAL</b>
                                </td>
                                <td>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="etica_a"
                                                    name="etica" required value="Mostra altru??smo em suas a????es.">
                                                <label for="etica_a" class="custom-control-label">
                                                    Mostra altru??smo em suas a????es.
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="etica_b"
                                                    name="etica" required value="Demostra ter senso de justi??a.">
                                                <label for="etica_b" class="custom-control-label">
                                                    Demostra ter senso de justi??a.
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="etica_c"
                                                    name="etica" required
                                                    value="Se mostra honesta em rela????o as suas ac????es cos os seu colegas de trabalho.">
                                                <label for="etica_c" class="custom-control-label">
                                                    Se mostra honesto (a) em rela????o as suas ac????es cos os seu colegas de
                                                    trabalho.
                                                </label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="etica_d"
                                                    name="etica" required
                                                    value="Age sem intuito de prejudicar a empresa e os seus colegas.">
                                                <label for="etica_d" class="custom-control-label">
                                                    Age sem intuito de prejudicar a empresa e os seus colegas.
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <select class="custom-select form-control-border border-width-2" name="etica_nota"
                                            required>
                                            <option value="">------------------</option>
                                            <option value="5 EXCELENTE">5</option>
                                            <option value="4 EXCELENTE">4</option>
                                            <option value="3 BOM">3</option>
                                            <option value="2 BOM">2</option>
                                            <option value="1 REGULAR">1</option>
                                            <option value="1 INSATISFAT??RIO">0</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Coment??rio do Avaliador(a)</label>
                            <input type="text" name="comentario" class="form-control" required
                                placeholder="Enter ...">
                        </div>
                    </div>


                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <hr class="my-2">
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Salvar</button>
                            <a href="{{ URL::action('PdscdesenpenhoController@index') }}" class="btn btn-danger"><i
                                    class="fa fa-times"></i>
                                Cancelar</a>
                        </div>
                    </div>
                    {!! Form::close() !!}
                    <hr class="my-2">
                </div>
            </div>
    @endif
@stop
@section('js')
    <script src="{{ asset('select2/js/bootstrap-select.min.js') }}"></script>
@stop
