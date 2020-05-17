<?php

namespace App\Http\Controllers\API;

use App\Category\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json(Category::all(),200);
    }
}
