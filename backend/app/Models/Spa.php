<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spa extends Model
{
    use HasFactory;

    protected $table = 'spa';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'spa_menu',
        'time_open',
        'time_close',
    ];
    protected $primaryKey = 'sw_id';

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function getAllSpa($perPage = 10)
    {
        return $this->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findSpa($slug)
    {
        $spa = Spa::where('slug', $slug)->first();

        if ($spa) {
            return $spa;
        } else {
            return null;
        }
    }

    public function isUpdatedAtMatch($userUpdatedAt, $dbUpdatedAt) {
        return $userUpdatedAt == $dbUpdatedAt;
    }
}
