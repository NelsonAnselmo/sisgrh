@extends('adminlte::page')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Backup/Backup</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->tipo == 'Administrador' || Auth::user()->tipo == 'Gerente')
    <div class="lockscreen-wrapper">
        <div class="lockscreen-logo">
            <a href="#"><i class="fa fa-book"></i>
                <b>Cópia</b> de Segurança
            </a>
        </div>

        <div class="text-left">
            <a href="{{ URL::action('BackupController@backup') }}"><i class="fas fa-download"></i> DESCAREGAR</a>
        </div>

        <div>
            <hr>
            A Cópia de segurança sera guardada por default na pasta "Public/storage".
            <hr>
            @include('errors.alerts')
        </div>
        <br>
        <a href="/home" class="btn btn-danger"><i class="fas fa-reply"></i>Voltar</a>
    </div>
    @else
    @include('errors.info')
    @endif
@stop
