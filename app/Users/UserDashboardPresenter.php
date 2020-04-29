<?php


namespace App\Users;


use App\Core\DashboardPresenter;
use Illuminate\Database\Eloquent\Collection;

class UserDashboardPresenter
{
    public function getTablePage(Collection $users)
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
}
