<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Users\UserFavorite\UserFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $favorites = UserFavorite::where('user_id',$request->user()->getKey())->get();
        return response()->json($favorites,200);
    }

    public function addToFavorites(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id'    =>  'required|int|exists:products,id',
        ]);
        if ($validator->failed()) {
            return response()->json($validator->fails(),422);
        }
        $favorite = UserFavorite::findOrCreate([
            'user_id'       =>  $request->user()->getKey(),
            'product_id'    =>  $request->get('product_id'),
        ]);
        return response()->json($favorite,200);
    }

    public function removeFromFavorites(int $id)
    {
        UserFavorite::find($id)->delete();
        return response()->json('Removed!',200);
    }
}
