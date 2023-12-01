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
        'action',
        'categories_id',
        // các thuộc tính khác
    ];

    // Mối quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Mối quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
