<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class AddressController extends Controller
{
    public function getCities()
    {
        $response = Http::get('https://provinces.open-api.vn/api/?depth=1');
        return $response->json();
    }

    public function getDistricts($cityCode)
    {
        $response = Http::get("https://provinces.open-api.vn/api/p/{$cityCode}?depth=2");
        return $response->json();
    }

    public function getWards($districtCode)
    {
        $response = Http::get("https://provinces.open-api.vn/api/d/{$districtCode}?depth=2");
        return $response->json();
    }
}
