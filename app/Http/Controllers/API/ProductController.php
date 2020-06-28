<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductGroupSearchRequest;
use App\ProductGroup\Product\Product;
use App\ProductGroup\ProductGroup;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{
    public function index(ProductGroupSearchRequest $request)
    {
        $data = $request->validated();
        $page = array_key_exists('page',$data)?$data['page']:1;
        $perPage = array_key_exists('perPage',$data)?$data['perPage']:12;
        $query = Product::query();
        if (array_key_exists('text',$data)) {
            $query->where(function($sub) use ($data) {
                $sub->where('group.title','LIKE','%'.$data['text'].'%')
                    ->orWhere('group.desc','LIKE','%'.$data['text'].'%')
                    ->orWhere('title', 'LIKE','%'.$data['text'].'%');
            });
        }
        if (array_key_exists('categoryId',$data)) {
            $query->where('group.category_id',$data['categoryId']);
        }
        if (array_key_exists('orderBy',$data)) {
            $query->orderByDesc($data['orderBy']);
        }
        if (array_key_exists('discount',$data)) {
            $query->whereHas('discount');
        }
        if (array_key_exists('discount_id',$data)) {
            $query->where('discount_id',$data['discount_id']);
        }
        $products = $query->get()->forPage($page,$perPage);
        return response()->json($products,200);
    }

    public function show(int $id)
    {
        $product = ProductGroup::where('id',$id)->with('products')->first();
        if(!$product)
        {
            return response()->json('Not found!',404);
        }
        return response()->json($product,200);
    }
}
