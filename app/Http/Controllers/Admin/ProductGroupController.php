<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductGroupRequest;
use App\Http\Requests\ProductGroupUpdateRequest;
use App\ProductGroup\ProductGroup;
use App\ProductGroup\ProductGroupDashboardPresenter;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductGroupController extends Controller
{
    private $dashboardPresenter;

    /**
     * UsersController constructor.
     * @param ProductGroupDashboardPresenter $dashboardPresenter
     */
    public function __construct(ProductGroupDashboardPresenter $dashboardPresenter)
    {
        $this->dashboardPresenter = $dashboardPresenter;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $productGroups = ProductGroup::all();
        return $this->dashboardPresenter->getTablePage($productGroups);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return $this->dashboardPresenter->getCreatePage();
    }

    /**
     * @param ProductGroupRequest $request
     * @return RedirectResponse
     */
    public function store(ProductGroupRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $product_group = ProductGroup::create($data);
        return redirect()->route('admin.products.create',$product_group->getKey());
    }

    /**
     * @param ProductGroup $productGroup
     * @return Factory|View
     */
    public function show(ProductGroup $productGroup)
    {
        return $this->dashboardPresenter->getShowPage($productGroup);
    }

    /**
     * @param ProductGroup $productGroup
     * @return Factory|View
     */
    public function edit(ProductGroup $productGroup)
    {
        return $this->dashboardPresenter->getEditPage($productGroup);
    }

    /**
     * @param ProductGroupUpdateRequest $request
     * @param ProductGroup $productGroup
     * @return RedirectResponse
     */
    public function update(ProductGroupUpdateRequest $request, ProductGroup $productGroup): RedirectResponse
    {
        $data = $request->validated();
        $productGroup->update($data);
        return redirect()->route('admin.product-groups.index');
    }

    /**
     * @param ProductGroup $productGroup
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(ProductGroup $productGroup): RedirectResponse
    {
        $productGroup->delete();
        return redirect()->route('admin.product-groups.index');
    }
}
