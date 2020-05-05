<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Users\User;
use App\Users\UserDashboardPresenter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

    /**
     * @return Factory|View
     */
    public function create()
    {
        return $this->dashboardPresenter->getCreatePage();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'    =>  'required|string|max:255',
            'last_name'     =>  'required|string|max:255',
            'email'         =>  'required|string|email|max:255|unique:users',
            'password'      =>  'required|string|min:6|confirmed',
            'phone'         =>  'required|string|max:255',
            'admin'         =>  'required|boolean'
        ]);
        $user = User::create($validator->validated());
        return redirect()->route('admin.users.index');
    }
    public function show(User $user)
    {
        return $this->dashboardPresenter->getShowPage($user);
    }
    public function edit(User $user)
    {
        return $this->dashboardPresenter->getEditPage($user);
    }
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'first_name'    =>  'required|string|max:255',
            'last_name'     =>  'required|string|max:255',
            'email'         =>  'required|string|email|max:255',
            'phone'         =>  'required|string|max:255',
            'admin'         =>  'required|boolean'
        ]);
        $user->update($validator->validated());
        return redirect()->route('admin.users.index');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
