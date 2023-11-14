<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
