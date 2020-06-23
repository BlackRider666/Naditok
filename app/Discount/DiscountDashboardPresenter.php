<?php


namespace App\Discount;


use App\Core\DashboardPresenter;
use App\ProductGroup\Product\Product;
use Illuminate\Database\Eloquent\Collection;

class DiscountDashboardPresenter
{
    public function getTablePage(Collection $discounts)
    {
        $headers = [
            'title' => 'Title',
        ];
        $name = 'discounts';
        return (new DashboardPresenter())->getTablePage($headers, $name, $discounts);
    }

    public function getShowPage(Discount $discount)
    {
        $header = $discount->title;
        $fields = [
            'title' => 'Title',
            'thumb_url' =>  'Thumb',
            'size'  => 'Size',
            'type'  => 'Type',
            'start' => 'Start date',
            'finish'=> 'Finish date',
        ];
        return view('pages.discount_show',[
            'header'    =>  $header,
            'data'      =>  [
                'item'      =>  $discount->only(array_keys($fields)),
                'item_id'   =>  $discount->getKey(),
                'fields'    =>  $fields,
            ],
            'relation'  =>  [
                'products'             =>  [
                    'headers'   =>  [
                        'size'  =>  'Products',
                    ],
                    'name'      =>  'products',
                    'items'     =>  $discount->products,
                ],
            ]
        ]);
    }

    public function getCreatePage()
    {
        $casts = (new Discount())->getCasts();
        unset($casts['id']);
        $name = 'discounts';
        $options = [
            'type'    =>  [
                [
                    'id'    =>  '0',
                    'title' =>  '%',
                ],
                [
                    'id'    =>  '1',
                    'title' =>  ' грн.',
                ]
            ],
        ];
        return (new DashboardPresenter())->getCreatePage($casts,$name,$options);
    }

    public function getEditPage(Discount $discount)
    {
        $name = 'discounts';
        $fields = [
            'title',
            'size',
            'start',
            'finish',
        ];
        return (new DashboardPresenter())->getEditPage($discount,$name,$fields);
    }

    public function getAddProduct(int $id)
    {
        $products = Product::all();
        return view('pages.add_product_to_discount',[
            'discount_id'   =>  $id,
            'items'         =>  $products,
        ]);
    }
}
