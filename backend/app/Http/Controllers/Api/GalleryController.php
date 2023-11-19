<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{

    public function index()
    {


        try {
            $size_array = [600, 800, 900, 1200, 1600];
            $results = DB::table('image')->get();

            $modifiedResults = $results->map(function ($item) use ($size_array) {
                $item->src = 'http://127.0.0.1:8000' . $item->img_src;
                // Use array_rand to get a random key, then use that key to get the actual width and height from $size_array
                $randomKey = array_rand($size_array);
                $item->width = $size_array[$randomKey];

                // To ensure that height and width are different, remove the chosen key from the array
                unset($size_array[$randomKey]);

                $randomKey = array_rand($size_array);
                $item->height = $size_array[$randomKey];

                unset($item->img_src); // Remove the old key if needed
                return $item;
            });

            // Reset array keys after unsetting elements to avoid potential issues
            $size_array = array_values($size_array);
            return response()->json(['images' => $modifiedResults]);
        } catch (\Throwable $th) {
            return response()->json(['errors' => 'Không thể kết nối']);
        }
    }
}
