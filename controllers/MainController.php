<?php namespace Controllers;

use Core\Controller;
use Core\Request;
use Models\RegisterModel;

class MainController extends Controller{


    /**
     *  render login function and set main view
     *
     * @return void
     */
    public function login(){
        $this-> setLayout('main');
        return $this -> render('login');
    }


    /**
     * 
     * control register page
     * 
     */

    public function registerPost(Request $request){

        $registerModel = new RegisterModel();
     
        if($request -> isPost()){
            $registerModel -> loadData($request->getBody());
           

            if($registerModel -> validation() && $registerModel -> register()){
                return 'Success';
            }
            return $this -> render('register' , [
                'model' => $registerModel
            ]);
        }
    }
        
    /**
     * render register function and set main view
     *
     * @param Request $request
     * @return void
     */
    public function registerGet (Request $request){

        $this->setLayout('main');
        return $this -> render('register');
    }
}