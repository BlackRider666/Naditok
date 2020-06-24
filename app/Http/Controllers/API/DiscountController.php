<?php

namespace App\Http\Controllers\API;

use App\Discount\Discount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page')?:1;
        $perPage = $request->get('perPage')?:10;
        $discounts = Discount::whereHas('products')->get()->forPage($page,$perPage);
        return response()->json($discounts,200);
    }
}
