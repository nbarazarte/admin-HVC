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

Route::group(['middleware' => 'auth'], function () {

	Route::get('/Dashboard', [
		'uses' => 'HomeController@index',
		'as' =>'home'
	]);

	Route::group(['middleware' => 'administrador'], function () {

	//Para los Usuarios del Sistema:
		
		//Crear Usuario:
		Route::get('Crear-Cuenta', [
						'uses' => 'HomeController@crearCuenta',
						'as' =>'registrar'
		]);

		Route::post('Crear-Cuenta', 'HomeController@postCrearCuenta');

		//Buscar usuarios:
		Route::get('Buscar-Cuenta', [
						'uses' => 'HomeController@buscarCuenta',
						'as' =>'buscarCuenta'
		]);

		//Ver Usuario:
		Route::get('Ver-Cuenta-{id}', [
						'uses' => 'HomeController@verCuenta',
						'as' =>'cuenta'
		]);

		//Editar Usuario
		Route::post('Editar-Cuenta', [
						'uses' => 'HomeController@editarCuenta',
						'as' =>'editarCuenta'
		]);

		//Editar Imágen
		Route::post('Editar-Imagen', [
						'uses' => 'HomeController@editarImagen',
						'as' =>'editarImagen'
		]);

		//Eliminar Cuenta
		Route::post('Eliminar-Cuenta', [
						'uses' => 'HomeController@eliminarCuenta',
						'as' =>'eliminarCuenta'
		]);

		//Eliminar Imágen
		Route::post('Eliminar-Imagen', [
						'uses' => 'HomeController@eliminarImagen',
						'as' =>'eliminarImagen'
		]);

		//Route::get('Ver-Cuenta/{id}','HomeController@verCuenta2');

		//Cambia el estatus del usuario por ajax en la Función "estatusUsuario(id,estatus)" en custom.js
		Route::get('usuario/{id}/estatus/{estatus}','HomeController@estatusUsuario');

	 });

	//Para los Clientes de HVC:

		//Crear Cliente:
		Route::get('Crear-Cliente', [
						'uses' => 'ClientesController@crearCuenta',
						'as' =>'registrarCli'
		]);

		Route::post('Crear-Cliente', 'ClientesController@postCrearCuenta');

		//Buscar Cliente:
		Route::get('Buscar-Clientes', [
						'uses' => 'ClientesController@buscarCuenta',
						'as' =>'buscarCuentaCli'
		]);

		//Ver Cliente:
		Route::get('Ver-Cliente-{id}', [
						'uses' => 'ClientesController@verCuenta',
						'as' =>'cuentaCli'
		]);

		//Editar Cliente
		Route::post('Editar-Cliente', [
						'uses' => 'ClientesController@editarCuenta',
						'as' =>'editarCuentaCli'
		]);

		//Editar Cliente
		Route::post('Editar-Imagen-Cliente', [
						'uses' => 'ClientesController@editarImagen',
						'as' =>'editarImagenCli'
		]);

		//Eliminar Cliente
		Route::post('Eliminar-Cuenta-Cliente', [
						'uses' => 'ClientesController@eliminarCuenta',
						'as' =>'eliminarCuentaCli'
		]);

		//Eliminar Imágen Cliente
		Route::post('Eliminar-Imagen-Cliente', [
						'uses' => 'ClientesController@eliminarImagen',
						'as' =>'eliminarImagenCli'
		]);

	//Para las Reservaciones:


		Route::post('Buscar-Disponibilidad', [
						'uses' => 'ReservacionController@buscarDisponibilidad',
						'as' =>'buscarDisponibilidad'
		]);



		//Crear Reservación:
		Route::get('Crear-Reservación', [
						'uses' => 'ReservacionController@crearReservacion',
						'as' =>'registrarReservacion'
		]);

		Route::post('Crear-Reservación', 'ReservacionController@postCrearReservacion');



		//Buscar Reservación:
		Route::get('Buscar-Reservación', [
						'uses' => 'ReservacionController@buscarReservacion',
						'as' =>'buscarReservacion'
		]);


		//Ver Reservación:
		Route::get('Ver-Reservación-{id}', [
						'uses' => 'ReservacionController@verReservacion',
						'as' =>'verReservacion'
		]);

		//Imprimir Reservación:
		Route::get('Imprimir-Reservación-{id}', [
						'uses' => 'ReservacionController@imprimirReservacion',
						'as' =>'imprimirReservacion'
		]);
		

		//Eliminar Post
		Route::post('Eliminar-Reservación', [
						'uses' => 'ReservacionController@eliminarReservación',
						'as' =>'eliminarReservación'
		]);




 });

Route::get('Recuperar-Clave', [
				'uses' => 'HomeController@getRecuperar',
				'as' =>'recuperar'
]);

Route::post('Recuperar-Clave', 'HomeController@postRecuperar');

Route::get('Acceso-Restringido', [
				'uses' => 'HomeController@denegado',
				'as' =>'denegado'
]);

// Authentication routes...
Route::get('/', [
				'uses' => 'Auth\AuthController@getLogin',
				'as' =>'login'
]);
Route::post('/', [
				'uses' => 'Auth\AuthController@postLogin',
				'as' =>'login'
]);
Route::get('Salir', [
				'uses' => 'Auth\AuthController@getLogout',
				'as' =>'logout'
]);
