<?php


namespace App\Core;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardPresenter
{
    public function getTablePage(array $headers, string $name, LengthAwarePaginator $items, bool $withoutToolbar = false)
    {
        return view('components.table-page',[
            'headers'   =>  $headers,
            'name'      =>  $name,
            'items'     =>  $items,
            'withoutToolbar'    =>  $withoutToolbar,
        ]);
    }

    public function getShowPage(string $header, Model $item, array $fields, array $relation =[])
    {
        return view('components.show-page',[
            'header'    =>  $header,
            'data'      =>  [
                'item' => $item->only(array_keys($fields)),
                'fields' => $fields,
            ],
            'relation'  =>  $relation
        ]);
    }

    public function getCreatePage(array $fields,string $name, array $options = [])
    {
        return view('components.create-page',[
            'fields'    =>  $fields,
            'name'      =>  $name,
            'options'   =>  $options,
        ]);
    }

    public function getEditPage(Model $model,string $name,array $fields, array $options = [])
    {
        return view('components.edit-page',[
            'model'  =>  $model,
            'name'   =>  $name,
            'fields' =>  $fields,
            'options'   =>  $options,
        ]);
    }
}
