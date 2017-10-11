<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//bienvenida al iniciar sesion
//Route::get('/', 'BienvenidaController@show');

//ruta para Dashboard
Route::get('/', 'LoginController@index');
//Rutas para vistas del usuario
Route::get('/contacto', 'BienvenidaController@contacto');
Route::post('/mail', 'BienvenidaController@mail');

Route::get('/password/email', 'Auth\PasswordController@getEmail');
Route::post('/password/email', 'Auth\PasswordController@postEmail');

Route::get('/password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('/password/reset', 'Auth\PasswordController@postReset');

Route::group( ['middleware' => 'auth'],
    function(){
      //Entradas
			Route::get('bienvenida/', 'BienvenidaController@show');
      Route::get('/perfil','AdministradosController@index');
      Route::post('/guardarimagenperfil', 'AdministradosController@imageUserStore');
      Route::get('/buscaclienteinteraccionresumen','BienvenidaController@grafico1');


      //layouts
      Route::get('/alertascompromisos', 'alertasarriba@index');



      // HRM
      Route::get('/newprofileuser','hrmcontroller@newprofileuser');
      Route::get('/editprofileuser','hrmcontroller@showprofileuser');
      Route::get('/muestraperfildeusuario/{id}','hrmcontroller@showprofileuserid');
      Route::get('/guardaperfildeusuario','hrmcontroller@guardaprofileuser');


      // CRM
      Route::get('/crmindex','crmcontroller@index');
      Route::get('/buscacliente/{cuenta}','crmcontroller@buscacliente');
      Route::get('/buscaclienteinteraccion/{cuenta}','crmcontroller@buscaclienteinteraccion');
      Route::get('/liberadiv/{id}','crmcontroller@liberadiv');
      Route::post('/crm/guardainteraccion','crmcontroller@storeinteractions');
      Route::get('/buscaclienteinteraccionresumen/{cuenta}','crmcontroller@buscaclienteinteraccionresumen');
      Route::get('/controlcompromisos', 'crmcontroller@controlcompromisosindex');
      Route::get('/compromisoscambiostatus/{id}', 'crmcontroller@compromisoscambiostatus');
      Route::get('/newcode', 'crmcontroller@newcode');



      //Carga de clientes
      Route::get('/cargaclientes', 'CargaclientesController@index');
      Route::post('/subirclientes', 'CargaclientesController@subirclientes');


      // Administracion de la herramienta
      Route::get('/newuser','admintoolcontroller@newUser');
      Route::post('/userstore','admintoolcontroller@userStore');
      Route::get('/nuevoperfilseguridad','admintoolcontroller@newPerfil');
      Route::post('/perfilstore','admintoolcontroller@perfilstore');
      Route::get('/editperfilseguridadshow','admintoolcontroller@editperfilseguridadshow');
      Route::get('/editperfilseguridadchecks/{id}','admintoolcontroller@editperfilseguridadchecks');
      Route::get('/editperfilseguridadcheckssub/{id}','admintoolcontroller@editperfilseguridadcheckssub');
      Route::post('/perfilstoreedit','admintoolcontroller@perfilstoreedit');



    });


Route::get('admin/auth/login', [
	'uses' => 'Auth\AuthController@getLogin',
	'as'	=>	'admin.auth.login'
]);


Route::post('admin/auth/login', [
	'uses' => 'Auth\AuthController@postLogin',
	'as'	=>	'admin.auth.login'
]);


Route::get('admin/auth/logout', [
	'uses' => 'Auth\AuthController@getLogout',
	'as'	=>	'admin.auth.logout'
]);
