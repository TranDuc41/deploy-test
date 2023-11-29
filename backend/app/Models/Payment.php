<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoices;

class Payment extends Model
{
    protected $table = 'payments'; // Định nghĩa tên bảng
    protected $primaryKey = 'payment_id'; // Định nghĩa tên cột khóa chính
    public function invoice()
    {
        return $this->belongsTo(Invoices::class, 'invoice_id');
    }
    use HasFactory;
}
