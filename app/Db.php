<?php

class Db {
    
    private $host = "localhost";
    private $dbname = "simple_chat";
    private $username = "root";
    private $password = "";
    protected $connection;

    public function __construct(){
        
        try{
            $this->connection = new PDO("mysql:host=". $this->host . ";dbname=" . $this->dbname, $this->username, $this->password );
            // echo "CONNECTED !";
        } catch(Exception $e){
            echo "CONNECTION FAILED -> " . $e->getMessage();
        }
    }

    public function get_connection(){
        if ($this->connection instanceof PDO){
            return $this->connection;
        }
    }

}