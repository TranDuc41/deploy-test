<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $results = DB::table('users')->whereNull('deleted_at')->orderByDesc('user_id')->paginate(10);
        $totalUsers = DB::table('users')->whereNull('deleted_at')->count();
        return view('users', compact('results', 'totalUsers'));
    }

    public function create(Request $request)
    {
        $user_id = Auth::id();

        if ($user_id) {

            $user = User::find($user_id);

            if ($user && $user->uesr_type === 'sp-admin') {

                $validator = Validator::make($request->all(), [
                    'name-user' => 'required|max:55',
                    'email-user' => 'required|email|max:55',
                    'pass-user' => 'required|max:255',
                    'type' => 'required|max:11',
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

                $currentDateTime = now();

                $requestedType = $request->input('type');
                // kiểm tra xem giá trị của '$request->input('type')' có tồn tại trong mảng
                if (!in_array($requestedType, ['staff', 'admin', 'sp-admin'])) {

                    return redirect()->back()->with('error', 'Vai trò không hợp lệ!');
                }

                DB::table('users')->insert([
                    'name' => $request->input('name-user'),
                    'email' => $request->input('email-user'),
                    'password' => Hash::make($request->input('pass-user')),
                    'uesr_type' => $requestedType,
                    'active' => 0,
                    'created_at' => $currentDateTime,
                ]);

                return redirect('users')->with('success', 'Người dùng đã được thêm thành công!');
            } else {
                abort(403, 'Bạn không có quyền thực hiện');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function store(Request $request)
    {
        // Logic để lưu dữ liệu từ $request vào cơ sở dữ liệu
    }

    public function show($id)
    {
        $result = DB::table('users')->select('name', 'email', 'uesr_type')->where('user_id', '=', $id)->first();
        return response()->json($result);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $user_id = Auth::id();

        if ($user_id) {
            $user = User::find($user_id);

            if ($user && $user->uesr_type === 'sp-admin') {

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

                $requestedType = $request->input('Select-role');
                // kiểm tra xem giá trị của '$request->input('Select-role')' có tồn tại trong mảng
                if (!in_array($requestedType, ['staff', 'admin', 'sp-admin'])) {

                    return redirect()->back()->with('error', 'Vai trò không hợp lệ!');
                }

                // Cập nhật thông tin user
                $user->name = $request->input('user-name');
                $user->email = $request->input('user-email');
                $user->uesr_type = $requestedType;
                $user->save();

                // Xử lý logic thành công
                return redirect()->route('users')->with('success', 'Dữ liệu đã được cập nhật thành công.');
            } else {

                abort(403, 'Bạn không có quyền thực hiện');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function softDelete($id)
    {
        $user_id = Auth::id();

        if ($user_id) {
            $user = User::find($user_id);

            if ($user && $user->uesr_type === 'sp-admin') {

                $user = User::find($id);

                if (!$user) {
                    session()->flash('error', 'Không tìm thấy người dùng.');
                    return response()->json(['message' => 'Xóa thất bại.']);
                } else {
                    $user->delete(); // Thực hiện xóa mềm
                    session()->flash('success', 'Xóa thành công.');
                    return response()->json(['message' => 'Xóa thành công.']);
                }
            } else {
                abort(403, 'Bạn không có quyền thực hiện');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function destroy($id)
    {
    }
}
