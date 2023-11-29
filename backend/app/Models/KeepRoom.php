<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\Room;
class KeepRoom extends Model
{
    protected $table = 'keep_rooms'; // Định nghĩa tên bảng
    protected $primaryKey = 'keep_room_id'; // Định nghĩa tên cột khóa chính
    
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'keep_room_id');
    }
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    use HasFactory;
}
