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

Route::post('/media', 'MediaController@store')->name('media.store');
Route::post('post/{post}/{media}/delete', 'MediaController@delete')->name('media.store');

Route::get('/user/{username}/edit-profile', 'UserController@editProfile')->name('user.editProfile');
Route::put('/user/{user}/update-profile', 'UserController@updateProfile')->name('user.updateProfile');
Route::get('/user/{username}/edit-password', 'UserController@editPassword')->name('user.editPassword');
Route::put('/user/{user}/update-password', 'UserController@updatePassword')->name('user.updatePassword');
Route::get('/user/{username}', 'UserController@profile')->name('user.profile');

Route::get('/sign-in', 'UserController@getSignin')->name('user.signin');
Route::post('/sign-in', 'UserController@signin')->name('user.signin');
Route::get('/sign-up', 'UserController@getSignup')->name('user.signup');
Route::post('/sign-up', 'UserController@signup')->name('user.signup');
Route::post('/sign-out', 'UserController@signout')->name('user.signout');

Route::view('post/create', 'post.create')->name('post.create')
    ->middleware('auth');
Route::post('post', 'PostController@store')->name('post.store');
Route::get('/post/{post}/edit', 'PostController@edit')->name('post.edit');
Route::put('post/{post}', 'PostController@update')->name('post.update');
Route::delete('post/{post}', 'PostController@delete')->name('post.delete');
Route::get('post/{slug}', 'PostController@show')->name('post.show');

Route::get('admin/post/{post}/edit', 'AdminController@editPost')->name('admin.editPost');
Route::put('admin/post/{post}', 'AdminController@updatePost')->name('admin.updatePost');
Route::delete('admin/post/{post}', 'AdminController@deletePost')->name('admin.deletePost');
Route::get('admin/posts', 'AdminController@indexPost')->name('admin.indexPost');

Route::get('/search', 'SearchController@update')->name('search');

Route::view('/', 'homepage')->name('homepage');

Route::view('/test', 'test')->name('test');
Route::post('/test', 'AdminController@test')->name('test');
