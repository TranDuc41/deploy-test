<?php

namespace App\Http\Controllers;
use App\Models\Amenities;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AmenitiesController extends Controller
{
    public function index()
    {
        $amenities = Amenities::paginate(10);
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
            'name' => 'required|max:500',
            'slug' => 'required|max:500|unique:amenities,slug',
        ]);
        if ($validator->fails()) {
            return redirect()->route('amenities')->with('error', 'Thêm không thành công. Hãy kiểm tra lại dữ liệu nhập.');
        }
        $amenities = new Amenities;
        $amenities->name = $request->input('name');
        $amenities->slug = $request->input('slug');

        $amenities->save();
        return redirect()->route('amenities')->with('success', 'Tiện ích đã được thêm thành công.');
    }

    public function update(Request $request, $encodedAmenities_id)
    {
        //chuỗi mã hóa
        
        // tách chuỗi key và  encodedUserId
        $hashID = substr($encodedAmenities_id, 0, 1) . substr($encodedAmenities_id, 6);
        // giải mã
        $decodedAmenities_id = base64_decode($hashID);
        $amenities = Amenities::find($decodedAmenities_id);
        
        if (!$amenities) {
            return redirect()->route('amenities')->with('error', 'Sửa không thành công. Hãy kiểm tra lại dữ liệu nhập.');
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
        //update date
        $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');
        $amenities->updated_at = $currentDateTime;
        $amenities->save();
       
        return redirect('amenities')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }
    public function delete($encodedAmenities_id)
    {
       // tách chuỗi key và  encodedUserId
       $hashID = substr($encodedAmenities_id, 0, 1) . substr($encodedAmenities_id, 6);
       // giải mã
       $decodedAmenities_id = base64_decode($hashID);
       $amenities = Amenities::find($decodedAmenities_id);
        if (!$amenities) {
            return redirect()->route('amenities');
        }
        // Xóa
        $amenities->delete();

        return redirect('amenities')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}
