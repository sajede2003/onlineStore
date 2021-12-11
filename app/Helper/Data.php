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
     * dynamic prepare for Update data function
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
    
    /**
     * dynamic prepare for insert data function
     *
     * @param array $data
     * @return void
     */
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
        //    dd($data);
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


    /**
     * Undocumented function
     *
     * @param [type] $table
     * @param [type] $userId
     * @param [type] $productId
     * @return void
     */
    public static function getUserAndProduct($table , $productId , $userId)
    {
        $db =new Database();

        $db->query("SELECT * FROM {$table} WHERE product_id = :product_id AND user_id = :user_id ");

        $db->bind(':product_id' , $productId);
        $db->bind(':user_id' , $userId);

        return $db->single();
    }


    /**
     * get by product for like and score function
     *
     * @param [type] $table
     * @param [type] $productId
     * @return void
     */
    public static function getByProduct($table , $productId)
    {
        
        $db = new Database();

        $n = $db->query("SELECT COUNT(id) from {$table} WHERE product_id = :product_id");

        // dd($n);

        $db->bind(':product_id' , $productId);

        return $db->fetch();

    }

    public static function isUserLike($table , $userId , $productId)
    {
        $db = new Database();


        $db->query("SELECT COUNT(user_id) as count FROM {$table} WHERE user_id = :user_id AND product_id = :product_id");
        $db->bind(':user_id' , $userId);
        $db->bind(':product_id' , $productId);
        return $db->fetch();
    }

    public static function deleteByUser($table , $userId , $productId)
    {
        $db = new Database();

        $db->query("DELETE FROM {$table} WHERE user_id = :user_id AND  product_id = :product_id ");
        $db->bind(':user_id' , $userId);
        $db->bind(':product_id' , $productId);

        $db->execute();
    }



    public static function groupCommentByParent($productId)
    {
        $db = new Database();

        $b =$db->query(
            "SELECT * FROM comments
            -- RIGHT JOIN comment on  users.id = comment.user_id 
            WHERE product_id = {$productId} "
        );
        // $db->bind(':product_id' , $productId);

        $result = $db->resultSet();



        // dd($result);


        $array = array();

        foreach ($result as $key => $value) {
            $array[$value['parent_comment']][] = $value;
        }
        return $array;
    }

    public static function avgScore($table , $productId)
    {
        $scores = self::getByProduct($table , $productId);

        $avg = 0 ;

        foreach ($scores as $item ) {
            $avg += $item['value'];
        }

        if(count($scores) == 0)
            return $avg ;


        return $avg / count($scores);
    }



}
