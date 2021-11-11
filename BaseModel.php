<?php

class BaseModel {
    
    protected $db;

    function __construct()
    {
        $this->db = Database::getInstance(MYSQL_HOST, MYSQL_DATABASE, MYSQL_USERNAME, MYSQL_PASSWORD);
    }
}