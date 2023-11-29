<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;
use App\Models\Reservation;
class Customer extends Model
{
    protected $table = 'customer'; // Định nghĩa tên bảng
    protected $primaryKey = 'customer_id'; // Định nghĩa tên cột khóa chính
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'customer_id');
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'customer_id');
    }
    use HasFactory;
}
