<?php namespace App\Helper;

use App\Core\Database;

class Data
{
    /**
     * get data from inputs function
     *
     * @param [type] $table
     * @return void
     */
    public static function getData($table)
    {

        $db = new Database();

        $db->query("SELECT * FROM {$table}");
        return $db->resultSet();
    }

    /**
     * get old data from table function
     *
     * @param [type] $table
     * @param [type] $id
     * @return void
     */
    public static function getOldData($table, $id)
    {
        $db = new Database();

        $db->query("SELECT * FROM {$table} WHERE id = :id");
        $db->bind(':id', $id);
        return $db->resultSet();
    }

    /**
     * dynamic prepare data function
     *
     * @param array $data
     * @return void
     */
    public static function PrepareData(array $data)
    {
        $PrepareData = "";

        foreach ($data as $key => $value) {
            $PrepareData .= " {$key} = :{$key},";
        }
        //remove last char(,)
        $PrepareData = substr_replace($PrepareData, "" , -1);
        return $PrepareData;
    }

    /**
     * edit items in table function
     *
     * @param [type] $table
     * @param [type] $data
     * @return void
     */
    public static function editItem($table, $data)
    {
        $db = new Database();

        $PrepareData =self::PrepareData($data);

        $db->query("UPDATE {$table} SET {$PrepareData} WHERE id = :id");

        foreach ($data as $key => $value) {
            $db->bind(":{$key}", $value);
        }
        

        return $db->execute();

    }

    /**
     * delete items from table function
     *
     * @param [type] $table
     * @param [type] $id
     * @return void
     */
    public static function deleteItem($table, $id)
    {
        $db = new Database;

        $db->query("DELETE FROM {$table} WHERE id = :id");
        $db->bind(':id', $id);
        $db->execute();
    }

}
