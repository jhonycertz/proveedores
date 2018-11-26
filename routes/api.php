<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\AuthController@login');

Route::group(['middleware' => 'auth:api'], function () {
	
	Route::delete('logout', 'API\AuthController@logout');
	Route::get('usuario', 'API\AuthController@usuario');
	Route::post('incidence-type/{document}/save', 'API\IncidenceTypeController@saveIncidence');
	Route::post('incidence-type/newType', 'API\IncidenceTypeController@newIncidenceType');


	Route::apiResource('incidence-type', 'API\IncidenceTypeController');
	Route::apiResource('requeriment-type', 'API\RequerimentTypeController');
	Route::apiResource('requeriment', 'API\RequerimentController');
	Route::apiResource('company-type', 'API\CompanyTypeController');
	Route::apiResource('company', 'API\CompanyController')->only(['index','show','update','destroy']);

	Route::get('company/{company}/documents', 'API\CompanyController@documents')->name('company.documents');

	Route::put('company/{company}/procesar', 'API\CompanyController@procesar')->name('company.procesar');
	Route::put('company/{company}/aprobar', 'API\CompanyController@aprobar')->name('company.aprobar');
	Route::put('company/{company}/aprobar-empresa', 'API\CompanyController@aprobarEmpresa')->name('company.aprobar.empresa');
	Route::post('company/{company}/create-date', 'API\CompanyController@createDate')->name('company.create.date');
	Route::delete('company/{company}/reprobar', 'API\CompanyController@reprobar')->name('company.reprobar');
	Route::post('company/{company}/{document}/incidencia', 'API\CompanyController@registrarIncidencia')->name('company.incidecia');
	
	//Documentos en el dashboard
	Route::post('company/{document}/accept-doc', 'API\CompanyController@acceptDocument')->name('acceptdocument');
	Route::post('company/{document}/reject-doc', 'API\CompanyController@rejectDocument')->name('rejectdocument');

	//Notificaciones
	Route::get('dashboard', 'API\DashboardController@index')->name('dashboard');
	Route::get('dashboard/getLogged', 'API\DashboardController@getlogged')->name('dashboard.getLogged');
	Route::get('dashboard/getRole', 'API\DashboardController@getRole')->name('dashboard.getRole');
	Route::get('dashboard/getMessages', 'API\DashboardController@getMessages')->name('dashboard.getMessages');

	//Roles y Usuarios
	Route::get('roles', 'API\UserController@getRoles')->name('roles.getRoles');
	Route::get('roles/getChargesTypes', 'API\UserController@getChargesTypes')->name('roles.getChargesTypes');
	Route::post('roles/getRoleById', 'API\UserController@getRoleById')->name('roles.getRoleById');
	Route::post('roles/storeRol', 'API\UserController@storeRol')->name('roles.storeRol');
	Route::post('roles/updateRole', 'API\UserController@updateRole')->name('roles.updateRole');
	Route::post('roles/deleteRol', 'API\UserController@deleteRol')->name('roles.deleteRol');
	Route::get('users', 'API\UserController@getUsers')->name('users.getUsers');
	Route::get('users/getRoles', 'API\UserController@getAllRoles')->name('users.getRoles');
	Route::post('users/getUserById', 'API\UserController@getUserById')->name('users.getUserById');
	Route::post('users/storeUser', 'API\UserController@storeUser')->name('users.storeUser');
	Route::post('users/updateUser', 'API\UserController@updateUser')->name('users.updateUser');
	Route::post('users/deleteUser', 'API\UserController@deleteUser')->name('users.deleteUser');

	//Citas
	Route::get('/dates', 'API\DatesController@getDates')->name('dates.getDates');
	Route::post('/dates/updateDate', 'API\DatesController@updateDate')->name('dates.updateDate');
	Route::post('/dates/getOnlyOne', 'API\DatesController@getOnlyOne')->name('dates.getOnlyOne');
	Route::post('/dates/updateAttendant', 'API\DatesController@updateAttendant')->name('dates.updateAttendant');
	
	Route::apiResource('document-type', 'API\DocumentTypeController');
	Route::apiResource('reply', 'API\ReplyController');
	Route::apiResource('question', 'API\QuestionController');
});