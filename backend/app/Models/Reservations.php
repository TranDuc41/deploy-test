<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KeepRoom;
use App\Models\Invoices;
use App\Models\Customer;
class Reservations extends Model
{
    protected $table = 'reservations'; // Định nghĩa tên bảng
    protected $primaryKey = 'reservation_id'; // Định nghĩa tên cột khóa chính
    public function keepRooms()
    {
        return $this->hasMany(KeepRoom::class, 'keep_room_id');
    }
    public function invoice()
    {
        return $this->hasOne(Invoices::class, 'reservation_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    use HasFactory;
}
