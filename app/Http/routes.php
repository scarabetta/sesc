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

Route::get('/', function(){ return redirect('/dashboard'); });

// REST SADE PARA PRUEBAS
Route::post('/esb/servicios/sesc/cerrar_reunion', 'RestExpedienteController@cerrarActa');

/* REST API */
Route::group(array('prefix' => 'api'), function(){
    Route::post('/expedientes', 'RestExpedienteController@addExpediente');
    Route::post('/expedientes/{nroexpediente}/documentos', 'RestExpedienteController@addDocumento');
    Route::post('/expedientes/{nroexpediente}/rechazos', 'RestExpedienteController@rechazarExpediente');
});

Route::group(['middleware' => ['auth']], function () {
  
    Route::get('/', function(){
        if(Auth::user()->rol->nombre == 'administrador'){
            return redirect('/users/');
        }else{
            return redirect('/expedientes/');
        }
    }); // Reemplazar por ExpedienteController@index
    Route::get('dashboard', function(){
        if(Auth::user()->rol->nombre == 'administrador'){
            return redirect('/users/');
        }else{
            return redirect('/expedientes/');
        }
    }); 
    // Fix provisorio para redirect de primera sesion
    Route::get('home', function(){
        if(Auth::user()->rol->nombre == 'administrador'){
            return redirect('/users/');
        }else{
            return redirect('/expedientes/');
        }
    }); 
    
    Route::group(['prefix' => 'users', 'middleware' => ['user_is_admin']], function(){
        Route::get('/', 'UserController@index');
        Route::get('/dashboard', 'UserController@index');
        Route::get('add', 'UserController@add');
        Route::get('edit/{user}', 'UserController@edit');
        Route::get('delete/{user}', 'UserController@delete');
        Route::post('update/{user}', 'UserController@update');
        Route::post('save', 'UserController@save');
    });

    /* EXPEDIENTES */
    Route::group(['prefix' => 'expedientes', 'middleware' => ['user_is_dir_or_coord']], function(){
        Route::get('/', 'ExpedientesController@list_all');
        Route::get('/archivo', 'ExpedientesController@list_archivadas');
        Route::get('/view/{id}', 'ExpedientesController@view');
        Route::get('/documento/{id}', 'ExpedientesController@view_documento');
        Route::get('/archivado/{id}', 'ExpedientesController@view_archived');
        Route::post('/votar/{id}', 'VotosController@vote');
    });
    
    /* PRESUPUESTOS */
    Route::group(['prefix' => 'montos', 'middleware' => ['user_is_dir_or_coord']], function(){
        Route::get('/', 'PresupuestosController@list_all');
        Route::get('/add', 'PresupuestosController@add');
        Route::post('/save', 'PresupuestosController@save');
        
    });

    /* ACTAS/REUNIONES */
    Route::group(['prefix' => 'reunion', 'middleware' => ['user_is_coordinador']], function(){
        Route::post('/crear', 'ActasController@create');
        Route::get('/cancelar/{id}', 'ActasController@cancelar');
        Route::post('/save', 'ActasController@save');
        Route::post('/save_gedo', 'ActasController@save_gedo');
        Route::post('/terminar', 'ActasController@terminar');
        Route::get('/ver/{id}', 'ActasController@view');
        Route::get('/print/{id}', 'ActasController@prnt');
        Route::get('/print_notif/{acta}/{expediente}', 'ActasController@prnt_notification');
        Route::get('/votos_excel/{id}', 'ActasController@votos_excel');
        Route::get('/close/{id}', 'ActasController@close');
        
    });    
});

Route::group(['prefix' => 'system'], function(){

    Route::get('/reset', function()
    {
        Artisan::call('clear-compiled');
        system('composer dump-autoload -o');
        Artisan::call('optimize');
        // Roll back all migrations and migrate them again
        //Artisan::call('cache:clear');
        //Artisan::call('config:cache');
        //Artisan::call('config:clear');
        //Artisan::call('migrate:refresh');
        // Fill tables with seeds
        //Artisan::call('db:seed');
    });

    Route::get('/migrate_refresh', function()
    {
        Artisan::call('migrate:refresh');
    });

    Route::get('/migrate', function()
    {
        Artisan::call('migrate');
    });

    Route::get('/seed', function()
    {
        Artisan::call('db:seed');
    });

}); 

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
