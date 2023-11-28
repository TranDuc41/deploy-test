<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = DB::table('faq')->orderBy('id', 'desc')->take(6)->get();
        return response()->json($faqs);
    }
}
