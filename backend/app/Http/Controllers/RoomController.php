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
use Illuminate\Validation\ValidationException;

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
            $rty_id = $request->input('kind-room');
            $sale_id = $request->input('sale-select');
            $packageIds = $request->input('package-room');
            $amenitieIds = $request->input('room-amenities');

            //Kiểm tra package
            $existingPackageIds  = DB::table('packages')
                ->whereIn('packages_id', $packageIds)
                ->pluck('packages_id');
            // Lọc ra những packageIds không tồn tại
            $nonExistingPackageIds = array_diff($packageIds, $existingPackageIds->toArray());
            // Nếu có packageIds không tồn tại, trả về lỗi
            if (!empty($nonExistingPackageIds)) {
                return redirect()->back()->with('error', 'Giá trị trong gói lưu trú không hợp lệ!');
            }

            //Kiểm tra amenities
            $existingAmenitieIds  = DB::table('amenities')
                ->whereIn('amenities_id', $amenitieIds)
                ->pluck('amenities_id');
            // Lọc ra những packageIds không tồn tại
            $nonExistingAmenitieIds = array_diff($amenitieIds, $existingAmenitieIds->toArray());
            // Nếu có packageIds không tồn tại, trả về lỗi
            if (!empty($nonExistingAmenitieIds)) {
                return redirect()->back()->with('error', 'Giá trị trong tiện nghi không hợp lệ!');
            }

            //Kiểm tra rty_id
            $checkRty_id = DB::table('room_type')->where('rty_id', $rty_id)->first();
            if (!$checkRty_id){
                return redirect()->back()->with('error', 'Giá trị trong loại phòng không hợp lệ!');
            }

            //Kiểm tra sale_id
            $checkSale_id = DB::table('sale')->where('sale_id', $sale_id)->first();
            if (!$checkSale_id){
                return redirect()->back()->with('error', 'Giá trị trong giảm giá không hợp lệ!');
            }

            // Kiểm tra và xử lý giá trị trước khi lưu vào cơ sở dữ liệu
            if (
                $title &&
                $price > 0 && $price < 1000000000 &&
                $adults > 0 && $adults < 30 &&
                $children > 0 && $children < 6 &&
                $area > 0 && $area < 300 &&
                !empty(trim($description))
            ) {
                // Tạo đối tượng Room
                $room = new Room([
                    'title' => $title,
                    'slug' => $this->createUniqueSlug($title),
                    'price' => $price,
                    'adults' => $adults,
                    'children' => $children,
                    'area' => $area,
                    'rty_id' => $rty_id,
                    'sale_id' => $sale_id,
                    'description' => $description,
                ]);

                // Lưu phòng để có được ID
                $room->save();

                // Lưu vào bảng room_package
                $roomPackageData = [];
                foreach ($packageIds as $packageId) {
                    $roomPackageData[] = [
                        'room_id' => $room->room_id,
                        'packages_id' => $packageId,
                    ];
                }
                // Lưu vào bảng room_amenities
                $amenitiesData = [];
                foreach ($amenitieIds as $amenitieId) {
                    $amenitiesData[] = [
                        'room_id' => $room->room_id,
                        'amenities_id' => $amenitieId,
                    ];
                }

                DB::table('room_package')->insert($roomPackageData);
                DB::table('room_amenities')->insert($amenitiesData);

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
            dd($th);
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
