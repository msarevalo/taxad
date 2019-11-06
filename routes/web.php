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

/**********************************************
 **********************************************
 * Creacion y administracion de marcas taxis***
 **********************************************
 **********************************************/

Route::get('taxis/marcas', 'PagesController@marca')->name('marcas');

Route::get('/taxis/marcas/create', 'PagesController@creamarca')->name('marca.crea');

Route::post('/taxis/marcas', 'PagesController@crearmarca')->name('marca.crear');

Route::get('/taxis/marcas/detalle/{id?}', 'PagesController@detallemarca')->name('marca.detalle');

Route::get('/taxis/marcas/edita/{id?}', 'PagesController@editamarca')->name('marca.edita');

Route::put('/taxis/marcas/{id}', 'PagesController@editarmarca')->name('marca.editar');


/**********************************************
 **********************************************
 * Creacion y administracion de autenticacion**
 **********************************************
 **********************************************/

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
