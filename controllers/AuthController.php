<?php namespace controllers;

use core\controller;
use core\Request;
use models\RegisterModel;

class AuthController extends controller{
    public function login(){
        $this-> setLayout('auth');
        return $this -> render('login');
    }

    public function register (Request $request){

        if($request-> isPost()){
            
            $registerModel = new RegisterModel();

            var_dump($request->getBody());
            die;
            return 'Handel submitted data';
        }
        return $this -> render('register');
    }
}