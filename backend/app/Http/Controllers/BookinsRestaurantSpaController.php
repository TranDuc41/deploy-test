<?php

namespace App\Http\Controllers;

use App\Models\BookingRestaurantSpa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use DateTime;

class BookinsRestaurantSpaController extends Controller
{
    public function show($id)
    {
        try {
            $bookingRestaurantSpaModel = new BookingRestaurantSpa();
            $bookingRestaurantSpa = $bookingRestaurantSpaModel->findBookingsId($id);

            if ($bookingRestaurantSpa) {
                return response()->json($bookingRestaurantSpa);
            } else {
                // Xử lý khi không tìm thấy nhà hàng
                return redirect()->route('restaurant')->with('error', 'Nội dung không tồn tại!');
            }
        } catch (\Throwable $th) {
            return redirect()->route('restaurant')->with('error', 'Nội dung không tồn tại!');
        }
    }

    public function update(Request $request, $id)
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
                return redirect()->route('restaurant')->with('error', 'Số điện thoại không hợp lệ!');
            } elseif (!isValidEmail($request->email)) {
                return redirect()->route('restaurant')->with('error', 'email không hợp lệ!');
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
                return redirect()->route('restaurant')->with('error', 'Sửa không thành công. Kiểm tra nội dung nhập vào!' . implode(', ', $errors));
            }

            $bookingRestaurantSpaModel = new BookingRestaurantSpa();
            $bookingRestaurantSpa = $bookingRestaurantSpaModel->findBookingsId($id);
            $databaseDateTime = $request->input('time_update');
            $carbonDateTime = Carbon::parse($databaseDateTime);

            if ($bookingRestaurantSpa) {

                $isUpdatedAtMatch = $bookingRestaurantSpa->isUpdatedAtMatch($carbonDateTime, $bookingRestaurantSpa->updated_at);

                if($isUpdatedAtMatch){
                    $dateTime = new DateTime($request->input('date'));
                    $formattedDate = $dateTime->format('d/m/Y');

                    $bookingRestaurantSpa->full_name = $request->input('name');
                    $bookingRestaurantSpa->phone_number = $request->input('phone_number');
                    $bookingRestaurantSpa->date_time = $formattedDate.' - '.$request->input('time');
                    $bookingRestaurantSpa->note = $request->input('note');
                    $bookingRestaurantSpa->email = $request->input('email');

                    $bookingRestaurantSpa->save();
                    return redirect()->route('restaurant')->with('success', 'Cập nhật thành công.');
                }
                else{
                    return redirect()->route('restaurant')->with('error', 'Đã có dữ liệu mới hơi. Tải lại trang và thử lại!');
                }
            } else {
                return redirect()->route('restaurant')->with('error', 'Không tìm thấy lịch đặt!');
            }
        } catch (\Throwable $th) {
            return redirect()->route('restaurant')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!');
        }
    }

    public function destroy($id)
    {
        try {
            $bookingRestaurantSpaModel = new BookingRestaurantSpa();
            $bookingRestaurantSpa = $bookingRestaurantSpaModel->findBookingsId($id);

            if($bookingRestaurantSpa) {
                $bookingRestaurantSpa->delete();
                return redirect()->route('restaurant')->with('success', 'Xóa thành công.');
            }else {
                return redirect()->route('restaurant')->with('error', 'Không tìm thấy lịch đặt!');
            }
        } catch (\Throwable $th) {
            return redirect()->route('restaurant')->with('error', 'Có lỗi xảy ra, vui lòng thử lại!' . $th->getMessage());
        }
    }
}
