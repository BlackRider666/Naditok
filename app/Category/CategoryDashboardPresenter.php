<?php


namespace App\Category;


use App\Core\DashboardPresenter;
use Illuminate\Database\Eloquent\Collection;

class CategoryDashboardPresenter
{
    public function getTablePage(Collection $categories)
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
        ];
        return (new DashboardPresenter())->getShowPage($header, $category, $fields);
    }

    public function getCreatePage()
    {
        $casts = (new Category())->getCasts();
        unset($casts['id']);
        $name = 'categories';
        $options = [
            'for_select'    =>  Category::all(),
        ];
        return (new DashboardPresenter())->getCreatePage($casts,$name,$options);
    }

    public function getEditPage(Category $category)
    {
        $name = 'categories';
        $fields = [
            'title',
            'parent_id',
        ];
        $options = [
            'for_select'    =>  Category::where('id','!=',$category->getKey())->get(),
        ];
        return (new DashboardPresenter())->getEditPage($category,$name,$fields, $options);
    }
}
