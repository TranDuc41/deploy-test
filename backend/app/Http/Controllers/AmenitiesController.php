<?php

namespace App\Http\Controllers;
use App\Models\Amenities;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AmenitiesController extends Controller
{
    public function index()
    {
        $amenities = Amenities::all();
        return view('amenities', compact('amenities'));
    }
    public function show($amenities_id)
    {
        $amenities = Amenities::find($amenities_id);
        return response()->json($amenities);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'slug' => 'required|max:100',
        ]);
        if ($validator->fails()) {
            return redirect()->route('amenities')->with('error', 'Sửa không thành công. Hãy kiểm tra lại dữ liệu nhập.');
        }
        $amenities = new Amenities;
        $amenities->name = $request->input('name');
        $amenities->slug = $request->input('slug');

        $amenities->save();
        return redirect()->route('amenities')->with('success', 'Room type added successfully.');
    }

    public function update(Request $request, $amenities_id)
    {
        
        $amenities = Amenities::find($amenities_id);
        
        if (!$amenities) {
            return redirect()->route('amenitiess')->with('error', 'Sửa không thành công. Hãy kiểm tra lại dữ liệu nhập.');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'slug' => 'required|max:100',
        ]);
        if ($validator->fails()) {
            return redirect()->route('amenities')->with('error', 'Sửa không thành công. Hãy kiểm tra lại dữ liệu nhập.');
        }
        // Cập nhật thông tin
        $amenities->name = $request->input('name');
        $amenities->slug = $request->input('slug');
        $amenities->save();
       
        return redirect('amenities')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }
    public function delete($amenities_id)
    {
        // Tìm sản phẩm cần xóa
        $amenities = Amenities::find($amenities_id);
        if (!$amenities) {
            return redirect()->route('amenities');
        }
        // Xóa
        $amenities->delete();

        return redirect('amenities')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}
