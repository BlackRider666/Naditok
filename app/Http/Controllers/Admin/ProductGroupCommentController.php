<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\ProductGroup\ProductGroupComment\ProductGroupComment;
use App\ProductGroup\ProductGroupComment\ProductGroupCommentDashboardPresenter;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductGroupCommentController extends Controller
{
    private $dashboardPresenter;

    /**
     * UsersController constructor.
     * @param ProductGroupCommentDashboardPresenter $dashboardPresenter
     */
    public function __construct(ProductGroupCommentDashboardPresenter $dashboardPresenter)
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
            $productGroupComments = ProductGroupComment::where(function ($query) use ($search) {
                $query->where('author', 'like', '%'.$search.'%');
            })->paginate(10);
            $productGroupComments->appends(['search' => $search]);
        } else {
            $productGroupComments = ProductGroupComment::paginate(10);
        }
        return $this->dashboardPresenter->getTablePage($productGroupComments);
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return $this->dashboardPresenter->getCreatePage();
    }

    /**
     * @param CommentRequest $request
     * @return RedirectResponse
     */
    public function store(CommentRequest $request): RedirectResponse
    {
        $data = $request->validated();
        ProductGroupComment::create($data);
        return redirect()->route('admin.comments.index');
    }

    /**
     * @param ProductGroupComment $comment
     * @return Factory|View
     */
    public function show(ProductGroupComment $comment)
    {
        return $this->dashboardPresenter->getShowPage($comment);
    }

    /**
     * @param ProductGroupComment $comment
     * @return Factory|View
     */
    public function edit(ProductGroupComment $comment)
    {
        return $this->dashboardPresenter->getEditPage($comment);
    }

    /**
     * @param CommentUpdateRequest $request
     * @param ProductGroupComment $comment
     * @return RedirectResponse
     */
    public function update(CommentUpdateRequest $request, ProductGroupComment $comment): RedirectResponse
    {
        $data = $request->validated();
        $comment->update($data);
        return redirect()->route('admin.comments.index');
    }

    /**
     * @param ProductGroupComment $comment
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(ProductGroupComment $comment): RedirectResponse
    {
        $comment->delete();
        return redirect()->route('admin.comments.index');
    }
}
