<?php
use App\Helper\Session;
use App\Helper\Auth;
use App\Models\User;

function dd($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die;
} 


function redirect($path){
    header("Location:{$path}");
}

function session(){
    return new Session();
}


function user()
{
    if(session()->has('user')) {
        $userId = session()->get('user');
        $user = new User();
        return $user->where('id' , $userId)->first();
    }

    return null;
}

function auth()
{
    return new Auth();
}


