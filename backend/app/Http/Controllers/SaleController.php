<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Psy\Readline\Hoa\Console;

class SaleController extends Controller
{
    public function index()
    {
        $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d\TH:i');
        $sales = Sale::with('user')->paginate(4);

        return view('sale', compact('sales', 'currentDateTime'));
    }
    public function show($sale_id)
    {
        $sale = Sale::find($sale_id);
        if ($sale) {
            // Định dạng lại trường ngày giờ theo định dạng js
            $sale->start_date = Carbon::parse($sale->start_date)->format('Y-m-d\TH:i');
            $sale->end_date = Carbon::parse($sale->end_date)->format('Y-m-d\TH:i');

        } else {
            return redirect()->route('sales')->with('error', 'Không tìm thấy dữ liệu.');
        }
        return response()->json($sale);
    }
    public function create(Request $request)
    {
        //chuỗi mã hóa
        $encodedUserId  = $request->input('user_id');
        
        
        // tách chuỗi key và  encodedUserId
        $hashID = substr($encodedUserId, 0, 1) . substr($encodedUserId, 6);
        // giải mã
        $decodedUserId = base64_decode($hashID);
        $admin = Sale::with('user')->where('user_id', $decodedUserId);
        if (!$admin) {
            return redirect()->route('sales')->with('error', 'Sửa không thành công.Việc này vượt quá quyền truy cập của bạn.');
        }
        $validator = Validator::make($request->all(), [
            'discount' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
        if ($validator->fails()) {
            return redirect()->route('sales')->with('error', 'Thêm không thành công.Hãy kiểm tra lại dữ liệu nhập.');
        }
        $sale = new Sale;
        $sale->discount = $request->input('discount');
        $sale->start_date = $request->input('start_date');
        $sale->end_date = $request->input('end_date');
        $sale->user_id =  $decodedUserId;
        $sale->save();
        return redirect()->route('sales')->with('success', 'Mã đã được thêm thành công.');
    }

    public function update(Request $request, $sale_id)
    {
        //chuỗi mã hóa
        $encodedUserId  = $request->input('user_id_edit');
        
        // tách chuỗi key và  encodedUserId
        $hashID = substr($encodedUserId, 0, 1) . substr($encodedUserId, 6);
        // giải mã
        $decodedUserId = base64_decode($hashID);

        $sale = Sale::find($sale_id);
        $sp_admin = Sale::with('user')->where('user_id', $decodedUserId);
        if (!$sp_admin) {
            return redirect()->route('sales')->with('error', 'Việc này vượt quá quyền truy cập của bạn.');
        }
        $validator = Validator::make($request->all(), [
            'discount' => 'required|min:1|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->route('sales')
                ->with('error', 'Sửa không thành công.Hãy kiểm tra lại dữ liệu nhập.');
        }
        if (!$sale) {
            return redirect()->route('sales')->with('error', 'Sửa không thành công.Hãy kiểm tra lại dữ liệu nhập.');
        }
        $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');
        // Cập nhật thông tin
        $sale->discount = $request->input('discount');
        $sale->start_date =  Carbon::parse($request->input('start_date'))->format('Y-m-d H:i:s');
        $sale->end_date = Carbon::parse($request->input('end_date'))->format('Y-m-d H:i:s');
        $sale->updated_at = $currentDateTime;
        $sale->save();
        return redirect('sale')->with('success', 'Mã đã được cập nhật thành công.');
    }
    public function delete($sale_id)
    {
        // Tìm sản phẩm cần xóa
        $sale = Sale::find($sale_id);
        if (!$sale) {
            return redirect()->route('sales')->withErrors('error', 'Xóa không thành công.Hãy kiểm tra lại dữ liệu nhập.');
        }
        // Xóa
        $sale->delete();

        return redirect('sale')->with('success', 'Mã đã được xóa thành công.');
    }
}
