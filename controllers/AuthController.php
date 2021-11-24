<?php namespace Controllers;

use Core\Controller;
use Core\Request;
use Models\RegisterModel;

class AuthController extends Controller{
/**
 * show main view function
 */
    // public function __construct()
    // {
    //     $this->setLayout('auth');
    // }

    /**
     *  render login function and set main view
     *
     * @return void
     */
    public function login(){
        $this-> setLayout('main');
        return $this -> render('login');
    }

    public function registerPost(Request $request){

        $registerModel = new RegisterModel();
     

            $registerModel -> loadData($request->getBody());
           

            if($registerModel -> validation() && $registerModel -> register()){
                return 'Success';
            }

            dd($registerModel->errors);

            return $this -> render('register' , [
                'model' => $registerModel
            ]);
    }
        

    public function registerGet (Request $request){

        $this->setLayout('main');
        return $this -> render('register');
    }
}