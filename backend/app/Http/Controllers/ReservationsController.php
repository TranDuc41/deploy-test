<?php

namespace App\Http\Controllers;

use App\Models\KeepRoom;
use App\Models\Reservations;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

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
    public function showReservationsItem($encodedId)
    {
        try {
            $id = Crypt::decrypt($encodedId);
            $reservations = Reservations::find($id);
            $reservations = Reservations::with('keep_room ', 'payment ', 'invoices', 'customer')
                ->where('reservation_id', $id);
            if (!$reservations) {
                return redirect()->back()->with('error', 'Không tìm thấy đơn.vui lòng thao tác lại');
            }
            $reservations->encoded_id =  Crypt::encrypt($reservations->reservation_id);
            return view('detailReservations', compact('reservations'));
            // return response()->json($customer);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Không tìm thấy đơn.vui lòng thao tác lại');
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
    //hien thi phòng để chọn
    // public function showRoom($request)
    // {
    //     try {
    //         $validator = Validator::make($request->all(), [
    //             'checkIn' => 'required|date',
    //             'checkOut' => 'required|date|after:checkIn',
    //             'adults' => 'required|number|max:20',
    //             'children' => 'required|number|max:20',
    //         ]);
    //         if ($validator->fails()) {
    //             $errors = $validator->errors();

    //             // Lấy tên trường lỗi đầu tiên
    //             $firstErrorField = $errors->keys()[0];
    //             return redirect()->back()->with('error', "Không thể tìm được phòng. ($firstErrorField) không hợp lệ.");
    //         }
    //         // Lấy thông tin từ request
    //         $room_adults = $request->input('adults');
    //         $room_children = $request->input('children');
    //         $room_checkin = $request->input('checkIn');
    //         $room_checkout = $request->input('checkOut');

    //         // Lấy danh sách các phòng thỏa mãn yêu cầu
    //         $rooms = Room::with('images', 'packages', 'amenities', 'roomType', 'sale')
    //             ->where(function ($query) use ($room_adults, $room_children) {
    //                 $query->where('adults', '>=', $room_adults)
    //                     ->where('children', '>=', $room_children)
    //                     ->where('status', 'work');
    //             })
    //             ->get();

    //         // Lấy danh sách các phòng đã được giữ trong khoảng thời gian yêu cầu
    //         $occupiedRooms = KeepRoom::where(function ($query) use ($room_checkin, $room_checkout) {
    //             $query->where(function ($subQuery) use ($room_checkin, $room_checkout) {
    //                 $subQuery->whereBetween('check_in', [$room_checkin, $room_checkout])
    //                     ->orWhereBetween('check_out', [$room_checkin, $room_checkout]);
    //             });
    //         })
    //             ->pluck('room_id')
    //             ->toArray();

    //         // Lọc danh sách phòng, loại bỏ các phòng đã được giữ
    //         $availableRooms = $rooms->filter(function ($room) use ($occupiedRooms) {
    //             return !in_array($room->id, $occupiedRooms);
    //         });

    //         // Trả lại kết quả hoặc thực hiện các bước tiếp theo

    //         return response()->json($availableRooms);
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', 'Không tìm thấy phòng.vui lòng thao tác lại');
    //     }
    // }
    public function createReservationsItem()
    {
        return view('newReservations');
    }
    // public function create(Request $request)
    // {
    //     try {
    //     $validator = Validator::make($request->all(), [
    //         'full_name' => 'required|max:55',
    //         'email' => 'required|email|unique:customer,email|max:100',
    //         'address' => 'required|max:255',
    //         'phone_number' => ['required', 'size:10', 'regex:/^0[0-9]*$/'],
    //     ]);
    //     if ($validator->fails()) {
    //         $errors = $validator->errors();

    //         // Lấy tên trường lỗi đầu tiên
    //         $firstErrorField = $errors->keys()[0];

    //         return redirect()->back()->with('error', "Thêm không thành công. ($firstErrorField) không hợp lệ.");
    //     }
    //     // Cập nhật thông tin
    //     $customer = new Reservations;
    //     $customer->full_name = $request->input('full_name');
    //     $customer->email = $request->input('email');
    //     $customer->address = $request->input('address');
    //     $customer->phone_number = $request->input('phone_number');
    //     //update date
    //     $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');
    //     $customer->create_at = $currentDateTime;
    //     $customer->update_at = $currentDateTime;
    //     $customer->save();
    //     return redirect()->back()->with('success', 'Thông tin đã được thêm thành công.');

    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', 'Lỗi thao tác.Kiểm tra lại dữ liệu');
    //     }

    // }

    // public function update(Request $request, $encodedId)
    // {
    //     try {
    //         $customerId = Crypt::decrypt($encodedId);
    //     $customer = Customer::find($customerId);
    //     if (!$customer) {
    //         return redirect()->back()->with('error', 'Không tìm thấy khách hàng.vui lòng thao tác lại');
    //     } else if ($customer->updated_at != $request->input('update')) {
    //         return redirect()->back()->with('error', 'Hãy cập nhật dữ liệu mới nhất trước khi sửa thông tin.');
    //     }
    //     $validator = Validator::make($request->all(), [
    //         'full_name' => 'required|max:55',
    //         'email' => [
    //             'required',
    //             'email',
    //             Rule::unique('customer', 'email')->ignore($customer->customer_id, 'customer_id') // Đặt tên bảng và tên cột của bảng bạn muốn kiểm tra
    //         ],
    //         'address' => 'required|max:255',
    //         'phone_number' => ['required', 'size:10', 'regex:/^0[0-9]*$/'],
    //     ]);
    //     if ($validator->fails()) {
    //         $errors = $validator->errors();

    //         // Lấy tên trường lỗi đầu tiên
    //         $firstErrorField = $errors->keys()[0];

    //         return redirect()->back()->with('error', "Sửa không thành công. ($firstErrorField) không hợp lệ.");
    //     }
    //     // Cập nhật thông tin
    //     $customer->full_name = $request->input('full_name');
    //     $customer->email = $request->input('email');
    //     $customer->address = $request->input('address');
    //     $customer->phone_number = $request->input('phone_number');
    //     //update date
    //     $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');
    //     $customer->updated_at = $currentDateTime;
    //     $customer->save();
    //     return redirect()->back()->with('success', 'Thông tin đã được cập nhật thành công.');

    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', 'Lỗi thao tác.Kiểm tra lại dữ liệu');
    //     }

    // }
    public function showInvoicesList()
    {
    }
    public function showPaymentList()
    {
    }
}
