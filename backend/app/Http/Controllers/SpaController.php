<?php

namespace App\Http\Controllers;

use App\Models\BookingRestaurantSpa;
use App\Models\Spa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use DateTime;

class SpaController extends Controller
{
    public function index()
    {
        $spaModel = new Spa();
        $spas = $spaModel->getAllSpa();

        return view('spa', compact('spas'));
    }

    public function index1()
    {
        $spaModel = new BookingRestaurantSpa();
        $spas = $spaModel->getAllBookingsSpa();

        return view('booking-spa', compact('spas'));
    }

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'description' => 'required|max:1000',
                'spa_menu' => 'required|file|mimes:pdf|max:20480',
                'open_time' => 'required|date_format:H:i',
                'close_time' => 'required|date_format:H:i',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return redirect()->route('spa')->with('error', 'Thêm không thành công. Kiểm tra nội dung nhập vào!');
            }

            $openTime = $request->input('open_time');
            $closeTime = $request->input('close_time');

            $openDateTime = \DateTime::createFromFormat('H:i', $openTime);
            $closeDateTime = \DateTime::createFromFormat('H:i', $closeTime);

            if ($closeDateTime <= $openDateTime) {
                return redirect()->route('spa')->with('error', 'Thời gian mở và đóng cửa không hợp lệ!.');
            }
            $spa = new Spa();
            $spa->name = $request->input('name');
            $spa->slug = $this->createUniqueSlug($request->input('name') . '-' . uniqid());
            $spa->description = $request->input('description');

            // Tạo tên mới cho tệp tin (ví dụ: sử dụng timestamp để tránh trùng lặp)
            $spaMenu = time() . '_' . $request->file('spa_menu')->getClientOriginalName();
            // $image = time() . '_' . $request->file('spa_img')->getClientOriginalName();

            // Di chuyển tệp tin đến đường dẫn mong muốn
            $request->file('spa_menu')->move(public_path('uploads/file'), $spaMenu);
            // $request->file('spa_img')->move(public_path('uploads'), $image);

            // Gán tên tệp tin cho các trường trong model
            $spa->spa_menu = $spaMenu;
            $spa->time_open = $request->input('open_time');
            $spa->time_close = $request->input('close_time');

            $spa->save();

            // Kiểm tra và xử lý ảnh
            $this->processImages($spa, $request->file('spa_img'));

            return redirect()->route('spa')->with('success', 'Spa đã được thêm thành công.');
        } catch (\Throwable $th) {
            return redirect()->route('spa')->with('error', 'Có lỗi xảy ra. Vui lòng thử lại.');
        }
    }

    // Hàm kiểm tra và xử lý ảnh
    private function processImages($spa, $images)
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

                    $spa->images()->save($imageModel);
                }
            }
        }
    }

    //Kiểm tra file ảnh
    public function isImage($file)
    {
        // Kiểm tra xem tệp có phải là hình ảnh hay không
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if ($file instanceof \Illuminate\Http\UploadedFile && $file->isValid()) {
            $extension = $file->getClientOriginalExtension();

            return in_array(strtolower($extension), $allowedExtensions);
        }

        return false;
    }

    //Kiểm tra tên ảnh đã tồn tại trong bảng image hay chưa
    private function isImageNameExists($imageName)
    {
        return Image::where('name', $imageName)->exists();
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
                'description' => 'required|max:1000',
                'spa_menu' => 'file|mimes:pdf|max:20480',
                'open_time' => 'required|date_format:H:i',
                'close_time' => 'required|date_format:H:i',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return redirect()->route('spa')->with('error', 'Sửa không thành công. Kiểm tra nội dung nhập vào!');
            }

            $openTime = $request->input('open_time');
            $closeTime = $request->input('close_time');
            $openDateTime = \DateTime::createFromFormat('H:i', $openTime);
            $closeDateTime = \DateTime::createFromFormat('H:i', $closeTime);

            if ($closeDateTime <= $openDateTime) {
                return redirect()->route('restaurant')->with('error', 'Thời gian mở và đóng cửa không hợp lệ!');
            }

            $spaModel = new Spa();
            $spa = $spaModel->findSpa($slug);

            $databaseDateTime = $request->input('time_update');
            $carbonDateTime = Carbon::parse($databaseDateTime);

            if ($spa) {
                $isUpdatedAtMatch = $spa->isUpdatedAtMatch($carbonDateTime, $spa->updated_at);

                if ($isUpdatedAtMatch) {
                    // Thực hiện cập nhật thông tin

                    if ($request->hasFile('spa_img')) {
                        $spa = Spa::where('slug', $slug)->first();
                        $images = DB::table('image')->where('imageable_id', $spa->sw_id)->get();

                        if (!$spa) {
                            session()->flash('error', 'Không tìm thấy spa.');
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
                        $this->processImages($spa, $request->file('spa_img'));
                    }

                    // Cập nhật đường dẫn cho spa_menu nếu có file mới
                    if ($request->hasFile('spa_menu')) {
                        $oldSpamenuPath = '/uploads/file/' . $spa->spa_menu;
                        $filePath = public_path($oldSpamenuPath);

                        if (File::exists($filePath)) {
                            File::delete($filePath);
                        }

                        $spaMenu = time() . '_' . $request->file('spa_menu')->getClientOriginalName();
                        $request->file('spa_menu')->move(public_path('uploads/file'), $spaMenu);
                        $spa->spa_menu = $spaMenu;
                    }

                    // Chỉ cập nhật các trường thực sự được gửi qua request
                    $spa->name = $request->input('name');
                    $spa->slug = $this->createUniqueSlug($request->input('name') . '-' . uniqid());
                    $spa->description = $request->input('description');
                    $spa->time_open = $request->input('open_time');
                    $spa->time_close = $request->input('close_time');

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
            return redirect()->route('spa')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
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
            return redirect()->route('spa')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    public function update1(Request $request, $id)
    {
        function isVietnamesePhoneNumber($number)
        {
            return preg_match('/^(03|05|07|08|09|01[2|6|8|9])[0-9]{8}$/', $number);
        }

        function isValidEmail($email)
        {
            $emailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
            return preg_match($emailRegex, $email);
        }

        try {

            if (!isVietnamesePhoneNumber($request->phone_number)) {
                return redirect()->route('bookings')->with('error', 'Số điện thoại không hợp lệ!');
            } elseif (!isValidEmail($request->email)) {
                return redirect()->route('bookings')->with('error', 'email không hợp lệ!');
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|max:55',
                'phone_number' => 'required',
                'email' => 'required|max:100',
                'date' => 'required|max:100',
                'time' => 'required|date_format:H:i',
                'note' => 'max:120',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return redirect()->route('bookings')->with('error', 'Sửa không thành công. Kiểm tra nội dung nhập vào!');
            }

            // Kiểm tra xem có bản ghi có id cụ thể và restaurant_id là null không
            $booking = BookingRestaurantSpa::where('id', $id)
                ->whereNull('restaurant_id')
                ->first();

            if ($booking) {

                $databaseUpdatedAt = Carbon::parse($booking->updated_at);
                $newUpdatedAt = Carbon::parse($request->input('time_update'));

                $isUpdatedAtMatch = $booking->isUpdatedAtMatch($newUpdatedAt, $booking->updated_at);

                if (!$isUpdatedAtMatch) {
                    return redirect()->route('spa.index1')->with('error', 'Đã có dữ liệu mới hơn. Vui lòng tải lại trang!');
                }

                $dateTime = new DateTime($request->input('date'));
                $currentDate = new DateTime();

                // Tính sự khác biệt giữa ngày được yêu cầu và ngày hiện tại
                $dateDifference = $currentDate->diff($dateTime);

                if ($dateTime > $currentDate && $dateDifference->days <= 36) {
                    $formattedDate = $dateTime->format('d/m/Y');

                    $booking->full_name = $request->input('name');
                    $booking->phone_number = $request->input('phone_number');
                    $booking->date_time = $formattedDate . ' - ' . $request->input('time');
                    $booking->note = $request->input('note');
                    $booking->email = $request->input('email');
                    $booking->save();

                    return redirect()->route('spa.index1')->with('success', 'Sửa thông tin thành công!');
                } else {
                    return redirect()->route('spa.index1')->with('error', 'Ngày giờ không hợp lệ!');
                }
            } else {
                // Bản ghi không tồn tại hoặc restaurant_id không phải là null
                return redirect()->route('spa.index1')->with('error', 'Sửa thất bại. Lịch đặt không tồn tại!');
            }
        } catch (\Throwable $th) {
            return redirect()->route('spa.index1')->with('error', 'Có lỗi xảy ra!');
        }
    }

    public function show1($id)
    {
        $booking = DB::table('bookings_restaurant_spa')
            ->where('id', $id)
            ->whereNull('restaurant_id')
            ->first();
        if ($booking) {
            return response()->json($booking);
        } else {
            return redirect()->route('spa.index1')->with('error', 'Lịch đặt không tồn tại!');
        }
    }

    public function delete1($id)
    {
        try {
            $booking = BookingRestaurantSpa::where('id', $id)
                ->whereNull('restaurant_id')
                ->first();

            if ($booking) {
                $booking->delete();
                session()->flash('success', 'Xóa thành công.');
                return response()->json(['message' => 'Xóa thành công.']);
            } else {
                session()->flash('error', 'Không tìm thấy lịch đặt!');
                return response()->json(['message' => 'Không tìm thấy lịch đặt!']);
            }
        } catch (\Throwable $th) {
            return redirect()->route('bookings')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }
}
