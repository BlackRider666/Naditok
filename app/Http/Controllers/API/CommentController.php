<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\ProductGroup\ProductGroupComment\ProductGroupComment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(CommentRequest $request)
    {
        $comment = ProductGroupComment::create($request->validated());
        if(!$comment)
        {
            return response()->json('Server error',500);
        }
        return response()->json($comment,200);
    }
}
