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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
});

require __DIR__.'/auth.php';

Route::get('error', 'App\Http\Controllers\ErrorController@index');
Route::get('account', 'App\Http\Controllers\AccountController@index');
Route::get('account/register', 'App\Http\Controllers\AccountController@create')->name();
Route::post('account/store', 'App\Http\Controllers\AccountController@store');
Route::get('account/detail/{id}', 'App\Http\Controllers\AccountController@show');


