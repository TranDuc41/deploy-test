<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotels extends Model
{
    use HasFactory;
    protected $primaryKey = 'hotel_id';
    protected $table = 'hotels'; // Tên của bảng trong cơ sở dữ liệu
    protected $fillable = ['hotel_id', 'name', 'address', 'phone'];
}
