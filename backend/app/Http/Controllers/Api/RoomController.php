<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('roomType', 'sale', 'packages', 'amenities', 'images')->orderBy('room_id', 'desc')->get();
        // Ẩn các trường 'rty_id' và 'sale_id'
        $rooms->makeHidden(['rty_id', 'sale_id']);
        return response()->json($rooms);
    }
}
