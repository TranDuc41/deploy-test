<?php

namespace App\Http\Controllers;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Psy\Readline\Hoa\Console;

class SaleController extends Controller
{
    public function index()
    {
        $sale = Sale::all();
        $currentDateTime = Carbon::now();
        return view('sale', compact('sale','currentDateTime'));
    }
    public function show($sale_id)
    {
        $sale = Sale::find($sale_id );
        return response()->json($sale);
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'discount' => 'required|min:1|max:100',
            'start_date' => 'required|date|date_format:Y-m-d H:i:s',
            'end_date' => 'required|date|date_format:Y-m-d H:i:s',
            'ad_id ' => 'required|max:100',
        ]);
        if ($validator->fails()) {
            return redirect()->route('sales')->withErrors('success', 'Thêm không thành công.Hãy kiểm tra lại dữ liệu nhập.');
        }
        $sale = new Sale;
        $sale->discount = $request->input('discount');
        $sale->start_date = $request->input('start_date');
        $sale->end_date = $request->input('end_date');
        $sale->ad_id = $request->input('ad_id');
        $sale->save();
        return redirect()->route('sales')->with('success', 'Mã đã được thêm thành công.');
    }

    public function update(Request $request, $sale_id )
    {
        
        $sale = Sale::find($sale_id );

        $validator = Validator::make($request->all(), [
            'discount' => 'required|min:1|max:100',
            'start_date' => 'required|date|date_format:Y-m-d H:i:s',
            'end_date' => 'required|date|date_format:Y-m-d H:i:s',
            'ad_id ' => 'required|max:100',
        ]);
        if ($validator->fails()) {
            return redirect()
                ->route('sales')
                ->withErrors('errors', 'Sửa không thành công.Hãy kiểm tra lại dữ liệu nhập.');

        }
        if (!$sale) {
            return redirect()->route('sales')->withErrors('errors', 'Sửa không thành công.Hãy kiểm tra lại dữ liệu nhập.');
        }
        
        // Cập nhật thông tin
        $sale->discount = $request->input('discount');
        $sale->start_date = $request->input('start_date');
        $sale->end_date = $request->input('end_date');
        $sale->ad_id = $request->input('ad_id');

        $sale->save();
        return redirect('sale')->with('success', 'Mã đã được cập nhật thành công.');
    }
    public function delete($sale_id )
    {
        // Tìm sản phẩm cần xóa
        $sale = Sale::find($sale_id );
        if (!$sale) {
            return redirect()->route('sales')->withErrors('errors', 'Xóa không thành công.Hãy kiểm tra lại dữ liệu nhập.');
        }
        // Xóa
        $sale->delete();

        return redirect('sale')->with('success', 'Mã đã được xóa thành công.');
    }
}
