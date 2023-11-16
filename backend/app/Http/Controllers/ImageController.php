<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    public function index()
    {
        $results = DB::table('image')->paginate(10);
        $totalImage = DB::table('image')->count();
        return view('image', compact('results', 'totalImage'));
    }

    public function create()
    {
        // Xử lý hiển thị form tạo mới hình ảnh
    }

    public function store(Request $request)
    {
        // Kiểm tra xem có file hình ảnh được gửi lên không
        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $image) {
                // Đặt tên mới cho hình ảnh (ví dụ: timestamp + tên gốc của file)
                $imageName = 'dominion' . '_' . $image->getClientOriginalName();

                // Kiểm tra xem tệp có phải là hình ảnh không
                if ($this->isImage($image) && !$this->imageExists($imageName)) {
                    // Di chuyển file hình ảnh đến thư mục lưu trữ (ví dụ: public/uploads)
                    $image->move(public_path('uploads'), $imageName);

                    // Lưu tên và địa chỉ lưu trữ của hình vào cơ sở dữ liệu sử dụng Query Builder
                    DB::table('image')->insert([
                        'name' => $imageName,
                        'img_src' => '/uploads/' . $imageName,
                        'created_at' => now(),
                    ]);
                } else {
                    // Xử lý trường hợp tệp không phải là hình ảnh hoặc đã tồn tại
                    return redirect()->route('images.index')->with('error', 'File không phải là hình ảnh hoặc tên tệp đã tồn tại.');
                }
            }

            // Thông báo thành công hoặc chuyển hướng đến trang khác
            return redirect()->route('images.index')->with('success', 'Hình ảnh đã được tải lên thành công!');
        }

        // Nếu không có file hình ảnh, xử lý lỗi ở đây
        return redirect()->route('images.index')->with('error', 'Vui lòng chọn ít nhất một hình ảnh để tải lên.');
    }

    // Phương thức để kiểm tra xem tệp có phải là hình ảnh không
    private function isImage($file)
    {
        return Str::startsWith($file->getMimeType(), 'image/');
    }

    // Phương thức để kiểm tra xem tên tệp đã tồn tại trong bảng image hay không
    private function imageExists($imageName)
    {
        return DB::table('image')->where('name', $imageName)->exists();
    }


    public function show($id)
    {
        // Xử lý hiển thị thông tin của hình ảnh có ID là $id
    }

    public function edit($id)
    {
        // Xử lý hiển thị form chỉnh sửa hình ảnh có ID là $id
    }

    public function update(Request $request, $id)
    {
        // Xử lý cập nhật thông tin của hình ảnh có ID là $id
    }

    public function destroy($id)
    {
        // Lấy thông tin của hình ảnh từ cơ sở dữ liệu
        $image = DB::table('image')->where('img_id', $id)->first();

        if (!$image) {
            session()->flash('error', 'Không tìm thấy hình ảnh.');
            return response()->json(['message' => 'Xóa thất bại.']);
        }

        // Xóa hình ảnh từ thư mục uploads
        $filePath = public_path($image->img_src);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        // Xóa hình ảnh từ cơ sở dữ liệu
        DB::table('image')->where('img_id', $id)->delete();

        session()->flash('success', 'Xóa thành công.');
        return response()->json(['message' => 'Xóa thành công.']);
    }
}
