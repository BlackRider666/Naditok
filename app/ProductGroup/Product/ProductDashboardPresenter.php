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
        return (new DashboardPresenter())->getShowPage($header, $product, $fields);
    }

    public function getCreatePage()
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
        ];
        return (new DashboardPresenter())->getCreatePage($casts,$name,$options);
    }

    public function getEditPage(Product $product)
    {
        $name = 'product-groups';
        $fields = [
            'title',
            'price',
            'quantity',
            'minimum',
            'status',
            'color',
            'product_code',
        ];
        return (new DashboardPresenter())->getEditPage($product,$name,$fields);
    }
}
