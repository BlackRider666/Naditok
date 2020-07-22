<?php


namespace App\ProductGroup;


use App\Brand\Brand;
use App\Category\Category;
use App\Core\DashboardPresenter;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductGroupDashboardPresenter
{
    public function getTablePage(LengthAwarePaginator $product_groups)
    {
        $headers = [
            'title' => 'Title',
        ];
        $name = 'product-groups';
        return (new DashboardPresenter())->getTablePage($headers, $name, $product_groups);
    }

    public function getShowPage(ProductGroup $productGroup)
    {
        $header = $productGroup->title;
        $fields = [
            'title'    =>  'Title',
            'brand_id'      =>  'Brand',
            'category_id'   =>  'Category',
            'desc'          =>  'Description',
            'weight'        =>  'Weight',
            'length'        =>  'Length',
            'width'         =>  'Width',
            'height'        =>  'Height',
        ];
        return view('pages.group_show',[
            'header'    =>  $header,
            'data'      =>  [
                'item' => $productGroup->only(array_keys($fields)),
                'fields' => $fields,
            ],
            'relation'  =>  [
                'headers'       =>  [
                    'title' =>  'Title',
                    'color' =>  'Color',
                ],
                'name'          =>  'products',
                'items'         =>  $productGroup->products()->paginate(10),
                'brand_id'      =>  $productGroup->brand->title,
                'category_id'   =>  $productGroup->category->title,
                'product_group_id'  =>  $productGroup->getKey(),
            ],
        ]);
    }

    public function getCreatePage()
    {
        $casts = (new ProductGroup())->getCasts();
        unset($casts['id']);
        $name = 'product-groups';
        $options = [
            'brand_id'    =>  Brand::all()->toArray(),
            'category_id'    =>  Category::all()->toArray(),
        ];
        return (new DashboardPresenter())->getCreatePage($casts,$name,$options);
    }

    public function getEditPage(ProductGroup $productGroup)
    {
        $name = 'product-groups';
        $fields = [
            'title',
            'brand_id',
            'category_id',
            'desc',
            'weight',
            'length',
            'width',
            'height',
        ];
        return (new DashboardPresenter())->getEditPage($productGroup,$name,$fields);
    }
}
