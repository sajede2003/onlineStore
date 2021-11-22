<?php namespace core;

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
    

    // public function __construct(){
    //     try{
    //         $this->pdo = new PDO("{$this->DBType}:host = {$this -> host}; dbname = {$this -> DBName}" , $this->userName , $this-> password);

    //     }catch (\Throwable $e){

    //         echo 'connecting in DB is wrong';

    //     }
    // }

    public function pdo()
    {
        try{
        return new PDO("mysql:host=localhost;dbname=onlinestore", 'root','');

        }catch (\Throwable $e){

            echo 'connecting in DB is wrong';

        }
    }

}
