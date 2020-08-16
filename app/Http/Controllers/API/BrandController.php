<?php

namespace App\Http\Controllers\API;

use App\Brand\Brand;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function index()
    {
        return response()->json(Brand::orderByDesc('created_at')->paginate(8),200);
    }
}
