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
        self::MakeSession('user_fullName' , $user->full_name);
        self::MakeSession('user' , $user->id);
        self::MakeSession('IsLogin' , true);

    }

    public static function logOutUser()
    {
        // dd($_SESSION);
        if(isset($_SESSION['IsLogin'])||$_SESSION['IsLogin']==true){
            session_destroy();
            header("Location:/");
            return true;
        }
    }

    public static function cartSession()
    {
        return isset($_SESSION['cart'])? $_SESSION['cart'] : $_SESSION['cart'] = [] ;
    }
}


isset($_SESSION['user_fullName'])?$_SESSION['user_fullName']:$_SESSION['user_fullName'] = null;

isset($_SESSION['cart'])? $_SESSION['cart'] : $_SESSION['cart'] = [] ;
