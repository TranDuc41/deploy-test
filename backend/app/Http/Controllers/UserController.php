<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class UserController extends Controller
{
    public function index()
    {
        $results = DB::table('users')->get();
        return view('users', compact('results'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name-user' => 'required|max:55',
            'email-user' => 'required|email|max:55',
            'pass-user' => 'required|max:255',
            'type' => 'required|max:11',
            'active-user' => 'required|numeric|max:10',
        ]);

        if ($validator->fails()) {
            return redirect('users')
                ->withErrors($validator)
                ->withInput();
        }

        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu hay chưa
        $existingUser = DB::table('users')->where('email', $request->input('email-user'))->first();

        if ($existingUser) {
            // Người dùng đã tồn tại
            return redirect('users')->with('error', 'Người dùng với địa chỉ email này đã tồn tại.')->withInput();
        }

        // Người dùng chưa tồn tại, tiếp tục thêm người dùng mới vào cơ sở dữ liệu
        $currentDateTime = now();

        DB::table('users')->insert([
            'name' => $request->input('name-user'),
            'email' => $request->input('email-user'),
            'password' => Hash::make($request->input('pass-user')),
            'user_type' => $request->input('type'),
            'active' => $request->input('active-user'),
            'created_at' => $currentDateTime,
        ]);

        return redirect('users')->with('success', 'Người dùng đã được thêm thành công!');
    }

    public function store(Request $request)
    {
        // Logic để lưu dữ liệu từ $request vào cơ sở dữ liệu
    }

    public function show($id)
    {
        $result = DB::table('users')->select('name', 'email', 'uesr_type', 'active')->where('user_id', '=', $id)->first();
        return response()->json($result);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id); // Tìm user cần cập nhật thông tin

        // Kiểm tra xem user có tồn tại hay không
        if (!$user) {
            return redirect()->back()->with('error', 'Người dùng không tồn tại.');
        }

        // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu hay chưa
        $existingEmail = User::where('email', $request->input('email'))->where('user_id', '!=', $id)->exists();

        if ($existingEmail) {
            // Email đã tồn tại trong cơ sở dữ liệu
            return redirect()->back()->with('error', 'Email đã tồn tại.');
        }

        // Cập nhật thông tin user
        $user->name = $request->input('user-name');
        $user->email = $request->input('user-email');
        $user->uesr_type = $request->input('Select-role');
        $user->active = $request->input('Select-active');
        $user->save();

        // Xử lý logic thành công
        return redirect()->route('users')->with('success', 'Dữ liệu đã được cập nhật thành công.');
    }

    public function destroy($id)
    {
        // Logic để xóa dữ liệu có ID tương ứng từ cơ sở dữ liệu
    }
}
