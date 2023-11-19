<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $table = 'info';
    protected $primaryKey = 'info_id';
    protected $fillable = ['title', 'link', 'hotel_id', 'content'];

    public function hotel()
    {
        return $this->belongsTo(Hotels::class, 'hotel_id', 'hotel_id');
         // Đảm bảo rằng 'hotel_id' là khóa ngoại trong bảng 'info'
        // và 'id' là khóa chính trong bảng 'hotels'
        // return $this->belongsTo('App\Models\Hotel', 'hotel_id', 'id');
    }
}