<?php

namespace App\Http\Controllers\Admin;

use App\Category\Category;
use App\Category\CategoryDashboardPresenter;
use App\Core\StorageManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
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

    /**
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['thumb'] = (new StorageManager())
            ->savePicture($request->file('thumb'),'category',1000);
        Category::create($data);
        return redirect()->route('admin.categories.index');
    }

    /**
     * @param Category $category
     * @return Factory|View
     */
    public function show(Category $category)
    {
        return $this->dashboardPresenter->getShowPage($category);
    }

    /**
     * @param Category $category
     * @return Factory|View
     */
    public function edit(Category $category)
    {
        return $this->dashboardPresenter->getEditPage($category);
    }

    /**
     * @param CategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());
        return redirect()->route('admin.categories.index');
    }

    /**
     * @param Category $category
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Category $category): RedirectResponse
    {
        (new StorageManager())->deleteFile($category->thumb,'category');
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
