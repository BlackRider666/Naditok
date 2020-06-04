<?php


namespace App\ProductGroup\Product\ProductSize;


use App\Core\DashboardPresenter;
use App\ProductGroup\Product\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductSizeDashboardPresenter
{
    public function getTablePage(Collection $productSizes)
    {
        $headers = [
            'size' => 'Size',
        ];
        $name = 'product-sizes';
        return (new DashboardPresenter())->getTablePage($headers, $name, $productSizes);
    }

    public function getShowPage(ProductSize $productSize)
    {
        $header = $productSize->size;
        $fields = [
            'size'          =>  'Size',
            'product_id'    =>  'Product',
        ];
        return (new DashboardPresenter())->getShowPage($header, $productSize, $fields);
    }

    public function getCreatePage(int $product_id)
    {
        $casts = (new ProductSize())->getCasts();
        unset($casts['id']);
        $name = 'product-sizes';
        $options = [
            'product_id'    =>  Product::all()->toArray(),
        ];
        return (new DashboardPresenter())->getCreatePage($casts,$name,$options);
    }

    public function getEditPage(ProductSize $productSize)
    {
        $name = 'product-sizes';
        $fields = [
            'size',
            'product_id',
        ];
        return (new DashboardPresenter())->getEditPage($productSize,$name,$fields);
    }
}
