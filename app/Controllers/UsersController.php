<?php namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Core\Request;
use App\Models\LoginModel;
use App\Models\RegisterModel;
use App\Core\ErrorMessage;
use App\Core\Validation;

class UsersController extends Controller
{
    private $db;
    protected RegisterModel $registerModel;
    protected LoginModel $loginModel;
    protected ErrorMessage $errorMessage;
    protected Validation $validation;
    public function __construct()
    {
        $this->registerModel = new RegisterModel();
        $this->loginModel = new LoginModel();
        $this->errorMessage = new ErrorMessage();
        $this->db = new Database();
        $this->validation = new Validation();


    }

    /**
     * controller register page function
     *
     * @param [type] $data
     * @return void
     */

    public function registerPost()
    {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $_POST = array_map('trim' , $_POST);




        $result = $this->validation->make($_POST, [
            'firstName' => 'required',
            'lastName' => 'required',
            // |phone|min:11
            'phoneNumber' => 'required | length',
            'email' => 'required',
            'password' => 'required'
        ]);
        if($result) { 
            //   Hash password
            //   $inputData['password'] = password_hash($inputData['password'], PASSWORD_DEFAULT);

            //   register user from model function
              if ($this->registerModel->register($_POST)) {
                //   redirect to the login
                  header('location:/login');
              } else {
                  die('something went wrong');
              }
        } else {
            $params = [
                "error" => $this->validation,
            ];

            // dd($this->validation->errors);


            $this->setLayout('main');
            return $this->render('register', $params);
        }
        // }

        // $numberValidation = "/^09|011[0-9]*$/";

        // validation phoneNumbers
        // if (empty($inputData['phoneNumber'])) {
        //     $this->errorMessage->set('phoneNumber' , 'please enter phoneNumber');
        // } elseif (!preg_match($numberValidation, $inputData['phoneNumber'])) {
        //     $inputData['phoneNumberError'] = 'phoneNumber can only contain number';
        // } elseif (strlen($inputData['phoneNumber'] < 11)) {
        //     $inputData['phoneNumberError'] = 'phoneNumber must be at least 11 characters.';
        // }

    //     // validation email
    //     if (empty($inputData['email'])) {
    //        $this->errorMessage->set('email' , 'please enter email');
    //     } elseif ($this->errorMessage->validateEmail('email')=== 0) {
    //         $inputData['emailError'] = 'please enter the correct format';
    //     } else {
    //         // check if email exists
    //         if ($this->registerModel->findUserByEmail($inputData['email'])) {
    //             $inputData['emailError'] = 'Email is already taken.';
    //         }
    //     }

    //     // validate password on length and numeric value
    //     if (empty($inputData['password'])) {
    //         $this->errorMessage->set('password' , 'please enter password');
    //     } elseif (strlen($inputData['password'] < 8)) {
    //         $inputData['passwordError'] = 'password must be at least 8 characters.';
    //     }

    //     //validation confirm password
    //     if (empty($inputData['confirmPassword'])) {
    //         $this->errorMessage->set('confirmPassword' , 'please enter confirm password.');
    //     } elseif ($inputData['password'] != $inputData['confirmPassword']) {
    //         $inputData['confirmPasswordError'] = 'passwords do not match, please try again.';
    //     }


    //     // errors is empty?
    //     if ($this->errorMessage->count() <= 0) {
    //         // Hash password
    //         $inputData['password'] = password_hash($inputData['password'], PASSWORD_DEFAULT);

    //         // register user from model function
    //         if ($this->registerModel->register($inputData)) {
    //             // redirect to the login
    //             header('location:/login');
    //         } else {
    //             die('something went wrong');
    //         }

    //     }

    //     $params = [
    //         "error" => $this->errorMessage,
    //     ];

    //     $this->setLayout('main');
    //     return $this->render('register', $params);

    }

    /**
     * render register function and set main view
     *
     * @param Request $request
     * @return void
     */

    public function registerGet(Request $request)
    {

        $params = [
            "error" => $this->errorMessage,

        ];

        $this->setLayout('main');
        return $this->render('register', $params);
    }


    /**
     *
     * login controller
     *
     */

    public function loginPost()
    {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $inputData = [
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'emailError' => '',
            'passwordError' => '',
        ];

        // validation email
        if (empty($inputData['email'])) {
            $inputData['emailError'] = 'please enter your email';
        } elseif (!filter_var($inputData['email'], FILTER_VALIDATE_EMAIL)) {
            $inputData['emailError'] = 'please enter the correct format';
        }else {
            // check if email exists
            if ($this->registerModel->findUserByEmail($inputData['email'])) {
                $inputData['emailError'] = 'Email is already taken.';
            }
        }

        // validate password on length and numeric value
        if (empty($inputData['password'])) {
            $inputData['passwordError'] = 'please enter password.';
        } elseif (strlen($inputData['password'] < 8)) {
            $inputData['passwordError'] = 'password must be at least 8 characters.';
        }

        // check if all errors are empty
        if (!empty($inputData['email']) && !empty($inputData['password'])) {
            $loggedInUser = $this->loginModel->login($inputData['email'], $inputData['password']);

            if ($loggedInUser) {
                $this->createUserSession($loggedInUser);
            } else {
                $inputData['passwordError'] = 'email or password is incorrect. please try again.';
            }

        }
            $params = [
                "inputData" => $inputData,
            ];

    
            $this->setLayout('main');
            return $this->render('login', $params);
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['email'] = $user->email;
        $_SESSION['password'] = $user->password;
    }

    /**
     *  render login function and set main view
     *
     * @return void
     */

    public function loginGet()
    {

        $params = [
            'inputData' => [
                'email' => '',
                'password' => '',
                'emailError' => '',
                'passwordError' => '',
            ],
        ];

        $this->setLayout('main');
        return $this->render('login', $params);
    }

}
