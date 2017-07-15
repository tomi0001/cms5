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

Route::get('/login/{years?}/{month?}/{day?}/{action?}', 'Controller@login2');
Route::get('/',"Controller@login");
Route::post('login3','Controller@login3');
Route::get('error','Controller@error');
Route::get('logout','Controller@logout');
Route::get('succes','Controller@succes');
Route::get('/ajax/edit_description','Controller@ajax1');
Route::get('/ajax/add_description','Controller@ajax2');
Route::get('/ajax/load_description','Controller@ajax3');
Route::get('/ajax/delete_description','Controller@ajax4');
Route::get('/ajax/sum_difference','Controller@ajax5');
Route::get('/ajax/average','Controller@ajax6');
Route::get('/ajax/sum_equivalent','Controller@ajax7');
