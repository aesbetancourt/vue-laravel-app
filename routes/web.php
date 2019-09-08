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




Auth::routes();

// Route::group(['middleware' => 'auth'], function () {
//     Route::get('/files/{type}/{id?}', 'FileEntriesController@index');

// });

Route::get('files/{path_file}/{file}', function($path_file, $file) {
    $path = storage_path().'/files/uploads/'.$path_file.'/'.$file;
    if(file_exists($path)) {
        return Response::download($path);
    }
});


Route::get('files/create', 'FileEntriesController@create');
Route::get('fil', 'FileEntriesController@getFiles');
Route::get('id-user', 'FileEntriesController@getIdUse');
Route::post('/delete/{id}/{path}', 'FileEntriesController@destroy');
Route::post('files/upload-file', 'FileEntriesController@uploadFil');



Route::get('/home', 'HomeController@index')->name('home');

Route::get('{path}','HomeController@index')->where('path', '([A-z\d-\/_.]+)?');





    