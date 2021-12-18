<?php namespace App\Models;

use App\Core\Database;
use PDO;

class Model extends Database
{
    protected $table;
    protected $query;
    protected $selectedFields = '*';
    protected $whereClause = [];
    protected $additionalQueries = [];
    protected $joinTable;
    protected $values = [];

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

        return $this->query("INSERT INTO {$this->table} ({$prepareData['fields']}) VALUE ({$prepareData['params']})")
            ->bindValues($data)
            ->execute();

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
        return $this->query("UPDATE {$this->table} SET {$prepareData}")
            ->prepareWhereQuery()
            ->bindValues($data)
            ->execute();
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
        return $this->query("SELECT {$this->selectedFields} FROM {$this->table}")
            ->prepareAdditionalQueries()
            ->prepareWhereQuery()
            ->bindValues()
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * get field query function
     *  "select * from users where id AND name"
     *
     * @return object
     */
    public function first()
    {
        return $this->query("SELECT {$this->selectedFields} FROM {$this->table} ")
            ->prepareWhereQuery()
            ->setLimit(1)
            ->bindValues()
            ->fetch(PDO::FETCH_OBJ);
    }

    // delete : delete
    /**
     * delete field from table function
     *
     * @return void
     */
    public function delete()
    {
        return $this->query("DELETE FROM {$this->table}")
            ->prepareWhereQuery()
            ->bindValues()
            ->execute();
    }

    //Allows us to write queries
    public function query($sql)
    {
        $this->query = $sql;
        return $this;
    }

    public function setLimit($limit)
    {
        $this->query .= " LIMIT $limit";
        return $this;
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
        $originalField = $field;

        if (count($bindField = explode(".", $field)) > 1) {
            $field = $bindField[1];
        }

        $where = [];
        //  id = :id
        $where['query'] = "{$originalField} {$operator} :{$field}";

        // id , 5
        $where['bind'] = ['field' => $field, 'value' => $value];

        $this->whereClause[] = $where;
        return $this;
    }

    /**
     * Undocumented function
     *
     * @param [type] $query
     * @return Model
     */
    public function addQuery($query)
    {
        //  {right join} {joinTable} on {table}.{field} =  {joinTable}.{field}
        $this->additionalQueries[] = $query;
        return $this;
    }

    /**
     * @param array $values
     * @return Model
     */
    protected function prepareWhereQuery()
    {
        if ($this->whereClause) {
            foreach ($this->whereClause as $index => $where) {
                if ($index === 0) {
                    $this->query .= " WHERE";
                }

                if ($index !== 0) {
                    $this->query .= " AND";
                }

                $this->query .= " {$where['query']} ";
                // [:id] [value]
                $this->values[$where['bind']['field']] = $where['bind']['value'];
            }
        }

        return $this;
    }

    public function setTable($tableName)
    {
        $this->table = $tableName;
    }

    public function prepareAdditionalQueries()
    {
        foreach ($this->additionalQueries as $query) {
            $this->query .= " $query ";
        }

        return $this;
    }

    public function bindValues($values = [])
    {
        $this->createStatment();

        if (count($values) > 0) {
            $this->values = array_merge($this->values, $values);
        }

        foreach ($this->values as $key => $value) {
            $this->bind(":{$key}", $value);
        }

        return $this;
    }
}
