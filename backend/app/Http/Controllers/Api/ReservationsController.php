<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

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
}
