<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        try {
           
            $customers = Customer::paginate(10);

            // Mã hóa ID của khách hàng và truyền nó vào view
            $encodedCustomers = $customers->map(function ($customer) {
                $customer->encoded_id =  Crypt::encrypt($customer->customer_id);
                return $customer;
            });

            return view('customer', compact('encodedCustomers'));
        } catch (\Throwable $th) {
            return view('/');
        }
    }
    public function show($encodedId)
    {
        try {
            $customerId = Crypt::decrypt($encodedId);
            $customer = Customer::find($customerId);
            if (!$customer) {
                return redirect()->back()->with('error', 'Không tìm thấy khách hàng.vui lòng thao tác lại');
            }
            $customer->encoded_id =  Crypt::encrypt($customer->customer_id);
            return view('detailcustomer', compact('customer'));
            // return response()->json($customer);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Không tìm thấy khách hàng.vui lòng thao tác lại');
        }
    }
    public function create(Request $request)
    {
        // try {

        // } catch (\Throwable $th) {
        //     return redirect()->back()->with('error', 'Lỗi thao tác.Kiểm tra lại dữ liệu');
        // }
        $validator = Validator::make($request->all(), [
            'prefix' => 'required|in:Ông,Bà',
            'full_name' => 'required|max:55',
            'email' => 'required|email|unique:customer,email|max:100',
            'address' => 'required|max:255',
            'phone_number' => ['required', 'size:10', 'regex:/^0[0-9]*$/'],
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();

            // Lấy tên trường lỗi đầu tiên
            $firstErrorField = $errors->keys()[0];

            return redirect()->back()->with('error', "Thêm không thành công. ($firstErrorField) không hợp lệ.");
        }
        // Cập nhật thông tin
        $customer = new Customer;
        $customer->prefix = $request->input('full_name');
        $customer->full_name = $request->input('full_name');
        $customer->email = $request->input('email');
        $customer->address = $request->input('address');
        $customer->phone_number = $request->input('phone_number');
        $customer->status = '1';
        $customer->save();
        return redirect()->back()->with('success', 'Thông tin đã được thêm thành công.');
    }
    public function update(Request $request, $encodedId)
    {
        try {
            if (!$encodedId) {
                return redirect()->route('customer.index')->with('error', 'Không tìm thấy khách hàng.vui lòng thao tác lại');
            }
            $customerId = Crypt::decrypt($encodedId);
            $customer = Customer::find($customerId);
            if (!$customer) {
                return redirect()->back()->with('error', 'Không tìm thấy khách hàng.vui lòng thao tác lại');
            } else if ($customer->updated_at != $request->input('update')) {
                return redirect()->back()->with('error', 'Hãy cập nhật dữ liệu mới nhất trước khi sửa thông tin.');
            }
            $validator = Validator::make($request->all(), [
                'full_name' => 'required|max:55',
                'email' => [
                    'required',
                    'email',
                    Rule::unique('customer', 'email')->ignore($customer->customer_id, 'customer_id') // Đặt tên bảng và tên cột của bảng bạn muốn kiểm tra
                ],
                'address' => 'required|max:255',
                'phone_number' => ['required', 'size:10', 'regex:/^0[0-9]*$/'],
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();

                // Lấy tên trường lỗi đầu tiên
                $firstErrorField = $errors->keys()[0];

                return redirect()->back()->with('error', "Sửa không thành công. ($firstErrorField) không hợp lệ.");
            }
            // Cập nhật thông tin
            $customer->full_name = $request->input('full_name');
            $customer->email = $request->input('email');
            $customer->address = $request->input('address');
            $customer->phone_number = $request->input('phone_number');
            //update date
            $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');
            $customer->updated_at = $currentDateTime;
            $customer->save();
            return redirect()->back()->with('success', 'Thông tin đã được cập nhật thành công.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Lỗi thao tác.Kiểm tra lại dữ liệu');
        }
    }
    public function delete($encodedId)
    {
        try {
            if (!$encodedId) {
                return redirect()->route('customer.index')->with('error', 'Không tìm thấy khách hàng.vui lòng thao tác lại');
            }
            $customerId = Crypt::decrypt($encodedId);
            $customer = Customer::find($customerId);
            if (!$customer) {
                return redirect()->back()->with('error', 'Không tìm thấy khách hàng.vui lòng thao tác lại');
            }
            $customer->status = '0';
            $customer->save();
            return redirect()->route('customer.index')->with('success', 'Xóa thành công.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Lỗi thao tác.Kiểm tra lại dữ liệu');
        }
    }
}
