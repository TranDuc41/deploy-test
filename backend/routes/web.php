<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\AmenitiesController;
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

//Room type
Route::get('/room-type', [RoomTypeController::class, 'index'])->name('room-types');
Route::post('/room-type', [RoomTypeController::class, 'create'])->name('room-types');

Route::get('/room-type/{rty_id}', [RoomTypeController::class, 'show'])->name('room-type');
Route::put('/room-type/{rty_id}', [RoomTypeController::class, 'update'])->name('room-type');
Route::delete('/room-type/{rty_id}', [RoomTypeController::class, 'delete'])->name('room-type');

//Sale
Route::get('/sale', [SaleController::class, 'index'])->name('sales');
Route::post('/sale', [SaleController::class, 'create'])->name('sale.create');
Route::get('/sale/{sale_id}', [SaleController::class, 'show'])->name('sale.show');
Route::put('/sale/{sale_id}', [SaleController::class, 'update'])->name('sale.update');
Route::delete('/sale/{sale_id}', [SaleController::class, 'delete'])->name('sale.delete');

//Amenities
Route::get('/amenities', [AmenitiesController::class, 'index'])->name('amenities');
Route::post('/amenities', [AmenitiesController::class, 'create'])->name('amenities.create');
Route::get('/amenities/{amenities_id}', [AmenitiesController::class, 'show'])->name('amenities.update');
Route::put('/amenities/{amenities_id}', [AmenitiesController::class, 'update'])->name('amenities.update');
Route::delete('/amenities/{amenities_id}', [AmenitiesController::class, 'delete'])->name('amenities.delete');