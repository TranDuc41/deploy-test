<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BookingRestaurantSpa extends Model
{
    use HasFactory;

    protected $table = 'bookings_restaurant_spa';

    protected $fillable = [
        'sw_id',
        'restaurant_id',
        'full_name',
        'phone_number',
        'date_time',
        'email',
        'note',
    ];
}
