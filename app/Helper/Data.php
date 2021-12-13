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
        $PrepareData = substr_replace($PrepareData, "", -1);
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
        $params = join(",", array_map(fn($item) => ":$item", array_keys($data)));
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
    public static function addItem($table, $data)
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
        // dd($data);
        $db = new Database();
        $PrepareData = self::PrepareUpdateData($data);

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
    public static function getUserAndProduct($table, $productId, $userId)
    {
        $db = new Database();

        $db->query("SELECT * FROM {$table} WHERE product_id = :product_id AND user_id = :user_id ");

        $db->bind(':product_id', $productId);
        $db->bind(':user_id', $userId);

        return $db->single();
    }

    /**
     * get by product for like and score function
     *
     * @param [type] $table
     * @param [type] $productId
     * @return void
     */
    public static function getByProduct($table, $productId)
    {

        $db = new Database();

        $n = $db->query("SELECT COUNT(id) as count from {$table} WHERE product_id = :product_id");

        $db->bind(':product_id', $productId);

        return $db->fetch();

    }

    public static function isUserLike($table, $userId, $productId)
    {
        $db = new Database();

        $db->query("SELECT COUNT(user_id) as count FROM {$table} WHERE user_id = :user_id AND product_id = :product_id");
        $db->bind(':user_id', $userId);
        $db->bind(':product_id', $productId);
        return $db->fetch();
    }

    public static function isUserChecked($table, $data)
    {
        // dd($data);
        $db = new Database();

        $db->query("SELECT * FROM {$table}
        WHERE product_id = {$data['product_id']}
        AND user_id = {$data['user_id']}");
        $result = $db->fetch();
// dd(isset($result));
        if (!$result) {
            self::addItem($table, $data);
            return true;
        } else {
            
            self::deleteBookmarkByUserIdAndProductId($table , $data);
            return false;
        }
    }

    public static function deleteByUser($table, $userId, $productId)
    {
        $db = new Database();

        $db->query("DELETE FROM {$table} WHERE user_id = :user_id AND  product_id = :product_id ");
        $db->bind(':user_id', $userId);
        $db->bind(':product_id', $productId);

        $db->execute();
    }

    public static function isUserScore($table, $data)
    {
        $db = new Database();

        $userId = $data['user_id'];
        $productId = $data['product_id'];

        $db->query("SELECT * FROM {$table} WHERE user_id = :user_id AND product_id = :product_id");

        $db->bind(':user_id', $userId);
        $db->bind(':product_id', $productId);

        $result = $db->fetchAll();

        // dd($result);

        if ($result == null) {
            self::addItem($table, $data);
            return true;
        } else {
            self::editScoreByUserIdAndProductId( $data);
            return false;

        }
    }

    public static function groupCommentByParent($productId)
    {
        $db = new Database();

        $db->query(
            "SELECT * FROM   users
                right join comments on  users.id = comments.user_id
                WHERE comments.product_id = $productId "
        );

        $result = $db->fetchAll();

        $array = array();

        foreach ($result as $key => $value) {
            $array[$value['parent_comment']][] = $value;
        }

        return $array;
    }

    public static function avgScore($table, $productId)
    {
        $scores = self::getByProduct($table, $productId);

        $scores = intval($scores);
        $avg = 0;

        $avg += $scores;

        if ($scores == 0) {
            return $avg;
        }

        return $avg / $scores;

    }

    public static function deleteBookmarkByUserIdAndProductId($data)
    {
        $db = new Database;
      
        $db->query("DELETE FROM bookmarks WHERE  product_id = :product_id and user_id = :user_id ");
        $db->bind(':user_id', $data['user_id']);
        $db->bind(':product_id', $data['product_id']);
        $db->execute();
    }

    public static function editScoreByUserIdAndProductId($data)
    {
        $db = new Database;
        $db->query("UPDATE scores SET score = :score WHERE user_id = :user_id and product_id = :product_id");
        $db->bind(':score',$data['score']);
        $db->bind(':user_id', $data['user_id']);
        $db->bind(':product_id', $data['product_id']);
        $db->execute();
    }

    public static function deleteProductByCategoryId($data)
    {
        $db = new Database;

        $db->query("DELETE FROM products WHERE category_id = :category_id");
        $db->bind(':category_id', $data);
        $db->execute();
    }


}
