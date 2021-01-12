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

/*
Route::get('/{any?}', function () {
    return view('welcome');
})->where('any','^(?!api).*$');
*/

Route::resource('hobbies', 'HobbiesController');

Route::get('/', function () {
    return view('welcome');
});
Route::get('/getHobbies','HobbiesController@getHobbies');
Route::get('/getHobby/{id}','HobbiesController@getHobby');
Route::get('/searchHobby/{term}','HobbiesController@searchHobby');
Route::get('/destroy/{id}', 'HobbiesController@destroy');
Route::get('/update/{id}', 'HobbiesController@update');
Route::post('/store', 'HobbiesController@store');
Route::post('/store2/{fn}/{ln}/{h}/{t}', 'HobbiesController@store2');