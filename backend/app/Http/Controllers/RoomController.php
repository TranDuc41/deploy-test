<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Image;
use App\Models\Room;
use App\Models\Sale;
use App\Models\RoomType;
use App\Models\Amenities;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = DB::table('room')->paginate('10');
        $totalRoom = DB::table('room')->count();
        $totalRoomType = DB::table('room_type')->count();
        return view('rooms', compact('rooms', 'totalRoom', 'totalRoomType'));
    }

    public function create()
    {
        $currentDate = Carbon::now();

        $roomTypes = DB::table('room_type')->get();
        $sales = DB::table('sale')->where('end_date', '>=', $currentDate)->get();
        $packages = DB::table('packages')->get();
        $amenities = DB::table('amenities')->get();
        return view('editRoom', compact('roomTypes', 'sales', 'packages', 'amenities'));
    }

    public function store(Request $request)
    {
        try {
            // Lấy giá trị từ request
            $title = trim($request->input('room-name'));
            $price = trim($request->input('room-price'));
            $adults = trim($request->input('room-adults'));
            $children = trim($request->input('room-children'));
            $area = trim($request->input('room-area'));
            $description = $request->input('description-input');
        
            // Kiểm tra và xử lý giá trị trước khi lưu vào cơ sở dữ liệu
            if ($title &&
             $price > 0 && $price < 1000000000 && 
             $adults > 0 && $adults < 30 &&
             $children > 0 && $children < 6 &&
             $area > 0 && $area < 300 &&
             !empty(trim($description))) {
                // Tạo đối tượng Room
                $room = new Room([
                    'title' => $title,
                    'slug' => $this->createUniqueSlug($title),
                    'price' => $price,
                    'adults' => $adults,
                    'children' => $children,
                    'area' => $area,
                    'description' => $description,
                ]);
        
                // Lưu phòng để có được ID
                $room->save();
        
                // Kiểm tra và xử lý ảnh
                $images = $request->file('images');
                foreach ($images as $image) {
                    $imageName = 'dominion' . '_' . $image->getClientOriginalName();
                    $image->move(public_path('uploads'), $imageName);
        
                    // Lưu thông tin ảnh vào bảng image và liên kết với phòng thông qua mối quan hệ đa hình
                    $imageModel = new Image([
                        'name' => $imageName,
                        'img_src' => '/uploads/' . $imageName,
                    ]);
        
                    $room->images()->save($imageModel);
                }
        
                return redirect()->back()->with('success', 'Thêm phòng thành công.');
            } else {
                return redirect()->back()->with('error', 'Vui lòng điền đầy đủ thông tin hoặc kiểm tra giá trị nhập vào.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra!. Thêm thất bại!');
        }
        
    }


    public function show($id)
    {
    }

    public function edit($slug)
    {
        $room = Room::where('slug', $slug)->first();
        if (!$room) {
            return redirect()->back()->with('error', 'Phòng không tồn tại.');
        }
        $images = $room->images()->paginate(4);

        $currentDate = Carbon::now();
        $sales = Sale::where('end_date', '>=', $currentDate)->get();
        $packages = $packages = DB::table('packages')->get();
        $roomTypes = RoomType::all();
        $amenities = Amenities::all();

        return view('editRoom', compact('room', 'images', 'sales', 'packages', 'roomTypes', 'amenities'));
    }

    public function update(Request $request)
    {
        dd($request->file('images'));
    }

    public function destroy($id)
    {
    }

    private function createUniqueSlug($title)
    {
        $slug = Str::slug($title);

        // Kiểm tra xem có bản ghi nào trong cơ sở dữ liệu có slug giống nhau không
        while (DB::table('room')->where('slug', $slug)->exists()) {
            // Nếu có, thêm một số duy nhất vào slug để tạo slug mới và duy nhất
            $slug = Str::slug($title) . '-' . uniqid();
        }

        return $slug;
    }
}
