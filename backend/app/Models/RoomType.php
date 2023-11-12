<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    protected $table = 'room_type';
    protected $primaryKey = 'rty_id';
    use HasFactory;

    public function rooms()
    {
        return $this->hasMany(Room::class, 'rty_id');
    }
}
