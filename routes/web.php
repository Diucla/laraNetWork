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

Route::get('/add', function () {

    return \App\User::find(1)->add_friend(3);

});


Route::get('/accept', function () {

    return \App\User::find(3)->accept_friend(1);

});

Route::get('/friends', function () {

    return \App\User::find(3)->friends();

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function (){

    Route::get('/profile/{slug}', [

        'uses' => 'ProfilesController@index',

        'as' => 'profile'

    ]);

    Route::get('/profile/edit/profile', [

        'uses' => 'ProfilesController@edit',

        'as' => 'profile.edit'

    ]);

    Route::post('/profile/update/profile', [

        'uses' => 'ProfilesController@update',

        'as' => 'profile.update'

    ]);


});