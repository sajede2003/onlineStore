<?php namespace App\Models;

use App\Core\Database;

class RegisterModel
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function register($data)
    {
        // dd($data);
        $this->db->query("INSERT INTO users (firstName , lastName , phoneNumber , email , password)
        VALUES (:firstName , :lastName , :phoneNumber , :email , :password)");
        // bind values
        $this->db->bind(':firstName', $data['firstName']);
        $this->db->bind(':lastName', $data['lastName']);
        $this->db->bind(':phoneNumber', $data['phoneNumber']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Execute function
        if ($this->db->execute()) 
            return true;
        else
            return false;

    }


    // Find user by email. Email is passed in by the controller
    public function checkExists($table ,$field , $col)
    {
        // prepared statement
        $this->db->query("SELECT * FROM {$table} WHERE {$field} = :{$field} ");

        // Email param will be binded with the email variable
        $this->db->bind(":{$field}" , $col);

        // execute and checked email and phone number is existed or not.
        if ($this->db->execute()) {
            if ($this->db->rowCount() > 0) 
                return true;
            else
                return false;
        }

    }

}