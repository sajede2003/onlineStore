<?php namespace App\Controllers;

use App\Core\Controller;
use App\Core\Database;
use App\Core\ErrorMessage;
use App\Core\Request;
use App\Core\Validation;
use App\Helper\CreateUserSession;
use App\Models\User;

class UsersController extends Controller
{
    protected User $users;
    protected ErrorMessage $errorMessage;
    protected Validation $validation;
    
    public function __construct()
    {
        $this->users = new User();
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
            'full_name' => 'required|min:8',
            'phone_number' => 'required|phone|length:11|unique:users',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'confirmPassword' => 'required|verify:password',
        ]);
        if ($validation ->valid()) {
            // Hash password
            $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
            if ($this->users->register($_POST)) {
                // redirect to the login
                header('location: /login');
            } else {
                $this->validation->set('confirmPassword' , 'something is wrong. please try again.');
            }
        } else {
            $params = [
                "error" => $this->validation->errors,
            ];
            // show in register view
            $this->setLayout('main');
            return $this->render('auth/register', $params);

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
        $this->setLayout('main');
        return $this->render('auth/register');
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
            if ($this->users->login($_POST)) {
                // redirect to the login
                header('location:/');
                return;
            } else {
                $this->validation->set('password' , 'email or password is incorrect. please try again.');
            }
        }
        $error = $this->validation->errors;

        // show in register view
        $this->setLayout('main');
        return $this->render('auth/login', compact('error'));
    }

        
    /**
     *  render login function and set main view
     *
     * @return void
     */

    public function loginGet()
    {
        $this->setLayout('main');
        return $this->render('auth/login');
    }

    public function logOut()
    {
        CreateUserSession::logOutUser();
    }

}
