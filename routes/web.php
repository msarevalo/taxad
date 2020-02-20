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

Route::get('/', 'Home@inicio')->name('home');

Route::post('/', 'PagesController@cambiar')->name('cambiar');

Route::get('/login', 'PagesController@login')->name('login');

Route::get('/registro', 'PagesController@registro')->name('registro');


/*********************************************
 *********************************************
 * Creacion y administracion de conductores***
 *********************************************
 *********************************************/


Route::get('/conductores', 'PagesController@conductor')->name('conductor');

Route::get('/conductores/detalle/{id?}', 'PagesController@detalle')->name('conductor.detalle');

Route::get('/conductores/edita/{id?}', 'PagesController@editacon')->name('conductor.edita');

Route::get('/conductores/create', 'PagesController@creacond')->name('conductor.crea');

Route::post('/conductores', 'PagesController@crearcond')->name('conductor.crear');

Route::put('/conductores/{id}', 'PagesController@editarcond')->name('conductor.editar');

Route::get('/conductores/{id}', 'PagesController@permitir')->name('conductor.permitir');

Route::delete('/conductores/{id}', 'PagesController@negar')->name('conductor.negar');


/*************************************************
 *************************************************
 * Creacion y administracion de Administradores***
 *************************************************
 *************************************************/

Route::get('/administradores', 'PagesController@administrador')->name('admin');

Route::get('/administradores/create', 'PagesController@creaadmin')->name('admin.crea');

Route::post('/administradores', 'PagesController@crearadmin')->name('admin.crear');

Route::get('/administradores/detalle/{id?}', 'PagesController@detalleadmin')->name('admin.detalle');

Route::get('/administradores/edita/{id?}', 'PagesController@editaadmin')->name('admin.edita');

Route::put('/administradores/{id}', 'PagesController@editaradmin')->name('admin.editar');


/*********************************************
 *********************************************
 * Creacion y administracion de taxis*********
 *********************************************
 *********************************************/

Route::get('/taxis', 'PagesController@taxi')->name('taxis');

Route::get('/taxis/detalle/{id?}', 'PagesController@detalletax')->name('taxi.detalle');

Route::get('/taxis/create', 'PagesController@creatax')->name('taxi.crea');

Route::get('/taxis/asigna/{id}', 'PagesController@asignatax')->name('taxi.asigna');

Route::post('/taxis', 'PagesController@creartax')->name('taxi.crear');

Route::get('/taxis/edita/{id?}', 'PagesController@editatax')->name('taxi.edita');

Route::put('/taxis/{id}', 'PagesController@editartax')->name('taxi.editar');

Route::post('/taxis/asigna/{id}', 'PagesController@asignartax')->name('taxi.asignar');

Route::get('/taxis/documento/{id}', 'PagesController@soat')->name('taxi.soat');

Route::post('/taxis/documento/{id?}', 'PagesController@soatcargar')->name('taxi.soatcargar');

Route::get('/taxis/reporta/{id}', 'PagesController@reporta')->name('taxi.reporta');

Route::put('/taxis/reporta/{id}', 'PagesController@reportar')->name('taxi.reportar');

Route::get('/taxis/gastos/{id}/{w}', 'PagesController@gastos')->name('taxi.gasto');

/**********************************************
 **********************************************
 * Creacion y administracion de marcas taxis***
 **********************************************
 **********************************************/

Route::get('/marcas', 'PagesController@marca')->name('marcas');

Route::get('/marcas/create', 'PagesController@creamarca')->name('marca.crea');

Route::post('/marcas', 'PagesController@crearmarca')->name('marca.crear');

Route::get('/marcas/detalle/{id?}', 'PagesController@detallemarca')->name('marca.detalle');

Route::get('/marcas/edita/{id?}', 'PagesController@editamarca')->name('marca.edita');

Route::put('/marcas/{id?}', 'PagesController@editarmarca')->name('marca.editar');


/**********************************************
 **********************************************
 * Creacion y administracion de autenticacion**
 **********************************************
 **********************************************/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**********************************************
 **********************************************
 ******************Calendario******************
 **********************************************
 **********************************************/

//Route::get('/calendar', 'PagesController@Calendario')->name('calendario');

Route::get('calendario/form','PagesController@form');
Route::post('evento/create','PagesController@create');
Route::get('calendario/details/{id}','PagesController@details');
Route::get('calendario','PagesController@index')->name('calendario');
Route::get('calendario/{month}','PagesController@index_month');
Route::post('evento/calendario','PagesController@calendario');
Route::get('calendario/delete/{id}','PagesController@deleteEvent')->name('calendario.delete');
Route::get('calendario/edit/{id}','PagesController@editaCalendario')->name('calendario.edita');
Route::put('/calendario/{id}', 'PagesController@editarCalendario')->name('calendario.editar');

/*************************************************
 *************************************************
 * Creacion y administracion de Socios************
 *************************************************
 *************************************************/

Route::get('/socios', 'PagesController@socio')->name('socios');

/*************************************************
 *************************************************
 * Creacion y administracion de Tarifas***********
 *************************************************
 *************************************************/

Route::get('/tarifa', 'PagesController@tarifa')->name('tarifa');

Route::get('/tarifa/edita', 'PagesController@editaTarifa')->name('tarifa.edita');

Route::put('/tarifa', 'PagesController@editarTarifa')->name('tarifa.editar');