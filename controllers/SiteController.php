<?php namespace controllers;

// use core\Application;
// use core\BaseRepository;
use core\controller;
use core\Database;
use core\Request;
use PDO;

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

    public function handleContact(Request $request)
    {
        $db = new Database();
        $pdo = $db->pdo();
        $data = $_POST;
        $sql = "INSERT INTO contact_us (subject , body, email) VALUES (:subject, :body, :email)";
        $stmt = $pdo->prepare($sql);
        $result=$stmt->execute($data);

        if($result){
            header('location:/table');
        }
    }

}
