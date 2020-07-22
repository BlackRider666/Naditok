<?php


namespace App\Category;


use App\Core\DashboardPresenter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryDashboardPresenter
{
    public function getTablePage(LengthAwarePaginator $categories)
    {
        $headers = [
            'title' => 'Title',
        ];
        $name = 'categories';
        return (new DashboardPresenter())->getTablePage($headers, $name, $categories);
    }

    public function getShowPage(Category $category)
    {
        $header = $category->title;
        $fields = [
            'title'    =>  'Title',
            'parent_id'     =>  'Parent id',
            'thumb_url'     =>  'Thumb',
        ];
        return (new DashboardPresenter())->getShowPage($header, $category, $fields);
    }

    public function getCreatePage()
    {
        $casts = (new Category())->getCasts();
        unset($casts['id']);
        $name = 'categories';
        $options = [
            'parent_id'    =>  Category::all()->toArray(),
        ];
        return (new DashboardPresenter())->getCreatePage($casts,$name,$options);
    }

    public function getEditPage(Category $category)
    {
        $name = 'categories';
        $fields = [
            'title',
            'parent_id',
            'thumb',
        ];
        $options = [
            'for_select'    =>  Category::where('id','!=',$category->getKey())->get(),
        ];
        return (new DashboardPresenter())->getEditPage($category,$name,$fields, $options);
    }
}
