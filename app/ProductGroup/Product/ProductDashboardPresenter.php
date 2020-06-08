<?php


namespace App\ProductGroup\Product;


use App\Core\DashboardPresenter;
use App\ProductGroup\ProductGroup;
use Illuminate\Database\Eloquent\Collection;

class ProductDashboardPresenter
{
    public function getTablePage(Collection $products)
    {
        $headers = [
            'title' => 'Title',
        ];
        $name = 'products';
        return (new DashboardPresenter())->getTablePage($headers, $name, $products);
    }

    public function getShowPage(Product $product)
    {
        $header = $product->group->title.', '.$product->title;
        $fields = [
            'title'             =>  'Title',
            'product_group_id'  =>  'Product Group',
            'price'             =>  'Price',
            'quantity'          =>  'Quantity',
            'minimum'           =>  'Minimum',
            'status'            =>  'Status',
            'view_count'        =>  'Number of views',
            'color'             =>  'Color',
            'product_code'      =>  'Product Code',
        ];
        $relation = [
            'product_group_id'  =>  $product->group->title,
            'photos'            =>  [
                'headers'   =>  [
                    'thumb'  =>  'Thumb',
                ],
                'name'      =>  'product-images',
                'items'     =>  $product->images,
            ],
            'sizes'             =>  [
                'headers'   =>  [
                    'size'  =>  'Sizes',
                ],
                'name'      =>  'product-sizes',
                'items'     =>  $product->sizes,
            ],
            'product_id'        =>  $product->getKey(),
        ];
        return view('pages.product_show',[
            'header'    =>  $header,
            'data'      =>  [
                'item' => $product->only(array_keys($fields)),
                'fields' => $fields,
            ],
            'relation'  =>  $relation,
        ]);
    }

    public function getCreatePage(int $product_group_id)
    {
        $casts = (new Product())->getCasts();
        unset($casts['id']);
        $name = 'products';
        $options = [
            'product_group_id'  =>  ProductGroup::all()->toArray(),
            'status'            =>  [
                [
                    'id'    =>  'test',
                    'title' =>  'test',
                ],
                [
                    'id'    =>  'test2',
                    'title' =>  'test2',
                ]
            ],
            'choose'    => [
                'product_group_id'    =>  $product_group_id,
            ],
        ];
        return (new DashboardPresenter())->getCreatePage($casts,$name,$options);
    }

    public function getEditPage(Product $product)
    {
        $name = 'products';
        $fields = [
            'title',
            'price',
            'quantity',
            'minimum',
            'status',
            'color',
            'product_code',
        ];
        $options = [
            'status'            =>  [
                [
                    'id'    =>  'test',
                    'title' =>  'test',
                ],
                [
                    'id'    =>  'test2',
                    'title' =>  'test2',
                ]
            ],
        ];
        return (new DashboardPresenter())->getEditPage($product,$name,$fields,$options);
    }
}
