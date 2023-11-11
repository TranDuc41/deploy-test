<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    Route::get('/create-room', [RoomController::class, 'store'])->name('edit-room.store');
    Route::get('/edit-room', [RoomController::class, 'create'])->name('room');
    Route::get('/edit-room/{id}', [RoomController::class, 'update'])->name('edit-room.update');

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
