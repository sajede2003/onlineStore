<?php namespace App\Models;

use App\Core\Database;

class ContactModel{
private $db;
    public function __construct() {
        $this->db = new Database;
    }

    public function handleContact()
    {
        $db = new Database();

        $pdo = $db->pdo();
        
        $data = $_POST;
        
        $sql = "INSERT INTO contact_us (subject , body, email) 
            VALUES (:subject, :body, :email)";
        
        $stmt = $pdo->prepare($sql);
        
        $result=$stmt->execute($data);

        if($result){
            header('Location:/table');
        }

    }
}