<?php namespace App\Core;

use App\Helper\IsAdmin;

class DashboardValid
{
    public static function checkAdminUser()
    {
        
        if (auth()->check())
            IsAdmin::checkUser();            
        else
            return redirect('/');
    }
}
