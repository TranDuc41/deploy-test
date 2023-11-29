<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $table = 'restaurants';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'drink_link',
        'food_link',
        'time_open',
        'time_close',
    ];
    protected $primaryKey = 'restaurant_id';

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getAllRestaurants($perPage = 10)
    {
        return $this->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findRestaurant($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();

        if ($restaurant) {
            return $restaurant;
        } else {
            return null;
        }
    }

    public function isUpdatedAtMatch($userUpdatedAt, $dbUpdatedAt) {
        return $userUpdatedAt == $dbUpdatedAt;
    }
}
