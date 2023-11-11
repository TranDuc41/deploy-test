<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'price',
        'sale_id',
        'adults',
        'children',
        'area',
        'description',
        'rty_id',
        'amenities_id',
        'packages_id',
        'img_id',
    ];

    protected $primaryKey = 'room_id';
}
