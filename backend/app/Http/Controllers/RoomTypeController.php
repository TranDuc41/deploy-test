<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class RoomTypeController extends Controller
{
    public function index()
    {
        try {
            $room_types = RoomType::paginate(10);

            return view('room-type', compact('room_types'));
        } catch (\Throwable $th) {
            return view('/');
        }
    }
    public function show($rty_id)
    {
        $room_type = RoomType::find($rty_id);
        return response()->json($room_type);
    }
    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'slug' => 'required|max:100|unique:room_type,slug',
                'description' => 'required|max:500',
            ]);
            if ($validator->fails()) {
                return redirect()->route('room-types')->with('error', 'Thêm không thành công. Hãy kiểm tra lại dữ liệu nhập.');
            }
            $room_type = new RoomType;
            $room_type->name = $request->input('name');
            $room_type->slug = $request->input('slug');
            $room_type->description = $request->input('description');
            $room_type->save();
            return redirect()->route('room-types')->with('success', 'Loại phòng đã được thêm thành công.');
        } catch (\Throwable $th) {
            return redirect()->route('room-types')->with('error', 'Lỗi thao tác.Kiểm tra lại dữ liệu');
        }
    }

    public function update(Request $request, $encodedrty_id)
    {
        try {
            // tách chuỗi key và  encodedUserId
            $hashID = substr($encodedrty_id, 0, 1) . substr($encodedrty_id, 6);
            // giải mã
            $decodedrty_id = base64_decode($hashID);
            $room_type = RoomType::find($decodedrty_id);

            if (!$room_type) {
                return redirect()->route('room-types');
            }
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'slug' => 'required|max:100',
                'description' => 'required|max:500',
            ]);
            if ($validator->fails()) {
                return redirect()->route('room-types')->with('error', 'Sửa không thành công. Hãy kiểm tra lại dữ liệu nhập.');
            }
            // Cập nhật thông tin
            $room_type->name = $request->input('name');
            $room_type->slug = $request->input('slug');
            $room_type->description = $request->input('description');
            //update date
            $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');
            $room_type->updated_at = $currentDateTime;
            $room_type->save();

            return redirect('room-type')->with('success', 'Loại phòng đã được cập nhật thành công.');
        } catch (\Throwable $th) {
            return redirect()->route('room-types')->with('error', 'Lỗi thao tác.Kiểm tra lại dữ liệu');
        }
    }
    public function delete($encodedrty_id)
    {
        try {
            // tách chuỗi key và  encodedUserId
            $hashID = substr($encodedrty_id, 0, 1) . substr($encodedrty_id, 6);
            // giải mã
            $decodedrty_id = base64_decode($hashID);
            $room_type = RoomType::find($decodedrty_id);
            if (!$room_type) {
                return redirect()->route('room-type');
            }
            try {
                // Kiểm tra xem có phòng nào được liên kết với loại phòng nhất định không
                $roomsCount = Room::where('rty_id', $decodedrty_id)->count();

                // Nếu có phòng liên quan đến loại phòng này, hãy ngăn chặn việc xóa
                if ($roomsCount > 0) {
                    return redirect()->back()->with('error', 'Không thể xóa loại phòng vì có liên quan phòng. Bạn có thể thay đổi loại phòng từ trang quản lý phòng.');
                }

                // Nếu không có phòng liên quan, tiến hành xóa
                $room_type->delete();

                return redirect('room-type')->with('success', 'Loại phòng đã được xóa thành công.');
            } catch (\Exception $e) {
                // Xử lý các ngoại lệ, ghi lại chúng, v.v.
                return redirect()->back()->with('error', 'Lỗi xóa loại phòng.');
            }
        } catch (\Throwable $th) {
            return redirect()->route('room-types')->with('error', 'Lỗi thao tác.Kiểm tra lại dữ liệu');
        }
    }
}
