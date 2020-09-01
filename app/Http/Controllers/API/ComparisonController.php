<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Users\UserComparison\UserComparison;
use Illuminate\Http\JsonResponse;

class ComparisonController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'comparisons'  =>  UserComparison::where('user_id',auth('sanctum')->user()->getKey())->get()
        ],200);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function store(int $id): JsonResponse
    {
        $comparison = UserComparison::create([
            'user_id'       =>  auth('sanctum')->user()->getKey(),
            'product_id'    =>  $id,
        ]);
        return response()->json([
            'comparison'    =>  $comparison,
        ],200);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $comparison = UserComparison::where('product_id',$id)
            ->where('user_id',auth('sanctum')->user()->getKey())->get();
        if (!$comparison) {
            return response()->json('Not found!',404);
        }
        $comparison->delete();
        return response()->json([
            'message'   => 'Success',
        ],200);
    }
}
