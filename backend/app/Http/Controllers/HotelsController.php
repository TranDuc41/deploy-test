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

        // Áp dụng phân trang với 10 bản ghi mỗi trang
        $hotels = $query->paginate(10);
        return view('hotels', compact('hotels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Kiểm tra số điện thoại đã tồn tại hay chưa
        $existingHotel = Hotels::where('phone', $request->input('phone'))->first();

        if ($existingHotel) {
            // Nếu số điện thoại đã tồn tại, hiển thị thông báo lỗi
            return redirect()->back()->with('error', 'Số điện thoại đã tồn tại. Vui lòng chọn số điện thoại khác.');
        }
        try {

            // Nếu số điện thoại chưa tồn tại, tiến hành validation và thêm mới
            $validatedData = $request->validate([
                'name' => 'required|max:55',
                'ward' => 'required',
                'district' => 'required',
                'city' => 'required',
                'phone' => ['required', 'size:10', 'regex:/^0[0-9]*$/'],
            ]);

            // Tạo giá trị cho trường 'address' sau khi đã xác minh
            $address = $request->input('ward') . ' ' . $request->input('district') . ' ' . $request->input('city');

            // Tạo instance mới của model Hotel và lưu vào cơ sở dữ liệu
            $hotel = new Hotels([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $address,
            ]);

            $hotel->save();

            return redirect()->route('hotels')->with('success', 'Khách sạn mới đã được thêm thành công.');
        } catch (\Exception $e) {
            // Trường hợp xảy ra lỗi, chuyển hướng và gửi thông báo lỗi
            return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
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

        // Kiểm tra số điện thoại đã tồn tại hay chưa
        $existingHotel = Hotels::where('phone', $request->input('phone'))->first();

        if ($existingHotel) {
            // Nếu số điện thoại đã tồn tại, hiển thị thông báo lỗi
            return redirect()->back()->with('error', 'Số điện thoại đã tồn tại. Vui lòng chọn số điện thoại khác.');
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
            return redirect()->route('hotels.index')->with('error', 'Không tìm thấy Hotel');
        }

        $hotel->delete();

        return redirect()->route('hotels.index')->with('success', 'Xóa thành công.');
    }
}
