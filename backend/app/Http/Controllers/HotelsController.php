<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotels;

class HotelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)

    {
        $query = Hotels::query(); 

        // Nếu có truy vấn tìm kiếm, lọc kết quả
        if ($request->has('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('address', 'LIKE', '%' . $request->search . '%')
                ->orWhere('phone', 'LIKE', '%' . $request->search . '%');
        }

        $hotels = $query->get();
        return view('hotels', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate dữ liệu đầu vào
            $validatedData = $request->validate([
                'name' => 'required|max:55',
                'address' => 'required|max:255',
                'phone' => 'required|size:10'
            ]);

            // Tạo bản ghi mới
            Hotels::create($validatedData);

            // Chuyển hướng với thông báo thành công
            return redirect('hotels')->with('success', 'Khách sạn mới đã được thêm thành công.');
        } catch (\Exception $e) {
            // Trường hợp xảy ra lỗi, chuyển hướng và gửi thông báo lỗi
            return redirect()->back()->with('err', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $hotel_id)
    {
        $hotel = Hotels::find($hotel_id);

        if (!$hotel) {
            return redirect()->route('hotels.index')->with('error', 'Hotel not found');
        }

        $hotel->name = $request->input('name');
        $hotel->address = $request->input('address');
        $hotel->phone = $request->input('phone');
        $hotel->save();

        return redirect()->route('hotels.index')->with('success', 'Hotel updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($hotel_id)
    {
        $hotel = Hotels::find($hotel_id);

        if (!$hotel) {
            return redirect()->route('hotels.index')->with('Lỗi', 'Không tìm thấy Hotel');
        }

        $hotel->delete();

        return redirect()->route('hotels.index')->with('Thành công ', 'Xóa thành công.');
    }
}
