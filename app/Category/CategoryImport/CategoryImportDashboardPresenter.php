<?php


namespace App\Category\CategoryImport;

use App\Core\DashboardPresenter;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Category\Category;

class CategoryImportDashboardPresenter
{
    public function getTablePage(LengthAwarePaginator $categories)
    {
        $headers = [
            'cat_id'    => 'Category',
            'out_id'    => 'Out ID',
            'exporter'  =>  'Exporter'
        ];
        $name = 'import-category';
        $options = [
            'cat_id' => Category::all()
        ];
        return (new DashboardPresenter())->getTablePage($headers, $name, $categories,true,$options,false,true);
    }

    public function getCreatePage()
    {
        $casts = (new CategoryImport())->getCasts();
        unset($casts['id']);
        $name = 'import-category';
        $options = [
            'cat_id'    =>  Category::all()->toArray(),
        ];
        return (new DashboardPresenter())->getCreatePage($casts,$name,$options);
    }
}
