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
        Validator::make($request->all(), [
            'product_id'    =>  'required|int|exists:products,id',
            'quantity'      =>  'required|int',
            'size'          =>  'required|string',
        ]);
        $shipment = Shipment::create([
            'user_id'       =>  $request->user()->getKey(),
            'product_id'    =>  $request->get('product_id'),
            'quantity'      =>  $request->get('quantity'),
            'size'          =>  $request->get('size'),
        ]);
        return response()->json($shipment->with('product'),200);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update_product(int $id, Request $request): JsonResponse
    {
        Validator::make($request->all(), [
            'quantity'    =>  'required|int'
        ]);
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
