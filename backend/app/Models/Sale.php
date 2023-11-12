<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sale';
    protected $primaryKey = 'sale_id';
    //Thêm trường username
    use HasFactory;

    public function rooms()
    {
        return $this->hasMany(Room::class, 'sale_id');
    }
}
