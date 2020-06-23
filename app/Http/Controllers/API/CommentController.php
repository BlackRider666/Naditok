<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\ProductGroup\ProductGroupComment\ProductGroupComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $comments = ProductGroupComment::all();
        if ($request->get('product_group_id')) {
            $comments = ProductGroupComment::where(
                'product_group_id',$request->get('product_group_id')
            )->get();
        }
        return response()->json($comments,200);
    }

    public function create(CommentRequest $request)
    {
        $comment = ProductGroupComment::create($request->validated());
        if (!$comment) {
            return response()->json('Server error',500);
        }
        return response()->json($comment,200);
    }
}
