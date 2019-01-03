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
    return view('login');
 });



// route to show the login form
Route::get('login', array('uses' => 'LoginController@showLogin'));

// route to process the form
Route::post('login', array('uses' => 'LoginController@doLogin'));

//route to logout
Route::get('logout', array('uses' => 'LoginController@doLogout'));

// route to show the admin form
Route::get('admininfo', array('uses' => 'AdminController@GetAdminInfo'));



Route::group(['middleware' => 'prevent-back-history'],function(){
  //\Auth::routes();
  Route::get('home', 'UserController@showHomePage')->name('home');
  Route::post('home', 'UserController@updateData')->name('home');
  Route::get('dashboard', 'AdminController@showHomePage')->name('dashboard');
  Route::post('dashboard', 'AdminController@store')->name('dashboard');
  Route::delete('dashboard', 'AdminController@delete')->name('dashboard');
  Route::put('dashboard', 'AdminController@update')->name('dashboard');
});



//Route::post('chat', array('uses' => 'ChatController@store'));
Route::get('conversations', array('uses' => 'ChatController@show'));
Route::get('contacts', array('uses' => 'ChatController@Contacts'));

Route::get('message', array('uses' => 'MessageController@show'));
Route::post('message', array('uses' => 'MessageController@store'));