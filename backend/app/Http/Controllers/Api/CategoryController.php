<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            // Lấy danh sách category từ cơ sở dữ liệu
            $categories = Category::all();

            // Trả về danh sách category dưới dạng JSON
            return response()->json(['categories' => $categories]);
        } catch (\Throwable $th) {
            // Xử lý nếu có lỗi
            return response()->json(['error' => 'Lỗi khi lấy danh sách category.'], 500);
        }
    }
}
