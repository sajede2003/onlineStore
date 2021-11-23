<?php namespace Controllers;


use Core\Controller;
use Core\Database;

class SiteController extends Controller
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

        $db = new Database();

        $pdo = $db->pdo();
                
        $query = $pdo -> prepare("SELECT * FROM contact_us");
        $query ->execute();
        $fetch = $query -> fetchAll();
        
        $params = [
            'fetch' =>  $fetch ,
        ];
        
        return $this-> render('table', $params);
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
