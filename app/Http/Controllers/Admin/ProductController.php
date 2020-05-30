<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\ProductGroup\Product\Product;
use App\ProductGroup\Product\ProductDashboardPresenter;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    private $dashboardPresenter;

    /**
     * UsersController constructor.
     * @param ProductDashboardPresenter $dashboardPresenter
     */
    public function __construct(ProductDashboardPresenter $dashboardPresenter)
    {
        $this->dashboardPresenter = $dashboardPresenter;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $products = Product::all();
        return $this->dashboardPresenter->getTablePage($products);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return $this->dashboardPresenter->getCreatePage();
    }

    /**
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Product::create($data);
        return redirect()->route('admin.products.index');
    }

    /**
     * @param Product $product
     * @return Factory|View
     */
    public function show(Product $product)
    {
        return $this->dashboardPresenter->getShowPage($product);
    }

    /**
     * @param Product $product
     * @return Factory|View
     */
    public function edit(Product $product)
    {
        return $this->dashboardPresenter->getEditPage($product);
    }

    /**
     * @param ProductUpdateRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $data = $request->validated();
        $product->update($data);
        return redirect()->route('admin.products.index');
    }

    /**
     * @param Product $product
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
        return redirect()->route('admin.products.index');
    }
}
