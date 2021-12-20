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

        $userIdSession = session()->get('user');

        $user = new User();
        $user = $user->where('id' , $userIdSession)->first();
      
        if($user->is_admin == 0){
            session()->flash('message' , "you're not admin");
            return redirect('/');
        }
           
    }
}