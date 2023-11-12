<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'img_src',
        'imageable_type',
        'imageable_id',
    ];

    protected $table = 'image';
    protected $primaryKey = 'img_id';
}
