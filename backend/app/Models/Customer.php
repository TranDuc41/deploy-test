<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer'; // Định nghĩa tên bảng
    protected $primaryKey = 'customer_id'; // Định nghĩa tên cột khóa chính
    use HasFactory;
}
