<?php namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Core\ErrorMessage;
use App\Core\Request;
use App\Core\Validation;
use App\Models\LoginModel;
use App\Models\RegisterModel;

class UsersController extends Controller
{
    protected RegisterModel $registerModel;
    protected LoginModel $loginModel;
    protected ErrorMessage $errorMessage;
    protected Validation $validation;
    
    public function __construct()
    {
        $this->registerModel = new RegisterModel();
        $this->loginModel = new LoginModel();
        $this->errorMessage = new ErrorMessage();
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
        // trim inputs
        $_POST = array_map('trim', $_POST);
        // set rules for inputs
        $validation = $this->validation->make($_POST, [
            'firstName' => 'required|min:3',
            'lastName' => 'required',
            'phoneNumber' => 'required|phone|length:10|unique:users',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|verify:password',
        ]);
        if ($validation ->valid()) {
            // Hash password
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            if ($this->registerModel->register($_POST)) {
                // redirect to the login
                header('location:/login');
            } else {
                $this->validation->set('confirmPassword' , 'something is wrong. please try again.');
            }
        } else {
            $params = [
                "error" => $this->validation->errors,
            ];
            // show in register view
            $this->setLayout('main');
            return $this->render('register', $params);

        }
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
            "error" => $this->validation->errors,
        ];

        $this->setLayout('main');
        return $this->render('register');
    }

    /**
     * login controller
     */

    public function loginPost()
    {
        $_POST = array_map('trim', $_POST);

        // set rules for inputs
        $validation = $this->validation->make($_POST, [
            'email' => 'required',
            'password' => 'required|min:8'
        ]);


        if ($validation->valid()) {
            // register user from model function
            if ($this->loginModel->login($_POST)) {
                // redirect to the login
                header('location:/');
                return;
            } else {
                $this->validation->set('password' , 'email or password is incorrect. please try again.');
            }
        }


            $params = [
                "error" => $this->validation->errors,
            ];

            // show in register view
            $this->setLayout('main');
            return $this->render('login', $params);
    }

        
    /**
     *  render login function and set main view
     *
     * @return void
     */

    public function loginGet()
    {

        $this->setLayout('main');
        return $this->render('login');
    }


}
