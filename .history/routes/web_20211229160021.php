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

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('error', 'App\Http\Controllers\ErrorController@index');
Route::get('account', 'App\Http\Controllers\AccountController@index')
->name('aIndex');
Route::get('account/create', 'App\Http\Controllers\AccountController@create');
Route::post('account/store', 'App\Http\Controllers\AccountController@store');
Route::get('account/detail/{user_id}', 'App\Http\Controllers\AccountController@show');
Route::get('account/edit/{id}', 'App\Http\Controllers\AccountController@edit');
Route::post('account/update/{id}', 'App\Http\Controllers\AccountController@update');
Route::post('account/delete/{id}', 'App\Http\Controllers\AccountController@destory');

