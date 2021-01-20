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

Auth::routes(['register' => false]);
Route::get('/logout', 'Auth\LoginController@logout');
// Route::post('/login', function(){
//   print_r('entered');exit;
// });

Route::get('/', function(){
  return redirect('/dashboard');
});

// Dashboard
Route::get('/dashboard', 'OrderController@statistics');
// Assign order routes
Route::get('/assign_order', 'OrderController@assign');

Route::post('/fetchdata', 'OrderController@fetchdata');

Route::post('/set_interval', 'OrderController@setInterval');

Route::post('/edit_order', 'OrderController@editOrder');

Route::get('/orders', 'OrderController@getOrders');

// User management routes
Route::get('/users', 'UserController@getUsers');

Route::post('/create_user', 'UserController@create');

Route::post('/edit_user', 'UserController@edit');

Route::get('/delete_user', 'UserController@delete');

// Picker management routes
Route::get('/pickers', 'PickerController@getPickers');

Route::post('/create_picker', 'Pickerontroller@create');

Route::post('/edit_picker', 'PickerController@edit');

Route::get('/delete_picker', 'PickerController@delete');