<?php namespace App\Helper;

use App\Core\Database;
use App\Models\User;
use PDO;
class IsAdmin{
    /**
     * check user is admin or not function
     *
     * @return void
     */
    public static function checkUser()
    {

        $userIdSession = $_SESSION['user'];

        $user = new User();
        $user = $user->where('id' , $userIdSession)->first();
        
        if($user->is_admin == 0)
            header('Location:/');
    }
}