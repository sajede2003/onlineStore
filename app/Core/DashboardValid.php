<?php namespace App\Core;

use App\Helper\CreateUserSession;
use App\Helper\IsAdmin;

class DashboardValid
{
    public static function checkAdminUser()
    {
        if(CreateUserSession::validUserLogin())
            IsAdmin::checkUser();
    }
}
