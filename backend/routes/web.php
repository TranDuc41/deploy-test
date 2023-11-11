<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::post('/create-room', [RoomController::class, 'store'])->name('edit-room.store');
    Route::get('/edit-room', [RoomController::class, 'create'])->name('room');
    Route::get('/edit-room/{slug}', [RoomController::class, 'edit'])->name('edit-room.edit');
    Route::post('/edit-room/{slug}', [RoomController::class, 'update'])->name('edit-room.update');

    // IMAGES
    Route::get('/images', [ImageController::class, 'index'])->name('images.index');
    Route::post('/upload', [ImageController::class, 'store'])->name('upload.store');
    Route::delete('/image/{id}', [ImageController::class, 'destroy'])->name('images.destroy');

    // USERS
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);

    // Route::post('/items', [UserController::class, 'store']);
    // Route::get('/items/{id}/edit', [UserController::class, 'edit']);
    // Route::put('/items/{id}', [UserController::class, 'update']);
    // Route::delete('/items/{id}', [UserController::class, 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Route::get('/billing', function () {
//     return view('billing');
// });
// Route::get('/virtual-reality', function () {
//     return view('virtual-reality');
// });
// Route::get('/rtl', function () {
//     return view('rtl');
// });
// Route::get('/profile', function () {
//     return view('profile');
// });
// Route::get('/sign-in', function () {
//     return view('sign-in');
// });
// Route::get('/sign-up', function () {
//     return view('sign-up');
// });

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
