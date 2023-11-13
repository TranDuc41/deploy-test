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
    public function index()
    {

        $hotels = Hotels::all(); // Hoặc lấy hotels theo một điều kiện cụ thể
        $infos = Info::with('hotel')->get();
        return view('info', compact('infos', 'hotels'));
        $infoCount = Info::count(); // Đếm tổng số ID
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
            'content' => 'required',
        ]);

        Info::create($validated);
        return redirect()->route('info.index')->with('success', 'Info created successfully');
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
    $hotels = Hotels::all(); // Assuming you want to list all hotels in the dropdown

    // Pass the 'info' and 'hotels' data to the edit view
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
        'content' => 'required',
    ]);

    $info->update($validatedData);

    return redirect()->route('info.index')->with('success', 'Information updated successfully');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($info_id)
{
    // Tìm bản ghi thông tin dựa trên info_id
    $info = Info::findOrFail($info_id);

    // Optional: Kiểm tra quyền xóa thông tin
    // $this->authorize('delete', $info);

    // Xóa bản ghi và kiểm tra kết quả
    if ($info->delete()) {
        // Nếu xóa thành công, chuyển hướng với thông báo success
        return redirect()->route('info.index')->with('success', 'Info deleted successfully.');
    } else {
        // Nếu xóa không thành công, chuyển hướng với thông báo error
        return redirect()->route('info.index')->with('error', 'An error occurred while deleting the info.');
    }
}
}
