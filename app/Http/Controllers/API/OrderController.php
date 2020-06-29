<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Order\Order;
use App\Order\OrderItem\OrderItem;
use App\Shipment\Shipment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $orders = Order::where('user_id',$request->user()->getKey())->with('items')->get();
        return response()->json($orders,200);
    }

    /**
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function store(OrderRequest $request): JsonResponse
    {
        if (!$request->user()->address) {
            return response()->json('Dont have address!',422);
        }
        $shipments = Shipment::find($request->get('shipments'));
        $order = Order::create([
            'user_id'   =>  $request->user()->getKey(),
            'status'    =>  'new'
        ]);
        foreach ($shipments as $shipment) {
            OrderItem::create([
                'product_id'    =>  $shipment->product_id,
                'quantity'      =>  $shipment->quantity,
                'price'         =>  $shipment->price,
                'order_id'      =>  $order->getKey(),
            ]);
        }
        return response()->json($order,200);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        if (!$order = Order::find($id)) {
            return response()->json('Not Found!',404);
        }
        return response()->json($order,200);
    }
}
