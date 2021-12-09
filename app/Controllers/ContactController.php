<?php namespace App\Controllers;

use App\Core\Controller;
use App\Core\Validation;
use App\Core\Request;
use App\Models\ContactModel;

class ContactController extends Controller{

    protected Validation $validation;
    protected ContactModel $contactModel;

    public function __construct() {
        $this->validation = new Validation();
        $this-> contactModel = new ContactModel();
    }


    public function contactPost()
    {
        // trim inputs
        $_POST = array_map('trim' , $_POST);

        $validation = $this->validation->make($_POST , [
            'subject' => 'required',
            'email' => 'required',
            'comment' => 'required|min:50'
        ]);


        if($validation -> valid()){
            if($this->contactModel->handleContact()){
                header("Location:/");
            }else{
                $this->validation->set('comment','something is wrong. please try again');
            }
        }else{
            $params = [
                "error"=>$this->validation->errors
            ];

            return $this->render('contact' ,$params);
        }



    }

    public function contactGet(Request $request)
    {

        $params = [
            "error"=>$this->validation->errors
        ];
        return $this->render('contact' , $params);
    }



}



