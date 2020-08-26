<?php

namespace App\Http\Controllers\Admin;

use App\Category\CategoryImport\CategoryImportDashboardPresenter;
use App\Category\CategoryImport\CategoryImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryImportRequest;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ImportCategoryController extends Controller
{

    private $dashboardPresenter;

    /**
     * UsersController constructor.
     * @param CategoryImportDashboardPresenter $dashboardPresenter
     */
    public function __construct(CategoryImportDashboardPresenter $dashboardPresenter)
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
            $categories = CategoryImport::whereHas('category',function ($query) use ($search) {
                $query->where('title_ru', 'like', '%'.$search.'%');
                $query->orWhere('title_ua', 'like', '%'.$search.'%');
            })->paginate(10);
            $categories->appends(['search' => $search]);
        } else {
            $categories = CategoryImport::paginate(10);
        }
        return $this->dashboardPresenter->getTablePage($categories);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return $this->dashboardPresenter->getCreatePage();
    }

    /**
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryImportRequest $request): RedirectResponse
    {
        $data = $request->validated();
        CategoryImport::create($data);
        return redirect()->route('admin.import-category.index');
    }
}
