<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductGroupSearchRequest;
use App\ProductGroup\Product\Product;
use App\ProductGroup\ProductGroup;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(ProductGroupSearchRequest $request)
    {
        $data = $request->validated();
        $page = array_key_exists('page',$data)?$data['page']:1;
        $perPage = array_key_exists('perPage',$data)?$data['perPage']:12;
        $query = ProductGroup::query();
        if (array_key_exists('text',$data)) {
            $query->where('title','LIKE','%'.$data['text'].'%');
        }
        if (array_key_exists('categoryId',$data)) {
            $query->where('category_id',$data['categoryId']);
        }
        $products = $query->whereHas('products')->get()->forPage($page,$perPage);
        return response()->json($products,200);
    }
}
