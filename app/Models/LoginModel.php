<?php

use App\Core\Database;

class LoginModel{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }
}