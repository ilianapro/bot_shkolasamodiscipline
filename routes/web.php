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

use App\Http\Controllers\frontpageController;

Route::get('/testik','frontpageController@testik');

Route::get('/', 'frontpageController@index');
Route::get('/date/{date}', 'frontpageController@indexdate');

Route::match(['get', 'post'], '/botman', 'BotManController@handle');
//Route::get('/botman/tinker', 'BotManController@tinker');

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
  ]);

Route::get('/admin', 'AdminController@index')->name('admin');

/* Manage Groups */
Route::resource('/admin/groups', 'GroupController');

/* Reporters */
Route::resource('/admin/reporters', 'ReportersController');

/* P A R T I C I P A N T S */
Route::get('/admin/participantsActive', 'participantsController@participantsActive')->name('participants.active');
Route::get('/admin/participantsInactive', 'participantsController@participantsInactive')->name('participants.inactive');
Route::get('/admin/participants/{participant}/edit', 'participantsController@edit')->name('participants.edit');
Route::patch('/admin/participants/{participant}', 'participantsController@update')->name('participants.update');

/* Motivators */
Route::get('/admin/motivators', 'MotivatorsController@index')->name('motivators.index');
Route::get('/admin/motivators/{motivation}/edit', 'MotivatorsController@edit')->name('motivators.edit');
Route::patch('/admin/motivators/{motivator}', 'MotivatorsController@update')->name('motivators.update');
Route::delete('/admin/motivators/{motivator}', 'MotivatorsController@destroy')->name('motivators.destroy');

/* Helper */
Route::resource('/admin/helper', 'HelpersController');


