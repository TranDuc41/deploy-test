<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    protected $table = 'reservations'; // Định nghĩa tên bảng
    protected $primaryKey = 'reservation_id'; // Định nghĩa tên cột khóa chính
    use HasFactory;
}
