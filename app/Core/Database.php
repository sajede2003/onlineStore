<?php namespace App\Core;

use Exception;
use pdo;

/**
 * connecting  class
 */
class Database
{
    // DB type
    public $DBType = 'mysql';
    // DB name
    public $DBName = 'onlinestore';
    // DB host
    public $host = 'localhost';
    // DB user name
    public $userName = 'root';
    // DB password
    public $password = '';

    private $statement;
    private $dbHandler;
    private $error;

    public function pdo()
    {
        try {
            $pdo = new PDO($this->DBType . ":host=" . $this->host . ";
            dbname=" . $this->DBName,
                $this->userName,
                $this->password);
            return $pdo;

        } catch (Exception $e) {

            $this->error = $e->getMessage();
            echo $this->error;

        }
    }

    //Allows us to write queries
    public function query($sql)
    {
        $this->statement = $this->pdo()->prepare($sql);
    }

//     //Bind values
    public function bind($parameter, $value, $type = null)
    {
        switch (is_null($type)) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
            default:
                $type = PDO::PARAM_STR;
        }
        $this->statement->bindValue($parameter, $value, $type);
    }

//     //Execute the prepared statement
    public function execute()
    {
        return $this->statement->execute();
    }

//     //Return an array
    public function resultSet()
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

//     //Return a specific row as an object
    public function single()
    {
        $this->execute();
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

//     //Get's the row count
    public function rowCount()
    {
        return $this->statement->rowCount();
    }
}
