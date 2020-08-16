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
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $search =  trim($request->input('search'));
        if ($search!="") {
            $productSizes = ProductSize::where(function ($query) use ($search) {
                $query->where('size', 'like', '%'.$search.'%');
            })->paginate(10);
            $productSizes->appends(['search' => $search]);
        } else {
            $productSizes = ProductSize::paginate(10);
        }
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
     * @param int $id
     * @return Factory|View
     */
    public function show(int $id)
    {
        $productSize = ProductSize::find($id);
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
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        $productSize = ProductSize::find($id);
        $product_id = $productSize->product->getKey();
        $productSize->delete();
        return redirect()->route('admin.products.show',$product_id);
    }
}
