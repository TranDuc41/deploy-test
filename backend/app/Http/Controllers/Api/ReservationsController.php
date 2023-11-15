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
    public function index($adults, $children, $roomType)
    {
        try {
            $room = Room::with('images', 'packages', 'amenities', 'roomType', 'sale')
                ->where('adults', '>=', $adults)
                ->where('children', '>=', $children)
                ->where('rty_id', $roomType)
                ->where('status', 'work')
                ->get();
            return response()->json(['rooms' => $room]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Room not found'], 404);
        }
    }
}
