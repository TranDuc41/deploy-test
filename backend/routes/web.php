<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\SpaController;
use App\Http\Controllers\BookinsRestaurantSpaController;
use App\Http\Controllers\FaqController;

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
    Route::get('/billing', function () {
        return view('billing');
    });

    //ROOMS
    Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::post('/create-room', [RoomController::class, 'store'])->name('edit-room.store');
    Route::get('/edit-room', [RoomController::class, 'create'])->name('edit-room.create');
    Route::get('/edit-room/{slug}', [RoomController::class, 'edit'])->name('edit-room.edit');
    Route::delete('/edit-room/{slug}', [RoomController::class, 'destroy'])->name('edit-room.destroy');
    Route::post('/edit-room/{id}', [RoomController::class, 'update'])->name('edit-room.update');

    // IMAGES
    Route::get('/images', [ImageController::class, 'index'])->name('images.index');
    Route::post('/upload', [ImageController::class, 'store'])->name('upload.store');
    Route::delete('/image/{id}', [ImageController::class, 'destroy'])->name('images.destroy');

    // USERS
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::delete('/users/{id}', [UserController::class, 'softDelete']);
    Route::get('/users/create', [UserController::class, 'create']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);

    // Route::post('/items', [UserController::class, 'store']);
    // Route::get('/items/{id}/edit', [UserController::class, 'edit']);
    // Route::put('/items/{id}', [UserController::class, 'update']);
    // Route::delete('/items/{id}', [UserController::class, 'destroy']);

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
    Route::put('/sale/{sale_id}', [SaleController::class, 'update']);
    Route::delete('/sale/{sale_id}', [SaleController::class, 'delete'])->name('sale.delete');

    //Amenities
    Route::get('/amenities', [AmenitiesController::class, 'index'])->name('amenities');
    Route::post('/amenities', [AmenitiesController::class, 'create'])->name('amenities.create');
    Route::get('/amenities/{amenities_id}', [AmenitiesController::class, 'show'])->name('amenities.update');
    Route::put('/amenities/{amenities_id}', [AmenitiesController::class, 'update'])->name('amenities.update');
    Route::delete('/amenities/{amenities_id}', [AmenitiesController::class, 'delete'])->name('amenities.delete');

    //Restaurant
    Route::get('/restaurant', [RestaurantController::class, 'index'])->name('restaurant');
    Route::post('/restaurant', [RestaurantController::class, 'create'])->name('restaurant');
    Route::get('/restaurant/{slug}', [RestaurantController::class, 'show'])->name('restaurant.show');
    Route::put('/restaurant/{slug}', [RestaurantController::class, 'update'])->name('restaurant.update');
    Route::delete('/restaurant/{slug}', [RestaurantController::class, 'destroy'])->name('restaurant.destroy');

    //Spa
    Route::get('/spa', [SpaController::class, 'index'])->name('spa');
    Route::post('/spa', [SpaController::class, 'create'])->name('spa');
    Route::get('/spa/{slug}', [SpaController::class, 'show'])->name('spa.show');
    Route::put('/spa/{slug}', [SpaController::class, 'update'])->name('spa.update');
    Route::delete('/spa/{slug}', [SpaController::class, 'destroy'])->name('spa.destroy');

    Route::get('/spa-bookings', [SpaController::class, 'index1'])->name('spa.index1');
    Route::put('/spa-bookings/{id}', [SpaController::class, 'update1'])->name('spaBooking.update');
    Route::get('/spa-bookings/{id}', [SpaController::class, 'show1'])->name('spaBooking.show');
    Route::delete('/spa-bookings/{id}', [SpaController::class, 'delete1'])->name('spaBooking.delete');

    //FAQ
    Route::get('/faq', [FaqController::class, 'index'])->name('faq');
    Route::get('/faq/{slug}', [FaqController::class, 'show'])->name('faq.show');
    Route::post('/faq', [FaqController::class, 'create'])->name('faq');
    Route::put('/faq/{slug}', [FaqController::class, 'update'])->name('faq.update');
    Route::delete('/faq/{slug}', [FaqController::class, 'delete'])->name('faq.delete');

    //Bookings Restaurant Spa
    Route::get('/bookings', [BookinsRestaurantSpaController::class, 'index'])->name('bookings');
    Route::get('/bookings/{id}', [BookinsRestaurantSpaController::class, 'show'])->name('bookingRestaurantSpa');
    Route::put('/bookings-restaurant-spa/{id}', [BookinsRestaurantSpaController::class, 'update'])->name('bookingRestaurantSpa.update');
    Route::delete('/bookings-restaurant-spa/{id}', [BookinsRestaurantSpaController::class, 'delete'])->name('bookingRestaurantSpa.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Hotels
Route::get('/hotels', [HotelsController::class, 'index'])->name('hotels');
Route::post('/hotels', [HotelsController::class, 'store'])->name('hotelData');
// Route::get('/hotels', [HotelsController::class, 'index'])->name('hotels.index');
Route::delete('/hotels/{hotel_id}', [HotelsController::class, 'destroy'])->name('hotel.destroy');
Route::get('/hotels/{hotel_id}/edit', [HotelsController::class, 'edit'])->name('hotels.edit');
Route::put('/hotels/{hotel_id}', [HotelsController::class, 'update'])->name('hotels.update');
Route::get('/hotels/search', [HotelsController::class, 'search'])->name('hotels.search');

//Info
Route::get('/info', [InfoController::class, 'index'])->name('info.index');
Route::post('/info', [InfoController::class, 'store'])->name('info.store');
Route::delete('/info/{info_id}', [InfoController::class, 'destroy'])->name('info.destroy');
Route::put('/info/{info}', [InfoController::class, 'update'])->name('info.update');
Route::get('/info/{info}/edit', [InfoController::class, 'edit'])->name('info.edit');
Route::get('/hotels', [HotelsController::class, 'index'])->name('hotels.index');

//Package
// Hiển thị danh sách package
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
// Tạo package mới (hiển thị form là phương thức GET, lưu là POST)
Route::get('/packages/create', [PackageController::class, 'create'])->name('packages.create');
Route::post('/packages', [PackageController::class, 'store'])->name('packages.store');
// Hiển thị form chỉnh sửa package và cập nhật thông tin
Route::get('/packages/{packages_id}/edit', [PackageController::class, 'edit'])->name('packages.edit');
Route::put('/packages/{packages_id}', [PackageController::class, 'update'])->name('packages.update');
// Xóa package
Route::delete('/packages/{packages_id}', [PackageController::class, 'destroy'])->name('packages.destroy');
Route::get('/search-packages', [PackageController::class, 'search']);



Route::get('/user/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
require __DIR__ . '/auth.php';

