<?php


namespace App\Brand;


use App\Core\DashboardPresenter;
use Illuminate\Pagination\LengthAwarePaginator;

class BrandDashboardPresenter
{
    public function getTablePage(LengthAwarePaginator $brands)
    {
        $headers = [
            'title' => 'Title',
        ];
        $name = 'brands';
        return (new DashboardPresenter())->getTablePage($headers, $name, $brands);
    }

    public function getShowPage(Brand $brand)
    {
        $header = $brand->title;
        $fields = [
            'title'     =>  'Title',
            'thumb_url' =>  'Thumb',
        ];
        return (new DashboardPresenter())->getShowPage($header, $brand, $fields);
    }

    public function getCreatePage()
    {
        $casts = (new Brand())->getCasts();
        unset($casts['id']);
        $name = 'brands';
        return (new DashboardPresenter())->getCreatePage($casts,$name);
    }

    public function getEditPage(Brand $brand)
    {
        $name = 'brands';
        $fields = [
            'title',
            'thumb',
        ];
        return (new DashboardPresenter())->getEditPage($brand,$name,$fields);
    }
}
