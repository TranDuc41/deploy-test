<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
});
Route::get('/tables', function () {
    return view('tables');
});
Route::get('/billing', function () {
    return view('billing');
});
Route::get('/images', function () {
    return view('image');
});
Route::get('/users', function () {
    return view('users');
});
Route::get('/rooms', function () {
    return view('rooms');
});
Route::get('/edit-room', function () {
    return view('editRoom');
});
Route::get('/virtual-reality', function () {
    return view('virtual-reality');
});
Route::get('/rtl', function () {
    return view('rtl');
});
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/sign-in', function () {
    return view('sign-in');
});
Route::get('/sign-up', function () {
    return view('sign-up');
});