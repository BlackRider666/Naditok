<?php

namespace App\Http\Controllers\Admin;

use App\Category\Category;
use App\Category\CategoryDashboardPresenter;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class CategoryController extends Controller
{

    private $dashboardPresenter;

    /**
     * UsersController constructor.
     * @param CategoryDashboardPresenter $dashboardPresenter
     */
    public function __construct(CategoryDashboardPresenter $dashboardPresenter)
    {
        $this->dashboardPresenter = $dashboardPresenter;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $categories = Category::all();
        return $this->dashboardPresenter->getTablePage($categories);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return $this->dashboardPresenter->getCreatePage();
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->validated());
        return redirect()->route('admin.categories.index');
    }
    public function show(Category $category)
    {
        return $this->dashboardPresenter->getShowPage($category);
    }
    public function edit(Category $category)
    {
        return $this->dashboardPresenter->getEditPage($category);
    }
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        return redirect()->route('admin.categories.index');
    }
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
