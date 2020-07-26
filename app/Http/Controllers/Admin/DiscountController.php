<?php

namespace App\Http\Controllers\Admin;

use App\Core\StorageManager;
use App\Discount\Discount;
use App\Discount\DiscountDashboardPresenter;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddProductToDiscountRequest;
use App\Http\Requests\DiscountRequest;
use App\Http\Requests\DiscountUpdateRequest;
use App\ProductGroup\Product\Product;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DiscountController extends Controller
{
    /**
     * @var DiscountDashboardPresenter
     */
    private $dashboardPresenter;

    /**
     * DiscountController constructor.
     * @param DiscountDashboardPresenter $dashboardPresenter
     */
    public function __construct(DiscountDashboardPresenter $dashboardPresenter)
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
            $discounts = Discount::where(function ($query) use ($search) {
                $query->where('title', 'like', '%'.$search.'%');
            })->paginate(10);
            $discounts->appends(['search' => $search]);
        } else {
            $discounts = Discount::paginate(10);
        }
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
            ->savePicture($request->file('thumb'), 'discount', 1000);
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
        (new StorageManager())->deleteFile($discount->thumb, 'discount');
        $discount->delete();
        return redirect()->route('admin.discounts.index');
    }

    /**
     * @param int $id
     * @return Application|Factory|View
     */
    public function getAddProduct(int $id)
    {
        return $this->dashboardPresenter->getAddProduct($id);
    }

    /**
     * @param AddProductToDiscountRequest $request
     * @return RedirectResponse
     */
    public function addProduct(AddProductToDiscountRequest $request): RedirectResponse
    {
        Product::find($request->get('product_id'))
            ->update(['discount_id' => $request->get('discount_id')]);
        return redirect()->route('admin.discounts.show',$request->get('discount_id'));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function removeProduct(int $id): RedirectResponse
    {
        $product = Product::find($id);
        $discount = $product->discount_id;
        $product->update(['discount_id' => null]);
        return redirect()->route('admin.discounts.show',$discount);
    }
}
