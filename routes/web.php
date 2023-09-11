<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {return redirect('/diary/list');});
Route::get('/diary/list','App\Http\Controllers\diary\ListController@list');
Route::get('/diary/newPost','App\Http\Controllers\diary\NewPostController@newPost');
Route::post('/diary/newPost','App\Http\Controllers\diary\NewPostController@register');
Route::get('/diary/delete/{id}', 'App\Http\Controllers\diary\ListController@delete')->name('diary.delete');
Route::get('/diary/edit/{id}', 'App\Http\Controllers\diary\ListController@edit')->name('diary.edit');
Route::post('/diary/update/{id}', 'App\Http\Controllers\diary\ListController@update')->name('diary.update');
Route::get('/diary/trash','App\Http\Controllers\diary\TrashController@trash');
Route::get('/diary/destroy/{id}', 'App\Http\Controllers\diary\TrashController@destroy')->name('trash.destroy');
Route::get('/diary/restoration/{id}', 'App\Http\Controllers\diary\TrashController@restoration')->name('trash.restoration');