<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::get('/','PlayersController@index');
//Route::get('/index','TasksController@index');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
        // いままで定義してきたルート
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/tasks/index', 'TaskController@index')->name('tasks.index');

    Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
    Route::post('/folders/create', 'FolderController@create');

    Route::get('/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
    Route::post('/tasks/create', 'TaskController@create');

    Route::get('/tasks/edit', 'TaskController@showEditForm')->name('tasks.edit');
    Route::post('/tasks/edit', 'TaskController@edit');
    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});