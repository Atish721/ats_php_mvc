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
    public $sqlResult;

    public function __construct()
    {
        try {
            return $this->connection = mysqli_connect($this->host, $this->user, $this->password, $this->database);
        } catch (Exception $e) {
            echo "Database connection Error: " . $e->getMessage();
            die;
        }
    }

    public function realEscapeString($string)
    {
        $string = $this->connection->real_escape_string($string);
        return trim($string);
    }

    public function andWhereClause($whereClause)
    {
        $statement = ' where ';

        foreach ($whereClause as $column => $value) {
            $statement .= (gettype($value) === 'integer') ?  $column . '=' . $this->realEscapeString($value) . ' and ' : $column . '=' . '\'' . $this->realEscapeString($value) . '\' and ';
        }

        return rtrim($statement, ' and ');
    }

    public function orWhereClause($whereClause)
    {
        $statement = ' where ';

        foreach ($whereClause as $column => $value) {

            $statement .= (gettype($value) === 'integer') ? $this->realEscapeString($value) . ' or ' : '\'' . $this->realEscapeString($value) . '\' or ';
        }

        return rtrim($statement, 'or');
    }

    public function runQuery($sqlQuery)
    {
        if(!empty($sqlQuery))
            return mysqli_query($this->connection, $sqlQuery);
        else
            echo mysqli_error($this->connection); die;
    }

    public function resultObject($sqlResult)
    {
        if(!empty($sqlResult))
            return mysqli_fetch_object($sqlResult);
        else
            echo mysqli_error($this->connection); die;
    }

    public function resultAssociative($sqlResult)
    {
        if(!empty($sqlResult))
        {
            $data=[];
            while ($rowData = mysqli_fetch_assoc($sqlResult)) {
                $data[]=$rowData;
            }
            
            return $data;
        }
        else
            echo mysqli_error($this->connection); die;
    }

    public function rawQuery($sqlQuery)
    {
        if(!empty($sqlQuery))
        {
            $sqlResult = $this->runQuery($sqlQuery);
        
            if(preg_match('/^(\s*?)select\s*?.*?\s*?from([\s]|[^;]|([\'"].*[\'"]))*?\s*?$/i', $sqlQuery))
            {
                if($sqlResult->num_rows==1)
                {
                    return $this->resultObject($sqlResult);
                }
                else
                {
                    return $this->resultAssociative($sqlResult);
                }
            }
            else
                return $sqlResult;
        }
        else
            echo mysqli_error($this->connection); die;

    }

    public function insert($table, $arrayData)
    {
        $sqlQuery = 'insert into ' . $table . ' (' . implode(',', array_keys($arrayData)) . ') values(';

        $sqlQuery .= "'" . implode("','", array_values($arrayData)) . "')";

        return $this->connection->query($sqlQuery);
    }

    public function update($table, $arrayData, $whereClause = '')
    {
        $whereStatement = '';

        $sqlQuery = 'update ' . $table . ' set ';
        foreach ($arrayData as $key => $value) {
            $sqlQuery .= $key . ' = \'' . $this->realEscapeString($value) . '\', ';
        }

        $sqlQuery = rtrim($sqlQuery, ', ');

        if (is_array($whereClause)) {
            $whereStatement = $this->andWhereClause($whereClause);
            $sqlQuery = $sqlQuery . $whereStatement;
        }

        return $this->connection->query($sqlQuery);
    }

    public function delete($table, $whereClause = '')
    {
        $whereStatement = '';

        $sqlQuery = 'delete from ' . $table;

        if (is_array($whereClause)) {
            $whereStatement = $this->andWhereClause($whereClause);
            $sqlQuery = $sqlQuery . $whereStatement;
        }

        return $this->connection->query($sqlQuery);
    }

    public function rowCount($table, $whereClause = '')
    {
        $sqlQuery = 'select * from ' . $table;

        if (is_array($whereClause)) {
            $whereStatement = $this->andWhereClause($whereClause);
            $sqlQuery = $sqlQuery . $whereStatement;
        }

        $sqlResult = $this->runQuery($sqlQuery);

        return mysqli_num_rows($sqlResult);
    }

    public function fetchAll($table, $whereClause = '')
    {
        $sqlQuery = 'select * from ' . $table;

        if (is_array($whereClause)) {
            $whereStatement = $this->andWhereClause($whereClause);
            $sqlQuery = $sqlQuery . $whereStatement;
        }
        $sqlResult = $this->runQuery($sqlQuery);
     
        return $this->resultAssociative($sqlResult);
    }


    public function fetch($select, $table, $whereClause = '')
    {
        $sqlQuery = 'select ' . $select . ' from ' . $table;

        if (is_array($whereClause)) {
            $whereStatement = $this->andWhereClause($whereClause);
            $sqlQuery = $sqlQuery . $whereStatement;
        }

        $sqlResult = $this->runQuery($sqlQuery);
        return $this->resultObject($sqlResult);
    }
}