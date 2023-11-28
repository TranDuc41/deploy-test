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

    public function getAllBookings($perPage = 10)
    {
        return $this->select(
            'bookings_restaurant_spa.*',
            'restaurants.restaurant_id as restaurant_id',
            'restaurants.name as restaurant_name',
        )
            ->leftJoin('restaurants', 'bookings_restaurant_spa.restaurant_id', '=', 'restaurants.restaurant_id')
            ->whereNotNull('bookings_restaurant_spa.restaurant_id')
            ->orderBy('bookings_restaurant_spa.created_at', 'desc')
            ->paginate($perPage);
    }

    public function getAllBookingsSpa($perPage = 10)
    {
        return $this->select(
            'bookings_restaurant_spa.*',
            'spa.name as spa_name'
        )
            ->leftJoin('spa', 'bookings_restaurant_spa.sw_id', '=', 'spa.sw_id')
            ->whereNotNull('bookings_restaurant_spa.sw_id')
            ->orderBy('bookings_restaurant_spa.created_at', 'desc')
            ->paginate($perPage);
    }
    
    public function findBookingsId($id)
    {
        $booking = BookingRestaurantSpa::where('id', $id)->first();

        if ($booking) {
            return $booking;
        } else {
            return null;
        }
    }

    public function isUpdatedAtMatch($userUpdatedAt, $dbUpdatedAt)
    {
        return $userUpdatedAt == $dbUpdatedAt;
    }
}
