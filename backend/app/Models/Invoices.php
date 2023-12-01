<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
class Invoices extends Model
{
    protected $table = 'invoices'; // Định nghĩa tên bảng
    protected $primaryKey = 'invoice_id'; // Định nghĩa tên cột khóa chính
    
    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservations_id');
    }
    use HasFactory;
}
