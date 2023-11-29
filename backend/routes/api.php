<?php

use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\InfoController;
use App\Http\Controllers\Api\ReservationsController;
use App\Http\Controllers\Api\RestaurantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\RoomTypeController;
use App\Http\Controllers\Api\SpaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/rooms', [RoomController::class, 'index']);
Route::get('/room-types', [RoomTypeController::class, 'index']);
Route::get('/room-types-group', [RoomTypeController::class, 'getRoomType']);

Route::get('/restaurants', [RestaurantController::class, 'index']);
Route::post('/restaurants', [RestaurantController::class, 'create']);

Route::get('/faqs', [FaqController::class, 'index']);

Route::get('/spa', [SpaController::class, 'index']);
Route::post('/spa', [SpaController::class, 'create']);

//lan anh
Route::get('rooms/{slug}', [RoomController::class, 'show']);
Route::get('reservations/{adults}/{children}/{slug_rty}', [ReservationsController::class, 'index']);
Route::get('gallery', [GalleryController::class, 'index']);
//Tri
Route::get('/info', [InfoController::class, 'index']);

Route::get('room-type/{sty_id}', [RoomController::class, 'showRoomByRoomType']);
