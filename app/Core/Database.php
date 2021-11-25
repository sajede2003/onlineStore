<?php namespace App\Core;

use pdo;
/**
 * connecting  class
 */
class Database{
    // DB type
    public $DBType= 'mysql' ;
    // DB name
    public $DBName = 'onlinestore';
    // DB host
    public $host = 'localhost';
    // DB user name
    public $userName = 'root';
    // DB password
    public $password = '';
    

    public function pdo()
    {
        try{
        return new PDO("mysql:host=localhost;dbname=onlinestore", 'root','');

        }catch (\Throwable $e){

            echo 'connecting in DB is wrong';

        }
    }

}
