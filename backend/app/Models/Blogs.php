<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
    use HasFactory;

    protected $table = 'blogs';
    protected $primaryKey = 'blog_id';
    protected $fillable = [
        'title',
        'slug',
        'user_id',
        'short_desc',
        'description',
        'read_time',
        'active',
        // các thuộc tính khác
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
