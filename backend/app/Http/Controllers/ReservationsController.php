<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\KeepRoom;
use App\Models\Reservations;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class ReservationsController extends Controller
{
    public function showReservationsList()
    {
        // try {


        // } catch (\Throwable $th) {
        //     return view('/');
        // }
        $reservations = Reservations::with('keep_room ', 'payment ', 'invoices', 'customer')->paginate(20);

        // Mã hóa ID của khách hàng và truyền nó vào view

        $encodedReservations = $reservations->map(function ($reservation) {
            $reservation->encoded_id =  Crypt::encrypt($reservation->reservations_id);
            return $reservation;
        });
        return view('reservationlist', compact('encodedReservations'));
    }
    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                // customer
                // 'prefix' => 'required|in:Ông,Bà',
                'full_name' => 'required|max:55',
                // 'email' => 'required|email|unique:customer,email|max:100',
                'address' => 'required|max:255',
                'phone_number' => ['required', 'size:10', 'regex:/^0[0-9]*$/'],
                'check_in' => 'required|date',
                'check_out' => 'required|date',
                'adults' => 'required|numeric',
                // 'total_amount' => 'required|numeric',
                'roomsIDS' => 'required|array',

            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();

                // Lấy tên trường lỗi đầu tiên
                $firstErrorField = $errors->keys()[0];

                return redirect()->back()->with('error', "Thêm không thành công. ($firstErrorField) không hợp lệ.");
            }
            $request->validate([
                'roomsIDS' => [
                    'required',
                    'array',
                    Rule::exists('room', 'room_id'), // Kiểm tra xem giá trị trong mảng tồn tại trong cột 'id' của bảng 'rooms' hay không
                ],
            ]);

            // Nếu kiểm tra thành công, bạn có thể lấy dữ liệu như sau:
            $selectedRoomIds = $request->input('roomsIDS', []);

            $customer = new Customer;
            $customer->prefix = $request->input('prefix') ?? 'Ông';
            $customer->full_name = $request->input('full_name');
            $customer->email = $request->input('email');
            $customer->address = $request->input('address');
            $customer->phone_number = $request->input('phone_number');
            $customer->status = '1';
            $customer->save();

            // $customer_id_add = Customer::where('email', $request->input('email'))->firstOrFail();

            $reservations = new Reservations();
            $reservations->method = "Offline";
            $reservations->check_in = Carbon::createFromFormat('Y-m-d', $request->input('check_in'))->toDateString();
            $reservations->check_out = Carbon::createFromFormat('Y-m-d', $request->input('check_out'))->toDateString();
            $reservations->adults = $request->input('adults');
            $reservations->children = $request->input('children');
            $reservations->note = $request->input('note');
            $reservations->user_id = Auth::id();
            $reservations->customer_id = $customer->customer_id;
            // Lưu phòng để có được ID
            $reservations->save();

            // Lấy reservations_id sau khi đã lưu vào cơ sở dữ liệu
            $reservations_id = $reservations->reservations_id;

            // Lưu vào bảng room_package và room_amenities
            $this->saveRoom($reservations_id, $selectedRoomIds);
            

            return redirect()->back()->with('success', 'Thêm phòng thành công.');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->back()->with('error', 'Thêm thất bại! Vui lòng kiểm tra lại dữ liệu nhập vào.' . $th);
        }
    }
    public function createReservations()
    {
        try {
            $rooms = Room::with('images', 'packages', 'amenities', 'roomType', 'sale')->get();
            return view('newReservations', compact('rooms'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn.vui lòng thao tác lại');
        }
    }

    public function showRoom($slug)
    {
        try {
            $room = Room::with('images', 'packages', 'amenities', 'roomType', 'sale')->where('slug', $slug)->first();
            if (!$room) {
                return redirect()->back()->with('error', 'Phòng không tồn tại.');
            }
            return response()->json($room);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Không tìm thấy phòng.vui lòng thao tác lại');
        }
    }
    // Hàm lưu vào bảng room_package và room_amenities
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
