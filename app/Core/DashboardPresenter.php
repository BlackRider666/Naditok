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
}
