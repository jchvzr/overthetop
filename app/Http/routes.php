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
      Route::get('/graficoiniciodata2', 'BienvenidaController@graficoiniciodata2');

      Route::get('/perfil','AdministradosController@index');
      Route::post('/guardarimagenperfil', 'AdministradosController@imageUserStore');
      Route::get('/buscaclienteinteraccionresumen','BienvenidaController@grafico1');

      //layouts
      Route::get('/alertascompromisos', 'alertasarriba@index');

      // HRM
      Route::get('/newprofileuser','hrmcontroller@newprofileuser');
      Route::get('/editprofileuser','hrmcontroller@showprofileuser');
      Route::get('/muestraperfildeusuario/{id}','hrmcontroller@showprofileuserid');
      Route::post('/guardaperfildeusuario','hrmcontroller@guardaprofileuser');
      Route::get('/muestraarchivosdeusuario/{id}','hrmcontroller@muestraarchivosdeusuario');


      // CRM
      Route::get('/crmindex','crmcontroller@index');
      Route::get('/buscacliente/{cuenta}','crmcontroller@buscacliente');
      Route::get('/buscaclienteinteraccion/{cuenta}','crmcontroller@buscaclienteinteraccion');
      Route::get('/liberadiv/{id}','crmcontroller@liberadiv');
      Route::post('/crm/guardainteraccion','crmcontroller@storeinteractions');
      Route::post('/crm/guardainteraccion2','crmcontroller@storeinteractions2');
      Route::get('/buscaclienteinteraccionresumen/{cuenta}','crmcontroller@buscaclienteinteraccionresumen');
      Route::get('/controlcompromisos', 'crmcontroller@controlcompromisosindex');
      Route::get('/compromisoscambiostatus/{id}/', 'crmcontroller@compromisoscambiostatus');
      Route::get('/compromisoscambiostatus/{id}/{dispotition}', 'crmcontroller@compromisoscambiostatus2');
      Route::get('/buscatelefono/{telefono}','crmcontroller@buscatelefono');
      Route::get('/buscacatalogocampaña/{id}','crmcontroller@buscacatalogocampaña');

       // pertenecen a /newcode
          Route::get('/newcode', 'crmcontroller@newcode');
          Route::post('/newcode/creacodigo','crmcontroller@newcodestore');
          Route::get('/newcode/mostrarcodigo/{id}','crmcontroller@newcodemostrarcodigo');
          Route::get('/newcode/mostrartratamiento/{id}','crmcontroller@newcodemostrartratamiento');
          Route::post('/newcode/editacodigo/{id}','crmcontroller@newcodeeditacodigo');
       // pertenecen a /newcatalogo
          Route::get('/newcatalogo', 'crmcontroller@newcatalogo');
          Route::post('/newcatalogo/creacatalogonew','crmcontroller@newcatalogostore');
          Route::get('/newcatalogo/muestracatalogodisponibles/{id}','crmcontroller@newcatalogomostrardisponibles');
          Route::get('/newcatalogo/muestracatalogoseleccionados/{id}','crmcontroller@newcatalogomostrarseleccionados');
          Route::get('/newcatalogo/muestracatalogonombre/{id}','crmcontroller@newcatalogomuestracatalogonombre');
          Route::post('/newcatalogo/editacatalogo/{id}','crmcontroller@newcatalogoeditacatalogo');

      //Carga de clientes
      Route::get('/cargaclientes', 'CargaclientesController@index');
      Route::post('/subirclientes', 'CargaclientesController@subirclientes');
      Route::post('/depurarclientes', 'CargaclientesController@depurarclientes');
      Route::get('/newcampaign', 'CargaclientesController@newcampaign');
      Route::post('/newcampaignup', 'CargaclientesController@newcampaignup');
      Route::get('/newcampaign/muestracampaign/{id}', 'CargaclientesController@newcampaignmuestracampaign');
      Route::get('/newcampaign/muestracatalogos/', 'CargaclientesController@newcampaignmuestracatalogos');
      Route::post('/newcampaign/editacampana/', 'CargaclientesController@newcampaigneditcampaign');

      //Marcacion
      Route::get('/Marcacion', 'crmcontroller@Marcacionshow');
      Route::post('/crm/Marcacion','crmcontroller@storeinteractionsmarcacion');

      // Administracion de la herramienta
      Route::get('/newuser','admintoolcontroller@newUser');
      Route::get('/edituser','admintoolcontroller@edituser');
      Route::get('/muestraeditusuario/{id}','admintoolcontroller@showedituserid');
      Route::post('/userstore','admintoolcontroller@userStore');
      Route::post('/edituserstore','admintoolcontroller@edituserstore');
      Route::get('/nuevoperfilseguridad','admintoolcontroller@newPerfil');
      Route::post('/perfilstore','admintoolcontroller@perfilstore');
      Route::get('/editperfilseguridadshow','admintoolcontroller@editperfilseguridadshow');
      Route::get('/editperfilseguridadchecks/{id}','admintoolcontroller@editperfilseguridadchecks');
      Route::get('/editperfilseguridadcheckssub/{id}','admintoolcontroller@editperfilseguridadcheckssub');
      Route::post('/perfilstoreedit','admintoolcontroller@perfilstoreedit');
      Route::get('/newcompany','admintoolcontroller@newcompany');
      Route::post('/companystore','admintoolcontroller@companystore');
      Route::post('/companyedit','admintoolcontroller@companyedit');
      Route::get('/newcompany/muestracompany/{id}','admintoolcontroller@newcompanymuestracompany');

      // Descarga de detalles
      Route::get('/descargacodigos','descargacontroller@descargacodigosindex');
      Route::post('/descargacodigosshow','descargacontroller@descargacodigosshow');
      Route::get('/descargacompromisos','descargacontroller@descargacompromisosindex');
      Route::post('/descargacompromisosshow','descargacontroller@descargacompromisosshow');


      // Dashboard
      Route::get('/resultados','dashboard@index');
      Route::post('/descargadashboard1','dashboard@descargadashboard1');
      Route::post('/descargadashboardpenetracion','dashboard@descargadashboardpenetracion');


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
