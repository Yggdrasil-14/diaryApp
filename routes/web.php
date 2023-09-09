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
Route::post('/delete{id}', 'App\Http\Controllers\DiaryListController@delete')->name('diary.delete');