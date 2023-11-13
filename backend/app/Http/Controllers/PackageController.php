<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('package', compact('packages'));
    }

    public function create()
    {
        return view('package.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        Package::create($validatedData);
        return redirect()->route('packages.index')->with('success', 'Package created successfully.');
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
            'name' => 'required|max:255',
        ]);

        $package = Package::findOrFail($packages_id);
        $package->update($validatedData);
        return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
    }

    public function destroy($packages_id)
    {
        $package = Package::findOrFail($packages_id);
        $package->delete();
        return redirect()->route('packages.index')->with('success', 'Package deleted successfully.');
    }
    public function search(Request $request)
    {
        $searchText = $request->search;
        $filteredPackages = Package::where('name', 'LIKE', "%{$searchText}%")
            ->orWhere('packages_id', 'LIKE', "%{$searchText}%")
            ->get();

        return response()->json($filteredPackages);
    }
}
