<?php


namespace App\Users;

use App\Core\DashboardPresenter;
use Illuminate\Pagination\LengthAwarePaginator;

class UserDashboardPresenter
{
    public function getTablePage(LengthAwarePaginator $users)
    {
        $headers = [
            'first_name' => 'First name',
            'last_name' =>  'Last name',
            'email'     =>  'Email',
        ];
        $name = 'users';
        return (new DashboardPresenter())->getTablePage($headers, $name, $users);
    }

    public function getShowPage(User $user)
    {
        $header = $user->fullname;
        $fields = [
            'first_name'    =>  'First Name',
            'last_name'     =>  'Last Name',
            'email'         =>  'Email',
        ];
        return (new DashboardPresenter())->getShowPage($header, $user, $fields);
    }

    public function getCreatePage()
    {
        $casts = (new User)->getCasts();
        unset($casts['id']);
        $name = 'users';
        return (new DashboardPresenter())->getCreatePage($casts,$name);
    }

    public function getEditPage(User $user)
    {
        $name = 'users';
        $fields = [
            'first_name',
            'last_name',
            'email',
            'phone',
            'admin',
            'avatar'
        ];
        return (new DashboardPresenter())->getEditPage($user,$name,$fields);
    }
}
