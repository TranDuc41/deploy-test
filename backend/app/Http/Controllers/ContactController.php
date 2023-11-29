<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; // Make sure to replace 'Contact' with your actual model name

class ContactController extends Controller
{
    public function saveData(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:55',
            'email' => 'required|email|max:254',
            'phone' => 'required|string|size:10',
            'title' => 'required|string|between:20,100',
            'content' => 'required|string|between:20,512',
        ]);

        // Save the data to the database
        Contact::create($data);

        return response()->json(['message' => 'Data saved successfully']);
    }
}