<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        try {
            $blogs = Blogs::with(['user', 'category'])->paginate(10);
            return view('blog', compact('blogs'));
        } catch (\Throwable $th) {
            return redirect('/')->with('error', 'Lỗi khi tải danh sách blog: ' . $th->getMessage());
        }
    }

    public function blog()
    {
        try {
            $categories = Category::all();
            return view('addBlog', compact('categories'));
        } catch (\Throwable $th) {
            return redirect('/')->with('error', 'Lỗi khi tải danh mục: ' . $th->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:100',
                'read-time' => 'required|numeric|min:1|max:100',
                'action' => 'required|in:0,1',
                'category' => 'required|numeric',
                'short-desc' => 'required|string|max:255',
                'description' => 'required|string',
                'image-blog' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->route('addBlog')->with('error', 'Thêm không thành công. Hãy kiểm tra lại dữ liệu nhập.');
            }

            $image = time() . '_' . $request->file('image-blog')->getClientOriginalName();
            $request->file('image-blog')->move(public_path('uploads'), $image);

            $blog = new Blogs();
            $blog->title = $request->input('title');
            $blog->slug = $this->createUniqueSlug($request->input('title')) . '-' . uniqid();
            $blog->user_id = Auth::id();
            $blog->read_time = $request->input('read-time');
            $blog->action = $request->input('action');
            $blog->categories_id = $request->input('category');
            $blog->short_desc = $request->input('short-desc');
            $blog->description = $request->input('description');
            $blog->save();

            $imageModel = new Image([
                'name' => $image,
                'img_src' => '/uploads/' . $image,
            ]);
            $blog->images()->save($imageModel);

            return redirect()->route('addBlog')->with('success', 'Thêm thành công.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Lỗi khi tạo blog mới: ' . $th->getMessage());
        }
    }

    //Tạo slug
    private function createUniqueSlug($title)
    {
        $slug = Str::slug($title);

        // Kiểm tra xem có bản ghi nào trong cơ sở dữ liệu có slug giống nhau không
        while (DB::table('blogs')->where('slug', $slug)->exists()) {
            // Nếu có, thêm một số duy nhất vào slug để tạo slug mới và duy nhất
            $slug = Str::slug($title) . '-' . uniqid();
        }

        return $slug;
    }

    // Hàm kiểm tra và xử lý ảnh
    private function processImages($room, $images)
    {
        if (!empty($images)) {
            foreach ($images as $image) {
                // Kiểm tra xem có phải là file ảnh hay không
                if ($image->isValid() && $this->isImage($image)) {
                    $imageName = 'dominion' . '_' . $image->getClientOriginalName();
                    // Kiểm tra xem tên ảnh đã tồn tại trong bảng image hay chưa
                    if (!$this->isImageNameExists($imageName)) {
                        $image->move(public_path('uploads'), $imageName);
                    } else {
                        $imageName = 'dominion' . '_' . uniqid() . '_' . $imageName;
                        $image->move(public_path('uploads'), $imageName);
                    }

                    // Lưu thông tin ảnh vào bảng image và liên kết với phòng thông qua mối quan hệ đa hình
                    $imageModel = new Image([
                        'name' => $imageName,
                        'img_src' => '/uploads/' . $imageName,
                    ]);

                    $room->images()->save($imageModel);
                }
            }
        }
    }

    // Kiểm tra tên ảnh đã tồn tại trong bảng image hay chưa
    private function isImageNameExists($imageName)
    {
        return Image::where('name', $imageName)->exists();
    }

    public function show($slug)
    {
        try {
            $blog = Blogs::where('slug', $slug)->first();
            $categories = Category::all();
            if ($blog) {
                return view('editBlog', compact('blog', 'categories'));
            } else {
                return redirect()->back()->with('error', 'Không tìm thấy bài viết.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Lỗi khi hiển thị blog: ' . $th->getMessage());
        }
    }

    // public function edit(Request $request, $slug)
    // {
    //     // dd($slug);
    // }
    public function edit(Request $request, $slug)
    {
        try {
            $blog = Blogs::where('slug', $slug)->first();
            if (!$blog) {
                return redirect()->route('blog')->with('error', 'Bài viết không tồn tại !');
            }

            // Validate form data if needed
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:55',
                'read-time' => 'required|numeric|min:1|max:100',
                'action' => 'required|in:0,1',
                'category' => 'required|numeric',
                'short-desc' => 'required|string|max:255',
                'description' =>  'required|string|max:512',
                'image-blog' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Thêm validate cho ảnh
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Lỗi khi cập nhật bài viết.');
            }

            // Cập nhật dữ liệu từ form
            $blog->title = $request->input('title');
            $blog->read_time = $request->input('read-time');
            $blog->action = $request->input('action');
            $blog->categories_id = $request->input('category');
            $blog->short_desc = $request->input('short-desc');
            $blog->description = $request->input('description');

            // Kiểm tra xem có tệp tin mới được gửi hay không
            if ($request->hasFile('image-blog') && $request->file('image-blog')->isValid()) {
                $image = time() . '_' . $request->file('image-blog')->getClientOriginalName();
                $request->file('image-blog')->move(public_path('uploads'), $image);

                // Kiểm tra xem bài viết có ảnh cũ hay không
                if ($blog->images()->exists()) {
                    // Xóa tệp ảnh cũ
                    $oldImage = public_path($blog->images->first()->img_src);
                    if (file_exists($oldImage)) {
                        unlink($oldImage);
                    }

                    // Cập nhật bản ghi ảnh
                    $blog->images()->update(['img_src' => '/uploads/' . $image]);
                } else {
                    // Tạo mới bản ghi ảnh
                    $imageModel = new Image([
                        'name' => $image,
                        'img_src' => '/uploads/' . $image,
                    ]);
                    $blog->images()->save($imageModel);
                }
            }

            // Lưu thay đổi vào database
            $blog->save();

            return redirect()->route('blog')->with('success', 'Bài viết đã được cập nhật thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Lỗi khi cập nhật bài viết: ' . $th->getMessage());
        }
    }

    public function delete($slug)
    {
        $blog = Blogs::where('slug', $slug)->first();

        if (!$blog) {
            session()->flash('error', 'Không tìm thấy blog.');
            return response()->json(['message' => 'Xóa thất bại.']);
        } else {
            $blog->delete(); // Thực hiện xóa mềm
            session()->flash('success', 'Xóa thành công.');
            return response()->json(['message' => 'Xóa thành công.']);
        }
    }
}
