<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order\Order;
use App\Order\OrderDashboardPresenter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class OrderController extends Controller
{
    private $dashboardPresenter;

    /**
     * UsersController constructor.
     * @param OrderDashboardPresenter $dashboardPresenter
     */
    public function __construct(OrderDashboardPresenter $dashboardPresenter)
    {
        $this->dashboardPresenter = $dashboardPresenter;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $orders = Order::paginate(10);
        return $this->dashboardPresenter->getTablePage($orders);
    }

    /**
     * @param int $id
     * @return Factory|View
     */
    public function show(int $id)
    {
        $order = Order::find($id);
        return $this->dashboardPresenter->getShowPage($order);
    }

    /**
     * @param int $id
     * @return Factory|View
     */
    public function edit(int $id)
    {
        $order = Order::find($id);
        return $this->dashboardPresenter->getEditPage($order);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $validator = Validator::make($request->all(),[
            'status'    =>  'required|string'
        ]);
        $data = $validator->validated();
        $order = Order::find($id);
        $order->update($data);
        return redirect()->route('admin.orders.show',$order->getKey());
    }
}
