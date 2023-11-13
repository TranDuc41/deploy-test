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
        $currentDateTime = Carbon::now();
        $sales = Sale::with('user')->get();

        return view('sale', compact('sales','currentDateTime'));
    }
    public function show($sale_id)
    {
        $sale = Sale::find($sale_id );
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

        $validator = Validator::make($request->all(), [
            'discount' => 'required|numeric|max:100',
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

    public function update(Request $request, $sale_id )
    {
        $sale = Sale::find($sale_id );
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
        
        // Cập nhật thông tin
        $sale->discount = $request->input('discount');
        $sale->start_date = $request->input('start_date');
        $sale->end_date = $request->input('end_date');

        $sale->save();
        return redirect('sale')->with('success', 'Mã đã được cập nhật thành công.');
    }
    public function delete($sale_id )
    {
        // Tìm sản phẩm cần xóa
        $sale = Sale::find($sale_id );
        if (!$sale) {
            return redirect()->route('sales')->withErrors('error', 'Xóa không thành công.Hãy kiểm tra lại dữ liệu nhập.');
        }
        // Xóa
        $sale->delete();

        return redirect('sale')->with('success', 'Mã đã được xóa thành công.');
    }
}
