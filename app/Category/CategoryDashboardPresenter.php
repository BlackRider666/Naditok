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
            'title_ru' => 'Title RU',
        ];
        $name = 'categories';
        return (new DashboardPresenter())->getTablePage($headers, $name, $categories);
    }

    public function getShowPage(Category $category)
    {
        $header = $category->title_ru;
        $fields = [
            'title_ru'    =>  'Title RU',
            'title_ua'    =>  'Title UA',
            'parent_id'     =>  'Parent id',
            'thumb_url'     =>  'Thumb',
            'desc_ru'       =>  'Desc RU',
            'desc_ua'       =>  'Desc RU',
            'slug'          =>  'URL'
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
            'title_ru',
            'title_ua',
            'parent_id',
            'thumb_url',
            'desc_ru',
            'desc_ua',
            'slug',
        ];
        $options = [
            'parent_id'    =>  Category::where('id','!=',$category->getKey())->get(),
        ];
        return (new DashboardPresenter())->getEditPage($category,$name,$fields, $options);
    }
}
