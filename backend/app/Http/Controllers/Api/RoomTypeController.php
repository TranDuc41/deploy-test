<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = DB::table('room_type')->orderBy('rty_id', 'desc')->get();
        return response()->json($roomTypes);
    }
}
