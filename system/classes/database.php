<?php

/**
 * @package		ATS PHP MVC
 * @author		Atish Chandole
 * @since       31 May 2021
 */

class database
{
    public $host     = HOST;
    public $user     = USER;
    public $database = DATABASE;
    public $password = PASSWORD;
    public $connection;
    public $result;

    public function __construct()
    {

        try {
            return $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        } catch (Exception $e) {
            echo "Database connection Error: " . $e->getMessage();
            die;
        }
    }

    public function andWhereClause($whereClause)
    {

        $statement = ' where ';

        foreach ($whereClause as $column => $value) {
            $statement .= (gettype($value) === 'integer') ?  $column . '=' . $value . ' and ' : $column . '=' . '\'' . $value . '\' and ';
        }

        return rtrim($statement, ' and ');
    }

    public function orWhereClause($whereClause)
    {
        $statement = ' where ';

        foreach ($whereClause as $column => $value) {

            $statement .= (gettype($value) === 'integer') ? $value . ' or ' : '\'' . $value . '\' or ';
        }

        return rtrim($statement, 'or');
    }

    public function query($qry)
    {
        $result = mysqli_query($this->connection, $qry);
        $row = mysqli_fetch_assoc($result);
        if ($row) {

            $data = array();
            while ($rowData = mysqli_fetch_assoc($row)) {
                $data[] = $rowData;
            }

            return $data;
        } else {
            echo mysqli_error($this->connection);
            die;
        }
    }

    public function insert($table, $arrayData)
    {

        $sql = 'insert into ' . $table . ' (' . implode(',', array_keys($arrayData)) . ') values(';

        $sql .= "'" . implode("','", array_values($arrayData)) . "')";

        return $this->connection->query($sql);
    }

    public function update($table, $arrayData, $whereClause = '')
    {

        $whereStatement = '';

        $sql = 'update ' . $table . ' set ';
        foreach ($arrayData as $key => $value) {
            $sql .= $key . ' = \'' . $value . '\', ';
        }

        $sql = rtrim($sql, ', ');

        if (is_array($whereClause)) {
            $whereStatement = $this->andWhereClause($whereClause);
            $sql = $sql . $whereStatement;
        }

        return $this->connection->query($sql);
    }

    public function delete($table, $whereClause = '')
    {
        $whereStatement = '';

        $sql = 'delete from ' . $table;

        if (is_array($whereClause)) {
            $whereStatement = $this->andWhereClause($whereClause);
            $sql = $sql . $whereStatement;
        }

        return $this->connection->query($sql);
    }



    public function rowCount($table, $whereClause = '')
    {

        $sql = 'select * from ' . $table;

        if (is_array($whereClause)) {
            $whereStatement = $this->andWhereClause($whereClause);
            $sql = $sql . $whereStatement;
        }

        $result = mysqli_query($this->connection, $sql);

        return mysqli_num_rows($result);
    }

    public function fetchAll($table, $whereClause = '')
    {

        $sql = 'select * from ' . $table;

        if (is_array($whereClause)) {
            $whereStatement = $this->andWhereClause($whereClause);
            $sql = $sql . $whereStatement;
        }
        $result = mysqli_query($this->connection, $sql);
        $rows = array();
        while ($rowData = mysqli_fetch_assoc($result)) {
            $rows[] = $rowData;
        }

        return $rows;
    }


    public function fetch($select, $table, $whereClause = '')
    {

        $sql = 'select ' . $select . ' from ' . $table;

        if (is_array($whereClause)) {
            $whereStatement = $this->andWhereClause($whereClause);
            $sql = $sql . $whereStatement;
        }

        $result = mysqli_query($this->connection, $sql);
        return mysqli_fetch_object($result);
    }
}
