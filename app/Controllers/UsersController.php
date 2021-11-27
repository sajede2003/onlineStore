<?php namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;



class UsersController extends Controller{

    public function __construct() {
        $model = $this->userModel = $this->renderModel('RegisterModel');
    }



    /**
     * render register function and set main view
     *
     * @param Request $request
     * @return void
     */
    public function registerGet (Request $request){
    

        $params=[
            'data' => [
                'firstName' => '', 
                'lastName' =>'', 
                'phoneNumber' => '', 
                'email' => '',
                'password' =>'',
                'confirmPassword' =>'',
                'phoneNumberError' => '',
                'emailError' => '',
                'passwordError' => '' ,
                'confirmPasswordError' => ''
            ]
        ];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $_POST = filter_input_array(INPUT_POST , FILTER_SANITIZE_STRING);

            $inputData = [
                'firstName' => trim($params['data']['firstName']), 
                'lastName' => trim($params['data']['lastName']), 
                'phoneNumber' => trim($params['data']['phoneNumber']), 
                'email' => trim($params['data']['email']),
                'password' => trim($params['data']['password']),
                'confirmPassword' => trim($params['data']['confirmPassword']),
                'phoneNumberError' => '',
                'emailError' => '',
                'passwordError' => '' ,
                'confirmPasswordError' => ''
                
            ];

            $numberValidation = "/^[0-9]*$/";
            $passwordValidation = "/^(.{0,7} | [^a-z]*[^\d]*)$/i";


            // validation phoneNumbers
            if(empty($inputData['phoneNumber'])){
                $inputData['phoneNumberError'] = 'please enter phoneNumber';
            }elseif(!preg_match($numberValidation , $inputData['phoneNumber'])){
                $inputData['phoneNumberError'] = 'phoneNumber can only contain number';
            }elseif(strlen($inputData['phoneNumber'] < 11)){
                $inputData['phoneNumberError'] = 'phoneNumber must be at least 11 characters.';
            }
            dd($inputData['phoneNumberError']);

            
            // validation email
            if(empty($inputData['email'])){
                $inputData['emailError'] = 'please enter your email';
            }elseif(!filter_var($inputData['email'] , FILTER_VALIDATE_EMAIL)){
                $inputData['emailError'] = 'please enter the correct format';
            }else{
                // check if email exists
                if($this->userModel->findUserByEmail($inputData['email'])){
                    $inputData['emailError'] = 'Email is already taken.';
                }
            }

            // validate password on length and numeric value
            if (empty($inputData['password'])){
                $inputData['passwordError'] = 'please enter password.';
            }elseif(strlen($inputData['password'] < 6)){
                $inputData['passwordError'] = 'password must be at least 8 characters.';
            }elseif(!preg_match($passwordValidation , $inputData['password'])){
                $inputData['passwordError'] = 'password must have at least one numeric value.';
            }

            //validation confirm password
            if (empty($inputData['confirmPassword'])){
                $inputData['confirmPasswordError'] = 'please enter password.';
            }elseif($inputData['password'] != $inputData['confirmPassword']){
                $inputData['confirmPasswordError'] = 'passwords do not match, please try again.';
            } 
            
            
            // errors is empty?
            if(empty($inputData['phoneNumberError'] && 
                $inputData['emailError'] &&
                $inputData['passwordError'] && 
                $inputData['confirmPasswordError'] ))
            {
                // Hash password
                $inputData['password'] = password_hash($inputData['password'],PASSWORD_DEFAULT);

                // register user from model function
                if($this->userModel->register($inputData)){
                    // redirect to the login
                    header('location:'.$this->renderModel('RegisterModel'));
                }else die('something went wrong');

            }



        }


        $this->setLayout('main');
        return $this -> render('register' , $params);
    }



    /**
     *  render login function and set main view
     *
     * @return void
     */

    public function loginGet(){

        $params = [
            'data' => [
                'usernameError' => '',
                'passwordError' => ''
            ]
        ];


        $this-> setLayout('main');
        return $this -> render('login' , $params);
    }
    


}