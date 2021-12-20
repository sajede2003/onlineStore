<?php  namespace App\Helper;


class Auth
{
    public function check()
    {
    
        return session()->has('is_login')
                ? session()->get('is_login')
                : false;
    }
}