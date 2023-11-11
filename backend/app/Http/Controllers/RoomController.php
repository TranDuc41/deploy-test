<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class RoomController extends Controller
{
    public function index()
    {
        return view('rooms');
    }

    public function create()
    {
        $currentDate = Carbon::now();

        $roomTypes = DB::table('room_type')->get();
        $sales = DB::table('sale')->where('end_date', '>=', $currentDate)->get();
        $packages = DB::table('packages')->get();
        return view('editRoom', compact('roomTypes', 'sales', 'packages'));
    }

    public function store(Request $request)
    {
        dd($request);
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        // Xử lý hiển thị form chỉnh sửa hình ảnh có ID là $id
    }

    public function update(Request $request, $id)
    {
        $roomId = 1;
        return view('editRoom', compact('roomId'));
    }

    public function destroy($id)
    {
    }
}
