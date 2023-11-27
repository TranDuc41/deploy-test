<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookingRestaurantSpa;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with('images')->select('*')->orderBy('restaurant_id', 'desc')->take(10)->get();
        return response()->json($restaurants);
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

            $restaurantId = Restaurant::where('slug', $data['restaurant'])->value('restaurant_id');

            $bookingRestaurantSpa = new BookingRestaurantSpa();

            $bookingRestaurantSpa->sw_id = isset($data['spa']) ? $data['spa'] : null;
            $bookingRestaurantSpa->restaurant_id = $restaurantId;
            $bookingRestaurantSpa->full_name = $data['fullName'];
            $bookingRestaurantSpa->phone_number = $data['phone'];
            $bookingRestaurantSpa->date_time = $formattedDate .' - '. $data['time'];
            $bookingRestaurantSpa->email = $data['email'];
            $bookingRestaurantSpa->note = isset($data['note']) ? $data['note'] : '';

            $bookingRestaurantSpa->save();

            // Log::info($formattedDate);
            return response()->json(['success' => true, 'message' => 'Request processed successfully']);
        } else {
            // Chữ ký không hợp lệ, trả về lỗi
            return response()->json(['success' => false, 'message' => 'Invalid signature'], 403);
        }
    }
}
