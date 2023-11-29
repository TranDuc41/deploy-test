<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'categories_id';

    protected $fillable = [
        'title',
        'content',
        'slug',
    ];

    public $timestamps = true;
}
