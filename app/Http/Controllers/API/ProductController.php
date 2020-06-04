<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\ProductGroup\Product\Product;
use App\ProductGroup\ProductGroup;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(ProductGroup::all(),200);
    }
}
