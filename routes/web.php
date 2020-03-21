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

Auth::routes();

Route::get('/home', 'BusinessController@all')->name('home');
Route::get('/email/verify', 'Auth\RegisterController@verifyEmail');
Route::get('business/create', 'BusinessController@create');
Route::get('business/my_businesses', 'BusinessController@my_businesses');
Route::post('business/store', 'BusinessController@store');
Route::get('business/edit/{id}', 'BusinessController@edit');
Route::post('business/update/{id}', 'BusinessController@update');
Route::get('business/delete/{id}', 'BusinessController@delete');
Route::get('business/reviews/{id}', 'ReviewController@get');
Route::get('business/all', 'BusinessController@all');
Route::get('business/dashboard', 'BusinessController@dashboard');
Route::post('review/store/{business_id}', 'ReviewController@store');
Route::get('review/toggle_status/{review_id}', 'ReviewController@toggle_status');
Route::post('comment/add', 'CommentController@store');



