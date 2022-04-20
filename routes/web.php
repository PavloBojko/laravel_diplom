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

Route::middleware(['auth'])->group(function ()
{
    Route::get('/', 'HomeController@users');
    Route::get('/edit/{id}', 'HomeController@edit');
    Route::get('/logout', 'LogicController@logout');
    
    Route::get('/security/{id}', 'HomeController@security');
    Route::get('/status/{id}', 'HomeController@status');
    Route::get('/media/{id}', 'HomeController@media');
    Route::get('/dell/{id}', 'DellController@dell');

});
Route::middleware(['auth', 'admin'])->group(function(){
    Route::get('/create_user', 'HomeController@create_user');
});

Route::get('/login', 'HomeController@login')->name('login');
Route::get('/register', 'HomeController@register');

Route::post('/register', 'RegisterController@register');
Route::post('/login', 'LoginController@login');
Route::post('/create_user', 'CreateUserController@create_user');
Route::post('/edit/{id}', 'EditUserController@edit');
Route::post('/security/{id}', 'UpdateUserController@security');
Route::post('/status/{id}', 'LogicController@status');
Route::post('/media/{id}', 'LogicController@media');




Route::get('/faker', 'LogicController@faker');

