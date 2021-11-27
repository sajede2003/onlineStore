<?php namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Validation;
use App\Models\RegisterModel;

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
        $validation = new Validation();
     
        $validation -> loadData($request->getBody());
           

        if($registerModel -> validate() && $registerModel -> register()){
            // go in dashboard page
            return 'Success';
        }
        // dd($registerModel -> errors);
        return $this -> render('register' , [
            'model' => $registerModel
        ]);
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