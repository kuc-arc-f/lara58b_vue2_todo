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

Route::group(['middleware' => 'api'], function() {
    /**************************************
     *
     **************************************/    
    Route::get('tasks',  function() {
        $tasks = App\Task::orderBy('id', 'desc')->get();
        return $tasks;
    });
    /**************************************
     *
     **************************************/    
    Route::get('tasks/show/{id}',  function($id) {
        $task = App\Task::find($id);
        return $task;
    });
    /**************************************
     *
     **************************************/
    Route::get('tasks/edit/{id}',  function($id) {
        $task = App\Task::find($id);
        return $task;
    });
    /**************************************
     *
     **************************************/    
    Route::post('tasks/add',  function() {
        $task = new App\Task();
        $task->title   = request('title');
        $task->content = request('content');
        $task->save();
        return ['title' => request('title'),'content' => request('content')];
    });
    /**************************************
     *
     **************************************/    
    Route::post('tasks/update/{id}',  function($id) {
        $task = App\Task::find($id);
        $task->title   = request('title');
        $task->content = request('content');
        $task->save();
        return ['title' => request('title'),'content' => request('content')];
    });
    /**************************************
     *
     **************************************/
    Route::get('test',  function() {
        return "#test";
    });


    //
//    Route::resource('todos', 'ToDosController', ['only'=>['index', 'store', 'show', 'update', 'destroy']]);
    Route::resource('todos', 'ApiTodosController');

});