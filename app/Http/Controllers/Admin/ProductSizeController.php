<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSizeRequest;
use App\Http\Requests\ProductSizeUpdateRequest;
use App\ProductGroup\Product\ProductSize\ProductSize;
use App\ProductGroup\Product\ProductSize\ProductSizeDashboardPresenter;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductSizeController extends Controller
{
    private $dashboardPresenter;

    /**
     * UsersController constructor.
     * @param ProductSizeDashboardPresenter $dashboardPresenter
     */
    public function __construct(ProductSizeDashboardPresenter $dashboardPresenter)
    {
        $this->dashboardPresenter = $dashboardPresenter;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $productSizes = ProductSize::all();
        return $this->dashboardPresenter->getTablePage($productSizes);
    }

    /**
     * @param int $product_id
     * @return Factory|View
     */
    public function create(int $product_id)
    {
        return $this->dashboardPresenter->getCreatePage($product_id);
    }

    /**
     * @param ProductSizeRequest $request
     * @return RedirectResponse
     */
    public function store(ProductSizeRequest $request): RedirectResponse
    {
        $data = $request->validated();
        ProductSize::create($data);
        return redirect()->route('admin.products.show',$data['product_id']);
    }

    /**
     * @param ProductSize $productSize
     * @return Factory|View
     */
    public function show(ProductSize $productSize)
    {
        return $this->dashboardPresenter->getShowPage($productSize);
    }

    /**
     * @param ProductSize $productSize
     * @return Factory|View
     */
    public function edit(ProductSize $productSize)
    {
        return $this->dashboardPresenter->getEditPage($productSize);
    }

    /**
     * @param ProductSizeUpdateRequest $request
     * @param ProductSize $productSize
     * @return RedirectResponse
     */
    public function update(ProductSizeUpdateRequest $request, ProductSize $productSize): RedirectResponse
    {
        $data = $request->validated();
        $productSize->update($data);
        return redirect()->route('admin.products.show',$data['product_id']);
    }

    /**
     * @param ProductSize $productSize
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(ProductSize $productSize): RedirectResponse
    {
        $id = ProductSize::find($productSize);
        dd($id);
        $productSize->delete();
        return redirect()->route('admin.products.show',$id);
    }
}
