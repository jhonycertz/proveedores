<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','WelcomeController@index')->name('root');
Route::get('admin','AdminController@index');


Route::get('/company/register', 'RegisterCompanyController@index')->name('register.company');
Route::post('/company/register', 'RegisterCompanyController@store');
Route::post('/company/companytypes', 'RegisterCompanyController@companyTypes')->name('register.companytype');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home/alertas', 'HomeController@alertas')->name('home-alertas');

Route::get('/home/preguntas', 'HomeController@preguntas')->name('home-preguntas');
Route::post('/home/preguntas', 'HomeController@preguntasStore');

Route::get('/home/documento', 'HomeController@documento')->name('home-documento');

Route::get('/home/registrar-documento', 'HomeController@registrarDocumento')->name('home-registrar-documento');
Route::post('/home/registrar-documento', 'HomeController@registrarDocumentoStore');
Route::post('/testing', 'HomeController@testing');
