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
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class RoomController extends Controller
{
    public function index()
    {
        // Lấy danh sách phòng với thông tin giảm giá
        $rooms = DB::table('room')
            ->select('room.*', 'sale.discount as discount_percentage')
            ->leftJoin('sale', 'room.sale_id', '=', 'sale.sale_id')
            ->paginate(10);

        $totalRoom = DB::table('room')->count();
        $totalRoomMaintenance = DB::table('room')->where('status', 'maintenance')->count();
        $totalRoomUsed = DB::table('room')->where('status', 'used')->count();
        $totalRoomType = DB::table('room_type')->count();

        return view('rooms', compact('rooms', 'totalRoom', 'totalRoomType', 'totalRoomMaintenance', 'totalRoomUsed'));
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
            $validStatusValues = ['work', 'maintenance', 'used'];
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
            $inputStatus = $request->input('room-status');

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
            if (!$checkRty_id) {
                return redirect()->back()->with('error', 'Giá trị trong loại phòng không hợp lệ!');
            }

            //Kiểm tra sale_id
            $checkSale_id = DB::table('sale')->where('sale_id', $sale_id)->first();
            if (!$checkSale_id) {
                return redirect()->back()->with('error', 'Giá trị trong giảm giá không hợp lệ!');
            }

            // Kiểm tra và xử lý giá trị trước khi lưu vào cơ sở dữ liệu
            if (
                $title &&
                $price > 0 && $price < 1000000000 &&
                $adults > 0 && $adults < 30 &&
                $children > 0 && $children < 6 &&
                $area > 0 && $area < 300 &&
                $inputStatus && in_array($inputStatus, $validStatusValues) &&
                !empty(trim($description))
            ) {
                // Tạo đối tượng Room
                $room = new Room([
                    'title' => $title,
                    'slug' => $this->createUniqueSlug($title) . '-' . uniqid(),
                    'price' => $price,
                    'adults' => $adults,
                    'children' => $children,
                    'area' => $area,
                    'rty_id' => $rty_id,
                    'sale_id' => $sale_id,
                    'description' => $description,
                    'status' => $inputStatus,
                ]);

                // Lưu phòng để có được ID
                $room->save();

                // Kiểm tra và xử lý ảnh
                $images = $request->file('images');
                foreach ($images as $image) {
                    // Kiểm tra xem có phải là file ảnh hay không
                    if ($image->isValid() && $this->isImage($image)) {
                        $imageName = 'dominion' . '_' . $image->getClientOriginalName();
                        $image->move(public_path('uploads'), $imageName);

                        // Lưu thông tin ảnh vào bảng image và liên kết với phòng thông qua mối quan hệ đa hình
                        $imageModel = new Image([
                            'name' => $imageName,
                            'img_src' => '/uploads/' . $imageName,
                        ]);

                        $room->images()->save($imageModel);
                    } else {
                        return redirect()->back()->with('error', 'Vui lòng chỉ chọn file hình ảnh.');
                    }
                }

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

                return redirect()->route('rooms.index')->with('success', 'Thêm phòng thành công.');
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

    public function update(Request $request, $id)
    {
        try {
            $validStatusValues = ['work', 'maintenance', 'used'];
            // Lấy giá trị từ request
            $title = trim($request->input('room-name'));
            $price = trim($request->input('room-price'));
            $slug = trim($request->input('room-slug'));
            $adults = trim($request->input('room-adults'));
            $children = trim($request->input('room-children'));
            $area = trim($request->input('room-area'));
            $description = $request->input('description-input');
            $rty_id = $request->input('kind-room');
            $sale_id = $request->input('sale-select');
            $packageIds = $request->input('package-room');
            $amenitieIds = $request->input('room-amenities');
            $inputStatus = $request->input('room-status');

            $room = Room::where('slug', $slug)->firstOrFail(); // Lấy ra phòng cần cập nhật

            // Kiểm tra và xử lý giá trị trước khi lưu vào cơ sở dữ liệu
            if (
                $title &&
                $price > 0 && $price < 1000000000 &&
                $adults > 0 && $adults < 30 &&
                $children > 0 && $children < 6 &&
                $area > 0 && $area < 300 &&
                $inputStatus && in_array($inputStatus, $validStatusValues) &&
                !empty(trim($description))
            ) {
                // Cập nhật thông tin phòng
                $room->title = $title;
                $room->slug = $this->createUniqueSlug($title) . '-' . uniqid();
                $room->price = $price;
                $room->adults = $adults;
                $room->children = $children;
                $room->area = $area;
                $room->rty_id = $rty_id;
                $room->sale_id = $sale_id;
                $room->description = $description;
                $room->status = $inputStatus;

                // Lưu các thay đổi
                $room->save();

                // Xóa hình ảnh cũ trước khi thêm hình ảnh mới
                // $room->images()->delete();

                // Kiểm tra và xử lý ảnh tương tự như trong hàm store
                $images = $request->file('images');
                if (!empty($images)) {
                    foreach ($images as $image) {
                        // Kiểm tra xem có phải là file ảnh hay không
                        if ($image->isValid() && $this->isImage($image)) {
                            $imageName = 'dominion' . '_' . $image->getClientOriginalName();
                            $image->move(public_path('uploads'), $imageName);

                            // Lưu thông tin ảnh vào bảng image và liên kết với phòng thông qua mối quan hệ đa hình
                            $imageModel = new Image([
                                'name' => $imageName,
                                'img_src' => '/uploads/' . $imageName,
                            ]);

                            $room->images()->save($imageModel);
                        } else {
                            return redirect()->back()->with('error', 'Vui lòng chỉ chọn file hình ảnh.');
                        }
                    }
                }
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
                return redirect()->route('rooms.index')->with('success', 'Cập nhật phòng thành công.');
            } else {
                return redirect()->back()->with('error', 'Vui lòng điền đầy đủ thông tin hoặc kiểm tra giá trị nhập vào.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Có lỗi xảy ra!. Cập nhật thất bại!');
        }
    }

    public function destroy($slug)
    {
        // Lấy thông tin của room từ cơ sở dữ liệu
        $room = DB::table('room')->where('slug', $slug)->first();
        $images = DB::table('image')->where('imageable_id', $room->room_id)->get();

        if (!$room) {
            session()->flash('error', 'Không tìm thấy phòng.');
            return response()->json(['message' => 'Xóa thất bại.']);
        }

        foreach ($images as $image) {
            // Xóa hình ảnh từ thư mục uploads
            $filePath = public_path($image->img_src);
            
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
        // Xóa room từ cơ sở dữ liệu
        DB::table('room')->where('slug', $slug)->delete();
        DB::table('image')->where('imageable_id', $room->room_id)->delete();

        session()->flash('success', 'Xóa thành công.');
        return response()->json(['message' => 'Xóa thành công.']);
    }

    //Tạo slug
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
}
