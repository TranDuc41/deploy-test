<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $table = 'faq';

    protected $fillable = [
        'title',
        'slug',
        'description',
    ];

    public function getAllFaq($perPage = 10)
    {
        return $this->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function findFaq($slug)
    {
        $faq = Faq::where('slug', $slug)->first();

        if ($faq) {
            return $faq;
        } else {
            return null;
        }
    }

    public function isUpdatedAtMatch($userUpdatedAt, $dbUpdatedAt) {
        return $userUpdatedAt == $dbUpdatedAt;
    }
}
