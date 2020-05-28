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

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => 'users'],  function (){
    Route::get('/', 'UserController@index');
    Route::get('delete/{id}', 'UserController@destroy');
    Route::get('edit/{id}', 'UserController@edit');
    Route::get('create', 'UserController@create');
    Route::post('save', 'UserController@save');
});

Route::group(['middleware' => 'auth', 'prefix' => 'sections'],  function (){
    Route::get('/', 'SectionsController@index');
    Route::get('delete/{id}', 'SectionsController@destroy');
    Route::get('edit/{id}', 'SectionsController@edit');
    Route::get('create', 'SectionsController@create');
    Route::post('save', 'SectionsController@save');
});

Route::get('/', function() {
    return redirect('/sections');
});
