<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Reservation;
class Invoices extends Model
{
    protected $table = 'invoices'; // Định nghĩa tên bảng
    protected $primaryKey = 'invoice_id'; // Định nghĩa tên cột khóa chính
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id');
    }
    use HasFactory;
}
