<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(){
        try {
            $customer = Customer::paginate(20);
            return view('customer', compact('customer'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Hành động sảy ra lỗi.');
        }  
    }
    public function create(){
        
    }
    public function update(){
        
    }
    public function destroy(){
        
    }
}
