<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blogs;

class BlogController extends Controller
{
    public function index()
    {
        // Lấy dữ liệu từ bảng blogs và images
        $blogs = Blogs::with('images')->orderBy('blog_id', 'desc')->get();

        // Format dữ liệu để chứa cả trường img_src
        $formattedBlogs = $blogs->map(function ($blog) {
            $imgSrc = $blog->images->first()->img_src ?? null;
            return [
                'blog_id' => $blog->blog_id,
                'title' => $blog->title,
                'short_desc' => $blog->short_desc,
                'read_time' => $blog->read_time,
                'img_src' => $imgSrc,
                // Thêm các trường khác nếu cần
            ];
        });

        return response()->json($formattedBlogs);
    }
}
