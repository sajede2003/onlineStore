<?php namespace App\Models;

use App\Core\Database;
use PDO;

class Model extends Database 
{
    protected $table;
    protected $query;
    protected $selectedFields = '*';
    protected $whereClause = [];

    // create : insert
    /**
     * insert data in db function
     *
     * @param [type] $data
     * @return void
     */
    public function create($data)
    {
        $prepareData = $this->PrepareInsertData($data);
        $this->query("INSERT INTO {$this->table} ({$prepareData['fields']}) VALUE ({$prepareData['params']})");

        foreach ($data as $key => $value) {
            $this->bind(":{$key}" , $value);
        }
        return $this->execute();

    }

    // update : update
    /**
     * update data in db function
     *
     * @param [type] $data
     * @return void
     */
    public function update($data)
    {
        $prepareData = $this->PrepareUpdateData($data);
        $this->query("UPDATE {$this->table} SET {$prepareData}");

        $values = [];
        $values = $this->prepareWhereQuery($values);

        foreach ($data as $key => $value) {
            $this->bind(":{$key}", $value);
        }
    
        return $this->execute();
    }

    // get : select 
    /**
     * select in get query function
     * select "id , name , email" from users
     *
     * @param array $fields
     * @return object
     */
    public function select(array $fields)
    {
        $this->selectedFields = implode(',', $fields);
        return $this;
    }

    /**
     * get field query function
     *  "select * from users where id AND name"
     * 
     * @return array
     */
    public function get()
    {
        $q = $this->query = "SELECT {$this->selectedFields} FROM {$this->table}";
        $values = [];

        $values = $this->prepareWhereQuery($values);


        $statement = $this->pdo->prepare($this->query);

        foreach ($values as $key => $value) {
            $statement->bindValue(":{$key}", $value);
        }


        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

       /**
     * get field query function
     *  "select * from users where id AND name"
     * 
     * @return object
     */
    public function first()
    {
        $this->query = "SELECT {$this->selectedFields} FROM {$this->table} ";
        $values = [];

        $values = $this->prepareWhereQuery($values);

        $this->query .= " LIMIT 1";

        $statement = $this->pdo->prepare($this->query);

        foreach ($values as $key => $value) {
            $statement->bindValue(":{$key}", $value);
        }

        $statement->execute();
        return $statement->fetch(PDO::FETCH_OBJ);
    }

    // delete : delete
    /**
     * delete field from table function
     *
     * @return void
     */
    public function delete()
    {
        $this->query("DELETE FROM {$this->table}");

        $values = [];
        $values = $this->prepareWhereQuery($values);

        return $this->execute();
    }


    /**
     * Undocumented function
     *
     * @param [type] $field
     * @param [type] $value
     * @param string $operator
     * @return Model
     */
     public function where($field, $value, $operator = "=")
     {
         $where = [];
         $where['query'] = "{$field} {$operator} :{$field}";
 
         $where['bind'] = ['field' => $field, 'value' => $value];
 
         $this->whereClause[] = $where;
         return $this;
     }

        /**
     * @param array $values
     * @return array
     */
    protected function prepareWhereQuery(array $values)
    {
        if ($this->whereClause) {
            foreach ($this->whereClause as $index => $where) {
                if ($index === 0) {
                    $this->query .= " Where";
                }

                if ($index !== 0) {
                    $this->query .= " AND";
                }

                $this->query .= " {$where['query']} ";
                $values[$where['bind']['field']] = $where['bind']['value'];
            }
        }
        return $values;
    }
}