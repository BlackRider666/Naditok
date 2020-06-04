<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImageRequest;
use App\ProductGroup\Product\ProductImage\ProductImage;
use App\ProductGroup\Product\ProductImage\ProductImageDashboardPresenter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductPhotoController extends Controller
{
    /**
     * @var ProductImageDashboardPresenter
     */
    private $dashboardPresenter;

    public function __construct(ProductImageDashboardPresenter $dashboardPresenter)
    {
        $this->dashboardPresenter = $dashboardPresenter;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $productSizes = ProductImage::all();
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
     * @param ProductImageRequest $request
     * @return RedirectResponse
     */
    public function store(ProductImageRequest $request): RedirectResponse
    {
        $data = $request->validated();
        ProductImage::create($data);
        return redirect()->route('admin.products.show',$data['product_id']);
    }

    /**
     * @param ProductImage $productImage
     * @return Factory|View
     */
    public function show(ProductImage $productImage)
    {
        return $this->dashboardPresenter->getShowPage($productImage);
    }

    /**
     * @param ProductImage $productImage
     * @return Factory|View
     */
    public function edit(ProductImage $productImage)
    {
        return $this->dashboardPresenter->getEditPage($productImage);
    }

    /**
     * @param ProductImageRequest $request
     * @param ProductImage $productImage
     * @return RedirectResponse
     */
    public function update(ProductImageRequest $request, ProductImage $productImage): RedirectResponse
    {
        $data = $request->validated();
        $productImage->update($data);
        return redirect()->route('admin.products.show',$data['product_id']);
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $productImage = ProductImage::find($id);
        $product_id = $productImage->product->getKey();
        $productImage->delete();
        return redirect()->route('admin.products.show',$product_id);
    }
}
