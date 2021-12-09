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
     * dynamic prepare Update data function
     *
     * @param array $data
     * @return void
     */
    public static function PrepareUpdateData(array $data)
    {
        $PrepareData = "";

        foreach ($data as $key => $value) {
            $PrepareData .= " {$key} = :{$key},";
        }
        //remove last char(,)
        $PrepareData = substr_replace($PrepareData, "" , -1);
        return $PrepareData;
    }

    public static function PrepareInsertData(array $data)
    {
        $DataArray = [];
        $fields = join(",", array_keys($data));
        $DataArray['fields'] = $fields;
        $params = join(",", array_map(fn ($item) => ":$item", array_keys($data)));
        $DataArray['params'] = $params;
        return $DataArray;
    }

    /**
     * add item in table function
     *
     * @param [type] $table
     * @param [type] $data
     * @return void
     */
    public static function addItem($table , $data)
    {
        $db = new Database();
        $PrepareData = self::PrepareInsertData(($data));
        $db->query("INSERT INTO {$table} ({$PrepareData['fields']}) VALUES ({$PrepareData['params']})");
        
        foreach ($data as $key => $value) {
           $db->bind(":{$key}", $value);
        }

        return $db->execute();
        
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

        $PrepareData =self::PrepareUpdateData($data);

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
