<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $infos = Info::all();
    //     return view('info', ['infos' => $infos]); // Truyền biến $infos sang view
    // }
    public function index()
    {
        $infos = Info::all();
        return view('info', compact('infos'));
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'title' => 'required|max:255',
    //         'link' => 'nullable|url',
    //         'hotel_id' => 'required|exists:hotels,hotel_id', // Kiểm tra xem hotel_id có tồn tại không
    //         'content' => 'nullable|string'
    //     ]);
    
    //     Info::create($validatedData);
    //     return redirect()->route('info.index')->with('success', 'Info has been added.');
    // }
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'title' => 'required|max:255',
        //     'link' => 'nullable|url',
        //     'hotel_id' => 'required|exists:hotels,hotel_id',
        //     'content' => 'nullable|string'
        // ]);

        // Info::create($validatedData);
        // return redirect()->back()->with('success', 'Info has been added.');
        $info = Info::create([
            'title' => $request->input('title'),
            'link' => $request->input('link'),
            'hotel_id' => $request->input('hotel_id'),
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Info added successfully!');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, $id)
    // {
    //     $info = Info::findOrFail($id);
    //     $validatedData = $request->validate([
    //         'title' => 'required|max:255',
    //         'link' => 'nullable|url',
    //         'content' => 'nullable|string'
    //     ]);

    //     $info->update($validatedData);
    //     return redirect()->back()->with('success', 'Info has been updated.');
    // }
    public function update(Request $request, $id)
    {
        // $info = Info::findOrFail($id);
        // $validatedData = $request->validate([
        //     'title' => 'required|max:255',
        //     'link' => 'nullable|url',
        //     'content' => 'nullable|string'
        // ]);

        // $info->update($validatedData);
        // return redirect()->back()->with('success', 'Info has been updated.');
    }
    /**
     * Remove the specified resource from storage.
     */
    // public function destroy($id)
    // {
    //     $info = Info::findOrFail($id);
    //     $info->delete();
    //     return redirect()->back()->with('success', 'Info has been deleted.');
    // }
    public function destroy($id)
    {
        // $info = Info::findOrFail($id);
        // $info->delete();
        // return redirect()->back()->with('success', 'Info has been deleted.');
    }
}
