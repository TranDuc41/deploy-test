<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Reservations;
use Illuminate\Http\Request;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ReservationsController extends Controller
{
    //nhận các tham số
    public function index($adults, $children, $slug_rty)
    {
        try {
            $rooms = Room::with('images', 'packages', 'amenities', 'roomType', 'sale')
                ->whereHas('roomType', function ($query) use ($slug_rty) {
                    $query->where('slug', $slug_rty);
                })
                ->where(function ($query) use ($adults, $children) {
                    $query->where('adults', '>=', $adults)
                        ->where('children', '>=', $children)
                        ->where('status', 'work');
                })
                ->get();
            if ($rooms->isEmpty()) {
                // kiem tra so phòng tìm kiếm có phải do số lượng
                $countByAdults = Room::where('adults', '>=', $adults)->count();
                if ($countByAdults === 0) {
                    return response()->json(['countbyadults' => 'Chúng tôi xin lỗi vì sự bất tiện này. Không có sẵn phòng cho số lượng khách trong yêu cầu của bạn. Vui lòng xem xét đặt nhiều phòng.']);
                } else {
                    // Check if no rooms were found due to 'slug' condition
                    $countBySlug = Room::with('roomType') -> whereHas('roomType', function ($query) use ($slug_rty) 
                    {
                        $query->where('slug', $slug_rty);
                    })->count();
                    if ($countBySlug === 0) {
                        // 
                        return response()->json(['countbyslug' => 'Chúng tôi xin lỗi vì sự bất tiện này. Không có sẵn phòng loại phòng trong yêu cầu của bạn. Vui lòng xem xét loại phòng khác.']);
                    }
                }
            } else {
                // Process retrieved rooms
                // ...
            }
            return response()->json(['rooms' => $rooms]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Rooms not found'], 404);
        }
    }
    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // customer
                'prefix' => 'required|in:Ông,Bà',
                'full_name' => 'required|max:55',
                'email' => 'required|email|max:100',
                'address' => 'required|max:255',
                'phone_number' => ['required', 'size:10', 'regex:/^0[0-9]*$/'],
                'check_in' => 'required|date',
                'check_out' => 'required|date',
                'adults' => 'required|numeric',
                'children' => 'required|numeric',
                'total_amount' => 'required|numeric',
                'room' => 'required|array',

            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();

                // Lấy tên trường lỗi đầu tiên
                $firstErrorField = $errors->keys()[0];

                return redirect()->back()->with('error', "Thêm không thành công. ($firstErrorField) không hợp lệ.");
            }
            $request->validate([
                'room' => [
                    'required',
                    'array',
                    Rule::exists('room', 'room_id'), // Kiểm tra xem giá trị trong mảng tồn tại trong cột 'id' của bảng 'rooms' hay không
                ],
            ]);

            // Nếu kiểm tra thành công, bạn có thể lấy dữ liệu như sau:
            $selectedRoomIds = $request->input('room', []);

            $customer = new Customer();
            $customer->prefix = $request->input('prefix');
            $customer->full_name = $request->input('full_name');
            $customer->email = $request->input('email');
            $customer->address = $request->input('address');
            $customer->phone_number = $request->input('phone_number');
            $customer->status = '1';
            $customer->save();


            $reservations = new Reservations();
            $reservations->method = "Online";
            $reservations->check_in = Carbon::createFromFormat('Y-m-d', $request->input('check_in'))->toDateString();
            $reservations->check_out = Carbon::createFromFormat('Y-m-d', $request->input('check_out'))->toDateString();
            $reservations->adults = $request->input('adults');
            $reservations->children = $request->input('children');
            $reservations->note = $request->input('note');
            $reservations->customer_id = $customer->customer_id;
            // Lưu phòng để có được ID
            $reservations->save();

            // Lấy reservations_id sau khi đã lưu vào cơ sở dữ liệu
            $reservations_id = $reservations->reservations_id;

            // Lưu vào bảng room_package và room_amenities
            $this->saveRoom($reservations_id, $selectedRoomIds);
            

            return response()->json(['success' => true, 'message' => 'Request processed successfully']);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json(['error' => false, 'message' => 'Có lỗi khi gửi đi!'], 403); }
    }
    private function saveRoom($reservations_id, $roomIDS)
    {
        $roomData = [];
        foreach ($roomIDS as $room) {
            $roomData[] = [
                'reservations_id' => $reservations_id,
                'room_id' => $room,
            ];
        }

        DB::table('reservations_room')->insert($roomData);
    }
}
