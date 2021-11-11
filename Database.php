<?php

class Database {

    private $connection = NULL;

    private static $_instance;

    public static function getInstance($dbhost = "localhost", $dbname = "myDataBaseName", $username = "root", $password    = "") 
    {
        if(!self::$_instance)
            self::$_instance = new self($dbhost, $dbname, $username, $password);

        return self::$_instance;
    }

    private function __construct($dbhost = "localhost", $dbname = "myDataBaseName", $username = "root", $password    = "")
    {
        $this->connection = new mysqli($dbhost, $username, $password, $dbname);
        if($this->connection->connect_error)
            throw new Exception('Could not connect to database ' . $this->connection->connect_errno . ': ' . $this->connection->connect_error, $this->connection->connect_errno);
    }

    public function _execute($sql, $params = [])
    {
        try {
            $stmt = $this->_prepare($sql);
            if(count($params))
                call_user_func_array(array($stmt, 'bind_param'), $params);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        } catch (\Throwable $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function fetch($sql, $params = [])
    {
        try {
            $stmt = $this->_prepare($sql);
            if(count($params))
                call_user_func_array(array($stmt, 'bind_param'), $params);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $result;
        } catch (\Throwable $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    public function fetchAll($sql, $params = [])
    {
        try {
            $stmt = $this->_prepare($sql);
            if(count($params))
                call_user_func_array(array($stmt, 'bind_param'), $params);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            return $result;
        } catch (\Throwable $ex) {
            throw new Exception($ex->getMessage());
        }
    }

    private function _prepare($sql)
    {
        $stmt = $this->connection->prepare($sql);
        if($stmt === false)
            throw new Exception("Unable to do prepared statement: " . $sql);
        
        return $stmt;
    }

    public function close()
    {
        $this->connection->close();
    }

    public function __destruct()
    {
        $this->close();
    }
}