<?php

namespace App\Http\Controllers;

use App\Models\Spa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

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
}
