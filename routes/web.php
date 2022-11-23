<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/{slug?}', 'HomeController@index');

Route::resource('beckup/beckup','BackupController');
Route::resource('colaborador/pdsc','PdscController');
Route::resource('colaborador/staff','StaffController');
Route::resource('configuracao/usuario','UserController');
Route::resource('configuracao/perfil','PerfilController');
Route::resource('configuracao/contrato','ContratoController');
Route::resource('configuracao/formacao','FormacaoController');
Route::resource('configuracao/entidade','EntidadeController');
Route::resource('colaborador/formado','ColFormadoController');
Route::resource('configuracao/departamento','DepartamentoController');

Route::get('beckup/beckups','BackupController@backup');
Route::get('colaborador/pdsc/pdf/Pdsc','PdscController@PDFPdsc');
Route::get('colaborador/staff/pdf/Staff','StaffController@PDFStaff');
Route::get('configuracao/usuario/pdf/Usuaario','UserController@PDFUser');
Route::get('configuracao/formacao/pdf/Formacao','FormacaoController@PDFFormacao');
Route::get('configuracao/contrato/pdf/Contrato','ContratoController@PDFContrato');
Route::get('configuracao/departamento/pdf/Departamento','DepartamentoController@PDFDepartamento');

