<?php
// Route::get('URL', 'controller@method')->name('このURLを参照できるようにする名前');
Route::get('/folders/{id}/tasks', 'TaskController@index')->name('tasks.index');
