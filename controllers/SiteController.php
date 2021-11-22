<?php namespace controllers;


use core\controller;
use core\Database;

class SiteController extends controller
{

    public function home()
    {
        $params = [
            'name' => "TheCodeholic",
        ];
        return $this->render('home', $params);
    }

    public function contact()
    {
        return $this->render('contact');
    }

    public function table(){
        return $this-> render('table');
    }

    public function handleContact()
    {
        $db = new Database();

        $pdo = $db->pdo();
        
        $data = $_POST;
        
        $sql = "INSERT INTO contact_us (subject , body, email) VALUES (:subject, :body, :email)";
        
        $stmt = $pdo->prepare($sql);
        
        $result=$stmt->execute($data);

        if($result){
            header('Location:/table');
        }
    }

}
