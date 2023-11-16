<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        $packages = Package::paginate(10);
        return view('package', compact('packages'));
    }

    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:packages',
        ]);

        try {
            // Tạo mới package
            Package::create($validatedData);

            // Chuyển hướng với thông báo thành công
            return redirect()->route('packages.index')->with('success', ' Thêm Package thành công .');
        } catch (QueryException $e) {
            // Gửi thông báo lỗi nếu có ngoại lệ xảy ra
            return redirect()->back()->withInput()->with('error', 'Đã xảy ra lỗi: ' . $e->getMessage());
        }
    }

    public function show($packages_id)
    {
        $package = Package::findOrFail($packages_id);
        return view('package.show', compact('package'));
    }

    public function edit($packages_id)
    {
        $package = Package::findOrFail($packages_id);
        return view('package.edit', compact('package'));
    }

    public function update(Request $request, $packages_id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:packages,name,' . $packages_id . ',packages_id',
        ], [
            'name.unique' => 'Tên đã tồn tại, vui lòng nhập tên khác.',
        ]);

        try {
            $package = Package::findOrFail($packages_id);
            $package->update($validatedData);
            return redirect()->route('packages.index')->with('success', 'Cập nhật Package thành công.');
        } catch (\Exception $e) {
            // Quay trở lại trang trước với thông báo lỗi
            return back()->withInput()->with('error', 'Lỗi khi cập nhật Package. Vui lòng thử lại.');
        }
    }


    public function destroy($packages_id)
    {
        $package = Package::findOrFail($packages_id);
        $package->delete();
        return redirect()->route('packages.index')->with('success', 'Xóa Package thành công .');
    }
    //Phương thức search
    public function search(Request $request)
    {
        $searchText = $request->search;
        $filteredPackages = Package::where('name', 'LIKE', "%{$searchText}%")
            ->orWhere('packages_id', 'LIKE', "%{$searchText}%")
            ->get();

        return response()->json($filteredPackages);
    }
}
