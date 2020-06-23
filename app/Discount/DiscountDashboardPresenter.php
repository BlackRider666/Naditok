<?php


namespace App\Discount;


use App\Core\DashboardPresenter;
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
            'thumb' => 'Thumb',
            'size'  => 'Size',
            'type'  => 'Type',
            'start' => 'Start date',
            'finish'=> 'Finish date',
        ];
        return (new DashboardPresenter())->getShowPage($header, $discount, $fields);
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
}
