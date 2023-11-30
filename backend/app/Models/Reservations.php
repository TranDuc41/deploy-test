<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Room;
use App\Models\Invoices;
use App\Models\Customer;
class Reservations extends Model
{
    protected $table = 'reservations'; // Định nghĩa tên bảng
    protected $primaryKey = 'reservation_id'; // Định nghĩa tên cột khóa chính
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function invoices()
    {
        return $this->hasOne(Invoice::class, 'reservation_id');
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'reservation_room', 'reservation_id', 'room_id');
    }
    use HasFactory;
}
