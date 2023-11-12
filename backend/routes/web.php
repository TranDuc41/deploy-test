<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelsController;
use App\Http\Controllers\InfoController;


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

























































Route::get('/hotels', [HotelsController::class, 'index'])->name('hotels');

Route::post('/hotels', [HotelsController::class, 'store'])->name('hotelData');

Route::get('/hotels', [HotelsController::class, 'index'])->name('hotels.index');
Route::delete('/hotels/{hotel_id}', [HotelsController::class, 'destroy'])->name('hotel.destroy');

Route::get('/hotels/{hotel_id}/edit', [HotelsController::class, 'edit'])->name('hotels.edit');
Route::put('/hotels/{hotel_id}', [HotelsController::class, 'update'])->name('hotels.update');


Route::get('/info', function () {
    return view('info');
});


Route::resource('info', InfoController::class);
// Route::get('/info', [InfoController::class, 'index'])->name('info.index');
// Route::post('/info', [InfoController::class, 'store'])->name('info.store');
// Route::put('/info/{id}', [InfoController::class, 'update'])->name('info.update');
// Route::delete('/info/{id}', [InfoController::class, 'destroy'])->name('info.destroy');

// Route::get('/infos', [InfoController::class, 'index'])->name('info.index');
// Route::post('/infos', [InfoController::class, 'store'])->name('info.store');
// Route::put('/infos/{info}', [InfoController::class, 'update'])->name('info.update');
// Route::delete('/infos/{info}', [InfoController::class, 'destroy'])->name('info.destroy');


// Route::get('/info', [InfoController::class, 'index'])->name('info.index');
// Route::post('/info', [InfoController::class, 'store'])->name('info.store');
// Route::put('/info/{id}', [InfoController::class, 'update'])->name('info.update');
// Route::delete('/info/{id}', [InfoController::class, 'destroy'])->name('info.destroy');

Route::post('/info', 'InfoController@store')->name('info.store');
