<?php

namespace App\Http\Controllers;

use App\Models\Info;
use App\Models\Hotels;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $page = $request->input('page', 1); // Lấy số trang từ URL, mặc định là 1 nếu không có
        $perPage = 10; // Số bản ghi trên mỗi trang

        // Kiểm tra xem trang có tồn tại không
        $infos = Info::with('hotel')->paginate($perPage, ['*'], 'page', $page);

        if ($infos->isEmpty() && $page > 1) {
            // Nếu trang không tồn tại và người dùng nhập số trang lớn hơn 1
            abort(404, 'Page not found');
        }

        $hotels = Hotels::all();

        return view('info', compact('infos', 'hotels'));
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
        $validated = $request->validate([
            'title' => 'required|max:255',
            'link' => 'nullable|url',
            'hotel_id' => 'required|exists:hotels,hotel_id',
            'content' => 'required|max:255',
        ]);

        Info::create($validated);
        return redirect()->route('info.index')->with('success', 'Thêm Info thành công. ');
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
    // Inside InfoController.php

    public function edit($info_id)
    {
        $info = Info::findOrFail($info_id);
        $hotels = Hotels::all(); // 
        return view('info.edit', compact('info', 'hotels'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $info_id)
    {
        $info = Info::findOrFail($info_id);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'link' => 'nullable|url',
            'hotel_id' => 'required|exists:hotels,hotel_id', // Đảm bảo hotel_id tồn tại trong bảng hotels
            'content' => 'required|max:255',
        ]);

        $info->update($validatedData);

        return redirect()->route('info.index')->with('success', 'Cập nhật info thành công ');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($info_id)
    {
        // Tìm bản ghi thông tin dựa trên info_id
        $info = Info::findOrFail($info_id);
        // Xóa bản ghi và kiểm tra kết quả
        if ($info->delete()) {
            // Nếu xóa thành công, chuyển hướng với thông báo success
            return redirect()->route('info.index')->with('success', 'Info đã được xóa thành công.');
        } else {
            // Nếu xóa không thành công, chuyển hướng với thông báo error
            return redirect()->route('info.index')->with('error', ' Xóa không thành công.');
        }
    }
}
