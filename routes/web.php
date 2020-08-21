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

// 認証を求めるページをグループ化しミドルウェアを適用する
Route::group(['middleware' => 'auth'], function() {
    // Route::get('URL', 'controller@method')->name('このURLを参照できるようにする名前');
    Route::get('/', 'HomeController@index')->name('home');
    
    Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');
    
    Route::get('/folders/create', 'FolderController@showCreateForm')->name('folders.create');
    Route::post('/folders/create', 'FolderController@create');
    
    Route::get('/folders/{id}/tasks/create', 'TaskController@showCreateForm')->name('tasks.create');
    Route::post('/folders/{id}/tasks/create', 'TaskController@create');
    
    Route::get('/folders/{id}/tasks/{task_id}/edit', 'TaskController@showEditForm')->name('tasks.edit');
    Route::post('/folders/{id}/tasks/{task_id}/edit', 'TaskController@edit');
});

// 会員登録・ログイン・ログアウト・パスワード再設定のルーティング定義
Auth::routes();

