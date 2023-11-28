<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Spa;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\BookingRestaurantSpa;

class SpaController extends Controller
{
    public function index()
    {
        $spas = Spa::with('images')->orderByDesc('sw_id')->take(6)->get();
    return response()->json($spas);
    }

    public function create(Request $request)
    {
        // Xử lý dữ liệu được gửi từ Next.js
        $requestData = $request->json()->all();

        // Kiểm tra chữ ký (sử dụng secretKey từ .env hoặc cấu hình khác)
        $receivedSignature = $requestData['signature'];
        $expectedSignature = hash_hmac('sha256', json_encode($requestData['data'], JSON_UNESCAPED_UNICODE), env('NEXTJS_SECRET_KEY'));

        if ($receivedSignature === $expectedSignature) {
            // Chữ ký hợp lệ, xử lý dữ liệu và trả về phản hồi
            // Log::info('Received Data: ', $requestData['data']);
            $data =  $requestData['data'];

            $date = $data['date'];
            $formattedDate = Carbon::createFromFormat('dmY', $date)->format('d/m/Y');

            $spaId = Spa::where('slug', $data['spa'])->value('sw_id');

            if ($spaId) {
                $bookingRestaurantSpa = new BookingRestaurantSpa();

                $bookingRestaurantSpa->sw_id = isset($data['spa']) ? $spaId : null;
                $bookingRestaurantSpa->restaurant_id = null;
                $bookingRestaurantSpa->full_name = $data['fullName'];
                $bookingRestaurantSpa->phone_number = $data['phone'];
                $bookingRestaurantSpa->date_time = $formattedDate . ' - ' . $data['time'];
                $bookingRestaurantSpa->email = $data['email'];
                $bookingRestaurantSpa->note = isset($data['note']) ? $data['note'] : '';

                $bookingRestaurantSpa->save();

                // Log::info($formattedDate);
                return response()->json(['success' => true, 'message' => 'Request processed successfully']);
            }else{
                return response()->json(['success' => false, 'message' => 'Invalid signature'], 404);
            }
        } else {
            // Chữ ký không hợp lệ, trả về lỗi
            return response()->json(['success' => false, 'message' => 'Invalid signature'], 403);
        }
    }
}
