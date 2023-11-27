<?php

namespace App\Http\Controllers;

use App\Models\Spa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class SpaController extends Controller
{
    public function index()
    {
        $spaModel = new Spa();
        $spas = $spaModel->getAllSpa();

        return view('spa', compact('spas'));
    }

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'description' => 'required|max:500',
                'spa_menu' => 'required|file|mimes:pdf|max:20480',
                'open_time' => 'required|date_format:H:i',
                'close_time' => 'required|date_format:H:i',
                'spa_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            if ($validator->fails()) {
                return redirect()->route('restaurant')->with('error', 'Thêm không thành công. Kiểm tra nội dung nhập vào!');
            }
            $spa = new Spa();
            $spa->name = $request->input('name');
            $spa->slug = $this->createUniqueSlug($request->input('name') . '-' . uniqid());
            $spa->description = $request->input('description');

            // Tạo tên mới cho tệp tin (ví dụ: sử dụng timestamp để tránh trùng lặp)
            $spaMenu = time() . '_' . $request->file('spa_menu')->getClientOriginalName();
            $image = time() . '_' . $request->file('spa_img')->getClientOriginalName();

            // Di chuyển tệp tin đến đường dẫn mong muốn
            $request->file('spa_menu')->move(public_path('uploads/file'), $spaMenu);
            $request->file('spa_img')->move(public_path('uploads'), $image);

            // Gán tên tệp tin cho các trường trong model
            $spa->spa_menu = $spaMenu;
            $spa->time_open = $request->input('open_time');
            $spa->time_close = $request->input('close_time');

            $spa->save();

            $imageModel = new Image([
                'name' => $image,
                'img_src' => '/uploads/' . $image,
            ]);
            $spa->images()->save($imageModel);

            return redirect()->route('spa')->with('success', 'Spa đã được thêm thành công.');
        } catch (\Throwable $th) {
            return redirect()->route('spa')->with('error', 'Có lỗi xảy ra. Vui lòng thử lại.' . $th->getMessage());
        }
    }

    //Tạo slug
    private function createUniqueSlug($title)
    {
        $slug = Str::slug($title);

        // Kiểm tra xem có bản ghi nào trong cơ sở dữ liệu có slug giống nhau không
        while (DB::table('spa')->where('slug', $slug)->exists()) {
            // Nếu có, thêm một số duy nhất vào slug để tạo slug mới và duy nhất
            $slug = Str::slug($title) . '-' . uniqid();
        }

        return $slug;
    }

    public function show($slug)
    {
        try {
            $spamodel = new Spa();

            $spa = $spamodel->findSpa($slug);

            if ($spa) {
                $images = $spa->images()->get();

                return response()->json(['spa' => $spa, 'images' => $images]);
            } else {
                // Xử lý khi không tìm thấy nhà hàng
                return redirect()->route('spa.show')->with('error', 'Nhà hàng không tồn tại!');
            }
        } catch (\Exception $e) {
            // Xử lý exception nếu có
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $slug)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'description' => 'required|max:500',
                'spa_menu' => 'file|mimes:pdf|max:20480',
                'open_time' => 'required|date_format:H:i',
                'close_time' => 'required|date_format:H:i',
                'spa_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return redirect()->route('spa')->with('error', 'Sửa không thành công. Kiểm tra nội dung nhập vào!' . implode(', ', $errors));
            }

            $spaModel = new Spa();
            $spa = $spaModel->findSpa($slug);

            $databaseDateTime = $request->input('time_update');
            $carbonDateTime = Carbon::parse($databaseDateTime);

            if ($spa) {
                $isUpdatedAtMatch = $spa->isUpdatedAtMatch($carbonDateTime, $spa->updated_at);

                if ($isUpdatedAtMatch) {
                    // Thực hiện cập nhật thông tin

                    // Cập nhật đường dẫn cho spa_menu nếu có file mới
                    if ($request->hasFile('spa_menu')) {
                        $oldSpamenuPath = '/uploads/file/' . $spa->spa_menu;
                        $filePath = public_path($oldSpamenuPath);

                        if (File::exists($filePath)) {
                            File::delete($filePath);
                        }

                        $spaMenu = time() . '_' . $request->file('spa_menu')->getClientOriginalName();
                        $request->file('spa_menu')->move(public_path('uploads/file'), $spaMenu);
                        // $spa->spa_menu = $spaMenu;
                    }

                    if ($request->hasFile('spa_img')) {
                        $spa = Spa::where('slug', $slug)->first();
                        $images = DB::table('image')->where('imageable_id', $spa->sw_id)->get();

                        if (!$spa) {
                            session()->flash('error', 'Không tìm thấy nhà hàng.');
                        }

                        foreach ($images as $image) {
                            // Xóa hình ảnh từ thư mục uploads
                            $filePath = public_path($image->img_src);

                            if (File::exists($filePath)) {
                                File::delete($filePath);
                            }
                        }

                        // Xóa hình ảnh cũ
                        $spa->images()->delete();

                        // Lưu hình ảnh mới
                        $image = new Image();
                        $image->name = time() . '_' . $request->file('spa_img')->getClientOriginalName();
                        $image->img_src = '/uploads/' . $image->name;
                        $request->file('spa_img')->move(public_path('uploads'), $image->name);

                        // Lưu thông tin hình ảnh vào cơ sở dữ liệu
                        $spa->images()->save($image);
                    }

                    // Chỉ cập nhật các trường thực sự được gửi qua request
                    $spa->name = $request->input('name');
                    $spa->slug = $this->createUniqueSlug($request->input('name') . '-' . uniqid());
                    $spa->description = $request->input('description');
                    $spa->time_open = $request->input('open_time');
                    $spa->time_close = $request->input('close_time');
                    $spa->spa_menu = $spaMenu;

                    // Lưu các thay đổi
                    $spa->save();

                    return redirect()->route('spa')->with('success', 'Sửa thông tin thành công!');
                } else {
                    return redirect()->route('spa')->with('error', 'Đã có dữ liệu mới. Vui lòng tải lại trang và thử lại!');
                }
            } else {
                // Xử lý khi không tìm thấy nhà hàng
                return redirect()->route('spa')->with('error', 'Spa không tồn tại!');
            }
        } catch (\Exception $e) {
            // Xử lý exception nếu có
            return redirect()->route('spa')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!' . $e->getMessage());
        }
    }

    public function destroy($slug)
    {
        try {
            $spaModel = new Spa();
            $spa = $spaModel->findSpa($slug);

            if ($spa) {
                
                $images = DB::table('image')->where('imageable_id', $spa->sw_id)->get();
                foreach ($images as $image) {
                    // Xóa hình ảnh từ thư mục uploads
                    $filePath = public_path($image->img_src);
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                }

                // Xóa hình ảnh liên quan trước khi xóa spa
                $spa->images()->delete();

                $oldSpamenuPath = '/uploads/file/' . $spa->spa_menu;
                $filePath = public_path($oldSpamenuPath);

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

                // Xóa spa
                $spa->delete();
                session()->flash('success', 'Xóa thành công.');
                return response()->json(['message' => 'Xóa thành công.']);
            } else {
                // Xử lý khi không tìm thấy spa
                session()->flash('error', 'Spa không tồn tại!');
                return response()->json(['message' => 'Spa không tồn tại!']);
            }
        } catch (\Throwable $th) {
            return redirect()->route('spa')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!' . $th->getMessage());
        }
    }
}
