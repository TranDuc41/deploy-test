<?php

namespace App\Http\Controllers;

use App\Models\BookingRestaurantSpa;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

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
            $restaurants->slug = $this->createUniqueSlug($request->input('name') . '-' . uniqid());
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

    public function show($slug)
    {
        try {
            $restaurantModel = new Restaurant();

            $restaurant = $restaurantModel->findRestaurant($slug);

            if ($restaurant) {
                $images = $restaurant->images()->get();

                return response()->json(['restaurant' => $restaurant, 'images' => $images]);
            } else {
                // Xử lý khi không tìm thấy nhà hàng
                return redirect()->route('restaurant.show')->with('error', 'Nhà hàng không tồn tại!');
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
                'drink_list' => 'file|mimes:pdf|max:20480',
                'food_menu' => 'file|mimes:pdf|max:20480',
                'open_time' => 'required|date_format:H:i',
                'close_time' => 'required|date_format:H:i',
                'restaurant_img' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return redirect()->route('restaurant')->with('error', 'Sửa không thành công. Kiểm tra nội dung nhập vào!' . implode(', ', $errors));
            }

            $restaurantModel = new Restaurant();
            $restaurant = $restaurantModel->findRestaurant($slug);

            $databaseDateTime = $request->input('time_update');
            $carbonDateTime = Carbon::parse($databaseDateTime);

            if ($restaurant) {
                $isUpdatedAtMatch = $restaurant->isUpdatedAtMatch($carbonDateTime, $restaurant->updated_at);

                if ($isUpdatedAtMatch) {
                    // Thực hiện cập nhật thông tin

                    // Cập nhật đường dẫn cho drink_list nếu có file mới
                    if ($request->hasFile('drink_list')) {
                        $oldDrinkListPath = '/uploads/file/' . $restaurant->drink_link;
                        $filePath = public_path($oldDrinkListPath);

                        if (File::exists($filePath)) {
                            File::delete($filePath);
                        }

                        $drinkList = time() . '_' . $request->file('drink_list')->getClientOriginalName();
                        $request->file('drink_list')->move(public_path('uploads/file'), $drinkList);
                        $restaurant->drink_link = $drinkList;
                    }

                    // Cập nhật đường dẫn cho food_menu nếu có file mới
                    if ($request->hasFile('food_menu')) {
                        $oldFoodListPath = '/uploads/file/' . $restaurant->food_link;
                        $filePath = public_path($oldFoodListPath);

                        if (File::exists($filePath)) {
                            File::delete($filePath);
                        }

                        $foodMenu  = time() . '_' . $request->file('food_menu')->getClientOriginalName();
                        $request->file('food_menu')->move(public_path('uploads/file'), $foodMenu);
                        $restaurant->food_link = $foodMenu;
                    }

                    if ($request->hasFile('restaurant_img')) {
                        $restaurant = Restaurant::where('slug', $slug)->first();
                        $images = DB::table('image')->where('imageable_id', $restaurant->restaurant_id)->get();

                        if (!$restaurant) {
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
                        $restaurant->images()->delete();

                        // Lưu hình ảnh mới
                        $image = new Image();
                        $image->name = time() . '_' . $request->file('restaurant_img')->getClientOriginalName();
                        $image->img_src = '/uploads/' . $image->name;
                        $request->file('restaurant_img')->move(public_path('uploads'), $image->name);

                        // Lưu thông tin hình ảnh vào cơ sở dữ liệu
                        $restaurant->images()->save($image);
                    }

                    // Chỉ cập nhật các trường thực sự được gửi qua request
                    $restaurant->name = $request->input('name');
                    $restaurant->description = $request->input('description');
                    $restaurant->time_open = $request->input('open_time');
                    $restaurant->time_close = $request->input('close_time');
                    
                    // Lưu các thay đổi
                    $restaurant->save();

                    return redirect()->route('restaurant')->with('success', 'Sửa thông tin thành công!');
                } else {
                    return redirect()->route('restaurant')->with('error', 'Đã có dữ liệu mới hơn. Tải lại trang và thử lại!');
                }
            } else {
                // Xử lý khi không tìm thấy nhà hàng
                return redirect()->route('restaurant')->with('error', 'Nhà hàng không tồn tại!');
            }
        } catch (\Exception $e) {
            // Xử lý exception nếu có
            return redirect()->route('restaurant')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!'.$e);
        }
    }

    public function destroy($slug)
    {
        try {
            $restaurantModel = new Restaurant();
            $restaurant = $restaurantModel->findRestaurant($slug);

            if ($restaurant) {

                $images = DB::table('image')->where('imageable_id', $restaurant->restaurant_id)->get();
                foreach ($images as $image) {
                    // Xóa hình ảnh từ thư mục uploads
                    $filePath = public_path($image->img_src);

                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                }

                // Xóa hình ảnh liên quan trước khi xóa nhà hàng
                $restaurant->images()->delete();

                $oldDrinkListPath = '/uploads/file/' . $restaurant->drink_link;
                $filePath = public_path($oldDrinkListPath);

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

                $oldFoodListPath = '/uploads/file/' . $restaurant->food_link;
                $filePath = public_path($oldFoodListPath);

                if (File::exists($filePath)) {
                    File::delete($filePath);
                }

                // Xóa nhà hàng
                $restaurant->delete();
                session()->flash('success', 'Xóa thành công.');
                return response()->json(['message' => 'Xóa thành công.']);
            } else {
                // Xử lý khi không tìm thấy nhà hàng
                session()->flash('error', 'Nhà hàng không tồn tại!');
                return response()->json(['message' => 'Nhà hàng không tồn tại!']);
            }
        } catch (\Throwable $th) {
            return redirect()->route('restaurant')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!' . $th->getMessage());
        }
    }
}
