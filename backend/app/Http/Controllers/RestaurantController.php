<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Image;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurantModel = new Restaurant();
        $restaurants = $restaurantModel->getAllRestaurants();

        return view('restaurant', compact('restaurants'));
    }

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'description' => 'required|max:500',
                'drink_list' => 'required|file|mimes:pdf|max:20480',
                'food_menu' => 'required|file|mimes:pdf|max:20480',
                'open_time' => 'required|date_format:H:i',
                'close_time' => 'required|date_format:H:i',
                'restaurant_img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            if ($validator->fails()) {
                return redirect()->route('restaurant')->with('error', 'Thêm không thành công. Kiểm tra nội dung nhập vào!');
            }
            $restaurants = new Restaurant();
            $restaurants->name = $request->input('name');
            $restaurants->slug = $this->createUniqueSlug($request->input('name'). '-' . uniqid());
            $restaurants->description = $request->input('description');

            // Tạo tên mới cho tệp tin (ví dụ: sử dụng timestamp để tránh trùng lặp)
            $drinkList = time() . '_' . $request->file('drink_list')->getClientOriginalName();
            $foodMenu = time() . '_' . $request->file('food_menu')->getClientOriginalName();
            $image = time() . '_' . $request->file('restaurant_img')->getClientOriginalName();

            // Di chuyển tệp tin đến đường dẫn mong muốn
            $request->file('drink_list')->move(public_path('uploads/file'), $drinkList);
            $request->file('food_menu')->move(public_path('uploads/file'), $foodMenu);
            $request->file('restaurant_img')->move(public_path('uploads'), $image);

            // Gán tên tệp tin cho các trường trong model
            $restaurants->drink_link = $drinkList;
            $restaurants->food_link = $foodMenu;
            $restaurants->time_open = $request->input('open_time');
            $restaurants->time_close = $request->input('close_time');

            $restaurants->save();

            $imageModel = new Image([
                'name' => $image,
                'img_src' => '/uploads/' . $image,
            ]);
            $restaurants->images()->save($imageModel);
            
            return redirect()->route('restaurant')->with('success', 'Nhà hàng đã được thêm thành công.');
        } catch (\Throwable $th) {
            return redirect()->route('restaurant')->with('error', 'Có lỗi xảy ra. Vui lòng thử lại.' . $th->getMessage());
        }
    }

    //Tạo slug
    private function createUniqueSlug($title)
    {
        $slug = Str::slug($title);

        // Kiểm tra xem có bản ghi nào trong cơ sở dữ liệu có slug giống nhau không
        while (DB::table('restaurants')->where('slug', $slug)->exists()) {
            // Nếu có, thêm một số duy nhất vào slug để tạo slug mới và duy nhất
            $slug = Str::slug($title) . '-' . uniqid();
        }

        return $slug;
    }
}
