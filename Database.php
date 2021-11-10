<?php

class Database{	

    private $connection = null;

    private static $_instance;

    public static function getInstance( $dbhost = "localhost", $dbname = "myDataBaseName", $username = "root", $password    = "") 
    {
        if(!self::$_instance) { // If no instance then make one
            self::$_instance = new self( $dbhost, $dbname, $username, $password);
        }
        return self::$_instance;
    }

    // this function is called everytime this class is instantiated		
    private function __construct( $dbhost = "localhost", $dbname = "myDataBaseName", $username = "root", $password    = "")
    {
        try{
            $this->connection = new mysqli($dbhost, $username, $password, $dbname);
            if( mysqli_connect_errno() ){
                throw new Exception("Could not connect to database.");   
            }
        }catch(Exception $e){
            throw new Exception($e->getMessage());   
        }			
    }

    // Insert a row/s in a Database Table
    public function Insert( $query = "" , $params = [] )
    {
        try{
            $stmt = $this->executeStatement( $query , $params );
            $stmt->close();
            return $this->connection->insert_id;
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
        return false;
    }

    // Select a row/s in a Database Table
    public function Select( $query = "" , $params = [] )
    {
        try{
            $stmt = $this->executeStatement( $query , $params );
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);				
            $stmt->close();
            return $result;
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
        return false;
    }

    // Update a row/s in a Database Table
    public function Update( $query = "" , $params = [] )
    {
        try{
            $this->executeStatement( $query , $params )->close();
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
        return false;
    }		

    // Remove a row/s in a Database Table
    public function Delete( $query = "" , $params = [] )
    {
        try{
            $this->executeStatement( $query , $params )->close();
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }
        return false;
    }		

    // execute statement
    private function executeStatement( $query = "" , $params = [] )
    {
        try{
            $stmt = $this->connection->prepare( $query );
            if($stmt === false) {
                throw New Exception("Unable to do prepared statement: " . $query);
            }
            if( $params ){
                call_user_func_array(array($stmt, 'bind_param'), $params );				
            }
            $stmt->execute();
            return $stmt;
        }catch(Exception $e){
            throw New Exception( $e->getMessage() );
        }

    }

}