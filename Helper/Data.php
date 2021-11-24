<?php namespace Helper;

use Core\Database;


class Data{

    public static function getData($table)
    {
        
        $db = new Database();

        $pdo = $db->pdo();
         
        
        $query = $pdo -> prepare("SELECT * FROM $table");
        $query ->execute();
        $fetch = $query -> fetchAll();
        return $fetch;
    }


}