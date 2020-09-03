<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\ProductGroup\Product\Product;
use App\ProductGroup\ProductGroup;
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
        $viewed = UserViewed::where('user_id',auth('sanctum')->user()->getKey())->first();
        $category_id = $viewed!== null?$viewed->product->category_id:0;
        $product_groups = ProductGroup::where('category_id',$category_id)->pluck('id');
        $products = Product::whereIn('product_group_id',$product_groups)->orderByDesc('created_at')->paginate(20);
        return response()->json([
            'products'  =>  $products,
        ],200);
    }
}
