<?php

namespace App\Http\Controllers\Admin;

use App\Brand\Brand;
use App\Brand\BrandDashboardPresenter;
use App\Core\StorageManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Requests\BrandUpdateRequest;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrandController extends Controller
{
    /**
     * @var BrandDashboardPresenter
     */
    private $dashboardPresenter;

    public function __construct(BrandDashboardPresenter $dashboardPresenter)
    {
        $this->dashboardPresenter = $dashboardPresenter;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $brands = Brand::all();
        return $this->dashboardPresenter->getTablePage($brands);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return $this->dashboardPresenter->getCreatePage();
    }

    /**
     * @param BrandRequest $request
     * @return RedirectResponse
     */
    public function store(BrandRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['thumb'] = (new StorageManager())
            ->savePicture($request->file('thumb'),'brand',1000);
        Brand::create($data);
        return redirect()->route('admin.brands.index');
    }

    /**
     * @param Brand $brand
     * @return Factory|View
     */
    public function show(Brand $brand)
    {
        return $this->dashboardPresenter->getShowPage($brand);
    }

    /**
     * @param Brand $brand
     * @return Factory|View
     */
    public function edit(Brand $brand)
    {
        return $this->dashboardPresenter->getEditPage($brand);
    }

    /**
     * @param BrandUpdateRequest $request
     * @param Brand $brand
     * @return RedirectResponse
     */
    public function update(BrandUpdateRequest $request, Brand $brand): RedirectResponse
    {
        $data = $request->validated();
        if(array_key_exists('thumb',$data))
        {
            (new StorageManager())->deleteFile($brand->thumb,'brand');
            $data['thumb'] = (new StorageManager())
                ->savePicture($request->file('thumb'),'brand',1000);
        }
        $brand->update($data);
        return redirect()->route('admin.brands.index');
    }

    /**
     * @param Brand $brand
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Brand $brand): RedirectResponse
    {
        (new StorageManager())->deleteFile($brand->thumb,'brand');
        $brand->delete();
        return redirect()->route('admin.brands.index');
    }
}
