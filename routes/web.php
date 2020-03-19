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
    return view('welcome');
});
//tasks
//Route::get('/tasks/data1', 'TasksController@data1');
Route::resource('tasks', 'TasksController');
//
Route::resource('books', 'BooksController');
Route::resource('members', 'MembersController');
Route::resource('depts', 'DeptsController');
//
Route::post('/todos/delete', 'TodosController@delete');
Route::resource('todos', 'TodosController');

//
Auth::routes();
//
Route::get('/home', 'HomeController@index')->name('home');

/**************************************
 * API
 **************************************/
Route::prefix('api')->group(function(){
//    Route::get('/apitodos/test1', 'ApiTodosController@test1');
    Route::post('/apitodos/get_item', 'ApiTodosController@get_item');
    Route::post('/apitodos/search', 'ApiTodosController@search');
    Route::post('/apitodos/create_todo', 'ApiTodosController@create_todo');
    Route::resource('apitodos', 'ApiTodosController' );
    //tasks
    Route::post('/apitasks/create_task', 'ApiTasksController@create_task');
    Route::post('/apitasks/update_post', 'ApiTasksController@update_post');
    Route::post('/apitasks/delete_task', 'ApiTasksController@delete_task');
    Route::get('/apitasks/get_tasks', 'ApiTasksController@get_tasks');
    Route::post('/apitasks/get_item', 'ApiTasksController@get_item');
    //
//    Route::resource('apitasks', 'ApiTasksController' );


});
