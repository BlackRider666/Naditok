<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\ProductGroup\Product\Product;
use App\Users\UserViewed\UserViewed;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductViewedController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function lastViewed(): JsonResponse
    {
        return response()->json([
            'products'  =>  UserViewed::where('user_id',auth('sanctum')->user()->getKey()),
        ],200);
    }

    /**
     * @return JsonResponse
     */
    public function recommendedProducts(): JsonResponse
    {
        $category_id = UserViewed::where('user_id',auth('sanctum')->user()->getKey())->first()->product()->category_id;
        $products = Product::where('category_id',$category_id?:0)->get();
        return response()->json([
            'products'  =>  $products,
        ],200);
    }
}
