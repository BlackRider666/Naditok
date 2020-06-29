<?php


namespace App\Order;


use App\Core\DashboardPresenter;
use Illuminate\Database\Eloquent\Collection;

class OrderDashboardPresenter
{
    public function getTablePage(Collection $orders)
    {
        $headers = [
            'user_id'       =>  'User ID',
            'created_at'    =>  'Created at',
            'status'        =>  'Status'
        ];
        $name = 'orders';
        return (new DashboardPresenter())->getTablePage($headers, $name, $orders,true);
    }

    public function getShowPage(Order $order)
    {
        $header = 'Order № '.$order->id;
        $fields = [
            'id'                =>  'ID',
            'user_id'           =>  'User',
            'status'            =>  'Status',
            'created_at'        =>  'Created at',
        ];
        $relation = [
            'user_id'  =>  $order->user->full_name,
            'items'             =>  [
                'headers'   =>  [
                    'product_id'    =>  'Product ID',
                    'quantity'      =>  'Quantity',
                    'price'         =>  'Price',
                    'total_price'   =>  'Total'
                ],
                'items'     =>  $order->items,
            ]
        ];
        return view('pages.order_show',[
            'header'    =>  $header,
            'data'      =>  [
                'item' => $order->only(array_keys($fields)),
                'fields' => $fields,
            ],
            'relation'  =>  $relation,
        ]);
    }

    public function getEditPage(Order $order)
    {
        $name = 'orders';
        $fields = [
            'status',
        ];
        $options = [
            'status'            =>  [
                [
                    'id'    =>  'new',
                    'title' =>  'New',
                ],
                [
                    'id'    =>  'confirm',
                    'title' =>  'Confirm',
                ],
                [
                    'id'    =>  'completed',
                    'title' =>  'Completed',
                ],
                [
                    'id'    =>  'archive',
                    'title' =>  'Archive',
                ],
                [
                    'id'    =>  'canceled',
                    'title' =>  'Canceled',
                ]
            ],
        ];
        return (new DashboardPresenter())->getEditPage($order,$name,$fields,$options);
    }
}
