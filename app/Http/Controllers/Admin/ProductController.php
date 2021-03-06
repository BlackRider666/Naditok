<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductToDiscountRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\ProductGroup\Product\Product;
use App\ProductGroup\Product\ProductDashboardPresenter;
use Exception;
use Illuminate\Contracts\Foundation\Application;
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
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $search =  trim($request->input('search'));
        if ($search!="") {
            $products = Product::where(function ($query) use ($search) {
                $query->where('title', 'like', '%'.$search.'%');
            })->paginate(10);
            $products->appends(['search' => $search]);
        } else {
            $products = Product::paginate(10);
        }
        return $this->dashboardPresenter->getTablePage($products);
    }

    /**
     * @param int $product_group_id
     * @return Factory|View
     */
    public function create(int $product_group_id)
    {
        return $this->dashboardPresenter->getCreatePage($product_group_id);
    }

    /**
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $product = Product::create($data);
        return redirect()->route('admin.product-groups.show',$product->product_group_id);
    }

    /**
     * @param int $id
     * @return Factory|View
     */
    public function show(int $id)
    {
        $product = Product::find($id);
        return $this->dashboardPresenter->getShowPage($product);
    }

    /**
     * @param int $id
     * @return Factory|View
     */
    public function edit(int $id)
    {
        $product = Product::find($id);
        return $this->dashboardPresenter->getEditPage($product);
    }

    /**
     * @param ProductUpdateRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(ProductUpdateRequest $request, int $id): RedirectResponse
    {
        $product = Product::find($id);
        $data = $request->validated();
        $product->update($data);
        return redirect()->route('admin.product-groups.show',$product->product_group_id);
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


    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function getAddDiscountToProduct(int $id)
    {
        return $this->dashboardPresenter->addDiscount($id);
    }

    public function addDiscount(AddProductToDiscountRequest $request)
    {
        Product::find($request->get('product_id'))
            ->update(['discount_id' => $request->get('discount_id')]);
        return redirect()->route('admin.products.show',$request->get('product_id'));
    }

    public function removeDiscount(int $id)
    {
        Product::find($id)
            ->update(['discount_id' => null]);
        return redirect()->route('admin.products.show',$id);
    }
}
