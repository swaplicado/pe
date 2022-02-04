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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    /* Indicadores */
    Route::get('indicator', 'IndicatorController@index')->name('indicador');
    Route::get('indicator/create', 'IndicatorController@create')->name('crear_indicador');
    Route::post('indicator', 'IndicatorController@store')->name('guardar_indicador');
    Route::get('indicator/{id}/edit', 'IndicatorController@edit')->name('editar_indicador');
    Route::put('indicator/{id}', 'IndicatorController@update')->name('actualizar_indicador');
    Route::delete('indicator/{id}', 'IndicatorController@destroy')->name('eliminar_indicador');
    Route::get('indicator/{id}/score', 'IndicatorController@score_indicator')->name('calificar_indicador');
    Route::put('indicator/score/{id}', 'IndicatorController@guardar_score')->name('colocar_calificacion');
    Route::post('indicator/guardar', 'IndicatorController@send_to_aprove')->name('enviar_aprobacion');
    Route::post('indicator/calificar','IndicatorController@sendscore_to_aprove')->name('enviar_calificaciones');
    Route::get('indicator/list_indicators_to_aprove', 'IndicatorController@list_indicators_to_aprove')->name('lista_indicadores_por_aprobar');
    Route::get('indicator/list_score_to_aprove', 'IndicatorController@list_score_to_aprove')->name('lista_calificacion_por_aprobar');
    Route::get('indicator/indicator_list', 'IndicatorController@indicator_list')->name('lista_indicadores');
    Route::post('indicator/aprove', 'IndicatorController@aprove_indicator')->name('aprobar');
    Route::post('indicator/refuse', 'IndicatorController@refuse_indicator')->name('rechazar');
    Route::post('indicator/scoreaprove', 'IndicatorController@aprove_score')->name('calificacion_aprobar');
    Route::post('indicator/scorerefuse', 'IndicatorController@refuse_score')->name('calificacion_rechazar');
});
