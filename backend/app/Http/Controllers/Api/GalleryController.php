<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GalleryController extends Controller
{
    public function index(){
        try {
            $results = DB::table('image')->get();
            $modifiedResults = $results->map(function ($item) {
            $item->src = $item->img_src;
            unset($item->img_src); // Remove the old key if needed
            return $item;
        });
            return response()->json(['images' => $modifiedResults]);
        } catch (\Throwable $th) {
            return response()->json(['errors' => 'Không thể kết nối']);
        }
        
    }
}
