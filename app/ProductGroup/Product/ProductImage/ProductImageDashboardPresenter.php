<?php


namespace App\ProductGroup\Product\ProductImage;


use App\Core\DashboardPresenter;
use App\ProductGroup\Product\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductImageDashboardPresenter
{
    public function getTablePage(Collection $productImages)
    {
        $headers = [
            'product_id' => 'Product',
        ];
        $name = 'product-images';
        return (new DashboardPresenter())->getTablePage($headers, $name, $productImages);
    }

    public function getShowPage(ProductImage $productImage)
    {
        $header = $productImage->product->title;
        $fields = [
            'product_id'    =>  'Product',
        ];
        return (new DashboardPresenter())->getShowPage($header, $productImage, $fields);
    }

    public function getCreatePage(int $product_id)
    {
        $casts = (new ProductImage())->getCasts();
        unset($casts['id']);
        $name = 'product-images';
        $options = [
            'product_id'    =>  Product::all()->toArray(),
            'choose'    => [
                'product_id'    =>  $product_id,
            ],
        ];
        return (new DashboardPresenter())->getCreatePage($casts,$name,$options);
    }

    public function getEditPage(ProductImage $productImage)
    {
        $name = 'product-images';
        $fields = [
            'size',
            'product_id',
        ];
        return (new DashboardPresenter())->getEditPage($productImage,$name,$fields);
    }
}
