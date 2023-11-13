<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Package;

class Room extends Model
{
    use HasFactory;

    protected $table = 'room';

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
        'status',
    ];
    protected $primaryKey = 'room_id';

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'room_package', 'room_id', 'packages_id');
    }

    public function amenities()
    {
        return $this->belongsToMany(Amenities::class, 'room_amenities', 'room_id', 'amenities_id');
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class, 'rty_id');
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }
}
