<?php

namespace App\Http\Controllers\Admin;

use App\Core\StorageManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductImageRequest;
use App\ProductGroup\Product\ProductImage\ProductImage;
use App\ProductGroup\Product\ProductImage\ProductImageDashboardPresenter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
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
        $data['thumb'] = (new StorageManager())
            ->savePicture($request->file('thumb'),'product-image',1000);
        ProductImage::create($data);
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
        (new StorageManager())->deleteFile($productImage->thumb,'product-image');
        $productImage->delete();
        return redirect()->route('admin.products.show',$product_id);
    }
}
