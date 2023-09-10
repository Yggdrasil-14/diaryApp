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

Route::get('/', function () {
    return view('welcome');
});
Route::get('diaryListDisplay','App\Http\Controllers\DiaryListController@diaryListDisplay');
Route::get('newPostDisplay','App\Http\Controllers\NewPostController@newPostDisplay');
Route::post('newPost','App\Http\Controllers\NewPostController@register');
Route::get('/delete/{id}', 'App\Http\Controllers\DiaryListController@delete')->name('diary.delete');
Route::get('/edit/{id}', 'App\Http\Controllers\DiaryListController@edit')->name('diary.edit');
Route::post('/update/{id}', 'App\Http\Controllers\DiaryListController@update')->name('diary.update');
Route::get('trashListDisplay','App\Http\Controllers\TrashListController@trashListDisplay');
Route::get('/destroy/{id}', 'App\Http\Controllers\TrashListController@destroy')->name('trash.destroy');
Route::get('/restoration/{id}', 'App\Http\Controllers\TrashListController@restoration')->name('trash.restoration');