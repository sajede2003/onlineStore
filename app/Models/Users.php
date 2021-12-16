<?php namespace App\Models;

use App\Helper\CreateUserSession;
use App\Models\Model;

class Users extends Model
{
    protected $table = 'users';

    // register

    public function register($data)
    {
        unset($data['confirmPassword']);
        $result = $this->create($data);

        if ($result) {
            return true;
        }

    }

    // login

    /**
     * check Equal password and email function
     *
     * @param [type] $data
     * @return object
     */
    public function login($data)
    {
        $email = $data['email'];
        $user = $this->where('email', $email)->first();

        $hashedPassword = $user->password;

        if (password_verify($data['password'], $hashedPassword)) {
            CreateUserSession::loginUserSession($user);
            header('location:/');
        } else {
            return false;
        }

    }

    // Find user by email. Email is passed in by the controller
    public function checkExists($table, $field, $col)
    {
        $item = $this->where($field, $col)->get();
        return count($item);
    }


    public function groupCommentByParent($productId)
    {
        $comments = $this
            ->addQuery("right join comments on  users.id = comments.user_id")
            ->where('comments.product_id' , $productId)
            ->get();


        $array = array();

        foreach ($comments as $key => $value) {
            $array[$value['parent_comment']][] = $value;
        }

        return $array;

    }



}
