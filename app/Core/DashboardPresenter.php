<?php


namespace App\Core;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DashboardPresenter
{
    public function getTablePage(array $headers, string $name, Collection $items)
    {
        return view('components.table-page',[
            'headers'   =>  $headers,
            'name'      =>  $name,
            'items'     =>  $items,
        ]);
    }

    public function getShowPage(string $header, Model $item, array $fields)
    {
        return view('components.show-page',[
            'header'    =>  $header,
            'data'      =>  [
                'item' => $item->only(array_keys($fields)),
                'fields' => $fields,
            ]
        ]);
    }

    public function getCreatePage(array $fields,string $name)
    {
        return view('components.create-page',[
            'fields'    =>  $fields,
            'name'      =>  $name,
        ]);
    }

    public function getEditPage(Model $model,string $name,array $fields)
    {
        return view('components.edit-page',[
            'model'  =>  $model,
            'name'   =>  $name,
            'fields' =>  $fields,
        ]);
    }
}
