<?php

namespace App\Http\Controllers\Admin;

use App\Core\StorageManager;
use App\Http\Controllers\Controller;
use App\Users\User;
use App\Users\UserDashboardPresenter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $search =  trim($request->input('search'));
        if ($search!="") {
            $users = User::where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%'.$search.'%')
                    ->orWhere('last_name', 'like', '%'.$search.'%');
            })->paginate(10);
            $users->appends(['search' => $search]);
        } else {
            $users = User::paginate(10);
        }
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
            'admin'         =>  'required|boolean',
            'avatar'        =>  'image',
        ]);
        $data = $validator->validated();
        if($request->file('avatar'))
        {
            $data['avatar'] = (new StorageManager())
                ->savePicture($request->file('avatar'),'user_avatar',400);
        }
        $data['password'] = Hash::make($data['password']);
        User::create($data);
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
            'admin'         =>  'required|boolean',
            'avatar'        =>  'image',
        ]);
        $data = $validator->validated();
        if($request->file('avatar'))
        {
            if ($user->avatar !== null) {
                (new StorageManager())->deleteFile($user->avatar,'user_avatar');
            }
            $data['avatar'] = (new StorageManager())
                ->savePicture($request->file('avatar'),'user_avatar',400);
        }
        $user->update($data);
        return redirect()->route('admin.users.index');
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
