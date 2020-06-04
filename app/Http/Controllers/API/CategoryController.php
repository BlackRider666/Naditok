<?php

namespace App\Http\Controllers\API;

use App\Category\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id',null)->get();
        return response()->json($categories,200);
    }
}
