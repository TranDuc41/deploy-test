<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            $categories = Category::paginate(10);
            return view('category', compact('categories'));
        } catch (\Throwable $th) {
            return view('/');
        }
    }

    public function show($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:100',
                'slug' => 'required|max:100|unique:categories,slug',
                'content' => 'required|max:500',
            ]);

            if ($validator->fails()) {
                return redirect()->route('categories')->with('error', 'Thêm không thành công. Hãy kiểm tra lại dữ liệu nhập.');
            }

            $category = new Category;
            $category->title = $request->input('title');
            $category->slug = $request->input('slug');
            $category->content = $request->input('content');
            $category->save();

            return redirect()->route('categories')->with('success', 'Danh mục đã được thêm thành công.');
        } catch (\Throwable $th) {
            return redirect()->route('categories')->with('error', 'Lỗi thao tác. Kiểm tra lại dữ liệu');
        }
    }

    public function update(Request $request, $encodedId)
    {
        try {
            // $hashID = substr($encodedId, 0, 1) . substr($encodedId, 6);
            // $decodedId = base64_decode($hashID);
            $category = Category::find($encodedId);

            if (!$category) {
                return redirect()->route('categories')->with('error', 'Sửa không thành công. Không tìm thấy......');
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'description' => 'required|max:500',
            ]);

            if ($validator->fails()) {
                return redirect()->route('categories')->with('error', 'Sửa không thành công. Hãy kiểm tra lại dữ liệu nhập.');
            }

            $category->title = $request->input('name');
            $category->content = $request->input('description');
            $category->save();

            return redirect('categories')->with('success', 'Danh mục đã được cập nhật thành công.');
        } catch (\Throwable $th) {
            return redirect()->route('categories')->with('error', 'Lỗi thao tác. Kiểm tra lại dữ liệu');
        }
    }

    public function delete($id)
    {
        $category = Category::find($id);
        if (!$category) {
            session()->flash('error', 'Xóa thất bại.');
            return response()->json(['message' => 'Xóa thất bại.']);
        }

        $category->delete();
        session()->flash('success', 'Xóa thành công.');
        return response()->json(['message' => 'Xóa thành công.']);
    }
}
