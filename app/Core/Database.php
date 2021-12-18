<?php namespace App\Core;

use Exception;
use PDO;

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
    private $error;
    protected $pdo;


    public function __construct() {
        try {
            $this->pdo = new PDO($this->DBType . ":host=" . $this->host . ";
            dbname=" . $this->DBName,
                $this->userName,
                $this->password);
        } catch (Exception $e) {

            $this->error = $e->getMessage();
            die($this->error);

        }
    }


    public function prepare()
    {
        $this->statement = $this->pdo->prepare($this->query);
    }

    public function createStatment()
    {
        $this->prepare();
    }

    //Bind values
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


    //Return a specific row
    public function fetch($type = null)
    {
        $this->execute();
        return $this->statement->fetch($type);
    }

    // PDO::FETCH_ASSOC
    public function fetchAll($type)
    {
        $this->execute();
        return $this->statement->fetchAll($type);
    }

     //Get's the row count
    public function rowCount()
    {
        return $this->statement->rowCount();
    }

    public function PrepareInsertData(array $data)
    {
        $DataArray = [];
        $fields = join(",", array_keys($data));
        $DataArray['fields'] = $fields;
        $params = join(",", array_map(fn($item) => ":$item", array_keys($data)));
        $DataArray['params'] = $params;
        return $DataArray;
    }

    public function PrepareUpdateData(array $data)
    {
        $PrepareData = "";

        foreach ($data as $key => $value) {
            $PrepareData .= " {$key} = :{$key},";
        }
        //remove last char(,)
        $PrepareData = substr_replace($PrepareData, "", -1);
        return $PrepareData;
    }
}
