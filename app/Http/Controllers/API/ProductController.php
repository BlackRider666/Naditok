<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductGroupSearchRequest;
use App\ProductGroup\Product\Product;
use App\ProductGroup\ProductGroup;
use App\Users\UserViewed\UserViewed;
use Illuminate\Database\Eloquent\Builder;
use function foo\func;

class ProductController extends Controller
{
    public function index(ProductGroupSearchRequest $request)
    {
        $data = $request->validated();
        $page = array_key_exists('page',$data)?$data['page']:1;
        $perPage = array_key_exists('perPage',$data)?$data['perPage']:12;
        $query = Product::query();
        if (array_key_exists('text',$data)) {
            $query->whereHas('group',function($sub) use ($data) {
                $sub->where('title','LIKE','%'.$data['text'].'%')
                    ->orWhere('desc','LIKE','%'.$data['text'].'%');

            })
                ->orWhere('title', 'LIKE','%'.$data['text'].'%');
        }
        if (array_key_exists('categoryId',$data)) {
            $query->whereHas('group', function ($sub) use ($data){
                $sub->where('category_id',$data['categoryId']);
            });
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
        if (auth('sanctum')->user()!==null) {
            foreach ($product->products() as $prod) {
                UserViewed::create([
                    'product_id'    =>  $prod->getKey(),
                    'user_id'       =>  auth('sanctum')->user()->getKey(),
                ]);
            }
        }
        if(!$product)
        {
            return response()->json('Not found!',404);
        }
        return response()->json($product,200);
    }
}
