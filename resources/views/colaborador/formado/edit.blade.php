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
                        <li class="breadcrumb-item active">Colaboraddor/STAFF</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->tipo == 'Administrador' || Auth::user()->tipo == 'Gerente')
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title m-0">Editar STAF => {{ $colaborador->nome }}</h3>
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

                {!! Form::model($colaborador, ['method' => 'PATCH','route' => ['staff.update', $colaborador->idcolaborador], 'files' => 'true']) !!}
                {{ Form::token() }}
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="processo">Nr. Processo</label>
                            <input type="text" name="processo" value="{{ $colaborador->processo }}" class="form-control"
                                required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" value="{{ $colaborador->nome }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="datanasc">Data Nasc.</label>
                            <input type="date" value="{{ $colaborador->dataNascimento }}" name="datanasc" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label for="bi">BI</label>
                            <input type="text" name="bi" value="{{ $colaborador->bi }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label for="dataemissao">Data Emissão</label>
                            <input type="date" value="{{ $colaborador->dataEmisaoBi }}" name="dataemissao" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class="form-group">
                            <label for="datavalidade">Data Validade</label>
                            <input type="date" value="{{ $colaborador->dataValidadeBi }}" name="datavalidade"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Sexo</label>
                            <select name='sexo' class="form-control selectpicker" data-live-search="true" required>
                                @if ($colaborador->sexo == 'Masculino')
                                    <option selected>Masculino</option>
                                    <option>Femenino</option>
                                    <option>Outros</option>
                                @elseif ($colaborador->sexo == 'Femenino')
                                    <option selected>Femenino</option>
                                    <option>Masculino</option>
                                    <option>Outros</option>
                                @elseif ($colaborador->sexo == 'Outros')
                                    <option selected>Outros</option>
                                    <option>Masculino</option>
                                    <option>Femenino</option>
                                @else
                                    <option value="" style="text-align: center">
                                        ---Selecione o
                                        Sexo---</option>
                                    <option>Masculino</option>
                                    <option>Femenino</option>
                                    <option>Outros</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="formacao">Formação Académica</label>
                            <input type="text" name="formacao" value="{{ $colaborador->formacaoAcademica }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="nomepai">Nome Pai</label>
                            <input type="text" name="nomepai" value="{{ $colaborador->nomePai }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="nomemae">Nome Mãe</label>
                            <input type="text" name="nomemae" value="{{ $colaborador->nomeMae }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="nuit">Nuit</label>
                            <input type="text" name="nuit" value="{{ $colaborador->nuit }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="text" name="telefone" value="{{$colaborador->telefone }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ $colaborador->email }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="inss">Nr. INSS</label>
                            <input type="text" name="inss" value="{{ $colaborador->inss }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="dataaberturainss">Data Abertura</label>
                            <input type="date" value="{{ $colaborador->dataAberturaInss }}" name="dataaberturainss"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>Departamento</label>
                            <select name='iddepartamento' class="form-control selectpicker" data-live-search="true" required>
                                @foreach ($departamento as $dep)
                                @if ($dep->iddepartamento == $colaborador->iddepartamento)
                                    <option value="{{ $dep->iddepartamento }}" selected>{{ $dep->nome }}</option>
                                @else
                                    <option value="{{ $dep->iddepartamento }}">{{ $dep->nome }}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Salvar</button>
                            <a href="{{ URL::action('StaffController@index') }}" class="btn btn-danger"><i
                                    class="fa fa-times"></i>
                                Cancelar</a>
                        </div>
                    </div>
                </div>
                </div>                    
                {!! Form::close() !!}

                <hr class="my-2">
            </div>
        </div>
    @else
        @include('errors.info')
    @endif
@stop
@section('js')
<script src="{{ asset('select2/js/bootstrap-select.min.js') }}"></script>
@stop
