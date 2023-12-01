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
    return view('index');
});
Route::get('/forgot', function () {
    return view('accounts.forgot');
});
Route::get('/signin', function () {
    return view('accounts.signin');
});
Route::get('/signup', function () {
    return view('accounts.signup');
});
Route::get('/users', function () {
    return view('accounts.users');
});
Route::get('/edit-user', function () {
    return view('accounts.edit-user');
});


Route::get('/404', function () {
    return view('404');
});
Route::get('/add-item', function () {
    return view('add-item');
});
Route::get('/catalog', function () {
    return view('catalog');
});
Route::get('/comments', function () {
    return view('comments');
});
Route::get('/reviews', function () {
    return view('reviews');
});