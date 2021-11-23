<?php namespace Controllers;

use Core\Controller;
use Core\Request;
use Models\RegisterModel;

class AuthController extends Controller{

    public function __construct() {
        $this-> setLayout('auth');
    }
    /**
     *  render login function
     *
     * @return void
     */
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