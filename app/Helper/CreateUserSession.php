<?php namespace App\Helper;

class CreateUserSession{
    public static function MakeSession($sessionName , $sessionValue)
    {
        $_SESSION[$sessionName] = $sessionValue;
    }

    public static function validUserLogin(){
        if (!isset($_SESSION['IsLogin'])|| $_SESSION['IsLogin'] == false) {
            header('Location: /login');
            return false;
        }

        return true;
    }

    public static function loginUserSession($user)
    {
        self::MakeSession('user' , $user->id);
        self::MakeSession('IsLogin' , true);

    }
}