<?php

namespace App\Http\Controllers\Admin;

use App\Category\Category;
use App\Category\CategoryDashboardPresenter;
use App\Core\StorageManager;
use App\Discount\Discount;
use App\Discount\DiscountDashboardPresenter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Requests\DiscountRequest;
use App\Http\Requests\DiscountUpdateRequest;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DiscountController extends Controller
{
    /**
     * @var CategoryDashboardPresenter
     */
    private $dashboardPresenter;

    public function __construct(DiscountDashboardPresenter $dashboardPresenter)
    {
        $this->dashboardPresenter = $dashboardPresenter;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $discounts = Discount::all();
        return $this->dashboardPresenter->getTablePage($discounts);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return $this->dashboardPresenter->getCreatePage();
    }

    /**
     * @param DiscountRequest $request
     * @return RedirectResponse
     */
    public function store(DiscountRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['thumb'] = (new StorageManager())
            ->savePicture($request->file('thumb'),'discount',1000);
        Discount::create($data);
        return redirect()->route('admin.discounts.index');
    }

    /**
     * @param Discount $discount
     * @return Factory|View
     */
    public function show(Discount $discount)
    {
        return $this->dashboardPresenter->getShowPage($discount);
    }

    /**
     * @param Discount $discount
     * @return Factory|View
     */
    public function edit(Discount $discount)
    {
        return $this->dashboardPresenter->getEditPage($discount);
    }

    /**
     * @param DiscountUpdateRequest $request
     * @param Discount $discount
     * @return RedirectResponse
     */
    public function update(DiscountUpdateRequest $request, Discount $discount): RedirectResponse
    {
        $data = $request->validated();
        $discount->update($data);
        return redirect()->route('admin.discounts.index');
    }

    /**
     * @param Discount $discount
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Discount $discount): RedirectResponse
    {
        (new StorageManager())->deleteFile($discount->thumb,'discount');
        $discount->delete();
        return redirect()->route('admin.discounts.index');
    }

    public function addProduct()
    {
        //
    }
}
