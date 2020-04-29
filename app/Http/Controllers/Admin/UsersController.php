<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Users\User;
use App\Users\UserDashboardPresenter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{
    /**
     * @var UserDashboardPresenter
     */
    private $dashboardPresenter;

    /**
     * UsersController constructor.
     * @param UserDashboardPresenter $dashboardPresenter
     */
    public function __construct(UserDashboardPresenter $dashboardPresenter)
    {
        $this->dashboardPresenter = $dashboardPresenter;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $users = User::all();
        return $this->dashboardPresenter->getTablePage($users);
    }
    public function show(int $id)
    {
        $user = User::find($id);

        return $this->dashboardPresenter->getShowpage($user);
    }
    public function destroy(int $id)
    {
        return redirect()->route('admin.users');
    }
}
