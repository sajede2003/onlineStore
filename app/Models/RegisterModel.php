<?php namespace App\Models;

use App\Core\Database;

class RegisterModel 
{

    // private $db;

    // public function __construct() {
    //     $this->db =  new Database;
    // }


    // public function registerPost($data)
    // {
    //     $this->db->query('INSERT INTO users
    //         VALUES (:firstName , :lastName , :phoneNumber , :email , :password');

    //     // bind values
    //     $this->db->bind(':firstName' , $data['firstName']);
    //     $this->db->bind(':lastName' , $data['lastName']);
    //     $this->db->bind(':phoneNumber' , $data['phoneNumber']);
    //     $this->db->bind(':email' , $data['email']);
    //     $this->db->bind(':password' , $data['password']);

    //     // Execute function
    //     if($this->db->execute()){
    //         return true;
    //     }else return false;
        
    // }


    // // Find user by email. Email is passed in by the controller
    // public function findUserByEmail($email)
    // {
    //     // prepared statement
    //     $this->db->query('SELECT * FROM users WHERE email = :email ');

    //     // Email param will be binded with the email variable
    //     $this->db->bind(':email' , $email);

    //     // check if email is already registered 
    //     if($this->db->rowCount > 0){
    //         return true;
    //     }else return false;
    // }

}