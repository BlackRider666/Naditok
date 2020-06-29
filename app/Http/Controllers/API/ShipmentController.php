<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Shipment\Shipment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShipmentController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $shipments = Shipment::where('user_id',$request->user()->getKey())->with('product.group')->get();
        return response()->json($shipments,200);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function add_product(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'product_id'    =>  'required|int|exists:products,id',
            'quantity'      =>  'required|int',
            'size'          =>  'required|string',
        ]);
        if ($validator->failed()) {
            return response()->json($validator->fails(),422);
        }
        $shipment = Shipment::firstOrCreate([
            'user_id'       =>  $request->user()->getKey(),
            'product_id'    =>  $request->get('product_id'),
        ], [
                'user_id'       =>  $request->user()->getKey(),
                'product_id'    =>  $request->get('product_id'),
                'quantity'      =>  0,
                'size'          =>  $request->get('size'),
            ]);
        $shipment->update([
            'quantity'  =>  $shipment->quantity+1,
        ]);
        $shipment = Shipment::find($shipment->getKey());
        return response()->json($shipment->with('product')->first(),200);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update_product(int $id, Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'quantity'    =>  'required|int'
        ]);
        if ($validator->failed()) {
            return response()->json($validator->fails(),422);
        }
        $shipment = Shipment::find($id);
        $shipment->update([
            'quantity'  =>  $request->get('quantity'),
        ]);
        return response()->json($shipment,200);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function delete_product(int $id): JsonResponse
    {
        Shipment::find($id)->delete();
        return response()->json('Removed!',200);
    }
}
